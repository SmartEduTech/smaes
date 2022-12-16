<?php
namespace smartedutech\smaes\component\rules\rule_types;
use smartedutech\smaes\component\rules\iRules;
use smartedutech\smaes\component\rules\Rules;
class LogicRules extends Rules implements iRules
{
    public function evaluate()
    {
        return 2;
    }
}
