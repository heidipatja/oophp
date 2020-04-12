<?php
/**
 * Namespace
 */
 namespace Hepa19\Dice;

/**
 * It's a dice!
 */
class Dice
{
    /**
     *
     * @var int $sides    Number of sides of dice
     * @var int $lastRoll    Last roll
     */
    private $sides;
    private $value;



    /**
     * Constructor to create a Dice
     *
     * @param int    $sides   Number of sides the dice has
     */

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }



    /**
     * Randomize dice value (roll dice)
     *
     * @return void
     */

    public function roll()
    {
        $this->value = rand(1, $this->sides);
        return $this->value;
    }



    /**
     * Get last roll on dice
     *
     * @return void
     */

    public function getLastRoll()
    {
        return $this->value;
    }
}
