<?php


if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
{

$username = filter_var( $_POST['username'], FILTER_VALIDATE_EMAIL);
$password = $_POST['password'];
$remember = isset( $_POST['rememberMe'] ) ? : 0 ;

global $auth, $auth_config;

   $login = $auth->login($username, $password, $remember);

    if ( $login['error'] )
    {
        flash()->error($login);
    } else
    {
    flash()->success('Yay, you are logged');
    redirect('/');
    }

}

require_once '_partial/header.php'

?>




<form method="POST" action"" class="box box-auth">
    
    <h2 class="box-auth-heading">Login</h2>
    <input type="email" name="username" class="form-control" placeholder="username" required >
    <input type="password" name="password" class="form-control" placeholder="password" required> 

    <label class="checkbox">
         <input type="checkbox" value="1" id="rememberMe" name="rememberMe" checked > remember me
        <button class="btn btn-lg btn-primary btn-block" type="submit" >Log in</button>
    </label>

    <p class="alt-action text-center">
        or
        <a href="<?= BASE_URL ?>/register">Create account</a>
    </p>
</form>


<?php require_once '_partial/footer.php' ?>