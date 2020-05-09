<?php

namespace Anax\View;

/**
 * Show all pages and posts
 */


if (!$resultset) {
    return;
}
?>

<table>
    <tr class="first">
        <th>Id</th>
        <th>Titel</th>
        <th>Typ</th>
        <th>Publicerad</th>
        <th>Skapad</th>
        <th>Uppdaterad</th>
        <th>Raderad</th>
        <th>Åtgärder</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>
