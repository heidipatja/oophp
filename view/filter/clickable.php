<?php

namespace Anax\View;

/**
 * Clickable links
 */

?>

<h1>Clickable</h1>

<h2>Text från clickable.txt</h2>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h2>Formatterad som HTML</h2>
<?= $text ?>

<h2>Med filtret Clickable</h2>
<pre><?= wordwrap(htmlentities($html)) ?></pre>

<h2>Med filtret Clickable formatterad som HTML</h2>
<?= $html ?>
