<?php

namespace Anax\View;

/**
 * Search for year in movie database
 */

?>

<h1>Sök på år</h1>

<p>Sök efter en film genom att använda årtal.</p>

<form method="get">
    <input type="hidden" name="route" value="search-year">
    <p>
        <label for "year1">Utgiven mellan:</label>
        <input type="number" name="year1" value="<?= $year1 ?: 1900 ?>" min="1900" max="2100"/>
        -
        <input type="number" name="year2" value="<?= $year2  ?: 2100 ?>" min="1900" max="2100"/>
        </label>
        <input type="submit" name="doSearch" value="Sök">
</form>
