<?php
    // including top.inc.php
    include_once("top.inc.php");

    // order id for product details
    $order_id = get_safe_value($con, $_GET['id']);

    // Change the status
    if(isset($_POST['change_status'])) {
        $id = get_safe_value($con, $_POST['status_change']);
        // prx($_POST);
        $sql = "UPDATE orders SET order_status = '$id' WHERE id = $order_id";
        mysqli_query($con, $sql);
    }

?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Order Master Details</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class = "table">
                                <thead>
                                     <tr>
                                        <th class="product-thumbnail">Product Name</th>
                                        <th class="product-thumbnail">Product Image</th>
                                        <th class="product-name"><span class="nobr">Product Qty</span></th>
                                        <th class="product-price"><span class="nobr">Product Price</span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Total Price</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // accessing order from order_detail table
                                        $sql = "SELECT order_detail.*, product.name, product.image FROM order_detail, product
                                        WHERE order_detail.order_id = $order_id and order_detail.product_id = product.id";

                                        // sql printing and then it run into mysql db in sql section for testing
                                        // echo $sql;

                                        $res = mysqli_query($con, $sql);

                                        //for final of all products
                                        $final_price = 0;
                                        while($row = mysqli_fetch_assoc($res)) {
                                            $total_price = $row['qty'] * $row['price'];
                                            $final_price += $total_price;
                                            // prx($row);
                                        ?>
                                        <tr>
                                            <td class="product-name"><?php echo $row['name']; ?></td>
                                            <td class="product-name"><img src ="../media/product/<?php echo $row['image']; ?>"></td>
                                            <td class="product-name"><?php echo $row['qty']; ?></td>
                                            <td class="product-name"><?php echo $row['price']; ?></td>
                                            <td class="product-name"><?php echo $total_price; ?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                        <tr>
                                            <td colspan = "3" style = "">
                                                <a href = "../invoice_pdf.php?id=<?php echo $order_id; ?>"><b>Download PDF</b></a>
                                            </td>
                                            <td class = "product-name">Total Price</td>
                                            <td class = "product-name"><?php echo $final_price;?></td>
                                        </tr>
                                    </tbody>                                
                            </table>

                            <!-- Address details of user -->
                            <div id="address_details" style="padding: 10px;">
                                <strong>Address:</strong>
                                <?php
                                    $sql = "SELECT * FROM orders WHERE id = $order_id";
                                    $res = mysqli_query($con, $sql);
                                    $row = mysqli_fetch_assoc($res);
                                    $order_status = $row['order_status'];
                                ?>
                                <p><?php echo $row['address']; ?></p>
                            </div>

                            <!-- Order Status -->
                            <div id="order_status" style="padding: 10px;">
                                <?php 
                                    $sql = "SELECT * FROM order_status WHERE id = $order_status";
                                    $row = mysqli_fetch_assoc(mysqli_query($con, $sql));
                                ?>
                                <strong>Order Status:</strong> <?php echo $row['name']; ?>
                            </div>

                            <!-- Order Status Changing -->
                            <div class="order_status_changig"  style="padding: 10px;">
                                <form method = "POST">
                                    <strong>Change Order Status:</strong>
                                    <select name="status_change" class = "form-control">
                                        <option value="">Select</option>
                                        <?php
                                            // fetching data from order_status
                                            $sql = "SELECT * FROM order_status";
                                            $res = mysqli_query($con, $sql);
                                            while($row = mysqli_fetch_assoc($res)) { ?>
                                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                            <?php }
                                        ?>
                                    </select>
                                    <input type="submit" name = "change_status" value="Change" class = "form-control btn-primary btn mt-2">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    // including footer.inc.php
    include_once("footer.inc.php");
?>