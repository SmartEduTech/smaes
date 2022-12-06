<?php
namespace smartedutech\smaes\component\rules;

class Rules
{
 private string $_IDR;
 private string $_title;
 private string $_ruleType;
 private object $_evaluation;
 private string $_condition;
 private object $_output;

    /**
     * Summary of __construct
     * @param string $IDR
     * @param string $title
     * @param string $ruleType
     * @param object $evaluation
     * @param string $condition
     * @param object $output
     */
    public function __construct(string $IDR, string $title, string $ruleType, object $evaluation, string $condition, object $output)
    {
        $this->_IDR = $IDR;
        $this->_title = $title;
        $this->_ruleType = $ruleType;
        $this->_evaluation = $evaluation;
        $this->_condition = $condition;
        $this->_output = $output;
    }
   

    /**
     * Summary of verifyRuleType
     * @param mixed $typeFunct
     * @return array<int>|string
     */
    public static function verifyRuleType($typeFunct)
    {
        $res = array();
        $evaluations = null;
        foreach ($typeFunct as $ty) {
            switch ($ty) {
                case 'logic':
                    $evaluations = new LogicRules();
                    $res[] = $evaluations->evaluate();
                    break;
                case 'arithmetic_logic':
                    $evaluations = new ArithmeticLogicRules();
                    $res[] = $evaluations->evaluate();
                    break;
                case 'arithmetic':
                    $evaluations = new ArithmeticRules();
                    $res[] = $evaluations->evaluate();
                    break;
                default:
                    return "undef rule";
            }
        }
        return $res;
    }


    /**
     * Summary of doEval
     * @return array<int>|string
     */
    public function doEval()
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
        return $this->verifyRuleType($ruleTypes);
    }
}