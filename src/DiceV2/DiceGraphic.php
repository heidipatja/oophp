<?php
/**
 * Namespace
 */
 namespace Hepa19\Dice;

 /**
 * Dice graphics
 */
class DiceGraphic extends Dice
{
     /**
      * @var integer SIDES Number of sides of the Dice.
      */
     const SIDES = 6;



    /**
     * Constructor to initiate the dice with six sides.
     */
    public function __construct()
    {
        parent::__construct(self::SIDES);
    }



    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of dice.
     */
    public function graphic()
    {
        return "dice-" . $this->getLastRoll();
    }
}
