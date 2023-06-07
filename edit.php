<?php



$id = segment(2);

try 
{
    $result = get_post( $id );
} catch ( PDOException $e)
{   $result = false;
};

$post = $result;

/*
echo '<pre>';
echo print_r( $post );
echo '</pre>';
*/


require '_partial/header.php';

?>

<div class="page-header">
    <h1 class="box-heading text-muted">This is edit</h1>
</div>

<section class="box">
    <form action="<?= BASE_URL ."/_admin/edit-item.php" ?>" method="post" class="edit-post">
        
        <header class="post-header">
            <h1 class="box-heading">Edit&nbsp;"<?= $post->title ?>"</h1>
        </header>

        <div class="form-group">
            <input type="text" name="title" class="form-control" value="<?= $post->title ?>" placeholder="title" >
        </div>

        <div class="form-group">
            <textarea name="text" id="" cols="20" rows="16" class="form-control"><?= $post->text ?></textarea>
        </div>

        <?php if ( isset( $id ) ) : ?>
        <?php  foreach ( get_all_tags($id) as $tag ) : ?>

            <div class="form-group">
                <label for="" class="checkbox">
                    <input type="checkbox" name="tags[]" value="<?= $tag->id ?>" 
                    <?= isset($tag->checked) ? "checked" : '' ?> ><?= plain($tag->tag) ?>
                </label>
            </div>

        <?php endforeach ?>
        <?php endif ?>

        <div class="form-group">
            <input name="post_id" value="<?= $post->id ?>" type="hidden">
            <button class="btn btn-primary">Edit post</button>
            <span class="or">
                <a href="<?= $post->link ?>">cancel</a>
            </span>
        </div>

    </form>
</section>














</section>







<?php

require_once '_partial/footer.php';

?>