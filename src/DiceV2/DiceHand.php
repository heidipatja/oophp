<?php
/**
 * Namespace
 */
 namespace Hepa19\DiceV2;

 /**
 * A dicehand, hand consisting of a number of dices.
 */
class DiceHand implements HistogramInterface
{
    use HistogramTrait;
    /**
     * @var array $dices   Array consisting of dices.
     * @var array  $values  Array consisting of values for last roll of dices.
     * @var array  $graphic  Array with class names to build graphics for roll
     */

    private $dices;
    private $values;
    private $graphic;


    /**
     * Constructor to initiate the dice hand with a number of dices.
     *
     * @param int $dices   Number of dices to create, per hand, defaults to two.
     * @param array $values   Values of dices in hand
     * @param array $graphic   Class names of dices in hand to build graphics
     */

    public function __construct(int $dices = 2)
    {
        $this->dices  = [];
        $this->values = [];
        $this->graphic = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[] = new Dice();
        }
    }



    /**
     * Roll all dices save their value to array
     * @param int $dices   Number of dices to create, per hand, defaults to two.
     * @param array $values   Values of dices in hand
     * @param array $graphic   Class names of dices in hand to build graphics
     *
     * @return void.
     */

    public function roll()
    {
        $this->graphic = [];
        $this->values = [];
        $noOfDices = count($this->dices);
        for ($i = 0; $i < $noOfDices; $i++) {
            $this->values[] = $this->dices[$i]->roll();
            $this->graphic[] = $this->dices[$i]->graphic();
        }
    }



    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */

    public function getValues()
    {
        return $this->values;
    }



    /**
     * Get dices from last roll.
     *
     * @return array with values of the last roll.
     */

    public function getHistogramSerie()
    {
        return $this->values;
    }



    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */

    public function getSum()
    {
        return array_sum($this->values);
    }



    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */

    public function getAverage()
    {
        return (array_sum($this->values) / count($this->dices));
    }



    /**
     * Get array with class names to build dice graphics
     *
     * @return array with class names for dice graphics
     */

    public function getGraphics()
    {
        return $this->graphic;
    }
}
