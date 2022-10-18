<?php
    include_once("connection.inc.php");
    include_once("function.inc.php");
    

    // collecting data
    $email = get_safe_value($con, $_POST['email']);
    $password = get_safe_value($con, $_POST['password']);

    // sql
    $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";

    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    $res_name = mysqli_fetch_assoc($res);

    if($count > 0) {
        $_SESSION['user_login'] = 'yes';
        $_SESSION['user_name'] = $res_name['name'];
        $_SESSION['user_id'] = $res_name['id'];
        
        echo "valid";
        
    } else {
        echo "wrong";
    }
?>