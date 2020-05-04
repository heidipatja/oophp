<?php

namespace Anax\View;

/**
 * Show all - with sorting
 */


if (!$resultset) {
    return;
}
$defaultRoute = "?route=show-all-sort&"
?>

<table class="movie-table">
    <tr class="first">
        <th>Rad</th>
        <th>Id <?= orderby("id", $defaultRoute) ?></th>
        <th>Bild <?= orderby("image", $defaultRoute) ?></th>
        <th>Titel <?= orderby("title", $defaultRoute) ?></th>
        <th>År <?= orderby("year", $defaultRoute) ?></th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="../image/movie/<?= $row->image ?>?w=150&aspect-ratio=3:2&crop-to-fit"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
<?php endforeach; ?>
</table>
