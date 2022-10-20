<?php
    // include_once("admin/function.inc.php");
    function pr($arr){
        echo '<pre>';
    }

    function prx($arr) {
        echo '<pre>';
        print_r($arr);
        die();
    }
    
    function get_safe_value($con, $str) {
        if($str != '') {
            return mysqli_real_escape_string($con, $str);
        }
    }
    // GET PRODUCT FUNCTION FOR Front-End
    function get_product($con, $limit = '', $cat_id = '', $product_id = '', $best_seller = '') {

        // Query & request to DB for Product
        // Join Operation between product & categories Table
        $sql = "SELECT product.*, categories.categories FROM product, categories WHERE product.status = 1";

        // category id
        if($cat_id != '') {
            $sql .= " and product.categories_id = $cat_id ";
        }

        // product id
        if($product_id != '') {
            $sql .= " and product.id = $product_id ";
        }

        //best seller
        if($best_seller != '') {
            $sql .= " and best_seller = $best_seller";
        }

        // product.categories_id == categories.id
        $sql .= " and product.categories_id = categories.id ";

        // order by decreasing
        $sql.= " ORDER BY product.id desc";

        // limit for home page for latest product
        if($limit != '') {
             $sql.= " limit $limit";
        }
        
        //getting product
        $res = mysqli_query($con, $sql); 

        // Product Array
        $data = array();

        while($row = mysqli_fetch_assoc($res)) {
            $data[] = $row;
        }

        // return data array with product
        return $data;

    }

    // sending data to contact_us table
    function send_message($con, $data) {
        $name = $data['name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        $message = $data['message'];
        $added_on = date('y-m-d h:i:s');

        $sql = "INSERT into contact_us(`name`, email, mobile, comment, added_on) 
        VALUES('$name', '$email', '$mobile', '$message', '$added_on')";

        if(mysqli_query($con, $sql)) {
            return "Message is sent successfully";
        }
    }


    // User Register Area
    function user_register($con, $data) {

        // collecting data
        $name = get_safe_value($con, $data['name']);
        $password = get_safe_value($con, $data['password']);
        $email = get_safe_value($con, $data['email']);
        $mobile = get_safe_value($con, $data['mobile']);
        $added_on = date('y-m-d h:i:s');

        // duplicate email checking
        $sql_dupli = "SELECT * FROM users WHERE email = '$email'";
        $count = mysqli_num_rows(mysqli_query($con, $sql_dupli));
        //$count = mysqli_num_rows($res);

        // sql
        $sql = "INSERT into users(name, password, email, mobile, added_on)
        VALUES('$name', '$password', '$email', '$mobile', '$added_on')";

        if($count > 0) {

            return "This email address is already registered!!";

        }elseif(mysqli_query($con, $sql)) {
            return "Welcome, Successfully Registered";
        }
    }

    // User Login Area
    function user_login($con, $data) {
        $email = get_safe_value($con, $data['email']);
        $password = get_safe_value($con, $data['password']);
        //sql

        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";

        // requesting  to DB
        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);
        $res_name = mysqli_fetch_assoc($res);

        if($count > 0) {

            // session_start();
            $_SESSION['user_login'] = 'yes';
            $_SESSION['user_name'] = $res_name['name'];
            $_SESSION['user_id'] = $res_name['id'];

            ?>
            <script>
                window.location.href='index.php';
            </script> 
            <?php

        }else {

            return "Please enter correct info!!";

        }
    }
?>