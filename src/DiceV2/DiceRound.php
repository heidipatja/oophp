<?php
/**
 * Namespace
 */
 namespace Hepa19\Dice;

 /**
 * A round in the dice game
 */
class DiceRound
{
    /**
     * @var int $roundSum   Sum of all dices in round so far
     * @var DicePlayer|DicePlayerComputer $currentPlayer   Current player
     */
    private $roundSum;
    private $currentPlayer;



    /**
     * Constructor to initiate a round in the dice game
     *
     * @param DicePlayer|DicePlayerComputer $currentPlayer   Current player
     * @param int $roundSum   Sum of all dices in round so far, defaults to 0
     */

    public function __construct($currentPlayer, int $roundSum = 0)
    {
        $this->currentPlayer = $currentPlayer;
        $this->roundSum = $roundSum;
    }



    /**
     * Get sum of round
     *
     * @return int $roundSum  Sum of dices played in round
     */

    public function getRoundSum()
    {
        return $this->roundSum;
    }



    /**
     * Set sum of round, update with sum from previous roll
     *
     * @param int $rollSum   Sum from last roll
     * @param int $roundSum   Total sum for round
     */

    public function setRoundSum(int $rollSum = 0)
    {
        $this->roundSum += $rollSum;
    }
}
