<?php

use function PHPUnit\Framework\assertEquals;
use PHPUnit\Framework\TestCase;
use smartedutech\smaes\component\rules\Evaluation;

class EvaluationTest extends TestCase
{

    public function testGetMarksNames()
    {
        $file = "C:\\Users\\Lenovo\\Documents\\GitHub\\smaes\\tests\\data\\dataTest.json";
        

        $desired_response = array(0 => 'name', 1 => 'age', 2 => 'is_admin');

        $classUnderTest = new Evaluation();

        $actual_response = $classUnderTest->getMarksNames($file);

        $this->assertEquals($desired_response, $actual_response);
    }
    public function testGetOutputBinds()
    {
        $classUnderTest = new Evaluation();
        // Test with multiple array elements with matching titles
        $input = [
            ["title" => "foo", "output" => "output1", "binds" => "binds1"],
            ["title" => "foo", "output" => "output2", "binds" => "binds2"],
            ["title" => "bar", "output" => "output3", "binds" => "binds3"],
            ["title" => "bar", "output" => "output4", "binds" => "binds4"],
        ];
        $expected = [
            ["title" => "foo", "binds" => ["output1" => "binds1", "output2" => "binds2"]],
            ["title" => "bar", "binds" => ["output3" => "binds3", "output4" => "binds4"]],
        ];

        $this->assertEquals($expected, $classUnderTest->getOutputBinds($input));

        // Test with single array element with matching title
        $input = [
            ["title" => "foo", "output" => "output1", "binds" => "binds1"],
            ["title" => "bar", "output" => "output2", "binds" => "binds2"],
        ];
        $expected = [
            ["title" => "foo", "binds" => ["output1" => "binds1"]],
            ["title" => "bar", "binds" => ["output2" => "binds2"]],
        ];
        $this->assertEquals($expected, $classUnderTest->getOutputBinds($input));

        // Test with single array element with no matching title
        $input = [
            ["title" => "foo", "output" => "output1", "binds" => "binds1"],
            ["title" => "foo", "output" => "output2", "binds" => "binds2"],
            ["title" => "bar", "output" => "output3", "binds" => "binds3"],
        ];
        $expected = [
            ["title" => "foo", "binds" => ["output1" => "binds1", "output2" => "binds2"]],
            ["title" => "bar", "binds" => ["output3" => "binds3"]],
        ];
        $this->assertEquals($expected, $classUnderTest->getOutputBinds($input));

        // Test with empty input
        $input = [];
        $expected = [];
        $this->assertEquals($expected, $classUnderTest->getOutputBinds($input));
    }

    public function testInsertArrayIntoJSON()
    {
        $classUnderTest = new Evaluation();
        $inputMark = ["foo", 123, true];
        $mrkn = ["name", "age", "is_admin"];
        $file = "C:\\Users\\Lenovo\\Documents\\GitHub\\smaes\\tests\\data\\dataTest.json";
        $expected = ["done mark name added successfully", "done mark age added successfully", "done mark is_admin added successfully"];
        $this->assertEquals($expected, $classUnderTest->insertArrayIntoJSON($inputMark, $mrkn, $file));
    }

    public function testGetInputsVariablesValuesFromJSON()
    {
        $classUnderTest = new Evaluation();
        $file = "C:\\Users\\Lenovo\\Documents\\GitHub\\smaes\\tests\\data\\dataTest.json";
        $expected = [
            ['name' => 'foo'],
            ['age' => 123],
            ['is_admin' => true],
        ];
        $actual = $classUnderTest->getInputsVariablesValuesFromJSON($file);
        assertEquals($expected, $actual);
    }

}
