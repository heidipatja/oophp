<?php

namespace Anax\View;

/**
 * View for lost guess game
 */


?><h1>Gissa mitt nummer</h1>

<p>Ajdå! Du har <?= $tries ?> gissningar kvar.</p>

<p>Rätt svar var <?= $number ?>.</p>

<form method="post" action="play">
    <input type="hidden" name="guess" autofocus>
    <input type="hidden" name="doGuess" value="Gissa">
    <input type="submit" name="doInit" value="Spela igen">
    <input type="hidden" name="doCheat" value="Fuska">
</form>
