<?php
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */

namespace Hepa19\Guess;

/**
 * Guess
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $number;
    private $tries;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param null|int $number The current secret number, default -1 to initiate the number from start.
     *
     * @param null|int $tries  Number of tries, default 6.
     */

    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->number = $number;
        $this->tries = $tries;

        if ($number === -1) {
            $this->random();
        }
    }




    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random() : void
    {
        $this->number = rand(1, 100);
    }




    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries() : int
    {
        return $this->tries;
    }




    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number() : int
    {
        return $this->number;
    }




    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @param int $number The current secret number
     * @return string to show the status of the guess made.
     */

    public function makeGuess(int $number) : string
    {
        if ($number < 1 || $number > 100) {
            throw new GuessException("Numret måste vara mellan 1 och 100.");
        }

        $this->tries--;

        if ($number < $this->number) {
            $res = "För lågt!";
        } elseif ($number > $this->number) {
            $res = "För högt!";
        } else {
            $res = "Rätt!";
        }

        return $res;
    }
}
