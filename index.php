<!-- Including Section of Header Page -->

<?php 
    // top.php page
    include_once("top.php");

    //Get Latest Products From DB usnig product Table
    $get_product = get_product($con, 12, '', '', '', '');
    // prx($get_product);
    $best_product = get_product($con, 4, '', '', 1, '');
    // prx($best_product);
?>

    <div class="body__overlay"></div>
        <!-- Start Slider Area -->
        <div class="slider__container slider--one bg__cat--3">
            <div class="slide__container slider__activation__wrap owl-carousel">
                <!-- Start Single Slide -->
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h2>collection 2022</h2>
                                        <h1>NICE T-Shirt</h1>
                                        <div class="cr__btn">
                                            <a href="index.php">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="images/slider/fornt-img/slider-1.jpg" alt="slider images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
                <!-- Start Single Slide -->
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h2>collection 2022</h2>
                                        <h1>NICE Sharee</h1>
                                        <div class="cr__btn">
                                            <a href="index.php">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="images/slider/fornt-img/slider-2.jpg" alt="slider images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
            </div>
        </div>
        <!-- End Slider Area -->
        <!-- Start Category Area -->
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">New Arrivals</h2>
                            <p>But I must explain to you how all this mistaken idea</p>
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">

                            <!-- Start Single Category -->
                            <?php foreach($get_product as $list) { ?>
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <!-- Product Image -->
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=<?php echo $list['id']; ?>">
                                            <img src="media/product/<?php echo $list['image']; ?>" alt="product images">
                                        </a>
                                    </div>

                                    <!-- Wish List, Cart -->
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li>
                                                <a href="javascript:void(0)" onclick="wishlist_manage(<?php echo $list['id'];?>,'add')">
                                                    <i class="icon-heart icons"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="manage_cart(<?php echo $list['id'];?>,'add')">
                                                    <i class="icon-handbag icons"></i>
                                                    <!-- for quantity -->
                                                    <input type="hidden" id = "qty" value = "1">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- product price -->
                                    <div class="fr__product__inner">
                                        <h4><a href="product.php?id=<?php echo $list['id'] ?>"><?php echo $list['name'] ?></a></h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize">TK.<?php echo $list['mrp']; ?></li>
                                            <li>TK.<?php echo $list['price']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- End Single Category -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Category Area -->
        <!-- Start Product Area -->
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Best Seller</h2>
                            <p>But I must explain to you how all this mistaken idea</p>
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">

                            <!-- Start Single Category -->
                            <?php foreach($best_product as $list) { ?>
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <!-- Product Image -->
                                    <div class="ht__cat__thumb">
                                        <a href="product.php?id=<?php echo $list['id'] ?>">
                                            <img src="media/product/<?php echo $list['image']; ?>" alt="product images">
                                        </a>
                                    </div>

                                    <!-- Wish List, Cart -->
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li>
                                                <a href="javascript:void(0)" onclick="wishlist_manage(<?php echo $list['id'];?>,'add')">
                                                    <i class="icon-heart icons"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" onclick="manage_cart(<?php echo $list['id'];?>,'add')">
                                                    <i class="icon-handbag icons"></i>
                                                    <!-- for quantity -->
                                                    <input type="hidden" id = "qty" value = "1">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- product price -->
                                    <div class="fr__product__inner">
                                        <h4><a href="product.php?id=<?php echo $list['id'] ?>"><?php echo $list['name'] ?></a></h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize">TK.<?php echo $list['mrp']; ?></li>
                                            <li>TK.<?php echo $list['price']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- End Single Category -->
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- End Product Area -->


<!-- Including Section of Footer Page -->
<?php 
    // footer.php page
    include_once("footer.php");
?>