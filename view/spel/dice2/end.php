<?php

namespace Anax\View;

/**
 * View for dice game - game over! Play again?
 */

?><h1>Tärning 100</h1>

<div class="round">

    <h2>Spelet är slut</h2>

    <p><?= $currentPlayer->getName() ?> vann! Spela igen?</p>

    <form method="post" action="play">
        <input type="submit" name="init" class="save" value="Ja">
        <input type="submit" name="init" class="roll" value="Ja, men i en annan färg">
    </form>

</div>


<div class="score-board">

    <h2>Ställning</h2>

    <?php foreach ($players as $player) : ?>
        <div class="player">
            <p><?= $player->getName() ?>: <?= $player->getScore() ?> </p>
        </div>
    <?php endforeach; ?>

</div>
