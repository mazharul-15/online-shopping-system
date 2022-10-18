<!-- Including Section of Header Page -->

<?php 
    // top.php page
    include_once("top.php");

    // Category id
    $product_id = mysqli_real_escape_string($con, $_GET['id']);

    // Display product 
    $get_product = get_product($con, '', '', $product_id);
    // prx($get_product);
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
                                  <a class="breadcrumb-item" href="categories.php?id=<?php echo $get_product[0]['categories_id']; ?>"><?php echo $get_product[0]['categories']; ?></a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active"><?php echo $get_product[0]['name']; ?></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Details Area -->
        <section class="htc__product__details bg__white ptb--100">
            <!-- Start Product Details Top -->
            <div class="htc__product__details__top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                            <div class="htc__product__details__tab__content">
                                <!-- Start Product Big Images -->
                                <div class="product__big__images">
                                    <div class="portfolio-full-image tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                            <img src="media/product/<?php echo $get_product[0]['image']; ?>" alt="full-image">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Product Big Images -->
                                
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                            <div class="ht__product__dtl">
                                <h2><?php echo $get_product[0]['name']; ?></h2>
                                <ul  class="pro__prize">
                                    <li class="old__prize">Tk.<?php echo $get_product[0]['mrp']; ?></li>
                                    <li>Tk.<?php echo $get_product[0]['price']; ?></li>
                                </ul>
                                <p class="pro__info"><?php echo $get_product[0]['short_desc']; ?></p>
                                <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                        <p><span>Availability:</span>
                                        <?php
                                            // product quantity check if avialable or not
                                            if($get_product[0]['qty'] > 0) {
                                                echo "In Stock: " . $get_product[0]['qty'];
                                                ?> 
                                                <div style="margin-top: 10px;">
                                                    <a href="javascript:void(0)" onclick="manage_cart(<?php echo $get_product[0]['id']?>,'add')" class = "fr__btn">
                                                        Add to cart
                                                    </a>
                                                    <div class = "zero_qty_message"></div>
                                                </div>
                                                <?php
                                            }else {
                                                echo "Not Availabe";
                                            }
                                        ?> 
                                        </p>
                                    </div>
                                    <div class="sin__desc">
                                        <p>
                                            <span>QTY:</span>
                                            <select name="quantity" id="qty">
                                                <option value="">0</option>
                                                <?php
                                                    $start = 1;
                                                    $end = $get_product[0]['qty']; 
                                                    while($start <= $end) { ?>
                                                        <option value="<?php echo $start;?>"><?php echo $start++; ?></option>
                                                    <?php } ?>
                                                
                                            </select>
                                        </p>
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="categories.php?id=<?php echo $get_product[0]['categories_id']; ?>"><?php echo $get_product[0]['categories']; ?>,</a></li>
                                        </ul>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Details Top -->
        </section>
        <!-- End Product Details Area -->

        <!-- Start Product Description -->
        <section class="htc__produc__decription bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="ht__pro__details__content">
                            <!-- Start Single Content -->
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <h4 class="ht__pro__title">Description</h4>
                                    <p>
                                        <?php echo $get_product[0]['description']; ?>
                                    </p>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product Description -->

<?php 
    // footer.php page
    include_once("footer.php");
?>