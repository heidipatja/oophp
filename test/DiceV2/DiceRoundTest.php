<?php

namespace Hepa19\DiceV2;

use PHPUnit\Framework\TestCase;

/**
 * Testing DiceRound class
 */
class DiceRoundTest extends TestCase
{
    /**
     * Test creating new round
     */
    public function testCreateDiceRoundWithPlayer()
    {
        $player = new DicePlayer();
        $round = new DiceRound($player);

        $this->assertInstanceOf("\Hepa19\DiceV2\DiceRound", $round);
    }



    /**
     * Test getting round sum
     */
    public function testGetRoundSum()
    {
        $player = new DicePlayer();
        $round = new DiceRound($player, 74);

        $res = $round->getRoundSum();
        $exp = 74;

        $this->assertEquals($res, $exp);
    }



    /**
     * Test getting round sum
     */
    public function testSetRoundSum()
    {
        $player = new DicePlayer();
        $round = new DiceRound($player, 74);

        $round->setRoundSum(21);

        $res = $round->getRoundSum();
        $exp = 95;

        $this->assertEquals($res, $exp);
    }
}
