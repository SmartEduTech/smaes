<?php
namespace smartedutech\smaes\component\rules;

class Rules
{
    public function __construct()
    {
        var_dump(get_class($this));
    }

    public static function verifyRuleType($typeFunct)
    {
        $res = array();
        $evaluations = null;
        foreach ($typeFunct as $ty) {
            switch ($ty) {
                case 'logic':
                    $evaluations = RulesFactory::getRule($ty);
                    $res[] = $evaluations->evaluate();
                    break;
                case 'arithmeticLogic':
                    $evaluations = RulesFactory::getRule($ty);
                    $res[] = $evaluations->evaluate();
                    break;
                case 'arithmetic':
                    $evaluations = RulesFactory::getRule($ty);
                    $res[] = $evaluations->evaluate();
                default:
                    return "undef rule";
            }
        }
        return $res;
    }

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
