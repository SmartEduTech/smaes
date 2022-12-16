<?php 
namespace smartedutech\smaes\component\rules\rule_types;
use smartedutech\smaes\component\rules\iRules;
use smartedutech\smaes\component\rules\Rules;
class ArithmeticRules extends Rules implements iRules{
    
    public function evaluate()
    {
        // $use = "use smartedutech\\smaes\\methods\\Methods;";
        // $res = $data->evaluation_rule->addition->variables->output;
        //  eval( "$use; $res;" );
        return 3;

    }
}