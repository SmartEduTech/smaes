<?php

use function PHPUnit\Framework\assertEquals;
use PHPUnit\Framework\TestCase;
use smartedutech\smaes\SmartModel;

class SmartModelTest extends TestCase
{
    public function testInputIntoModel()
    {
        $classUnderTest = new SmartModel();

        // Arrange
        $inputMark = ['foo', 123, true];
        $file = "C:\\Users\\Lenovo\\Documents\\GitHub\\smaes\\tests\\data\\dataTest.json";
        $expected = ["done mark name added successfully", "done mark age added successfully", "done mark is_admin added successfully"];
        $actual = $classUnderTest->InputIntoModel($inputMark, $file);
        assertEquals($expected, $actual);
    }

}