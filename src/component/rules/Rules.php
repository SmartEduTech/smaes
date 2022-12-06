<?php
namespace smartedutech\smaes\component\rules;

class Rules
{
    // protected string $_IDR;
    // protected string $_title;
    // protected string $_type;

    // public function __construct(string $id, string $title, string $type)
    // {
    //     $this->_IDR = $id;
    //     $this->_title = $title;
    //     $this->_type = $type;

    // }

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
                    break;
                default:
                    return "undef rule";
            }
        }
        return $res;
    }
}
