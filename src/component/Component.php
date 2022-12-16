<?php 
namespace smartedutech\smaes\component;
use PHPUnit\TextUI\XmlConfiguration\Variable;
use smartedutech\smaes\component\rules\Rules;
/**
 * Summary of Component
 * A component contains a set of evaluation rules (R1, R2...) and evaluation variables(input_variables, output_variables)
 * ([as indicated in the JSON file])
 */
class Component
{
    private Rules $_rules;
    private Variable $_variables;
   
    public function __construct(Rules $rules, Variable $vars)
    {
        $this->_rules = $rules;
        $this->_variables = $vars;
    }
}