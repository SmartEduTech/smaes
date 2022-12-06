<?php

namespace smartedutech\smaes\component\rules;

class RulesFactory
{
    public static function getRule($type)
    {
        if($type != null){
            $class_name = ucfirst($type) . "Rules";
        $ns = __NAMESPACE__ . '\\' . $class_name;
        return new $ns;
        }
    }
}
