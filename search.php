<?php
    // including top.php page
    include_once("top.php");

    //
    if(isset($_GET['search'])) {
        $search_product = get_safe_value($con, $_GET['search']);
        if($search_product != '') {
            $get_product = get_search_products($con, $search_product);
            // prx($get_product);
        }else {
            ?>
            <script>
                window.location.href="index.php";
            </script>
            <?php
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
                            <span class="breadcrumb-item active">Search Result</span>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active"><?php echo $search_product; ?></span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Bradcaump area -->
<section class="htc__product__grid bg__white ptb--100">
<div class="container">
    <div class="row">
        <?php if(count($get_product) > 0) {?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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


<?php
    // including footer.php
    include_once("footer.php");
?>