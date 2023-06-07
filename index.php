<?php

require '_inc/config.php';



$routes = [
 
    '/' =>[
        'GET' => 'home.php'],

    '/register' => [
        'GET' => 'register.php',
        'POST'=> 'register.php'
    ],

    '/login' => [
        'GET' => 'login.php',
        'POST'=> 'login.php'
    ],

    '/logout' => [
        'GET' => 'logout.php',
        'POST'=> 'logout.php'
    ],

    '/post' => [
        'GET'  => 'post.php'],
        'POST' => '_admin/add-post.php',

    '/edit' => [
        'GET'  => 'edit.php',
        'POST' => '_admin/edit-post.php'],

    '/delete' => [
        'GET'  => 'delete.php',
        'POST' => '_admin/delete-post.php' ],

    '/tag' => [
        'GET'  => 'tag.php'
    ],

    '/user' => [
        'GET' => 'user.php'
    ]

    ];
 

$method = $_SERVER['REQUEST_METHOD'];
$page = segment(1);

$allowed = ['login', 'register'];

if ( ! in_array( $page, $allowed) && ! logged_in() )
{
    redirect('/login');
}


if ( ! isset( $routes["/$page"][$method] ) )
{
    show_404();
}
require $routes["/$page"][$method];




?>