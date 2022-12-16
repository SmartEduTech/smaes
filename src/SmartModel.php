<?php

namespace smartedutech\smaes;

use smartedutech\smaes\component\rules\Evaluation;

class SmartModel
{
    public function __construct()
    {
    }

    /**
     * Summary of evaluate
     * This function get input marks from the user, insert them into the JSON file then triggre the evaluation
     * @param mixed $inputMark
     * @param string $file
     * @return array
     */
    public function evaluate(mixed $inputMark, string $file)
    {
        $e = new Evaluation();
        $allMarkNames = $e->getMarksNames($file);

        $e->insertArrayIntoJSON($inputMark, $allMarkNames, $file);
        return $e->evalConditionsFromJSON($file);

    }
    public function findPropertyComponent(string $JSON_file, string $propertyName)
    {
        //prend en param le fichier JSON de la composante ainsi que le nom de la propriété cherché dans cette composante
        //et retourne la valeur la propriété passé en param (apres traitement et non pas la valeur initiale)
        return "$propertyName = propertyValue after evaluation ";
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
