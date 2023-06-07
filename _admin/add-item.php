<?php

require '../_inc/config.php';


if ( ! $data = validate_post() )
{
    redirect('back');
}


extract( $data );
/*
echo '<pre>';
echo print_r(  $_POST  );
echo '</pre>';
*/

if ( validate_image($_FILES) ) 
{
    $img = $_FILES;
} 


$slug = slugify( $title );


if ( isset($img) ) {
    // Set image placement folder
    $target_dir = "../_img/";

    // Get file path
    $path_img = $target_dir . basename( $img["fileUpload"]["name"] );   

    if (!file_exists( $img["fileUpload"]["tmp_name"] )) {
        // Validation goes here
    } else 
    {
        if (move_uploaded_file($img["fileUpload"]["tmp_name"], $path_img))
        {            
            $insert_post = $db->prepare("
                INSERT INTO posts
                    (user_id, title, text, image, slug)
                VALUES (:user_id, :title, :text, :image, :slug)
                ");

            $insert_post->execute([
                'user_id' => $user_id,
                'title'   => $title,
                'text'    => $text,
                'image'   => $path_img, 
                'slug'    => $slug
            ]);
        }
    }
} 
else
{
    $insert_post = $db->prepare("
    INSERT INTO posts
            (user_id, title, text, slug)
    VALUES (:user_id, :title, :text, :slug)
    ");

    $insert_post->execute([
        'user_id' => $user_id,
        'title'   => $title,
        'text'    => $text,
        'slug'    => $slug
    ]);
} 


$lastId = $db->lastInsertId();

$post['id'] = $lastId;

// If I set new tags, set them
if ( isset( $tags ) ) 
{
    foreach ( $tags as $tag_id)
    {
        $insert_tags = $db -> prepare("
        INSERT INTO post_tags
        VALUES (:post_id, :tag_id)
        ");

        $insert_tags = $insert_tags->execute([
            'post_id' => $lastId,
            'tag_id'  => $tag_id
        ]);
    }
}


if ( $insert_post->rowCount() ) 
{
        
    flash()->success("Yey' I added :)");
    redirect( get_post_link( $post ) );
}

flash()->warning('Sorry mate');
redirect('back');





?>