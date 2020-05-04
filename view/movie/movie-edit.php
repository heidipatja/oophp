<?php

namespace Anax\View;

/**
 * Edit a movie
 */

?>

<h1>Redigera film</h1>

<form method="post">
    <input type="hidden" name="movieId" value="<?= $movie->id ?>"/>

    <p>
        <label for "movieTitle">Titel:</label>
        <input type="text" name="movieTitle" value="<?= $movie->title ?>"/>
        </label>
    </p>

    <p>
        <label for "movieYear">År:</label>
        <input type="number" name="movieYear" value="<?= $movie->year ?>"/>
    </p>

    <p>
        <label for "movieImage">Bild:</label>
        <input type="text" name="movieImage" value="<?= $movie->image ?>"/>
        </label>
    </p>

    <p>
        <input type="submit" class="save" name="doSave" value="Save">
        <input type="reset" class="reset" value="Reset">
    </p>
    <p>
        <a href="movie-select">Tillbaka</a>
    </p>
</form>
