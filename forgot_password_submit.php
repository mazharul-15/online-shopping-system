<?php
    include_once("connection.inc.php");
    include_once("function.inc.php");

    // collecting email from jquery
    $email = get_safe_value($con, $_POST['email']);

    //checking email id is exist or not
    $sql_email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $sql_email_check);

    $email_check = mysqli_num_rows($res);

    if($email_check > 0) {

        $row = mysqli_fetch_assoc($res);
        $password = $row['password'];
        $html = "<h3>$password</h3>";

        // Sending Email to Admin.
        include_once("smtp/PHPMailerAutoload.php");
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->post = 587; // 465;
        $mail->SMTPSecure = "tls";
        $mail->SMTPAuth = true;
        $mail->Username = "pilifedeveloping@gmail.com";
        $mail->Password = "mbxidpyyzquooeyn"; // App Pasword: mbxidpyyzquooeyn
        $mail->SetFrom("pilifedeveloping@gmail.com");
        $mail->addAddress($email);
        $mail->IsHTML(true);
        $mail->Subject = "New OTP";
        $mail->Body = $html;
        $mail->SMTPOptions = array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));

        // $mail->send();

        if($mail->send()) {

            echo 'your password is sent to your email id. Please go to <a href="login.php">login page</a>';
            die();
        }else {

            echo "Not";
        }

    }else {
        echo "This email id is not registered";
        die();
    }
?>