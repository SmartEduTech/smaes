<?php

namespace smartedutech\smaes\component\rules;

use smartedutech\smaes\component\variables\Variable;

class Evaluation
{
    private string $_condition;
    private string $_output;
    public function __construct()
    {}

    /**
     * Summary of doEval
     * This function get a JSON file as a @param string $file extract from it Rules and conditions
     * and @return array<array> (exp : [RuleType] => ( [result] => rule result , [condition] => rule condition))
     */
    public function doEval(string $file)
    {
        $ruleTypes = array();
        $conditions = array();
        $data = json_decode(file_get_contents($file));
        $rules = $data->Rules;
        foreach ($rules as $key => $value) {
            foreach ($value as $propKey => $propValue) {
                if ($propValue->Rule_Type != null) {
                    $r = RulesFactory::getRule($propValue->Rule_Type)->evaluate();
                    $ruleTypes[] = ["type" => $propValue->Rule_Type, "result" => $r];
                    foreach ($propValue as $pk => $pv) {
                        if (!empty($pv) && is_object($pv)) {
                            foreach ($pv as $k => $v) {
                                if ($k === 'Condition' && $v != null) {
                                    $this->_condition = $v;
                                    $conditions[] = ["type" => $propValue->Rule_Type, "condition" => $this->_condition];
                                    $obj = array();
                                    for ($i = 0; $i < count($ruleTypes); $i++) {
                                        if ($ruleTypes[$i]["type"] === $conditions[$i]["type"]) {
                                            $obj[$ruleTypes[$i]["type"]] = ["result" => $ruleTypes[$i]["result"], "condition" => $conditions[$i]["condition"]];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $obj;
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

        foreach ($mrkn as $mk => $mv) {
            $var = new Variable($data->input_variables->$mv->type);
            if ($var->verifyTypeValue($inputMark[$mk])) {
                $data->input_variables->$mv->value = $inputMark[$mk];
                file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                $res[] = "done tableau";
            } else {
                $res[] = "oops tableau";
            }

        }
        return $res;
    }

    /**
     * Summary of getConditions
     * fuction gets conditions from JSON file
     * @param string $file
     * @return array<string>
     */
    public function getConditions(string $file)
    {
        $conditions = [];
        $rules = $this->doEval($file);
        foreach ($rules as $rule) {
            $this->_condition = $rule["condition"];
            $conditions[] = $this->_condition;
        }return $conditions;
    }

    /**
     * Summary of evalConditionsFromJSON
     * this functions treat all rule conditions from the JSON file
     * @param string $file
     * @return array
     */
    public function evalConditionsFromJSON(string $file)
    {
        $conditions = [];
        $data = json_decode(file_get_contents($file));
        $rules = $this->doEval($file);
        foreach ($rules as $rule) {
            $this->_condition = $rule["condition"];
            $conditions[] = $this->_condition;
            $res = [];
            foreach ($conditions as $condition) {
                $allMarkNames = $this->getMarksNames($file);
                foreach ($allMarkNames as $markName) {
                    if (str_contains($condition, $markName)) {
                        $dataExist = $data->input_variables->$markName->value;
                        $specificCondition = str_ireplace("@$markName", "$dataExist", $condition);
                        $test = eval("return $specificCondition;");
                        switch ($markName) {
                            case "EXAM":
                                $tmp = $test ? "etudiant ABS" : $data->input_variables->EXAM->value;
                                $res[] = $tmp;
                                break;
                            case "REGIME":
                                $tmp = $test ? "regime is mixte" : $data->input_variables->REGIME->value;
                                $res[] = $tmp;
                                break;
                        }
                    }

                }

            }

        }
        return $res;
    }


      /**
       * Summary of getOutputsFromJSON
       * This function returns array of names' marks and their values from the JSON file
       * @param string $file
       * @return array<array>
       */
    public function getOutputsFromJSON(string $file)
    {
        $data = json_decode(file_get_contents($file));
        foreach ($data->input_variables as $mnKey => $mnVal) {
            $allMarkNames[] = ["$mnKey" => $mnVal->value];

        }
        return $allMarkNames;
    }
}
