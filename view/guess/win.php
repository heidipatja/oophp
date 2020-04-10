<?php

namespace Anax\View;

/**
 * View for won guess game
 */


?><h1>Gissa mitt nummer</h1>

<p>Grattis! Nummer <?= $number ?> var rätt.

<p>Du vann spelet med <?= $tries ?> försök kvar.</p>

<form method="post" action="play">
    <input type="hidden" name="guess" autofocus>
    <input type="hidden" name="doGuess" value="Gissa">
    <input type="submit" name="doInit" value="Spela igen">
    <input type="hidden" name="doCheat" value="Fuska">
</form>
