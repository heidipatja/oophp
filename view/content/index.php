<?php

namespace Anax\View;

/**
 * Index page for movie database
 */

if (!$resultset) {
    return;
}
?>

<h1>Översikt</h1>

<table class="content-table">
    <tr class="first">
        <th>Id</th>
        <th>Titel</th>
        <th>Typ</th>
        <th>Path</th>
        <th>Slug</th>
        <th>Skapad</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->path ?></td>
        <td><?= $row->slug ?></td>
        <td><?= $row->created ?></td>
    </tr>
<?php endforeach; ?>
</table>
