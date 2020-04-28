<?php

namespace Hepa19\DiceV2;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class HistogramTest extends TestCase
{
    private $histogram;

    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp() : void
    {
        $this->histogram = new Histogram();
    }
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $this->assertInstanceOf("\Hepa19\DiceV2\Histogram", $this->histogram);
    }



    /**
     * Test that getAsText returns histogram info as a strings
     */
    public function testGetAsText()
    {
        $hand = new DiceHand(3);
        $hand->roll();
        $this->histogram->injectData($hand);

        $res = $this->histogram->getAsText();

        $this->assertIsString($res);
    }

    /**
     * Test that geSerie returns an array
     */
    public function testGetSerie()
    {
        $res = $this->histogram->getSerie();

        $this->assertIsArray($res);
    }
}
