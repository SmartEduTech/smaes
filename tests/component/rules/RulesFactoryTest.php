<?php

use PHPUnit\Framework\TestCase;
use smartedutech\smaes\component\rules\RulesFactory;

class RulesFactoryTest extends TestCase
{public function testGetRuleArithmetic()
    {
    $this->assertEquals(new smartedutech\smaes\component\rules\rule_types\ArithmeticRules("arithmetic"), RulesFactory::getRule("arithmetic"));

}
    public function testGetRuleLogic()
    {
        $this->assertEquals(new smartedutech\smaes\component\rules\rule_types\LogicRules("logic"), RulesFactory::getRule("logic"));
    }
    public function testGetRuleArithmeticLogic()
    {
        $this->assertEquals(new smartedutech\smaes\component\rules\rule_types\ArithmeticLogicRules("arithmeticLogic"), RulesFactory::getRule("arithmeticLogic"));
    }
    public function testGetRule()
    {
        $this->assertEquals("undef rule", RulesFactory::getRule(""));
    }
}