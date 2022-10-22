<?php
    include_once("connection.inc.php");
    include_once("function.inc.php");

    // collecting email from jquery
    $email = get_safe_value($con, $_POST['email']);
    //checking email id is exist or not
    $sql_email_check = "SELECT * FROM users WHERE email = '$email'";
    $email_check = mysqli_num_rows(mysqli_query($con, $sql_email_check));

    if($email_check > 0) {
        echo "A password reset link is sent to your email id";
        die();
    }else {
        echo "This email id is not registered";
        die();
    }
?>