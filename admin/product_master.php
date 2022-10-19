<?php
    // including header file
    include_once("top.inc.php");

    // Product: Active / Deactive/ Edit / Delete
    if(isset($_GET['status'])) {
        $status = get_safe_value($con, $_GET['status']);
        $id = get_safe_value($con, $_GET['id']);
        $image = get_safe_value($con, $_GET['image']);

        if($status == 'active') {
            $sql = "UPDATE product SET status = 1 WHERE id = $id";
        } elseif($status == 'deactive') {
            $sql = "UPDATE product SET status = 0 WHERE id = $id";
        }elseif($status == 'delete') {
            $sql = "DELETE FROM product WHERE id = $id";
            unlink("../media/product/".$image);
        }

        // sent query to database
        mysqli_query($con, $sql);
    }

    // sql query for product from database
    $sql = "SELECT product.*, categories.categories, sub_categories.sub_categories 
    FROM product, categories, sub_categories WHERE product.categories_id = categories.id and 
    product.sub_categories_id = sub_categories.id ORDER BY product.id desc";
    $res = mysqli_query($con, $sql);
    // prx($res);
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Products</h4>
                        <h4 class="box-link"><a href="manage_products.php"> Add Products</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                       <th class = "serial">#</th>
                                       <th>ID</th>
                                       <th>Categories</th>
                                       <th>Sub Categories</th>
                                       <th>Name</th>
                                       <th>Image</th>
                                       <th>MRP</th>
                                       <th>Price</th>
                                       <th>Qty</th>
                                       <th>Action</th>
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
                                            <td><?php echo $row['name']; ?></td>
                                            <td>
                                                <img src="../media/product/<?php echo $row['image']; ?>" alt="pic" style="width: 70px; height: 65px">
                                            </td>
                                            <td><?php echo $row['mrp']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><?php echo $row['qty']; ?></td>
                                            <td><?php 
                                                if($row['status'] == 1) {
                                                    echo "<span class= 'badge badge-complete'><a href='?status=deactive&id=".$row['id']."'>Active</a></span>&nbsp";
                                                }else {
                                                    echo "<span class= 'badge badge-pending'><a href='?status=active&id=".$row['id']."'>Deactive</a></span>&nbsp";
                                                }
                                                echo "<span class= 'badge badge-edit'><a href='edit_products.php?status=edit&id=".$row['id']."'>Edit</a></span>&nbsp";
                                                echo "<span class= 'badge badge-delete'><a href='?status=delete&id=".$row['id']."&image=".$row['image']."'>Delete</a></span>";
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