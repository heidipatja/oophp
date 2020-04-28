<?php

namespace Hepa19\DiceV2;

use PHPUnit\Framework\TestCase;

/**
 * Testing DiceRound class
 */
class DiceGameTest extends TestCase
{
    /**
     * Test creating new game
     */
    public function testCreateDiceGame()
    {
        $game = new DiceGame(100, "Heidi", 3, 2);

        $this->assertInstanceOf("\Hepa19\DiceV2\DiceGame", $game);
    }



    /**
     * Test getting players
     */
    public function testGetPlayers()
    {
        $game = new DiceGame(100, "Heidi", 3, 2);
        $players = $game->getPlayers();

        $this->assertIsArray($players);
        $this->assertCount(3, $players);

        $newplayer = new DicePlayer(20, 3, "DiceMaster");
        $res = $game->getCurrentPlayer();

        $this->assertNotEquals($res, $newplayer);
    }



    /**
     * Test getting current round
     */
    public function testGetCurrentRound()
    {
        $game = new DiceGame(100, "Heidi", 3, 2);
        $round = $game->getCurrentRound();

        $this->assertInstanceOf("\Hepa19\DiceV2\DiceRound", $round);
        $this->assertIsObject($round);
    }



    /**
     * Test setting next player
     */
    public function testSetNextPlayer()
    {
        $game = new DiceGame(100, "Heidi", 3, 1);
        $firstplayer = $game->getCurrentPlayer();
        $game->setNextPlayer();
        $secondplayer = $game->getCurrentPlayer();

        $this->assertNotEquals($firstplayer, $secondplayer);

        $game->setNextPlayer();

        $this->assertNotEquals($firstplayer, $secondplayer);
    }



    /**
     * Test if roll contains a dice with value 1
     */
    public function testHasOnes()
    {
        $game = new DiceGame(100, "Heidi", 200, 2);
        $res = $game->hasOnes();
        $this->assertFalse($res);
        $game->roll();
        $res = $game->hasOnes();

        $this->assertTrue($res);
    }



    /**
     * Test creating new round
     */
    public function testCreateNewRound()
    {
        $game = new DiceGame(100, "Heidi", 2, 2);
        $game->roll();
        $round = $game->getCurrentRound();
        $game->newRound();
        $newround = $game->getCurrentRound();

        $this->assertNotEquals($round, $newround);

        $game->goToNextRound();
        $newerround = $game->getCurrentRound();

        $this->assertNotEquals($newround, $newerround);
    }



    /**
     * Test save
     */
    public function testSave()
    {
        $game = new DiceGame(100, "Heidi", 2, 2);

        $player = $game->getCurrentPlayer();
        $scorebefore = $player->getScore();

        $round = $game->getCurrentRound();
        $round->setRoundSum(21);

        $game->save();

        $scoreafter = $player->getScore();

        $this->assertNotEquals($scorebefore, $scoreafter);
    }



    // /**
    //  * Test creating new round
    //  */
    // public function testGoToNextRound()
    // {
    //     $game = new DiceGame(100, "Heidi", 2, 2);
    //     $game->roll();
    //     $round = $game->getCurrentRound();
    //     $game->goToNextRound();
    //     $newround = $game->getCurrentRound();
    //
    //     $this->assertNotEquals($round, $newround);
    // }



    /**
     * Test to play computer
     */
    public function testPlayComputer()
    {
        $game = new DiceGame(100, "Heidi", 3, 2);
        $player1 = $game->isComputer();
        $this->assertFalse($player1);

        $game->goToNextRound();
        $res2 = $game->isComputer();
        $this->assertTrue($res2);

        $res = $game->playComputer();
        $this->assertIsString($res);
    }



    /**
     * Test getting highest score of players
     */
    public function testHighestScore()
    {
        $game = new DiceGame(100, "Heidi", 3, 2);
        $player = $game->getCurrentPlayer();
        $player->setScore(23);
        $game->goToNextRound();

        $res = $game->getHighestScore();
        $exp = 23;

        $this->assertEquals($res, $exp);
    }



    /**
     * Test player has won
     */
    public function testHasWon()
    {
        $game = new DiceGame(100, "Heidi", 3, 2);
        $player = $game->getCurrentPlayer();

        $player->setScore(11);
        $res2 = $game->hasWon();
        $this->assertFalse($res2);

        $player->setScore(101);
        $res = $game->hasWon();
        $this->assertTrue($res);
    }
}
