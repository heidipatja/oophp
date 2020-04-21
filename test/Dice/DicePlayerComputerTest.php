<?php

namespace Hepa19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DicePlayerComputerTest extends TestCase
{
    /**
     * Test choosing action for computer player - roll
     * Highest competing score is over 90
     */
    public function testChooseActionRoll()
    {
        $computer = new DicePlayerComputer();
        $computer->setScore(80);
        $roundSum = 15;
        $highestScore = 91;

        $res = $computer->chooseAction($roundSum, $highestScore);
        $exp = "roll";
        $this->assertEquals($exp, $res);
    }



    /**
     * Test choosing action for computer player - save
     * Sum for current round is at least 25
     */
    public function testChooseActionSave()
    {
        $computer = new DicePlayerComputer();
        $roundSum = 30;
        $highestScore = 20;

        $res = $computer->chooseAction($roundSum, $highestScore);
        $exp = "save";
        $this->assertEquals($exp, $res);
    }



    /**
     * Test choosing action for computer player - save
     * Will reach 100
     */
    public function testChooseActionReached100()
    {
        $computer = new DicePlayerComputer();
        $computer->setScore(85);
        $roundSum = 17;
        $highestScore = 60;

        $res = $computer->chooseAction($roundSum, $highestScore);
        $exp = "save";
        $this->assertEquals($exp, $res);
    }



    /**
     * Test choosing action for computer player - roll
     * Player score and round sum is over 90
     */
    public function testChooseActionScoreOver90()
    {
        $computer = new DicePlayerComputer();
        $computer->setScore(80);
        $roundSum = 14;
        $highestScore = 60;

        $res = $computer->chooseAction($roundSum, $highestScore);
        $exp = "roll";
        $this->assertEquals($exp, $res);
    }



    /**
     * Test choosing action for computer player - roll
     * Player score and round sum is over 90
     */
    public function testChooseActionFirstRoll()
    {
        $computer = new DicePlayerComputer();
        $roundSum = 0;
        $highestScore = 0;

        $res = $computer->chooseAction($roundSum, $highestScore);
        $exp = "roll";
        $this->assertEquals($exp, $res);
    }
}
