<?php

require '../_inc/config.php';

/*
echo '<pre>';
echo print_r( $_POST );
echo '</pre>';
*/

if ( ! $data = validate_post() )
{
    redirect('back');
}

extract( $data );

echo '<pre>';
echo print_r( $tags );
echo '</pre>';

$post = get_post( $post_id, false );


$updated_post = $db->prepare("
    UPDATE posts SET
        title = :title,
        text  = :text        
    WHERE
        id = :post_id
");

$updated_post->execute([
    'title'   => $title,
    'text'    => $text,
    'post_id' => $post_id
]);




// If I have tags, delete them 

    $delete_tags = $db -> prepare("
        DELETE post_tags FROM post_tags
        WHERE post_id = :pid
    ");

    $delete_tags->execute([
        'pid' => $post_id
    ]);


// If I set new tags, set them
if ( isset( $tags ) ) 
{
    foreach ( $tags as $tag_id)
    {
        $update_tags = $db -> prepare("
        INSERT INTO post_tags
        VALUES (:post_id, :tag_id)
        ");

        $update_tags = $update_tags->execute([
            'post_id' => $post_id,
            'tag_id'  => $tag_id
        ]);
    }
}

if ( $updated_post->rowCount() ) 
{
        
    flash()->success("Yey' I'm edited");
    redirect( get_post_link( $post ) );
}

flash()->warning('Sorry mate');
redirect('back');



?>