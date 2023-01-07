<?php

namespace smartedutech\smaes\component\rules;

use smartedutech\smaes\component\variables\Variable;

class Evaluation
{
    private string $_condition;
    private bool $_output;
    public function __construct()
    {
    }

    /**
     * Summary of doEval
     *This function get a JSON file as a @param string $file extract from it Rules and conditions
     * and @return array<array> (exp : [RuleType] => ( [result] => rule result , [condition] => rule condition))
     * @param string $file
     * @return array<array>|null
     */
    public function doEval(string $file)
    {
        $obj = array();
        $binds = array();
        $data = json_decode(file_get_contents($file));
        $rules = $data->Rules;
        foreach ($rules as $key => $value) {
            foreach ($value as $propKey => $propValue) {
                if ($propValue->Rule_Type != null) {
                    $rule = RulesFactory::getRule($propValue->Rule_Type);
                    $result = $rule->evaluate();
                    $title = $propValue->title;
                    $type = $propValue->Rule_Type;
                    foreach ($propValue as $pk => $pv) {
                        if (!empty($pv) && is_object($pv)) {
                            foreach ($pv as $k => $v) {
                                if ($k === 'Condition' && $v != null) {
                                    $condition = $v;
                                }
                                if ($k === 'output' && $v != null) {
                                    $output = $v;

                                    foreach ($output as $outKey => $outVal) {

                                        $obj[] = ["title" => $title, "type" => $type, "result" => $result, "condition" => $condition, "output" => $outKey, "binds" => []];

                                        foreach ($outVal as $bind) {
                                            foreach ($bind as $varName => $newData) {
                                                $binds[] = ["title" => $title, "output" => $outKey, "bind" => ["varNameToRefac" => $varName, "newData" => $newData]];
                                            }
                                        }
                                    }
                                }
                            }
                        }

                    }
                }
            }
        }

        $res = $this->getRuleBinds($binds);
        $result = [];
        foreach ($obj as $element => $value) {
            $title = $value["title"];
            $output = $value["output"];
            $key = "$title - $output";
            foreach ($res as $elementres => $valueres) {
                if ($elementres === $key) {
                    $value["binds"][] = $valueres;
                    $result[] = $value;
                }
            }
        }

        return $this->getOutputBinds($result);

    }

    /**
     * Summary of getOutputBinds
     * this function insert binds of the same rule in the same array :
     * [0=>binds for the test condition = true , and false => for test condition = false]
     * @param mixed $result
     * @return array
     */
    public function getOutputBinds($result)
    {

        for ($i = 0; $i < count($result); $i++) {
            if (!empty($result[$i + 1]) && $result[$i]["title"] === $result[$i + 1]["title"] && is_array($result[$i])) {
                $result[$i]["binds"] = [$result[$i]["output"] => $result[$i]["binds"], $result[$i + 1]["output"] => $result[$i + 1]["binds"]];
                unset($result[$i]["output"], $result[$i + 1]);
                $result = array_values($result); //réindexe le tableau pour éviter les trous dans les indices
            } else if (!empty($result[$i + 1]) && $result[$i]["title"] != $result[$i + 1]["title"] && is_array($result[$i + 1])) {
                $result[$i]["binds"] = [$result[$i]["output"] => $result[$i]["binds"]];
                unset($result[$i]["output"]);
                $result = array_values($result);
            } else if (!isset($result[$i + 1]) && $result[$i]["title"] != $result[$i - 1]["title"] && is_array($result[$i - 1])) {
                $result[$i]["binds"] = [$result[$i]["output"] => $result[$i]["binds"]];
                unset($result[$i]["output"]);
                $result = array_values($result);
            }
        }
        return $result;

    }

    /**
     * Summary of getRuleBinds
     * this function return [ruleName - outputCondition] = [binds to do]
     * @param mixed $binds
     * @return array
     */
    public function getRuleBinds($binds)
    {
        $combinedBinds = array();

        for ($i = 0; $i < count($binds); $i++) {
            $title = $binds[$i]["title"];
            $output = $binds[$i]["output"];
            $key = "$title - $output";
            $bind = $binds[$i]["bind"];

            if (isset($binds[$i + 1]) && !empty($binds[$i + 1]["title"]) && $title === $binds[$i + 1]["title"] && $output === $binds[$i + 1]["output"]) {
                $combinedBinds[$key][] = array_diff($bind, $binds[$i + 1]["bind"]);
            } else {
                $combinedBinds[$key][] = $bind;
            }
        }

        return $combinedBinds;
    }
    /**
     * Summary of getMarksNames
     * function returns array of input_variables names from the JSON file
     * @param string $file
     * @return array
     */
    public function getMarksNames(string $file)
    {
        $data = json_decode(file_get_contents($file));
        foreach ($data->input_variables as $mnKey => $mnValue) {
            $allMarkNames[] = $mnKey;
        }
        return $allMarkNames;
    }

