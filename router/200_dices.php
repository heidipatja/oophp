<?php
/**
 * Routes for 100 dices game
 */



/**
 * Init the dice game, redirect to play
 */
$app->router->get("spel/dice/init", function () use ($app) {

    return $app->response->redirect("spel/dice/play");
});


/**
 * Show game status
 */
$app->router->get("spel/dice/play", function () use ($app) {
    $title = "Tärningsspelet 100";

    $data = [

    ];

    $app->page->add("spel/dice/play", $data);
    // $app->page->add("spel/dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
