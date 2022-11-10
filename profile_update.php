<?php
    // including connection.inc.php
    include_once("connection.inc.php");
    include_once("function.inc.php");

    $id = get_safe_value($con, $_POST['id']);
    $name = get_safe_value($con, $_POST['name']);
    $email = get_safe_value($con, $_POST['email']);
    $password = get_safe_value($con, $_POST['password']);
    $mobile = get_safe_value($con, $_POST['mobile']);

    $sql = "UPDATE users SET name = '$name', password = '$password', email = '$email', mobile = '$mobile' 
    WHERE id = $id";

    if(mysqli_query($con, $sql)) {
        $_SESSION['user_name'] = $name;
        echo "done";
    }
?>