<?php
    // top.php page
    include_once("top.php");
    
    // user_id form $_SESSION['user_id']
    if(isset($_SESSION['user_id'])) {

        $user_id = get_safe_value($con, $_SESSION['user_id']);
    }else {
        ?>
        <script>
            window.location.href = "login.php";
        </script>
        <?php
    }

    //Removing item form wishlist
    if(isset($_GET['action'])) {

        // $user_id = get_safe_value($con, $_SESSION['user_id']);
        $product_id = get_safe_value($con, $_GET['product_id']);

        $sql = "DELETE FROM wishlist WHERE user_id = $user_id and product_id = $product_id";

        mysqli_query($con, $sql);

    }

    // fetching data form wish & product table of DB
    if(isset($_SESSION['user_id'])) {
        // $user_id = get_safe_value($con, $_SESSION['user_id']);

        $sql = "SELECT product.name, product.mrp, product.price, product.image,  
        wishlist.product_id FROM product, wishlist WHERE wishlist.user_id = $user_id and 
        product.id = wishlist.product_id";

        $res = mysqli_query($con, $sql);

        $get_wishlist = array();

        while($row = mysqli_fetch_assoc($res)) {
            $get_wishlist[] = $row;
            // prx($get_wishlist);
        }
    }
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
                                  <span class="breadcrumb-item active">Wishlist</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">products</th>
                                            <th class="product-name">name of products</th>
                                            <th class="product-price">Price</th>
                                            <!-- <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th> -->
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($get_wishlist)) {
                                            foreach($get_wishlist as $list) {
                                                $image = $list['image'];
                                                $product_name = $list['name'];
                                                $product_mrp = $list['mrp'];
                                                $product_price = $list['price'];
                                                $product_id = $list['product_id'];
                                            ?>
                                            <tr>
                                                <td class="product-thumbnail"><a href="product.php?id=<?php echo $product_id; ?>"><img src="media/product/<?php echo $image; ?>" alt="product img" /></a></td>
                                                <td class="product-name"><a href="product.php?id=<?php echo $product_id;?>"><?php echo $product_name; ?></a>
                                                    <ul  class="pro__prize">
                                                        <li class="old__prize">Tk. <?php echo $product_mrp; ?></li>
                                                        <!-- <li>Tk. <?php //echo $product_price; ?></li> -->
                                                    </ul>
                                                </td>
                                                <td class="product-price"><span class="amount">Tk. <?php echo $product_price; ?></span></td>
                                                <td class="product-remove"><a href="javascript:void(0)"
                                                onclick = "remove_item('<?php echo $list['product_id']; ?>','remove')"><i class="icon-trash icons"></i></a></td>
                                                <!-- another method for performing on page action -->
                                                <!-- <td class = "Product-remove">
                                                    <a href="?action=remove&product_id=<?php //echo $list['product_id']?>"><i class="icon-trash icons"></i></a>
                                                </td> -->
                                            </tr>

                                            <?php } 
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="index.php">Continue Shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->

        <!-- Javascript for removing item -->
        <script>
            function remove_item(pid, action) {
                console.log(pid, action);
                jQuery.ajax({
                    url: 'wishlist.php',
                    type: 'GET',
                    data: 'product_id='+pid+'&action='+action,
                    success: function() {
                        window.location.href = window.location.href;
                    }
                });
            }
        </script>

<?php 
    // footer.php page
    include_once("footer.php");
?>