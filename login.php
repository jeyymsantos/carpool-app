<?php

include 'includes/connection.php';
include 'includes/exist.php';

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $bg = $_SESSION['bg'];
}

include 'user_components/head.php';
?>

<title>Sabay App | Login Page </title>
</head>

<body>

    <div class="container my-3 col-lg-5 p-4 mt-5" style="background-color: #fff">

        <?php
        if (!empty($_SESSION['message'])) :
        ?>
            <div class="alert alert-<?= $bg ?> alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['message']);
            unset($_SESSION['bg']);
        endif ?>

        <h1 class=""> Sabay App </h1>

        <hr>
        <form method="POST" action="config/login.php">
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email address</label>
                <input name="email" type="email" required class="form-control" id="inputEmail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input minlength="8" required name="password" type="password" class="form-control" id="inputPassword">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="register.php" class="btn btn-secondary">Register</a>
        </form>
    </div>

    <?php
    include_once 'user_components/foot.php';
    ?>