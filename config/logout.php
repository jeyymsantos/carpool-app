<?php

include '../includes/connection.php';

    unset($_SESSION['auth_id']);
    $_SESSION['bg'] =  "success";
    $_SESSION['title'] =  "Logged Out";
    $_SESSION['message'] = "Your account has been successfully logged out!";
    header('Location: ' . $home .'/login.php');

    
