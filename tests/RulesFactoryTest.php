<?php
use PHPUnit\Framework\TestCase;
use smartedutech\smaes\component\rules\RulesFactory;

class RulesFactoryTest extends TestCase
{

    public function testGetRule()
    {
        $this->assertEquals(new smartedutech\smaes\component\rules\ArithmeticRules(), RulesFactory::getRule("arithmetic"));
        $this->assertEquals(new smartedutech\smaes\component\rules\LogicRules(), RulesFactory::getRule("logic"));
        $this->assertEquals(new smartedutech\smaes\component\rules\ArithmeticLogicRules(), RulesFactory::getRule("arithmeticLogic"));
    }
}
