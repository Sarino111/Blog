<?php

if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
{
    $email = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat'];

    global $auth, $auth_config;

    $register = $auth->register($email, $password, $repeat_password);

    if ( $register['error'] )
    {
        flash()->error( $register );
    }
    flash()->success('Now, you fill the same');
    redirect('/login');

}





require_once '_partial/header.php'


?>




<form method="POST" action"" class="box box-auth">
    
    <h2 class="box-auth-heading">Register</h2>
    <input type="text" name="email" class="form-control" placeholder="email" required >
    <input type="password" name="password" class="form-control" placeholder="password" required> 
    <input type="password" name="repeat" class="form-control" placeholder="repeat password" required> 

    <label class="checkbox">
        <button class="btn btn-lg btn-primary btn-block" type="submit" >register</button>
    </label>

    <p class="alt-action text-center">
        or
        <a href="<?= BASE_URL ?>/login">log in</a>
    </p>
</form>


<?php require_once '_partial/footer.php' ?>