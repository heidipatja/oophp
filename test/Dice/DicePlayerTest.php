<?php

namespace Hepa19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DicePlayerTest extends TestCase
{
    /**
     * Test creating new player
     */
    public function testCreateDicePlayerNoArguments()
    {
        $player = new DicePlayer();
        $this->assertInstanceOf("\Hepa19\Dice\DicePlayer", $player);
    }

    /**
     * Test getting score
     */
    public function testGetScore()
    {
        $player = new DicePlayer(23, 2, "Heidi");

        $res = $player->getScore();
        $exp = 23;
        $this->assertEquals($exp, $res);
    }



    /**
     * Test rolling dice and checking that value is in correct range
     */
    public function testRollAndCheckValues()
    {
        $player = new DicePlayer(23, 1, "Heidi");

        $player->roll();

        $res = $player->getValues();
        $exp = ($res >= 1 && $res <= 6);
        $this->assertNotEquals($exp, $res);
    }



    /**
     * Test getting player hand
     */
    public function testGetPlayerHand()
    {
        $player = new DicePlayer();

        $hand = $player->getPlayerHand();
        $this->assertInstanceOf("\Hepa19\Dice\DiceHand", $hand);
    }



    /**
     * Test resetting player hand (creating a new one)
     */
    public function testUnsetPlayerHand()
    {
        $player = new DicePlayer();

        $oldhand = $player->getPlayerHand();
        $player->roll();
        $newhand = $player->unsetPlayerHand();

        $this->assertNotEquals($oldhand, $newhand);
    }



    /**
     * Test getting graphics
     */
    public function testGetGraphics()
    {
        $player = new DicePlayer(23, 3, "Heidi");

        $player->roll();

        $graphics = $player->getGraphics();
        $graphics = substr($graphics[1], 0, -2);

        $this->assertStringContainsString($graphics, "dice-");
    }



    /**
     * Test getting graphics
     */
    public function testGetSum()
    {
        $player = new DicePlayer(23, 3, "Heidi");

        $res = $player->getSum();
        $exp = 23;

        $this->assertNotEquals($res, $exp);
    }


    /**
     * Test getting graphics
     */
    public function testGetName()
    {
        $player = new DicePlayer(23, 3, "Heidi");

        $res = $player->getName();
        $exp = "Heidi";

        $this->assertEquals($res, $exp);
    }



    /**
     * Test getting graphics
     */
    public function testSetScore()
    {
        $player = new DicePlayer(23, 3, "Heidi");

        $player->setScore(14);

        $res = $player->getScore();
        $exp = 37;

        $this->assertEquals($res, $exp);
    }
}
