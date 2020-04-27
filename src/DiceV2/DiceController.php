<?php

namespace Hepa19\DiceV2;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * Controller for Dice Game v2
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * Index, redirects to init
     *
     * @return object
     */
    public function indexAction() : object
    {
        return $this->app->response->redirect("spel/dice2/init");
    }



    /**
     * Game set up
     * Get input from user such as name and number of players and dices
     *
     * @return object
     */
    public function initAction() : object
    {
        $page = $this->app->page;
        $title = "Tärningsspelet 100 - Sätt upp spelet";

        $page->add("spel/dice2/init");

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * Init the dice game, redirect to play
     *
     * @return object
     */
    public function initActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        $name = $request->getPost("name");
        $players = $request->getPost("players");
        $dices = $request->getPost("dices");

        $dicegame = new DiceGame(100, $name, $dices, $players);

        $session->set("dicegame", $dicegame);
        $session->set("players", $dicegame->getPlayers());

        return $response->redirect("spel/dice2/play");
    }


    /**
     * Show game status and play the game
     *
     * @return object
     */
    public function playActionGet() : object
    {
        $title = "Tärningsspelet 100 - Spela";

        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;
        $page = $this->app->page;

        $dicegame = $session->get("dicegame");
        $players = $session->get("players");

        $hasOnes = $dicegame->hasOnes();
        $isComputer = $dicegame->isComputer();
        $currentPlayer = $dicegame->getCurrentPlayer();
        $currentHand = $currentPlayer->getPlayerHand();
        $currentRound = $dicegame->getCurrentRound();
        $roundSum = $currentRound->getRoundSum();
        $rollSum = $currentHand->getSum();
        $graphics = $currentHand->getGraphics();
        $action = null;
        if ($dicegame->isComputer()) {
            $action = $dicegame->playComputer();
        }

        $session->set("roundSum", $currentRound->getRoundSum());
        $session->set("currentRound", $dicegame->getCurrentRound());
        $session->set("currentPlayer", $dicegame->getCurrentPlayer());
        $session->set("rollSum", $currentHand->getSum());
        $session->set("isComputer", $dicegame->isComputer());

        $data = [
            "players" => $players,
            "currentPlayer" => $currentPlayer,
            "currentRound" => $currentRound,
            "currentHand" => $currentHand,
            "graphics" => $graphics,
            "roundSum" => $roundSum,
            "rollSum" => $rollSum,
            "action" => $action,
            "hasOnes" => $hasOnes,
            "isComputer" => $isComputer
        ];

        $page->add("spel/dice2/play", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * Choosing a route based on POST info
     *
     * @return object
     */
    public function playActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;
        $page = $this->app->page;

        $dicegame = $session->get("dicegame");

        $init = $request->getPost("init");
        $roll = $request->getPost("roll");
        $save = $request->getPost("save");
        $newround = $request->getPost("newround");
        $playcomputer = $request->getPost("playcomputer");

        if ($init) {
            return $response->redirect("spel/dice2/init");
        } else if ($roll) {
            return $response->redirect("spel/dice2/roll");
        } else if ($save) {
            return $response->redirect("spel/dice2/save");
        } else if ($newround) {
            return $response->redirect("spel/dice2/new-round");
        } else if ($playcomputer) {
            $action = $dicegame->playComputer();
            return $response->redirect("spel/dice2/" . $action);
        } else {
            return $response->redirect("spel/dice2/init");
        }
    }



    /**
     * Roll dice
     *
     * @return object
     */
    public function rollActionGet() : object
    {
        $response = $this->app->response;
        $session = $this->app->session;
        $dicegame = $session->get("dicegame");
        $dicegame->roll();

        return $response->redirect("spel/dice2/play");
    }



    /**
     * New round
     *
     * @return object
     */
    public function newroundActionGet() : object
    {
        $response = $this->app->response;
        $session = $this->app->session;
        $dicegame = $session->get("dicegame");
        $dicegame->goToNextRound();

        return $response->redirect("spel/dice2/play");
    }

    /**
     * Save dice values
     *
     * @return object
     */
    public function saveActionGet() : object
    {
        $response = $this->app->response;
        $session = $this->app->session;

        $dicegame = $session->get("dicegame");
        $dicegame->save();
        $currentPlayer = $dicegame->getCurrentPlayer();
        $currentHand = $currentPlayer->getPlayerHand();
        $currentRound = $dicegame->getCurrentRound();

        $session->set("currentRound", $dicegame->getCurrentRound());
        $session->set("currentPlayer", $dicegame->getCurrentPlayer());
        $session->set("rollSum", $currentHand->getSum());
        $session->set("roundSum", $currentRound->getRoundSum());

        if ($dicegame->hasWon()) {
            return $response->redirect("spel/dice2/end");
        } else {
            return $response->redirect("spel/dice2/new-round");
        }
    }



    /**
     * End the dive game, show who won and button to play again
     *
     * @return object
     */
    public function endActionGet() : object
    {
        $page = $this->app->page;
        $session = $this->app->session;
        $title = "Tärningsspelet 100 - Spelet är slut!";

        $dicegame = $session->get("dicegame");
        $players = $session->get("players");

        $currentPlayer = $dicegame->getCurrentPlayer();

        $data = [
            "players" => $players,
            "currentPlayer" => $currentPlayer
        ];

        $page->add("spel/dice2/end", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
