<?php

namespace Anax\View;

/**
 * View for playing guess game
 */


?><h1>Gissa mitt nummer</h1>

<p>Gissa på ett nummer mellan 1 och 100.</p>

<p>Du har <?= $tries ?> försök kvar.</p>

<?php if ($res) : ?>
    <p class="result"><?= $res ?></p>
<?php endif; ?>


<form method="post" action="play">
    <input type="number" name="guess" autofocus>
    <input type="submit" name="doGuess" value="Gissa">
    <input type="submit" name="doInit" value="Börja om">
    <input type="submit" name="doCheat" value="Fuska">
</form>
