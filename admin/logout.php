<?php
    session_start();
    // Admin Logout
    unset($_SESSION['ADMIN_LOGIN']);
    unset($_SESSION['ADMIN_USER_NAME']);

    header("location: login.php");
    die();
?>