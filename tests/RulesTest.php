<?php

use PHPUnit\Framework\TestCase;
use smartedutech\smaes\component\rules\Rules;

class RulesTest extends TestCase
{
    public function testVerifyRuleTypeIfEmty()
    {
        $this->assertEquals("undef rule", Rules::verifyRuleType([""]));

    }
    public function testVerifyRuleTypeIfLogic()
    {
        $this->assertEquals([2], Rules::verifyRuleType(["logic"]));

    }
    public function testVerifyRuleTypeIfArethmetic()
    {
        $this->assertEquals([3], Rules::verifyRuleType(["arithmetic"]));
    }
    public function testVerifyRuleTypeIfArethmeticLogic()
    {
        $this->assertEquals([4], Rules::verifyRuleType(["arithmeticLogic"]));
    }
    public function testVerifyRuleType()
    {
        $this->assertEquals([2, 3, 4], Rules::verifyRuleType(["logic", "arithmetic", "arithmeticLogic"]));
    }

}
