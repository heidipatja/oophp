<?php

namespace Hepa19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceHandTest extends TestCase
{
    /**
     * Test getting average of dice values
     */
    public function testGetAverage()
    {
        $hand = new DiceHand(3);

        $hand->roll();

        $res = $hand->getAverage();
        $exp = $hand->getSum() / 3;

        $this->assertEquals($res, $exp);
    }



    /**
     * Test that getValues() returns array
     */
    public function testGetValues()
    {
        $hand = new DiceHand(3);

        $hand->roll();

        $res = $hand->getValues();

        $this->assertIsArray($res);
    }



    /**
     * Test getting graphics
     */
    public function testGetGraphics()
    {
        $hand = new DiceHand(3);

        $hand->roll();

        $graphics = $hand->getGraphics();
        $graphics = substr($graphics[1], 0, -2);

        $this->assertStringContainsString($graphics, "dice-");
    }
}
