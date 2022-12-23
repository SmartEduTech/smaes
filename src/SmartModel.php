<?php

namespace smartedutech\smaes;

use smartedutech\smaes\component\rules\Evaluation;

class SmartModel
{
    public function __construct()
    {
    }

    /**
     * Summary of InputIntoModel
     * This function get input marks from the user, insert them into the JSON file
     * @param mixed $inputMark
     * @param string $file
     * @return array
     */
    public function InputIntoModel(mixed $inputMark, string $JSON_file)
    {
        $e = new Evaluation();
        $allMarkNames = $e->getMarksNames($JSON_file);
        return  $e->insertArrayIntoJSON($inputMark, $allMarkNames, $JSON_file);

    }
    /**
     * Summary of evaluate
     * This function get evaluation conditions, then triggre the evaluation and refactor each variable after condition verification
     * @param mixed $inputMark
     * @param string $file
     * @return array
     */
    public function evaluate(string $JSON_file)
    {
        $e = new Evaluation();
        return $e->evalConditionsFromJSON($JSON_file);
    }

    /**
     * Summary of findPropertyComponent
     * search inserted propertyName in the JSON file and returns propertyName's value after evaluation
     * @param string $JSON_file
     * @param string $propertyName
     * @return string|null
     */
    public function findPropertyComponent(string $JSON_file, string $propertyName)
    {
        $e = new Evaluation();
        $output = null;
        $registredData = $e->getInputsVariablesValuesFromJSON($JSON_file);
        $formatedPropertyName = strtoupper($propertyName);
        foreach ($registredData as $mark) {

            foreach ($mark as $key => $value) {
                if ($key === $formatedPropertyName) {
                    $output = "$formatedPropertyName = $value";
                }
            }
        }
        return (!empty($output)) ? $output : "$formatedPropertyName does not exist please try again";
    }

    public function getResults()
    {
        //return moyenne de l'UE :
        //ainsi que la moyenne de chaque ECUE de cette UE :
        //exp moyenne de l'UE Méthodes et processus logiciels    : 18,43
        //les moyennes de ECUE qui constituent cette UE :
        // -  ECUE springboot : 17.56
        // -  ECUE microservice : 19.5
        //l'affichage sera comme suit :
        // moyenne (UE) MPL : 18,43
        //      (ECUE178)SB : 17.56, (ECUE458)MS :  19.5
        return "data";

    }
}
