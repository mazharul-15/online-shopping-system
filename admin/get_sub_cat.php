<?php
    // including database connection
    include_once("connection.inc.php");

    // including function.inc.php
    include_once("function.inc.php");

    $categories_id = get_safe_value($con, $_POST['categories_id']);

    // fetching sub categories according to their category
    $sql = "SELECT * FROM sub_categories WHERE categories_id = $categories_id and status = 1";
    
    $res = mysqli_query($con, $sql);

    if(mysqli_num_rows($res) > 0) {
        $html = '<option value = "0">Select Sub Category</option>';
        while($row = mysqli_fetch_assoc($res)) {
            $html .= "<option value = ".$row['id'].">".$row['sub_categories']."</option>";
            // $html .= '<option value = "'.$row['id'].'">'.$row['sub_categories'].'</option>';
        }
        echo $html;
    }else {
        echo "<option>No Sub Category</option>";
    }
?>