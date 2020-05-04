<?php

namespace Anax\View;

/**
 * Select a movie to edit or delete or add a new one
 */

?>

<h1>Admin</h1>

<p>Lägg till, redigera eller radera filmer ur databasen.</p>

<form method="post">
    <p>
        <label>Film:<br>
        <select name="movieId">
            <option value="">Välj film</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" class="add" name="doAdd" value="Lägg till">
        <input type="submit" class="edit" name="doEdit" value="Redigera">
        <input type="submit" class="delete" name="doDelete" value="Radera">
    </p>
</form>
