<?php
/**
 * Namespace
 */
 namespace Hepa19\DiceV2;

 /**
 * A computer player in the dice game
 */
class DicePlayerComputer extends DicePlayer
{
    /**
     * Logic for computer.
     * Evaluates the state of the game and decides if to roll or save.
     * @param int $roundSum   Sum of all dices from round, to be added to score
     * @param int $highestScore   Score of (other) player with highest score
     * @return string $action   Action to be taken (roll or save)
     */
    public function chooseAction(int $roundSum = 0, int $highestScore = 0)
    {
        $action = null;

        if ($this->score + $roundSum >= 100) {
            $action = "save";
        } else if ($highestScore > 90) {
            $action = "roll";
        } else if ($this->score + $roundSum > 90) {
            $action = "roll";
        } else if ($roundSum >= 25) {
            $action = "save";
        } else {
            $action = "roll";
        }

        return $action;
    }
}
