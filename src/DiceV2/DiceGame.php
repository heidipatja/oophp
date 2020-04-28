<?php
/**
 * Namespace
 */
 namespace Hepa19\DiceV2;

 /**
 * A dicehand, consisting of dices.
 */
class DiceGame
{
    // use HistogramTrait;

    /**
     * @var int $scoreToWin   Score required to win the game
     * @var int $noOfPlayers   Number of players in the game
     * @var array $players   array containing all players
     * @var int $dices   Number of dices per player/hand
     * @var object $currentPlayer   Current player
     * @var DiceRound $currentRound   Current round
     * @var Histogram $histogram   Histogram over all rolls in game
     */
    private $scoreToWin;
    private $noOfPlayers;
    private $players;
    private $currentPlayer;
    private $currentRound;
    private $histogram;



    /**
     * Constructor to initiate the game
     *
     * @param int $maxScore   Max score (to win), defaults to 100
     * @param string $playerName   Name for human player, default Anonymous
     * @param int $dices   Number of dices per player/hand
     * @param int $dices   Number of players, defaults to 2
     */

    public function __construct(int $scoreToWin = 100, string $name = null, int $dices = 2, int $noOfPlayers = 2)
    {
        $this->noOfPlayers = $noOfPlayers + 1;
        $this->scoreToWin = $scoreToWin;
        $this->players = [];

        for ($i = 0; $i < $this->noOfPlayers; $i++) {
            if ($i == 0) {
                $this->players[]  = new DicePlayer(0, $dices, $name);
            } else {
                $name = "Dator" . $i;
                $this->players[] = new DicePlayerComputer(0, $dices, $name);
            }
        }

        $this->currentPlayer = $this->players[0];
        $this->currentRound = new DiceRound($this->currentPlayer);

        $this->histogram = new Histogram();
        $this->histogram->injectData($this->currentPlayer->getPlayerHand());
    }



    /**
     * Get players
     *
     * @return array with DicePlayer objects
     */

    public function getPlayers()
    {
        return $this->players;
    }



    /**
     * Get current player
     *
     * @return DicePlayer
     */

    public function getCurrentPlayer()
    {
        return $this->currentPlayer;
    }



    /**
     * Get current round
     *
     * @return DiceRound
     */

    public function getCurrentRound()
    {
        return $this->currentRound;
    }



    /**
     * Get histogram
     *
     * @return Histogram
     */

    public function getHistogram()
    {
        return $this->histogram;
    }



    /**
     * Change current player to the next player in the $players array
     *
     * @param object $currentPlayer   Current player
     * @param array $players   Array containing all players in game
     * @param int $currentIndex   Index position of current player in array
     * @param int $noOfPlayers   Number of players in game
     *
     * @return void
     */

    public function setNextPlayer()
    {
        $currentIndex = array_search($this->currentPlayer, $this->players);
        if ($currentIndex + 1 == $this->noOfPlayers) {
            $this->currentPlayer = $this->players[0];
        } else {
            $this->currentPlayer = $this->players[$currentIndex + 1];
        }
    }



    /**
     * Roll dice and update sum for round
     *
     * @return void
     */

    public function roll()
    {
        $this->currentPlayer->roll();
        $this->histogram->getSerie();
        $rollSum = $this->currentPlayer->getSum();
        $this->currentRound->setRoundSum($rollSum);
        $this->histogram->injectData($this->currentPlayer->getPlayerHand());
    }



    /**
     * Save values from rolls made in round (update player score)
     *
     * @return void
     */

    public function save()
    {
        $sumToAdd = $this->currentRound->getRoundSum();
        $this->currentPlayer->setScore($sumToAdd);
    }



    /**
     * Create a new round
     * Unset player hands, set the next player and create a new round
     *
     * @return void
     */

    public function goToNextRound()
    {
        $this->currentPlayer->unsetPlayerHand();
        $this->setNextPlayer();
        $this->newRound();
    }



    /**
     * Returns action (roll or save) based on logic in DicePlayerComputer class
     * @param int $roundSum   Sum of dice values for round
     * @param int $highestScore   Highest score of dice values
     * @param string $action   Action to be taken (roll or save)
     *
     * @return $action (roll or save)
     */

    public function playComputer()
    {
        $roundSum = $this->currentRound->getRoundSum();
        $highestScore = $this->getHighestScore();
        $action = $this->currentPlayer->chooseAction($roundSum, $highestScore);

        return $action;
    }



    /**
     * Returns true if current player is a computer, else false
     *
     * @return bool
     */

    public function isComputer()
    {
        if (get_class($this->currentPlayer) == "Hepa19\DiceV2\DicePlayerComputer") {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Start new round
     * Create new DiceRound object
     * @param DiceRound $currentRound   Create new DiceRound object and set to current
     * @param DiceRound $currentPlayer   Player who plays round, current player
     *
     * @return void
     */

    public function newRound()
    {
        $this->currentRound = new DiceRound($this->currentPlayer);
    }



    /**
     *
     * Returns true if any of the dices has a value of 1
     *
     * @return bool|none
     */

    public function hasOnes()
    {
        if (in_array(1, $this->currentPlayer->getValues())) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Get highest current score of all players, current player excluded
     *
     * @return int $highestScore
     */

    public function getHighestScore()
    {
        $highestScore = 0;

        for ($i = 0; $i < $this->noOfPlayers; $i++) {
            $playerScore = $this->players[$i]->getScore();

            if ($this->players[$i] === $this->currentPlayer) {
                continue;
            } else if ($this->players[$i]->getScore() > $highestScore) {
                $highestScore = $playerScore;
            }
        }

        return $highestScore;
    }



    /**
     * Check score to see if current player reached 100
     * Returns true if score is 100 or over, otherwise false
     *
     * @return bool
     */

    public function hasWon()
    {
        if ($this->currentPlayer->getScore() >= 100) {
            return true;
        } else {
            return false;
        }
    }
}
