<?php

namespace Anax\View;

/**
 * Reset database
 */

?>

<h1>Återställ databasen</h1>

<p>Återställ databasen till sin ursprungliga form.</p>

<form method="get">
    <input type="submit" class="reset" name="reset" value="Återställ">
    <?= $output ?>
</form>
