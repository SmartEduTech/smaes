<?php 
namespace smartedutech\smaes\component;
use smartedutech\smaes\component\rules\Rules;
/**
 * Summary of Component
 * A component contains a set of evaluation rules (R1, R2...) and evaluation variables(input_variables, output_variables)
 * ([as indicated in the JSON file])
 */
class Component
{
    private Rules $_rules;
   
    public function __construct(Rules $rules)
    {
        $this->_rules = $rules;
    }
}