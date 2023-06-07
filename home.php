<?php


try 
{
    $results = get_posts();
} catch ( PDOException $e)
{   $results = [];
};


require '_partial/header.php';

?>

<section class="box post-title">
    <h1 class="box-heading text-muted">This is my blog</h1>

    <?php foreach ($results as $post): ?>
    <article id="id-<?= $post->id ?>" class="home">
        <header class="post-header">
            <h2>
                <a href="<?= $post->link ?>" class="post-header ">
                <?= $post->title ?>
                </a>
                <time datetime="<?= $post->date ?>">
                    <small class="text-muted date"><?= $post->time ?></small>
                </time>
            </h2>
        </header>

        <p><?= $post->text ?></p>

        <p class="tags">
            <?php if ( isset($post->tags) ) : ?>
                <?php foreach ($post->tag_links as $tag => $tag_link) : ?>
                <a href="<?= $tag_link ?>" class="btn btn-dark btn-sm" > <?= $tag ?></a>
                <?php endforeach  ?>
            <?php endif ?>
        </p>

    </article>

    <?php endforeach ?>












</section>







<?php

require_once '_partial/footer.php';

?>