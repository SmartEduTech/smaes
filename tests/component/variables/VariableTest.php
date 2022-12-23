<?php

use PHPUnit\Framework\TestCase;
use smartedutech\smaes\component\variables\Variable;


class VariableTest extends TestCase
{
    public function testVerifyTypeValue()
{
    // Test with valid types
    $var = new Variable("string|integer|boolean");
    $this->assertTrue($var->verifyTypeValue("foo"));
    $this->assertTrue($var->verifyTypeValue(123));
    $this->assertTrue($var->verifyTypeValue(true));

    // Test with invalid type
    $this->assertFalse($var->verifyTypeValue(1.23));

    // Test with empty value
    $var = new Variable("string");
    $this->assertTrue($var->verifyTypeValue(""));
}

}