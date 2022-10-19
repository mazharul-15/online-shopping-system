<?php
    //including top.php
    include_once("top.php");

    // Category id
    $sub_cat_id = mysqli_real_escape_string($con, $_GET['id']);

    // Display product
    if($sub_cat_id > 0) {

        //$get_product = get_product($con, '', $sub_cat_id, '');
        $sql = "SELECT product.*, categories.categories, sub_categories.sub_categories 
        FROM product, categories, sub_categories WHERE product.sub_categories_id = $sub_cat_id and 
        product.categories_id = categories.id and product.sub_categories_id = sub_categories.id";
        $res = mysqli_query($con, $sql);
        // prx($res);

        $get_product = array();

        while($row = mysqli_fetch_assoc($res)) {
            $get_product[] = $row;
            // prx($row);
        }

    }else {
        // header("location: index.php");
        // die();
        ?>
        <script>
            window.location.href = 'index.php';
        </script>
        <?php

    }
?>

<div class="body__overlay"></div>
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
                                  <span class="breadcrumb-item active">
                                    <?php 
                                        if(count($get_product) >0 ) {
                                            echo $get_product[0]['categories'];
                                        }else {
                                            echo "Products";
                                        } 
                                    ?>
                                </span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <div class="row">
                    <?php if(count($get_product) > 0) {?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="htc__product__rightidebar">
                            <div class="htc__grid__top">
                                <div class="htc__select__option">
                                    <select class="ht__select">
                                        <option>Default softing</option>
                                        <option>Sort by popularity</option>
                                        <option>Sort by average rating</option>
                                        <option>Sort by newness</option>
                                    </select>
                                </div>
                                
                            </div>
                            <!-- Start Product View -->
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">

                                        <!-- Start Single Product -->
                                        <?php foreach($get_product as $list) { ?>
                                        <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                                            <div class="category">
                                                <div class="ht__cat__thumb">
                                                    <a href="product.php?id=<?php echo $list['id'] ?>">
                                                        <img src="media/product/<?php echo $list['image']; ?>" alt="product images">
                                                    </a>
                                                </div>
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
                                        <!-- End Single Product -->
                                    </div>
                                </div>
                                <!-- End Product View -->
                            </div>
                        </div>
                    </div>
                    <?php }else {
                        echo "No products found!!";
                    } ?>
                </div>
            </div>
        </section>
        <!-- End Product Grid -->
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
    // including footer.php
    include_once("footer.php");
?>