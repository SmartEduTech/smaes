<?php

use PHPUnit\Framework\TestCase;
use smartedutech\smaes\component\rules\Rules;

class RulesTest extends TestCase
{
    public function testVerifyRuleType()
    {
        $this->assertEquals("undef rule", Rules::verifyRuleType([""]));
        $this->assertEquals([2], Rules::verifyRuleType(["logic"]));
        $this->assertEquals([2,4], Rules::verifyRuleType(["logic","arithmeticLogic"]));
        $this->assertEquals([2,4,3], Rules::verifyRuleType(["logic","arithmeticLogic","arithmetic"]));

    }
}
