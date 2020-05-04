<?php

namespace Anax\View;

/**
 * Edit a movie
 */

?>

<h1>Redigera film</h1>

<form method="post">
    <input type="hidden" name="movieId" value="<?= $movie->id ?>"/>

        <label for "movieTitle">Titel:</label>
        <input type="text" name="movieTitle" value="<?= $movie->title ?>"/>
        </label>

        <label for "movieYear">År:</label>
        <input type="number" name="movieYear" value="<?= $movie->year ?>"/>


        <label for "movieImage">Bild:</label>
        <input type="text" name="movieImage" value="<?= $movie->image ?>"/>

        <br>

        <input type="submit" class="save" name="doSave" value="Save">
        <input type="reset" class="reset" value="Reset">

        <p>
            <a href="movie-select">Tillbaka</a>
        </p>
</form>
