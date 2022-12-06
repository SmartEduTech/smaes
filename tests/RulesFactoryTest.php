<?php
use PHPUnit\Framework\TestCase;
use smartedutech\smaes\component\rules\RulesFactory;

class RulesFactoryTest extends TestCase
{

    public function testGetRuleArithmetic()
    {
        $this->assertEquals(new smartedutech\smaes\component\rules\ArithmeticRules(), RulesFactory::getRule("arithmetic"));

    }
    public function testGetRuleLogic()
    {
        $this->assertEquals(new smartedutech\smaes\component\rules\LogicRules(), RulesFactory::getRule("logic"));
    }
    public function testGetRuleArithmeticLogic()
    {
        $this->assertEquals(new smartedutech\smaes\component\rules\ArithmeticLogicRules(), RulesFactory::getRule("arithmeticLogic"));
    }
    public function testGetRule()
    {
        $this->assertEquals(null, RulesFactory::getRule(""));
    }
}
