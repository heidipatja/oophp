<?php

namespace Hepa19\DiceV2;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new DiceGraphic();
        $this->assertInstanceOf("\Hepa19\DiceV2\DiceGraphic", $dice);
    }



    /**
     * Test getting graphics
     */
    public function testGraphic()
    {
        $hand = new DiceGraphic();

        $hand->roll();

        $graphics = $hand->graphic();
        $graphics = substr($graphics[1], 0, -2);

        $this->assertStringContainsString($graphics, "dice-");
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
