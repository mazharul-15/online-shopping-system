<?php
    // Adding file
    include_once("connection.inc.php");
    include_once("function.inc.php");

    $msg = '';
    //Admin Log IN info sent to Database
    if(isset($_POST['submit'])) {

        $username = get_safe_value($con, $_POST['username']);
        $password = get_safe_value($con, $_POST['password']);
        // sql for qeury
        $sql = "SELECT * FROM admin_users WHERE username = '$username' && password = '$password'";

        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);
        //Checking Log info
        if($count > 0) {
            //Session Started
            session_start();
            $_SESSION['ADMIN_LOGIN'] = 'yes';
            $_SESSION['ADMIN_USER_NAME'] = $username;
            header("location: categories.php");

        }else {
            $msg = "Please enter correct info";
        }
    }

?>

<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/styles.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body class="bg-dark">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <form method = "post">
                     <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name = "username" class="form-control" placeholder="user name" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name = "password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" name = "submit" class="btn btn-success btn-flat m-b-30 m-t-30">Log In</button>
					</form>

                    <!-- ERROR Message Print -->
                    <div style = "color: red; margin-top: 10px;">
                        <?php if($msg != NULL) {echo $msg; } ?>
                    </div>
               </div>
            </div>
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>