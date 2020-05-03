<?php

namespace Anax\View;

/**
 * View for playing dice game
 * Includes score board, statistics and info for round and buttons to play
 */

?><h1>Tärning 100</h1>

<div class="round">

    <h2>Nuvarande runda</h2>

    <div class="stats">
        <p>Spelare: <?= $currentPlayer->getName() ?> </p>
        <p>Summa för rundan: <?= $roundSum ?> </p>
    </div>

    <div class="dice-graphics">
        <?php foreach ($graphics as $class) : ?>
            <i class="dice-sprite <?= $class ?>"></i>
        <?php endforeach; ?>
    </div>



    <?php if ($hasOnes) : ?>
        <form method="post" action="play">
            <input type="submit" name="newround" class="roll" value="Nästa runda">
            <input type="submit" name="init" value="Börja om">
        </form>

    <?php elseif ($isComputer && $action == "roll") : ?>
        <p class="action">Datorn väljer att slå.</p>
        <form method="post" action="play">
            <input type="submit" name="playcomputer" class="save" value="Slå åt datorn">
            <input type="submit" name="init" value="Börja om">
        </form>

    <?php elseif ($isComputer && $action == "save") : ?>
        <p class="action">Datorn väljer att spara.</p>
        <form method="post" action="play">
            <input type="submit" name="save" class="roll" value="Nästa runda">
            <input type="submit" name="init" value="Börja om">
        </form>

    <?php else : ?>
        <form method="post" action="play">
            <input type="submit" name="roll" class="roll" value="Slå">
            <input type="submit" name="save" class="save" value="Spara">
            <input type="submit" name="init" value="Börja om">
        </form>

    <?php endif ?>

</div>

<div class="score-board">

    <h2>Ställning</h2>

    <div class="stats">
        <?php foreach ($players as $player) : ?>
            <p><?= $player->getName() ?>: <?= $player->getScore() ?> </p>
        <?php endforeach; ?>
    </div>

</div>
