<?php 
namespace smartedutech\smaes\component\rules;

class Rules{
    private string $_type;
    private $_description;

    //on va faire une fonction qui verifie la nature de la regle deval 
    //pour nous deriger vers la classe de regle specifique 'logic, arithmetic, logicarithmitic'
    public function verifyRuleType ()
    {
        $res = null; 
        switch ($this->_type){
            case 'logic':
                $res = new LogicRules();
                break;
            case 'arithmetic_logic':
                $res = new ArithmeticLogicRules();
                break;
            case 'arithmetic':
                $res = new ArithmeticRules();
                break;
            }
        return $res;
    }
}

