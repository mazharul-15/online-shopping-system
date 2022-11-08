<?php
    //including database connection
    include_once("connection.inc.php");

    //including function
    include_once("function.inc.php");
    // send OTP
    $email = get_safe_value($con, $_POST['email']);
    $otp = rand(1111, 9999);
    $_SESSION['otp'] = $otp;
    $html = "<h3>$otp</h3> is your OTP";

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
        echo "done";
    }else {
        echo "Not";
    }
?>