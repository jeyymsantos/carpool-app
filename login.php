<?php

include 'includes/connection.php';
include 'includes/exist.php';

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
    $title = $_SESSION['title'];
}

include 'user_components/head.php';
include 'user_components/modal.php';
?>

<title>Sabay App | Login Page </title>
</head>

<body style="background-color: #430852; font-family: 'Montserrat'">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Dancing+Script:wght@700&family=Montserrat:wght@500&family=Oswald&family=Pacifico&family=Shalimar&family=Shrikhand&family=Sigmar&family=Varela+Round&family=Xanh+Mono:ital@1&display=swap" rel="stylesheet">

    <div class="container my-3 col-lg-5 p-4 mt-8" style="background-color: #FBEDFF;  border-radius: 20px">

        <?php
        if (!empty($_SESSION['message'])) :
        ?>
            <div class="alert alert-<?= $bg ?> alert-dismissible fade show" role="alert">
            <?= $message ?>
                <?= $title ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            
            unset($_SESSION['bg']);
            unset($_SESSION['title']);
            unset($_SESSION['message']);
        endif ?>


        <center><img src="assets/img/login_illustration.png" alt="" width=300 height=250>
            <h1 style="font-family: 'Shrikhand', cursive; color: #430852; font-size: 90px;"> Sabay </h1>
            <p style="font-family: 'Montserrat'"><i>making your daily Filipino trips convenient</i> </p>
        </center>


        <?php require 'user_components/modal.php'; ?>
        <hr>
        <form method="POST" action="config/login.php" class="rounded">

            <div class="mb-1">

                <label for="inputEmail" class="form-label"></label>
                <input name="email" type="email" placeholder="email address" required class="form-control" id="inputEmail" aria-describedby="emailHelp" style="  border: 2px solid #430852; border-radius: 20px;">

            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label"></label>
                <input minlength="8" placeholder="password" name="password" type="password" class="form-control" id="inputPassword" style="  border: 2px solid #430852; border-radius: 20px;">
            </div>
            <button type="submit" class="btn btn-primary" style=" border-radius: 18px; background-color: #430852; width: 280px">Login</button>
            <a href="register.php" class="btn btn-secondary" style=" border-radius: 18px; width: 280px">Register</a>
        </form>
    </div>

    <?php
    include_once 'user_components/foot.php';
    ?>