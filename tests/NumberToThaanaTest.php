<?php

namespace Tests;

use Mazin\Thaana\NumberToThaana;
use PHPUnit\Framework\TestCase;

class NumberToThaanaTest extends TestCase
{
    public function testNullCases()
    {
        $testOne = (new NumberToThaana("0"))->convert();
        $testTwo = (new NumberToThaana(""))->convert();

        $this->assertNull($testOne);
        $this->assertNull($testTwo);
    }
    
    public function testArgumentCases()
    {
        $testOne = is_string(null);
        $testTwo = is_string(0);
        $testThree = is_string("");

        $this->assertFalse($testOne);
        $this->assertFalse($testTwo);
        $this->assertTrue($testThree);
    }
}