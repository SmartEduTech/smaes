<?php

use PHPUnit\Framework\TestCase;
use smartedutech\smaes\component\rules\Evaluation;

class EvaluationTest extends TestCase
{

    public function testDoEval()
    {
        $file = "C:\\Users\\Lenovo\\Documents\\GitHub\\smaesLibraryTest\\vendor\\smartedutech\\smaes\\data\\ECUE1_Component.json";

        $desired_response = array('logic' => array("result" => 2, "condition" => "'@EXAM'=='ABS'"), 'arithmeticLogic' => array("result" => 4, "condition" => "'@regime'=='mixte'"));

        $classUnderTest = new Evaluation();

        $actual_response = $classUnderTest->doEval($file);

        $this->assertEquals($desired_response, $actual_response);

    }

    public function testGetMarksNames()
    {
        $file = "C:\\Users\\Lenovo\\Documents\\GitHub\\smaesLibraryTest\\vendor\\smartedutech\\smaes\\data\\ECUE1_Component.json";

        $desired_response = array(0 => 'TP', 1 => 'DS', 2 => 'CC', 3 => 'EXAM', 4 => 'Exam_ABS', 5 => 'credit', 6 => 'session', 7 => 'regime');

        $classUnderTest = new Evaluation();

        $actual_response = $classUnderTest->getMarksNames($file);

        $this->assertEquals($desired_response, $actual_response);
    }
}
