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
            $sql = "UPDATE sub_categories SET status = 1 WHERE id = $id";
            // sql for product table
            $sql_product = "UPDATE product SET status = 1 WHERE sub_categories_id = $id";

        } elseif($status == 'deactive') {

            // sql for categories table
            $sql = "UPDATE sub_categories SET status = 0 WHERE id = $id";
            //sql for product table
            $sql_product = "UPDATE product SET status = 0 WHERE sub_categories_id = $id";

        }elseif($status == 'delete') {

            // sql for categories table
            $sql = "DELETE FROM sub_categories WHERE id = $id";
            // sql for product table
            $sql_product ="DELETE FROM product WHERE sub_categories_id = $id";

        }

        // sent query to database
        // DB request to categories table
        mysqli_query($con, $sql);
        // DB request to product table
        mysqli_query($con, $sql_product);
    }

    // sql query for categories from database
    $sql = "SELECT sub_categories.*, categories.categories FROM sub_categories, categories 
    WHERE sub_categories.categories_id = categories.id"; //ORDER BY sub_categories asc";

    $res = mysqli_query($con, $sql);
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Sub Categories</h4>
                        <h4 class="box-link"><a href="manage_sub_categories.php"> Add Sub Categories</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                       <th >#</th>
                                       <th>ID</th>
                                       <th>Categories</th>
                                       <th>Sub Categories</th>
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
                                            <td><?php echo $row['sub_categories']; ?></td>
                                            <td><?php 
                                                if($row['status'] == 1) {
                                                    echo "<span class= 'badge badge-complete'><a href='?status=deactive&id=".$row['id']."'>Active</a></span>&nbsp";
                                                }else {
                                                    echo "<span class= 'badge badge-pending'><a href='?status=active&id=".$row['id']."'>Deactive</a></span>&nbsp";
                                                }
                                                echo "<span class= 'badge badge-edit'><a href='edit_sub_categories.php?status=edit&id=".$row['id']."'>Edit</a></span>&nbsp";
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