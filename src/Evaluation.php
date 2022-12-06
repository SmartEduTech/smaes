<?php

namespace smartedutech\smaes;
use smartedutech\smaes\component\rules\Rules;

class Evaluation
{
    private string $_condition;
    private string $_output;
    public function __construct(string $condition, bool $output)
    {
        $this->_condition = $condition;
        $this->_output = $output;
    }

    /**
     * Summary of doEval
     * This function triggre the evaluation in each rule claimed in the JSON file and return an array of rules results
     * @return array|string
     */
    public function doEval(Rules $r)
    {
        $ruleTypes = array();
        $file = "C:\\Users\\Lenovo\\Documents\\GitHub\\smaes\\data\\ECUE1_Component.json";
        // $use = "use smartedutech\\smaes\\methods\\Methods;";
        $data = json_decode(file_get_contents($file));
        $rules = $data->Rules;
        foreach ($rules as $rule => $key) {
            foreach ($key as $propKey => $propValue) {
                if ($propValue->Rule_Type != '') {
                    $ruleTypes[] = $propValue->Rule_Type;
                }
            }
        }
        return $r->verifyRuleType($ruleTypes);
    }
}
