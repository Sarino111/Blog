<?php

/*
$id = segment(2);

try 
{
    $result = get_post( $id );
} catch ( PDOException $e)
{   $result = false;
};

$post = $result;
*/
/*
echo '<pre>';
echo print_r( $_POST );
echo '</pre>';
*/


require '_partial/header.php';

?>

<div class="page-header">
    <h1 class="box-heading text-muted">Add post</h1>
</div>

<section class="box">
    <form action="<?= BASE_URL ."/_admin/add-item.php" ?>" method="post" enctype="multipart/form-data" class="mb-3 edit-post">
    
    <input type="hidden" name="user_id" value="<?= $user->uid ?>" >
    
    <header class="post-header">
        <h1 class="box-heading">Title</h1>
    </header>
    
    <div class="form-group">
        <input type="text" name="title" class="form-control" value="" placeholder="title" >
    </div>
    
    <div class="form-group">
            <textarea name="text" id="" cols="20" rows="16" class="form-control"></textarea>
        </div>
        
        <?php if ( isset( $id ) ) : ?>
            <?php  foreach ( get_all_tags($id) as $tag ) : ?>
                
                <div class="form-group">
                    <label for="" class="checkbox">
                    <input type="checkbox" name="tags[]" value="<?= $tag->id ?>" >
                    <?= plain($tag->tag) ?>
                </label>
            </div>
            
            <?php endforeach ?>
            <?php endif ?>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary mt-4">Add post</button>
            <span class="or">
                <a href="<?= BASE_URL ?>">cancel</a>
            </span>
        </div>

        
        
        <h3 class="text-center mb-5">Upload File in PHP 8</h3>
        <div class="user-image mb-3 text-center">
            <div style="width: 100px; height: 100px; overflow: hidden; background: #cccccc; margin: 0 auto">
                
                <img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder" alt="">
                
            </div>
        </div>
        <div class="custom-file">
            <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile">
            <label class="custom-file-label" for="chooseFile">Select file</label>
        </div>
        
        
        
    </form>
</section>














</section>







<?php

require_once '_partial/footer.php';

?>