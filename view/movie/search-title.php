<?php

namespace Anax\View;

/**
 * Search title in movie database
 */

?>

<h1>Sök på titel</h1>

<p>Sök efter en filmtitel. Använd % som wildcard.</p>

<form method="get">
    <input type="hidden" name="route" value="search-title">
    <p>
        <label for "searchTitle">Titel:</label>
        <input type="search" name="searchTitle" value="<?= esc($searchTitle) ?>"/>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Sök">
    </p>
</form>
