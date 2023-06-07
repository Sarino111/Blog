<?php

function show_404()
{
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    die();
}


function redirect( $data, $status_code = 302 )
{
    if ( $data === 'back' ) {
        $link = $_SERVER['HTTP_REFERER'];
    } else {
        $link = str_replace( BASE_URL, '', $data );
        $link = ltrim($link, '/');
        $link = trim( $link );
        $location = BASE_URL . "/$link";

    }

    header("Location: $location", true, $status_code);
    die();
}


//
function get_segments() {

$current_url = 'http'.
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 's://' : '://')
    . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$segments = str_replace( BASE_URL, '', $current_url);
$segments = parse_url($segments, PHP_URL_PATH);
$segments = trim($segments, '/');
$segments = explode('/', $segments);

return $segments;


}

function segment( $index )
{
    $segments = get_segments();
    
    return isset($segments[$index-1]) ? $segments[$index-1] :false;
}


function upload_image( $image, $post_id ) {


    $suffix = ['jpg', 'jpeg', 'png' ];
    $image = trim($image);

    fopen( PATH_URL."/_img/".$image, "r" );


}











?>