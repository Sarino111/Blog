<?php

require '../_inc/config.php';

$post_id = $_POST['post_id'];

$id = filter_var($id, FILTER_VALIDATE_INT);

if ( ! $post_id )
{
    redirect('back');
}

/*
echo '<pre>';
echo print_r( $data['post_id'] );
echo '</pre>';
*/




$delete_post = $db->prepare("
    DELETE FROM posts
    WHERE id = :post_id
");

$delete_post->execute([
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


if ( $delete_post->rowCount() ) 
{
        
    flash()->success("I was deleted");
    redirect( get_home_link() );
}

flash()->warning('Sorry mate');
redirect('back');



?>