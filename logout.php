<?php


if ( ! logged_in() )
{
    return false;
} else
{

    log_out();
    flash()->success('Ou, you are log out man');
    redirect('/login');
}




?>

