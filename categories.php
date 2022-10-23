<!-- Including Section of Header Page -->

<?php 
    // top.php page
    include_once("top.php");

    // sort
    if(isset($_GET['sort'])) {

        if($_GET['sort'] == 'default') {

            $sort_by = " ORDER  BY product.id desc";

        }elseif($_GET['sort'] == 'price_high') {

            $sort_by = " ORDER BY product.price asc";

        }elseif($_GET['sort'] == 'price_low') {

            $sort_by = " ORDER BY product.price desc";

        }elseif($_GET['sort'] == 'new') {

            $sort_by = " ORDER BY product.id asc";

        }elseif($_GET['sort'] == 'old') {

            $sort_by = " ORDER BY product.id desc";

        }
    }
 
    // Category id
    $cat_id = mysqli_real_escape_string($con, $_GET['id']);

    // Display product
    if($cat_id > 0) {
        if(isset($sort_by)) {

            $get_product = get_product($con, '', $cat_id, '', '', $sort_by);

        } else {
            $get_product = get_product($con, '', $cat_id, '', '', '');
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
    // prx($get_product); 
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
                                    <select class="ht__select" onchange = "sort_product(<?php echo $cat_id;?>)" 
                                    id = "sort_product">
                                        <option value = "default">Default softing</option>
                                        <option value = "price_high">Sort by price low to high</option>
                                        <option value = "price_low">Sort by price high to low</option>
                                        <option value = "new">Sort by new first</option>
                                        <option value="old">Sort by old first</option>
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


<script>
    function sort_product(cat_id) {
        var sorted_by = jQuery("#sort_product").val();
        // console.log(cat_id, "  ", sorted_by);
        window.location.href="categories.php?id="+cat_id+"&sort="+sorted_by;

    }
</script>

<?php 
    // footer.php page
    include_once("footer.php");
?>