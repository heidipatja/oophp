<?php

namespace Anax\View;

/**
 * Edit
 */

?>

<h1>Redigera</h1>

<form method="post">
    <input type="hidden" name="contentId" value="<?= esc($content->id) ?>"/>

        <label for "contentTitle">Titel:</label>
        <input type="text" name="contentTitle" value="<?= esc($content->title) ?>"/>
        </label>

        <label for "contentPath">Path:</label>
        <input type="text" name="contentPath" value="<?= esc($content->path) ?>"/>

        <label for "contentSlug">Slug:</label>
        <input type="text" name="contentSlug" value="<?= esc($content->slug) ?>"/>

        <label for "contentData">Text:</label>
        <textarea name="contentData"><?= esc($content->data) ?></textarea>

        <label for "contentType">Typ:</label>
        <input type="text" name="contentType" value="<?= esc($content->type) ?>"/>

        <label for "contentFilter">Filter:</label>
        <input type="text" name="contentFilter" value="<?= esc($content->filter) ?>"/>

        <label for "contentPublish">Publicera:</label>
        <input type="datetime" name="contentPublish" value="<?= esc($content->published) ?>"/>

        <br>

        <input type="submit" class="save" name="doSave" value="Spara">
        <input type="reset" class="reset" value="Återställ">
        <input type="submit" class="delete" name="doDelete" value="Radera">

    </fieldset>
</form>
