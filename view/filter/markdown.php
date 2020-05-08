<?php

namespace Anax\View;

/**
 * Markdown
 */

?>

<h1>Markdown</h1>

<h2>Text från sample.md</h2>
<pre><?= $text ?></pre>

<h2>Med filtret Markdown</h2>
<pre><?= htmlentities($html) ?></pre>

<h2>Texten formatterad som HTML</h2>
<?= $html ?>
