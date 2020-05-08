<?php

namespace Anax\View;

/**
 * BBCode
 */

?>

<h1>BBCode</h1>


<h2>Text från bbcode.txt</h2>
<pre><?= wordwrap(htmlentities($text)) ?></pre>

<h2>Med filtret BBCode</h2>
<pre><?= wordwrap(htmlentities($html)) ?></pre>

<h2>BBCode och nl2br()</h2>
<?= nl2br($html) ?>
