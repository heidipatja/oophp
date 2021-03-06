<?php
/**
 * Routes for guess game
 */



/**
 * Init the guess game, redirect to play
 */
$app->router->get("spel/guess/init", function () use ($app) {
    $_SESSION["res"] = null;
    $game = new Hepa19\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("spel/guess/play");
});


/**
 * Show game status
 */
$app->router->get("spel/guess/play", function () use ($app) {
    $title = "Gissa mitt nummer";

    $data = [
        "guess" => $_SESSION["guess"] ?? null,
        "res" => $_SESSION["res"] ?? null,
        "tries" => $_SESSION["tries"] ?? null,
        "number" => $_SESSION["number"] ?? null
    ];

    $_SESSION["res"] = null;

    $app->page->add("spel/guess/play", $data);
    // $app->page->add("spel/guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Choosing a route based on POST info
 */
$app->router->post("spel/guess/play", function () use ($app) {
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;
    $guess = $_POST["guess"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;
    $res = null;

    if ($_POST["doInit"]) {
        return $app->response->redirect("spel/guess/init");
    } else if ($doGuess) {
        $_SESSION["guess"] = $guess;
        return $app->response->redirect("spel/guess/make-guess");
    } else if ($doCheat) {
        $_SESSION["res"] = "Pssst! Numret är " . $number . "... ";
        return $app->response->redirect("spel/guess/play");
    } else {
        return $app->response->redirect("spel/guess/init");
    }
});


/**
 * Make a guess
 */
$app->router->get("spel/guess/make-guess", function () use ($app) {
    $guess = $_SESSION["guess"] ?? null;
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;

    $game = new Hepa19\Guess\Guess($number, $tries);

    try {
        $res = $game->makeGuess($guess);
    } catch (Hepa19\Guess\GuessException $e) {
        $res = $e->getMessage();
    } catch (TypeError $e) {
        $res = "Du kan bara skriva in siffror!";
    }

    $_SESSION["tries"] = $game->tries();
    $_SESSION["res"] = $res;

    if ($res == "Rätt!") {
        return $app->response->redirect("spel/guess/win");
    } else if ($_SESSION["tries"] < 1) {
        return $app->response->redirect("spel/guess/fail");
    } else {
        return $app->response->redirect("spel/guess/play");
    }
});


/**
 * Won game, guessed correctly
 */
$app->router->get("spel/guess/win", function () use ($app) {
    $title = "Gissa mitt nummer - Du vann!";

    $data = [
        "tries" => $_SESSION["tries"] ?? null,
        "number" => $_SESSION["number"] ?? null
    ];

    $app->page->add("spel/guess/win", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Lost game, no tries left
 */
$app->router->get("spel/guess/fail", function () use ($app) {
    $title = "Gissa mitt nummer - Du förlorade!";

    $data = [
        "tries" => $_SESSION["tries"] ?? null,
        "number" => $_SESSION["number"] ?? null
    ];

    $app->page->add("spel/guess/fail", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
