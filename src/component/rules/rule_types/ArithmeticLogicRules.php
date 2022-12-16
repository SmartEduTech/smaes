<?php
namespace smartedutech\smaes\component\rules\rule_types;
use smartedutech\smaes\component\rules\iRules;
use smartedutech\smaes\component\rules\Rules;

class ArithmeticLogicRules extends Rules implements iRules{
    public function evaluate()
    {
        return 4;
    }
}