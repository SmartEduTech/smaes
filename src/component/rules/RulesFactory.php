<?php

namespace smartedutech\smaes\component\rules;

abstract class RulesFactory
{

    /**
     * Summary of getRule
     * This function create a specific rule instance based on the inserted rule type
     * @param mixed $id
     * @param mixed $title
     * @param mixed $type
     * @return mixed
     */
    public static function getRule($type)
    {
        $res = null;
        switch ($type) {

            case 'logic':
            case 'arithmeticLogic':
            case 'arithmetic':
                if ($type != null) {
                    $class_name = ucfirst($type) . "Rules";
                    $ns = __NAMESPACE__ . '\\rule_types\\' . $class_name;
                    $res = new $ns( $type);
                    $res->setType($type);
                    return $res;
                }
                break;
            default:
                return "undef rule";
        }
        return $res;
    }
}
