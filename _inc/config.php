<?php

// global function
require_once 'function-general.php';
require_once 'function-string.php';
require_once 'function-post.php';
require_once 'function-auth.php';


// authorization function
require_once 'vendor/phpauth/sources/Helpers.php';
require_once 'vendor/phpauth/sources/AuthInterface.php';
require_once 'vendor/phpauth/sources/Auth.php';
require_once 'vendor/phpauth/sources/ConfigInterface.php';
require_once 'vendor/phpauth/sources/Config.php';



// show all errors
ini_set('display_startup_errors', 1 );
ini_set('display_errors', '1');
error_reporting(E_ALL & ~E_NOTICE);

// show flash message
if( !session_id() ) @session_start();

// Initialize Composer Autoload
require_once 'vendor/autoload.php';

// Constants
define( 'BASE_URL', 'http://localhost/blog2' );
define( 'PATH_URL', realpath( __DIR__ . '/../' ));

// database
$config = [

    'db' => [
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'blog',
    'username' => 'root',
    'password' => 'root'
    ]
];

$db = new PDO('mysql:host=localhost;dbname=blog', 'root', 'root');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$auth_config = new \PHPAuth\Config($db);
$auth   = new \PHPAuth\Auth($db, $auth_config);


?>