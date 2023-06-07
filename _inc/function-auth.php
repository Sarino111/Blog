<?php


function logged_in()
{

    global $auth, $auth_config;

    if ( ! isset($_COOKIE[$auth_config->cookie_name] ) ) 
    { return false;
    } else {
        return true;
    }
  
  
}


function get_user()
{
    global $auth, $auth_config;

    if ( ! isset( $_COOKIE[$auth_config->cookie_name] ) ) return false;

    $user_id = $auth->getSessionUID( $_COOKIE[$auth_config->cookie_name] );
    $user = $auth->getUser( $user_id );

    return (object) $user;

}

function log_out( ) {
    
    global $auth, $auth_config;

    $auth->logout( $_COOKIE[$auth_config->cookie_name] );

}


?>