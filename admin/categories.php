<?php
    // including header file
    include_once("top.inc.php");


    // $sql = "SELECT * FROM categories ORDER BY categories desc";
    // $res = mysqli_query($con, $sql);

    // Categories Active/Deactive/Delete/Edit
    /*if(isset($_GET['type']) && $_GET['type'] != ''){

        $type = get_safe_value($con, $_GET['type']);

        if($type == 'status') {

            $operation = get_safe_value($con, $_GET['operation']);
            $id = get_safe_value($con, $_GET['id']);

            if($operation == "active") {
                $status = 1;
            } else {
                $status = 0;
            }

            $sql = "UPDATE categories set status = $status WHERE id = $id";
            mysqli_query($con, $sql);
        }
    } */


    // for edit it goes to "edit_category.php"

    // category: Active / Deactive/ Delete
    if(isset($_GET['status'])) {
        $status = get_safe_value($con, $_GET['status']);
        $id = get_safe_value($con, $_GET['id']);

        if($status == 'active') {

            // sql for categories table
            $sql = "UPDATE categories SET status = 1 WHERE id = $id";

            // sql for sub categories
            $sql_sub_category = "UPDATE sub_categories SET status = 1 WHERE categories_id = $id";
            
            // sql for product table
            $sql_product = "UPDATE product SET status = 1 WHERE categories_id = $id";

        } elseif($status == 'deactive') {

            // sql for categories table
            $sql = "UPDATE categories SET status = 0 WHERE id = $id";

            // sql for sub categories
            $sql_sub_category = "UPDATE sub_categories SET status = 0 WHERE categories_id = $id";

            //sql for product table
            $sql_product = "UPDATE product SET status = 0 WHERE categories_id = $id";

        }elseif($status == 'delete') {

            // sql for categories table
            $sql = "DELETE FROM categories WHERE id = $id";

            // retrive image name for deleting
            $sql_image = "SELECT product.image FROM product WHERE categories_id = $id";
            $res_image = mysqli_query($con, $sql_image);
            while($row_image = mysqli_fetch_assoc($res_image)) {
                $image = $row_image['image'];
                unlink("../media/product/".$image);
            }

            // sql for sub categories
            $sql_sub_category = "DELETE FROM sub_categories WHERE categories_id = $id";

            // sql for product table
            $sql_product ="DELETE FROM product WHERE categories_id = $id";

        }

        // sent query to database
        // DB request to categories table
        mysqli_query($con, $sql);

        // DB request to sub categories table
        mysqli_query($con, $sql_sub_category);

        // DB request to product table
        mysqli_query($con, $sql_product);
    }

    // sql query for categories from database
    $sql = "SELECT * FROM categories ORDER BY categories desc";
    $res = mysqli_query($con, $sql);
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Categories</h4>
                        <h4 class="box-link"><a href="manage_categories.php"> Add Categories</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                       <th >#</th>
                                       <th>ID</th>
                                       <th>Categories</th>
                                       <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $id = 1;
                                        while($row = mysqli_fetch_assoc($res)) {?>
                                        <tr>
                                            <td class = "serial"><?php echo $id++; ?></td>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['categories']; ?></td>
                                            <td><?php 
                                                if($row['status'] == 1) {
                                                    echo "<span class= 'badge badge-complete'><a href='?status=deactive&id=".$row['id']."'>Active</a></span>&nbsp";
                                                }else {
                                                    echo "<span class= 'badge badge-pending'><a href='?status=active&id=".$row['id']."'>Deactive</a></span>&nbsp";
                                                }
                                                echo "<span class= 'badge badge-edit'><a href='edit_category.php?status=edit&id=".$row['id']."'>Edit</a></span>&nbsp";
                                                echo "<span class= 'badge badge-delete'><a href='?status=delete&id=".$row['id']."'>Delete</a></span>";
                                            ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    // including footer file
    include_once("footer.inc.php");
?>