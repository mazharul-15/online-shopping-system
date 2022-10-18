<?php 
    // including connection.inc.php
    include_once("connection.inc.php");
    include_once("function.inc.php");
    unset($_SESSION['user_login']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_id']);
    unset($_SESSION['cart']);
    ?>
    
    <script>
        window.location.href='index.php';
    </script>

    <?php
    die();
?>