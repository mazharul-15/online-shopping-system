<?php
    // including top page
    include_once("top.php");
?>


       <!-- Start Bradcaump area -->
       <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/banner.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">My Order</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- wishlist-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
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
                                                $uid = $_SESSION['user_id'];
                                                $sql = "SELECT orders.*, order_status.name FROM orders, order_status WHERE orders.user_id = $uid and 
                                                orders.order_status = order_status.id ORDER BY orders.id desc";
                                                $res = mysqli_query($con, $sql);
                                                while($row = mysqli_fetch_assoc($res)) {
                                                // prx($row);
                                            ?>
                                            <tr>
                                                <td class="product-name"><?php echo $row['id']; ?><a href = "my_order_details.php?id=<?php echo $row['id']; ?>" style = "display:block;">details</a></td>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wishlist-area end -->
        <!-- Start Banner Area -->
        <div class="htc__banner__area">
            <ul class="banner__list owl-carousel owl-theme clearfix">
                <li><a href="product-details.html"><img src="images/banner/bn-3/1.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/2.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/3.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/4.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/5.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/6.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/1.jpg" alt="banner images"></a></li>
                <li><a href="product-details.html"><img src="images/banner/bn-3/2.jpg" alt="banner images"></a></li>
            </ul>
        </div>
        <!-- End Banner Area -->
        <!-- End Banner Area -->

<?php
    // including footer page
    include_once("footer.php");
?>