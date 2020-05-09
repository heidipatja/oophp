<?php

namespace Anax\View;

/**
 * Delelte page/blog post
 */

?>

<h1>Radera</h1>

<form method="post">

    <input type="hidden" name="contentId" value="<?= esc($content->id) ?>"/>

    <label for "contentTitle">Titel:</label>
        <input type="text" name="contentTitle" value="<?= esc($content->title) ?>" readonly/>

    <br>
    <input type="submit" name="doDelete" class="delete" value="Radera">

</form>
