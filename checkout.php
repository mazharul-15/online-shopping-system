<?php 
    // including top.php
    include_once("top.php");
    //prx($_SESSION['cart']);
    // prx(count($_SESSION['cart']));

    //Check whether the cart is empty or not
    if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        ?>
        <script>
            window.location.href = "index.php";
        </script>
        <?php
    }

    // Collecting order info
    if(isset($_POST['submit'])) {
        // prx($_POST);
        $user_name = get_safe_value($con, $_POST['user_name']);
        $address = get_safe_value($con, $_POST['address']);
        $email = get_safe_value($con, $_POST['email']);
        $mobile = get_safe_value($con, $_POST['mobile']);
        $paymet_type = get_safe_value($con, $_POST['payment_type']);

        $user_id = $_SESSION['user_id'];

            // Total price:
        $total_cart = 0;
        foreach($_SESSION['cart'] as $key => $val) {
            $productArr = get_product($con, '', '', $key, '');

            // prx($productArr);
            $price = $productArr[0]['price'];
            $qty = $val['qty'];
            $total_cart += ($price * $qty);

            product_quantity_update($con, $key, $qty);
        }

        // prx($total_cart);

        //payment method checking
        if($paymet_type == 'paynow') {

        }else {
            $payment_status = 'pending';
        }

        $order_status = 1;
        $added_on = date('y-m-d h:i:s');

        // sending order to database
        $sql = "INSERT INTO orders(user_id, user_name, address, payment_type, total_price, payment_status,
        order_status, added_on)
        VALUES('$user_id', '$user_name', '$address', '$paymet_type', '$total_cart', '$payment_status', 
        '$order_status', '$added_on')";

        mysqli_query($con, $sql);

        //get id of last inserted data
        $order_id = mysqli_insert_id($con);
        foreach($_SESSION['cart'] as $key => $val) {
            $productArr = get_product($con, '', '', $key);

            // prx($productArr);
            // $name = $productArr[0]['name'];
            $price = $productArr[0]['price'];
            $qty = $val['qty'];
            // $total_price += ($price * $qty);

            // sending data to order_detail table
            $sql_order_detail = "INSERT INTO order_detail(order_id, product_id, qty, price, added_on)
            VALUES('$order_id', '$key', '$qty', '$price', '$added_on')";

            mysqli_query($con, $sql_order_detail);
        }

        // doing empty $_SESSION['cart']
        unset($_SESSION['cart']);
        // welcome your order is placed & it redirect to thank_you.php
        ?>
        <script>
            window.location.href = "thank_you.php";
        </script>
        <?php
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
                                  <span class="breadcrumb-item active">checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                    <div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <!-- <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form action="#">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="email" id="user-email">
                                                            </div>
                                                            <div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="password" id="user-pass">
                                                            </div>
                                                            <p class="require">* Required fields</p>
                                                            <div class="dark-btn">
                                                                <a href="#">LogIn</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form action="#">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Name</label>
                                                                <input type="email" id="user-email">
                                                            </div>
															<div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="email" id="user-email">
                                                            </div>
															
                                                            <div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="password" id="user-pass">
                                                            </div>
                                                            <div class="dark-btn">
                                                                <a href="#">Register</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="accordion__title">
                                        Address Information
                                    </div>
                                    <div>
                                    <!-- class="accordion__body" -->
                                        <div class="bilinfo">
                                            <form method = "POST">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name = "user_name" placeholder="Your Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name = "address"placeholder="Street Address" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="email" name = "email" placeholder="Email address" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name = "mobile" placeholder="Phone number" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion__title">
                                                    payment information
                                                </div>
                                                <div class="accordion__body">
                                                    <div class="paymentinfo">
                                                        <div class="single-method" style="font-size: 16px;">
                                                            Cash on Delivery: <input type="radio" name="payment_type" id="cod" value = "Cash on delivery"required>
                                                            &nbsp;&nbsp;Pay Now: <input type="radio" name="payment_type" id="paynow" value="paynow" required>
                                                        </div>
                                                        <div class="single-method">
                                                            <input type="submit" name = "submit" value="Submit" class = "btn btn-primary mt-2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                                
                                <?php 

                                    if(isset($_SESSION['cart'])) {
                                        $total_price = 0;
                                        foreach($_SESSION['cart'] as $key => $val) {
                                            $productArr = get_product($con, '', '', $key);

                                            // prx($productArr);
                                            $name = $productArr[0]['name'];
                                            $price = $productArr[0]['price'];
                                            $image = $productArr[0]['image'];
                                            $qty = $val['qty'];
                                            $total_price += ($price * $qty);
                                ?>
                                <!-- product Quantity -->
                                <div>
                                    <input type="hidden" id = "<?php echo $key?>qty" value="<?php echo $qty; ?>">
                                </div>
                                <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="media/product/<?php echo $image ?>" alt="ordered item" >
                                </div>
                                <div class="single-item__content">
                                    <a href="product.php?id=<?php echo $key; ?>"><?php echo $name; ?></a>
                                    <span class="price">Tk. <?php echo $price ?></span>
                                </div>
                                <div class="single-item__remove">
                                    <a href="javascript:void(0)"
                                    onclick = "manage_cart('<?php echo $key; ?>','remove')"><i class="icon-trash icons"></i></a>
                                </div>

                            </div>
                            <?php } }?>
                        </div>
                            <div class="order-details__count">
                                <!-- <div class="order-details__count__single">
                                    <h5>sub total</h5>
                                    <span class="price">$909.00</span>
                                </div>
                                <div class="order-details__count__single">
                                    <h5>Tax</h5>
                                    <span class="price">$9.00</span>
                                </div>
                            </div> -->
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price">Tk. <?php if(isset($total_price)) { echo $total_price; }?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->


<?php
    // including footer.php
    include_once("footer.php");
?>
