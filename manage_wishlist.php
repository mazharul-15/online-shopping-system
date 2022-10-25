<?php
    include_once('connection.inc.php');
    include_once('function.inc.php');
    include_once('add_to_cart.inc.php');

    $pid = get_safe_value($con, $_POST['pid']);
    $type = get_safe_value($con, $_POST['type']);

    // Creating Object
    if(isset($_SESSION['user_name'])) {

        $user_id = $_SESSION['user_id'];
        $added_on = date('y-m-d h:i:s'); 


        // if duplicate added or not
        $sql_dupli = "SELECT * FROM wishlist WHERE user_id = $user_id and product_id = $pid";
        $res = mysqli_query($con, $sql_dupli);
        
        if(mysqli_num_rows($res) > 0) {
            
        }else {

            $sql = "INSERT INTO wishlist(user_id, product_id, added_on) 
            VALUES('$user_id', '$pid', '$added_on')";
    
            mysqli_query($con, $sql);

            //counting total product in wishlist of a user with user_id
            $sql_total_wishlist = "SELECT * FROM wishlist WHERE user_id = $user_id";
            $result = mysqli_num_rows(mysqli_query($con, $sql_total_wishlist));

            echo $result;

        }

    }else {
        echo 'not_login';
    }
?>  