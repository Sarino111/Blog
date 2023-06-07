<?php


$user = get_user();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blogByMe</title>

    <link rel="stylesheet" href="<?= BASE_URL.'/_assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL.'/_assets/css/blog.css' ?>">
</head>
<body>

<header></header>

    <main id="<?= segment(1) ?>" >

    <?= flash()->display() ?>

    <header class="navbar ">

        <?php if ( logged_in() ) : ?>
            
            <p class="d-flex">
                <a href="<?= BASE_URL ?>" class="btn btn-outline-light btn-sm ">Home</a>
                <a href="<?= BASE_URL ?>/post/new/" class="btn btn-outline-light btn-sm ">Add post</a>
            </p>

            <p class="d-flex">
                <a href="<?= BASE_URL ."/user/".$user->uid ?>" class="btn btn-outline-light btn-sm "><?= $user->email ?></a>
                <a href="<?= BASE_URL ."/logout" ?>" class="btn btn-outline-light btn-sm ">log out</a>
            </p>
        <?php endif ?>

    </header>

