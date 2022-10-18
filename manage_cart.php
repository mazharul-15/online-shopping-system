<?php
    include_once('connection.inc.php');
    include_once('function.inc.php');
    include_once('add_to_cart.inc.php');

    $pid = get_safe_value($con, $_POST['pid']);
    $qty = get_safe_value($con, $_POST['qty']);
    $type = get_safe_value($con, $_POST['type']);

    // Creating Object
    $obj = new add_to_cart();

    if($type == 'add') {

        $obj->addProduct($pid, $qty);

    }elseif($type == 'remove') {

        $obj->removeProduct($pid);

    }elseif($type == 'update') {

        $obj->updateProduct($pid, $qty);

    }

    // print total product
    echo $obj->totalProduct(); 
?>  