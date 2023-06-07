<?php

$user_id = segment(2);

try 
{
    $results = get_user_post( $user_id );
} catch ( PDOException $e)
{   
    $results = [];
};

$user = get_user();


require '_partial/header.php';

?>


<section class="box post-title">
    <h1 class="box-heading text-muted">user...&nbsp;<?= $user->email ? : '' ?></h1>

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

        <?php if (isset( $post->tag)) : foreach ( $post->tag_links as $tag => $tag_link ) : ?>

            <a href="<? $tag_link ?>" class="btn btn-dark btn-sm"><?= $tag ?></a>
        <?php endforeach ?>
        <?php endif ?>

    </article>
    <?php endforeach ?>
 
</section>


<?php

require_once '_partial/footer.php';

?>