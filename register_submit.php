<?php
    include_once("connection.inc.php");
    include_once("function.inc.php");
    

    // collecting data
    $name = get_safe_value($con, $_POST['name']);
    $email = get_safe_value($con, $_POST['email']);
    $mobile = get_safe_value($con, $_POST['mobile']);
    $password = get_safe_value($con, $_POST['password']);
    $added_on = date('y-m-d h:i:s');

    // duplicate email checking
    $sql_dupli = "SELECT * FROM users WHERE email = '$email'";
    $count = mysqli_num_rows(mysqli_query($con, $sql_dupli));
    //$count = mysqli_num_rows($res);

    // sql
    $sql = "INSERT into users(name, password, email, mobile, added_on)
    VALUES('$name', '$password', '$email', '$mobile', '$added_on')";

    if($count > 0) {

        echo "This email address is already registered!!";

    }elseif(mysqli_query($con, $sql)) {
        echo "Welcome, Successfully Registered";
    }
?>