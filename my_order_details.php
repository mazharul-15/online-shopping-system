<?php
    // including top page
    include_once("top.php");

    // order id for product details
    $order_id = get_safe_value($con, $_GET['id']);
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
                                    <a class="breadcrumb-item" href="my_order.php">My Order</a>
                                    <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                    <span class="breadcrumb-item active">Order Details</span>
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
                                                <td class="product-name"><img src ="media/product/<?php echo $row['image']; ?>"></td>
                                                <td class="product-name"><?php echo $row['qty']; ?></td>
                                                <td class="product-name"><?php echo $row['price']; ?></td>
                                                <td class="product-name"><?php echo $total_price; ?></td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                            <tr>
                                                <td colspan = "3" style = "background: #ba9999;">
                                                <?php if($final_price > 0) {?>
                                                    <a href = "invoice_pdf.php?id=<?php echo $order_id; ?>"><b>Download PDF</b></a>
                                                <?php } ?>
                                                </td>
                                                <td class = "product-name">Total Price</td>
                                                <td class = "product-name"><?php echo $final_price;?></td>
                                            </tr>
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