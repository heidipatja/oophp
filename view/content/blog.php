<?php

namespace Anax\View;

/**
 * Blog
 */


if (!$resultset) {
    return;
}
?>

<h1>Blogg</h1>

<article>

<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h2 class="blog-title-link"><a href="blog/blogpost?slug=<?= esc($row->slug) ?>"><?= esc($row->title) ?></a></h1>
        <p><i>Publicerad: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p>
    </header>
    <?= $row->data ?>
</section>
<?php endforeach; ?>

</article>
