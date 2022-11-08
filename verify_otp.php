<?php
    //including database connection
    include_once("connection.inc.php");

    //including function
    include_once("function.inc.php");
    // send OTP
    $otp = get_safe_value($con, $_POST['otp']);
    if($otp == $_SESSION['otp']) {
        echo 'done';
    }else {
        echo 'not';
    }
?>