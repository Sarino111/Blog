<?php

$tag = segment(2);

try 
{
    $results = get_tag_post( $tag );
} catch ( PDOException $e)
{   
    $results = [];
};

/*
echo '<pre>';
echo print_r( $results );
echo '</pre>';
*/




require '_partial/header.php';

?>


<section class="box post-title">
    <h1 class="box-heading text-muted">Tag...&nbsp;<?= $tag ?></h1>

    <?php foreach ($results as $post): ?>
    <article id="id-<?= $post->id ?>" class="tag">
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
            <p class="btn btn-dark btn-sm" > <?= $tag ?></p>
        </p>

    </article>

    <?php endforeach ?>












</section>







<?php

require_once '_partial/footer.php';

?>