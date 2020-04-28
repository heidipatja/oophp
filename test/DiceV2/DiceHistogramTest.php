<?php

namespace Hepa19\DiceV2;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceHistogramTest extends TestCase
{
    private $dice;

    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp() : void
    {
        $this->dice = new DiceHistogram();
    }
    /**
     * Test that getHistogramMax returns correct max value
     */
    public function testGetHistogramMax()
    {
        $res = $this->dice->getHistogramMax();

        $exp = 6;

        $this->assertEquals($res, $exp);
    }


    /**
     * Test that getHistogramMax returns correct max value
     */
    public function testGetHistogramSerie()
    {
        $res = $this->dice->getHistogramSerie();

        $this->assertIsArray($res);
    }



    /**
     * Test that testRollDice returns integers (rolls)
     *
     */
    public function testGetLastRoll()
    {
        $this->dice->roll();

        $res = $this->dice->getLastRoll();
        $this->assertIsInt($res);
    }
}
