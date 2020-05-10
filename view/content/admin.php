<?php

namespace Anax\View;

/**
 * Admin page
 */


if (!$resultset) {
    return;
}
?>

<h1>Admin</h1>

<a class="reset button" href="reset">Återställ</a>
<a class="create button" href="create">Skapa</a>

<table class="content-table">
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
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
        <td>
            <a href="edit?id=<?= $row->id ?>"><i class="fas fa-edit"></i></a>
            <a href="delete?id=<?= $row->id ?>"><i class="fas fa-trash"></i></a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
