<?php

namespace Hepa19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Hepa19\Dice\Dice", $dice);
    }



    /**
     * Test roll
     *
     */
    public function testCreateObjectWithArguments()
    {
        $dice = new Dice(1);

        $dice->roll();

        $res = $dice->getLastRoll();
        $exp = 1;

        $this->assertEquals($res, $exp);
    }



    /**
     * Test that
     *
     */
    public function testRollDice()
    {
        $dice = new Dice();

        $dice->roll();

        $res = $dice->getLastRoll();
        $this->assertIsInt($res);
    }
}
