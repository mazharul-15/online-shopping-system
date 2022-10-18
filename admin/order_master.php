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

    // category: Active / Deactive/ Edit / Delete
    if(isset($_GET['status'])) {
        $status = get_safe_value($con, $_GET['status']);
        $id = get_safe_value($con, $_GET['id']);

        if($status == 'delete') {
            $sql = "DELETE FROM users WHERE id = $id";
        }

        // sent query to database
        mysqli_query($con, $sql);
    }

    // sql query for categories from database
    $sql = "SELECT * FROM users";
    $res = mysqli_query($con, $sql);
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Order Master</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class = "table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Order ID</th>
                                        <th class="product-name"><span class="nobr">Order Date</span></th>
                                        <th class="product-name"><span class="nobr">User name</span></th>
                                        <th class="product-price"><span class="nobr">Address</span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Payment Type</span></th>
                                        <th class="product-add-to-cart"><span class="nobr">Payment Status</span></th>
                                        <th class="product-add-to-cart"><span class="nobr">Order Status</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    // accessing order from orders table
                                    // $uid = $_SESSION['user_id'];
                                    $sql = "SELECT orders.*, order_status.name FROM orders, order_status WHERE 
                                    orders.order_status = order_status.id ORDER BY order_status.id asc"; //orders.id desc";
                                    $res = mysqli_query($con, $sql);
                                    while($row = mysqli_fetch_assoc($res)) {
                                    // prx($row);
                                ?>
                                <tr>
                                    <td class="product-name"><?php echo $row['id']; ?><a href = "order_master_details.php?id=<?php echo $row['id']; ?>" 
                                    style = "display:block;">details</a></td>
                                    <td class="product-name"><?php echo $row['added_on']; ?></td>
                                    <td class="product-name"><?php echo $row['user_name']; ?></td>
                                    <td class="product-name"><?php echo $row['address']; ?></td>
                                    <td class="product-name"><?php echo $row['payment_type']; ?></td>
                                    <td class="product-price"><span class="amount"><?php echo $row['payment_status']; ?></span></td>
                                    <td class="product-stock-status"><span class="wishlist-in-stock"><?php echo $row['name']; ?></span></td>
                                </tr>
                                <?php
                                    }
                                ?>
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