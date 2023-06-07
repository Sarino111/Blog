<?php

function get_query( $where = false )
{
    $query = "
        SELECT p.*,pu.email, GROUP_CONCAT( t.tag SEPARATOR '-|-' ) AS tags
        FROM posts p 
        LEFT JOIN post_tags pt ON p.id = pt.post_id
        LEFT JOIN tags t ON pt.tag_id = t.id 
        LEFT JOIN phpauth_users pu ON p.user_id = pu.id
        ";

    if ( isset( $where ) )
    {
        $query .= $where;
    }

    $query .= " GROUP by p.id"; 
    
    return $query;
}


function get_posts( $auto_format = true )
{

    global $db;

    $results = $db -> query( get_query() );

    $results->rowCount() ? $posts = $results->fetchAll(PDO::FETCH_ASSOC) : [];

    if ( $auto_format === true )
    {
        $posts = array_map('format_post', $posts );
    }

    return $posts;
}


function get_post( $post_id = 0, $auto_format = true )
{
    global $db;

    $result = $db -> prepare( get_query( "WHERE p.id = :pid" ));

    $result -> execute([
        'pid' => $post_id
    ]);

    $result = $result -> fetch(PDO::FETCH_ASSOC);

    if ( $auto_format === true )
    {
        $result = format_post( $result );
    }

    return $result;

}

function get_all_tags( $post_id = 0)
{
    global $db;

    $query = $db -> query ("
        SELECT * FROM tags        
    ");

    $query->rowCount() ? $results = $query -> fetchAll(PDO::FETCH_OBJ) : false;

    if ( isset($post_id) ) 
    {
        $query = $db-> prepare("
        SELECT t.id FROM tags t
        JOIN post_tags pt ON t.id = pt.tag_id
        WHERE pt.post_id = :pid
        ");

        $query->execute([
            'pid' => $post_id
        ]);

        $query->rowCount() ? $get_tags = $query->fetchAll(PDO::FETCH_COLUMN) : false;

        if ( isset( $get_tags ) && (! $get_tags == 0) )
        {

           foreach ( $results as $key => $tag )
           {
                if (in_array( $tag->id, $get_tags))
                {
                    $results[$key] -> checked = true;
                }
                
            }
            //$get_post_tag = in_array( $post_id, $get_post_tag);
        }       
         
    }

    return $results;
}


function format_post( $post ) 
{
    $post['title'] = plain( $post['title'] );
    $post['text']  = plain( $post['text'] );

    if ( $post['tags'] ) {

        $post['tag'] = explode( '-|-', $post['tags'] );
        $post['tag'] = array_map( 'plain', $post['tag'] );

        foreach ( $post['tag'] as $tag )
        {
            $post['tag_links'][$tag] = BASE_URL . '/tag/' . $tag;
        }
    }

    $post['id'] = filter_var($post['id'], FILTER_VALIDATE_INT);

    $post['timestamp'] = strtotime( $post['created_at']);    
    $post['date'] = date( 'Y m d', $post['timestamp'] );
    $post['time'] = date( 'd.m.Y g:i', $post['timestamp'] );

    $post['link'] = get_post_link( $post, '/post/' );
    $post['link_home'] = get_home_link();
    $post['edit_link'] = get_edit_link( $post );
    $post['delete_link'] = get_delete_link( $post);

    return (object) $post;
}


function get_tag_post( $tag = 0, $auto_format = true )
{

    $tag = urlencode( $tag );
    $tag = plain( $tag );

    global $db;

    $get_post = $db -> prepare (get_query( "WHERE t.tag = :tag" ) );

    $get_post->execute([
        'tag' => $tag
    ]);


    $get_post->rowCount() ? $results = $get_post->fetchAll(PDO::FETCH_ASSOC) : [] ;

    if ( $auto_format === true )
    {
        $results = array_map('format_post', $results );
    }

    return $results;

}


function get_user_post( $user_id = 0, $auto_format = true )
{

    global $db;

    $get_post = $db -> prepare (get_query( "WHERE p.user_id = :pid" ) );

    $get_post->execute([
        'pid' => $user_id
    ]);


    $get_post->rowCount() ? $results = $get_post->fetchAll(PDO::FETCH_ASSOC) : [] ;

    if ( $auto_format === true )
    {
        $results = array_map('format_post', $results );
    }

    return (object) $results;

}


function get_post_link( $post, $path = '/post/')
{
    if ( is_array( $post ))
    {
        $id = $post['id'];
    }
    else
    {
        $id = $post->id;
    }
    
    $link = BASE_URL . $path . $id;


    return filter_var($link, FILTER_SANITIZE_URL);
}

function get_home_link( $path = '/' )
{
    $link = BASE_URL . $path;


    return filter_var($link, FILTER_SANITIZE_URL);
}


function get_edit_link( $post, $path = '/edit/')
{
    return $link = get_post_link( $post, $path );
}

function get_delete_link( $post, $path = '/delete/')
{
    return get_post_link( $post, $path );
}


function validate_post()
{
    $title = htmlspecialchars( $_POST['title'], ENT_HTML5);
    $text  = htmlspecialchars( $_POST['text'], ENT_HTML5);
    $tags  = filter_input( INPUT_POST, 'tags', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
    $user_id = filter_var( $_POST['user_id'], FILTER_VALIDATE_INT);
    
    if ( $post_id = isset( $_POST['post_id'] ) )
    {
        $post_id = filter_input( INPUT_POST, 'post_id', FILTER_VALIDATE_INT);

        
        if ( ! $post_id )
        {
            flash()->error('What are you trying to pull here');
        }
    } 
    else 
    {
        $post_id = false;
    } 
    

    if ( ! $title = trim( $title ))
    {
        flash()->error('Write some title');
    }

    if ( ! $text = trim($text)  )
    {
        flash()->error('write some text man');
    }

    if ( flash()->hasMessages() )
    {
        return false;
    }

return compact(
    'post_id', 'title', 'text', 'tags', 'user_id',
    $post_id, $title, $text, $tags, $user_id
);

}



function validate_image( $target_file )
{

// control if file exist
if ( ! file_exists( $target_file['fileUpload']['tmp_name'] ) ) {
    return false;    
}
// Get file extension
$imageExt = strtolower(pathinfo($target_file['fileUpload']['full_path'], PATHINFO_EXTENSION));

// Allowed file types
$allowed_file_ext = array('jpg', 'jpeg', 'png');

if ( ! in_array($imageExt, $allowed_file_ext) ) {
    flash()->error("Allowed file formats .jpg, .jpeg and .png");
    redirect('back');
}

// image not bigger than 3MB
if ( $target_file["fileUpload"]["size"] > 3097152 ) {
        flash()->error("File is too large. File size should be less than 2 megabytes.");
        redirect('back');
}

return $target_file;

}

?>