<?php
/**
 * Namespace
 */
 namespace Hepa19\DiceV2;

/**
 * It's a dice!
 */
class Dice
{
    /**
     *
     * @var int $sides    Number of sides of dice
     * @var int $value    Last roll
     */
    protected $sides;
    private $value;



    /**
     * Constructor to create a Dice
     *
     * @param int    $sides   Number of sides the dice has, defaults to 6
     */

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }



    /**
     * Randomize dice value to value between 1 and number of sides (roll dice)
     *
     * @return int
     */

    public function roll()
    {
        $this->value = rand(1, $this->sides);
        return $this->value;
    }



    /**
     * Get last roll on dice
     *
     * @return int
     */

    public function getLastRoll()
    {
        return $this->value;
    }

    /**
     * Get class name for graphics
     *
     * @return string class name
    */
    public function graphic()
    {
        return "dice-" . $this->getLastRoll();
    }
}