    /**
     * Summary of insertArrayIntoJSON
     * This function get inputMark from user, markNames from the jsonFile and add each input in the right mark value
     * in the JSON file
     * @param mixed $inputMark
     * @param array $mrkn
     * @param string $file
     * @return array<string>
     */
    public function insertArrayIntoJSON(mixed $inputMark, array $mrkn, string $file)
    {
        $res = [];
        $data = json_decode(file_get_contents($file));

        foreach ($mrkn as $i => $mv) {
            if (array_key_exists($mv, $inputMark)) {
                $mk = $mv;
                $var = new Variable($data->input_variables->$mv->type);
                if ($var->verifyTypeValue($inputMark[$mk])) {
                    $data->input_variables->$mv->value = $inputMark[$mk];
                    file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                    $res[] = "done mark $mv added successfully";
                } else {
                    $res[] = "oops $mv can not be added please check your input type";
                }
            }
        }
        return $res;
    }

    /**
     * Summary of getInputsVariablesValuesFromJSON
     * This function returns array of names' marks and their values from the JSON file
     * @param string $file
     * @return array<array>
     */
    public function getInputsVariablesValuesFromJSON(string $file)
    {
        $data = json_decode(file_get_contents($file));
        foreach ($data->input_variables as $mnKey => $mnVal) {
            $allMarkNames[] = ["$mnKey" => $mnVal->value];

        }
        return $allMarkNames;
    }
    /**
     * Summary of getTestConditions
     * this function returns an array of eval conditions
     * @param mixed $conditions
     * @param mixed $data
     * @param mixed $file
     * @return array<string>
     */
    public function getTestConditions($condition, $data, string $file)
    {
        $res = [];

        $allMarkNames = $this->getMarksNames($file);
        foreach ($allMarkNames as $markName) {
            if (str_contains($condition, $markName)) {
                $dataExist = $data->input_variables->$markName->value;
                $specificCondition = str_ireplace("@$markName", "$dataExist", $condition);
                $test = eval("return $specificCondition;");
                $converted_test = $test ? 'true' : 'false';
                $res[$condition] = $converted_test;
            }
        }

        return $res;
    }
    /**
     * Summary of evalConditionsFromJSON
     * this functions treat all rule conditions from the JSON file
     * @param string $file
     * @return array|null|string
     */
    public function evalConditionsFromJSON(string $file)
    {
        $mrkn = [];
        $inputs = [];
        $dataArray = $this->doEval($file);
        $data = json_decode(file_get_contents($file));
        foreach ($dataArray as $rule) {
            $this->_condition = $rule["condition"]; // $rule["condition"] condition dans le fichier => doeval tab final
            $res = $this->getTestConditions($this->_condition, $data, $file); //resultat de la condition
            foreach ($res as $r => $rv) { //$r = condtion $rv = result de condition
                if ($r === $this->_condition) {
                    foreach ($rule["binds"] as $bindkey => $bindValue) {
                        if ($bindkey === $rv) {
                            foreach ($bindValue as $value) {
                                foreach ($value as $v) {
                                    $pos = strpos($v["varNameToRefac"], '@');
                                    if ($pos !== false) {
                                        $v["varNameToRefac"] = substr_replace($v["varNameToRefac"], '', $pos, 1);
                                    }
                                    //check if string has {} so its a method to triggre
                                    $check = (strpos($v["newData"], '{') !== false || strpos($v["newData"], '}') !== false) ? true : false;
                                    //call us of the method
                                    $use = "use smartedutech\\smaes\\methods\\Methods;";
                                    //replace @Vars with their values from json file
                                    $ifFunction = $this->replaceFunctionVars($v["newData"], $file);
                                    //if string has {} so we will evaluate a method / else we will return the normal value
                                    $resF = $check ? eval("$use; return $ifFunction;") : $v["newData"];
                                    //we're getting bool values as strings so we return it with their real type
                                    $convertedMarkValueInput = $v["newData"] === "false" ? false : ($v["newData"] === "true" ? true : $resF);
                                    //mrkn[] is an array with the inputvariables to change in the json file
                                    $mrkn[] = $v["varNameToRefac"];
                                    //inputs is an array with the value of each new inputvariables for the json file
                                    $inputs[] = $convertedMarkValueInput;
                                }
                            }
                        }
                    }
                }
            }
        }

        // Créez un tableau associatif à partir des tableaux $mrkn et $inputs
        $inputMark = array_combine($mrkn, $inputs);
        return $this->insertArrayIntoJSON($inputMark, $mrkn, $file);
    }

    /**
     * Summary of replaceFunctionVars
     * this function get the method in the json ex : method::sum(@tp,@ds) and replace @tp and @ds with their values
     * from the json
     * and returns method::sum(valueTP,valueDS)
     * @param string $data
     * @param string $file
     * @return array|string
     */
    public function replaceFunctionVars(string $data, string $file)
    {
        $variables = [];
        $datajson = json_decode(file_get_contents($file));

        // extract the variables from the string using a regular expression
        preg_match_all('/@([A-Za-z]+)/', $data, $matches);

        // add the variables to the array
        foreach ($matches[1] as $variable) {
            $variables[] = $variable;
        }

        // replace the variables in the string with "FOUND"
        foreach ($variables as $var) {
            $data = str_replace("@$var", $datajson->input_variables->$var->value, $data);
        }

        // return the modified string
        return $data;
    }

}
