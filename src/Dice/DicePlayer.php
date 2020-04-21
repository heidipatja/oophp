<?php
/**
 * Namespace
 */
 namespace Hepa19\Dice;

 /**
 * A player in the dice game
 */
class DicePlayer
{
    /**
     * @var DiceHand $hand   Hand holding the dices
     * @var int  $score  Current score in dice game
     * @var int  $dices  Number of dices in hand
     * @var string  $name  Name of player
     */

    protected $score;
    protected $dices;
    protected $name;
    protected $hand;


    /**
     * Constructor to initiate the player
     *
     * @param int $score   Player score, defaults to 0
     * @param int $dices   Number of dices player has, defaults to 2
     * @param string $name   Player's name
     * @param DiceHand $hand   Player hand holding dices
     */

    public function __construct(int $score = 0, int $dices = 2, string $name = null)
    {
        $this->score = $score;
        $this->dices = $dices;
        $this->name = $name;
        $this->hand = new DiceHand($this->dices);
    }



    /**
     * Roll all dices in hand
     *
     * @return void.
     */

    public function roll()
    {
        $this->hand->roll();
    }



    /**
     * Return player hand
     *
     * @return DiceHand $hand      Player hand holding dices
     */

    public function getPlayerHand()
    {
        return $this->hand;
    }



    /**
     * Unset player hand (create a new hand for player)
     * @param DiceHand $hand   Hand object holding dices
     * @param int $dices   Number of dices in hand
     *
     * @return void
     */

    public function unsetPlayerHand()
    {
        return $this->hand = new DiceHand($this->dices);
    }


    /**
     * Get graphics for current hand
     *
     * @return array graphics for dices
     */

    public function getGraphics()
    {
        return $this->hand->getGraphics();
    }



    /**
     * Return player score
     *
     * @return int $score      Player score
     */

    public function getScore()
    {
        return $this->score;
    }



    /**
     * Return player hand dice values
     *
     * @return array   Array with dice values
     */

    public function getValues()
    {
        return $this->hand->getValues();
    }



    /**
     * Return player sum for player's hand
     *
     * @return array
     */

    public function getSum()
    {
        return $this->hand->getSum();
    }


    /**
     * Get player name
     *
     * @return void
     */

    public function getName()
    {
        return $this->name;
    }



    /**
    * Update (set) player score
    * @param int $roundSum   Sum of all dices from round, to be added to score
    * @param int $score   Player's total score
    *
    * @return void
    */

    public function setScore(int $roundSum = 0)
    {
        $this->score = $this->score + $roundSum;
    }
}
