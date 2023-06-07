<?php


$id = segment(2);

if ( $id === 'new' )
{
    include_once 'add.php';
    die();
}

try 
{
    $result = get_post( $id );
} catch ( PDOException $e)
{   $result = false;
};

$post = $result;
$user = get_user();

/*
echo '<pre>';
echo print_r( $post);
echo '</pre>';
*/

require '_partial/header.php';

?>
<div>

    <p class="post_img" >
        <img src="<?= $post->image ?>" class="image" alt="post image">
    </p>
    <h1 class="box-heading text-muted title">This is a post</h1>

</div>

<section class="box post-title post">
    

    <article id="id-<?= $post->id ?>" class="post">
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

            <?php if ( $user->uid === $post->user_id ) : ?>
                <a href="<?= $post->edit_link ?>" class="btn btn-info" >Edit post</a>
                <small>or</small>
                <a href="<?= $post->delete_link ?>" class="btn btn-danger" >Delete post</a>
            <?php endif ?>

            <a href="<?= $post->link_home ?>" class="btn btn-sm" >cancel</a>

        </div>
            
    </article>














</section>







<?php

require_once '_partial/footer.php';

?>