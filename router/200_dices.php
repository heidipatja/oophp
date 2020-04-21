<?php
/**
 * Routes for 100 dices game
 */



/**
 * Game set up
 * Get input from user such has name, number of players, number of dices
 */
$app->router->get("spel/dice/init", function () use ($app) {
    $title = "Tärningsspelet 100 - Sätt upp spelet";

    $app->page->add("spel/dice/init");
    // $app->page->add("spel/dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Init the dice game, redirect to play
 */
$app->router->post("spel/dice/init", function () use ($app) {

    $name = $_POST["name"] ?? null;
    $players = $_POST["players"] ?? null;
    $dices = $_POST["dices"] ?? null;

    $dicegame = new Hepa19\Dice\DiceGame(100, $name, $dices, $players);

    $players = $dicegame->getPlayers();

    $_SESSION["dicegame"] = $dicegame;
    $_SESSION["players"] = $players;

    return $app->response->redirect("spel/dice/play");
});



/**
 * Show game status and play the game
 */

$app->router->get("spel/dice/play", function () use ($app) {
    $title = "Tärningsspelet 100";

    $dicegame = $_SESSION["dicegame"];
    $players = $_SESSION["players"];
    $hasOnes = $dicegame->hasOnes();
    $isComputer = $dicegame->isComputer();
    $currentRound = $dicegame->getCurrentRound() ?? null;
    $roundSum = $currentRound->getRoundSum() ?? null;
    $currentPlayer = $dicegame->getCurrentPlayer() ?? null;
    $currentHand = $currentPlayer->getPlayerHand() ?? null;
    $graphics = $currentHand->getGraphics() ?? null;
    $rollSum = $currentHand->getSum() ?? null;
    $action = null;
    if ($dicegame->isComputer()) {
        $action = $dicegame->playComputer() ?? null;
    }

    $_SESSION["roundSum"] = $roundSum;
    $_SESSION["currentRound"] = $currentRound;
    $_SESSION["currentPlayer"] = $currentPlayer;
    $_SESSION["rollSum"] = $rollSum;

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

    $action = null;
    $graphics = null;
    $currentHand = null;
    $currentRound = null;
    $currentHand = null;

    $app->page->add("spel/dice/play", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Choosing a route based on POST info
 */

$app->router->post("spel/dice/play", function () use ($app) {
    $dicegame = $_SESSION["dicegame"];
    $init = $_POST["init"] ?? null;
    $roll = $_POST["roll"] ?? null;
    $save = $_POST["save"] ?? null;
    $newround = $_POST["newround"] ?? null;
    $playcomputer = $_POST["playcomputer"] ?? null;

    if ($init) {
        return $app->response->redirect("spel/dice/init");
    } else if ($roll) {
        return $app->response->redirect("spel/dice/roll");
    } else if ($save) {
        return $app->response->redirect("spel/dice/save");
    } else if ($newround) {
        return $app->response->redirect("spel/dice/new-round");
    } else if ($playcomputer) {
        $action = $dicegame->playComputer();
        return $app->response->redirect("spel/dice/" . $action);
    } else {
        return $app->response->redirect("spel/dice/init");
    }
});



/**
 * Roll dice
 */

$app->router->get("spel/dice/roll", function () use ($app) {
    $dicegame = $_SESSION["dicegame"];

    $dicegame->roll();

    return $app->response->redirect("spel/dice/play");
});



/**
 * New round
 */

$app->router->get("spel/dice/new-round", function () use ($app) {
    $dicegame = $_SESSION["dicegame"];

    $dicegame->goToNextRound();

    return $app->response->redirect("spel/dice/play");
});



/**
 * Save dice values
 */

$app->router->get("spel/dice/save", function () use ($app) {
    $dicegame = $_SESSION["dicegame"];

    $dicegame->save();

    $_SESSION["currentRound"] = null;
    $_SESSION["currentPlayer"] = null;
    $_SESSION["rollSum"] = null;
    $_SESSION["roundSum"] = null;

    if ($dicegame->hasWon()) {
        return $app->response->redirect("spel/dice/end");
    } else {
        return $app->response->redirect("spel/dice/new-round");
    }
});



/**
 * End the dice game, show who won and button to play again
 */
$app->router->get("spel/dice/end", function () use ($app) {
    $title = "Tärningsspelet 100 - Spelet är slut!";
    $dicegame = $_SESSION["dicegame"];
    $players = $_SESSION["players"];
    $currentPlayer = $dicegame->getCurrentPlayer() ?? null;

    $data = [
        "players" => $players,
        "currentPlayer" => $currentPlayer
    ];

    $app->page->add("spel/dice/end", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
