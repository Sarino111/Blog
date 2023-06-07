<?php


$id = segment(2);


try 
{
    $result = get_post( $id );
} catch ( PDOException $e)
{   $result = false;
};

$post = $result;





require '_partial/header.php';

?>


<section class="box post-title post">
    <h1 class="box-heading text-muted">Delete :(</h1>

    <form action="<?= BASE_URL ?>/_admin/delete-item.php" method="post" class="delete-post" >
        <header class="post-header">
            <h2>
                <a href="<?= $post->link ?>" class="post-header ">
                <?= $post->title ?>
                </a>
                <time datetime="<?= $post->date ?>">
                    <small class="text-muted"><?= $post->time ?></small>
                </time>
            </h2>
        </header>

        <p><?= $post->text ?></p>

        <p class="box">            
            <?php if ( isset( $post->tags) ) : ?>
                <?php foreach ( $post->tag_links as $tag => $tag_link ) : ?>
                    <a href="<?= $tag_link ?>" class="btn btn-dark btn-sm"><?= $tag ?></a>
                <?php endforeach ?>
            <?php endif ?>
        </p>

        <div class="form-group">
            <input name="post_id" value="<?= $post->id ?>" type="hidden">
            <button class="btn btn-danger">Delete post</button>
            <small>or</small>
            <a href="<?= $post->link ?>" class="btn btn-sm" >cancel</a>

        </div>
            
    </form>


</section>





<?php

require_once '_partial/footer.php';

?>