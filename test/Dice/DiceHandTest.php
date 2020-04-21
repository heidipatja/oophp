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
}
