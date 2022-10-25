<!-- Connecting to database -->
<?php
    include_once("connection.inc.php");
    include_once("function.inc.php");

    //including add_to_cart.inc.php
    include_once("add_to_cart.inc.php");

    // dispaly category name form database start
    $sql = "SELECT * FROM categories WHERE status = 1 ORDER BY categories asc";
    $cat_res = mysqli_query($con, $sql);

    $cat_arr = array();
    
    while($row = mysqli_fetch_assoc($cat_res)) {
        $cat_arr[] = $row;
    }
    // dispaly category name form database end

    // fetching sub_categories name form sub_categories table
    $sql_sub = "SELECT * FROM sub_categories WHERE status = 1"; //ORDER BY sub_categories asc";
    $sub_cat = mysqli_query($con, $sql_sub);

    $sub_cat_arr = array();
    while($sub_row = mysqli_fetch_assoc($sub_cat)) {
        $sub_cat_arr[] = $sub_row;
        // prx($sub_row);
    }

    // display total product that is stored into $_SESSION['cart']
    $obj = new add_to_cart();
    $total_product = $obj->totalProduct();

?>

<!-- Header page  -->

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>jammer's eShop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">


    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Area -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
                                <div class="logo">
                                     <!-- <a href="index.php"><img src="images/logo/4.png" alt="logo images"></a> -->
                                     <h3><a href="index.php">jammer's eShop</a></h3>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-7 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <!-- Category From Database -->
                                        <?php foreach($cat_arr as $list) { ?>
                                        <li class = "drop">
                                            <a href="categories.php?id=<?php echo $list['id'];?>"><?php echo $list['categories'];?></a>
                                            <!-- sub categories -->
                                            <ul class="dropdown ">
                                                <?php foreach($sub_cat_arr as $sub_list) { 
                                                    if($list['id'] == $sub_list['categories_id']) { ?>
                                                        <li>
                                                            <a href="sub_categories.php?id=<?php echo $sub_list['id'];?>"> <?php echo $sub_list['sub_categories']; ?></a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                <?php } ?>  
                                            </ul>
                                        </li>
                                        <?php } ?>    
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>
                                <!-- FOR  Mobile Menu -->
                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>

                                            <!-- Category From Database -->
                                        <?php foreach($cat_arr as $list) { ?>
                                        <li class = "drop">
                                            <a href="categories.php?id=<?php echo $list['id'];?>"><?php echo $list['categories'];?></a>
                                            <!-- sub categories -->
                                            <ul class="dropdown ">
                                                <?php foreach($sub_cat_arr as $sub_list) { 
                                                    if($list['id'] == $sub_list['categories_id']) { ?>
                                                        <li>
                                                            <a href="sub_categories.php?id=<?php echo $sub_list['id'];?>"> <?php echo $sub_list['sub_categories']; ?></a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                <?php } ?>  
                                            </ul>
                                        </li>
                                        <?php } ?>                                            
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>  
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-4 col-xs-4">
                                <div class="header__right">

                                    <!-- Search Option -->
                                    <div class="header__search search search__open">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    <div class="header__account" >
                                        <!-- <a href="login.php"><i class="icon-user icons"></i></a> -->
                                        <?php
                                            
                                            if(isset($_SESSION['user_login'])) {

                                                echo '<a href = "logout.php" style = "font-size: 10px;">'.$_SESSION['user_name'].'</a>';
                                                //echo '<a href ="logout.php" style ="font-size: 12px">log out</a>';
                                                echo '<a href ="my_order.php" style ="font-size: 12px">My Order</a>';

                                            }else {

                                                echo '<a href="login.php">Login/Register</a>';

                                            }
                                        ?>
                                    </div>

                                    <!-- Shopping Cart -->
                                    <div class="htc__shopping__cart">
                                        <a href="wishlist.php"><i class="icon-heart icons"></i></a>
                                        <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua">
                                            <?php
                                                echo $total_product;
                                                // if(isset($_SESSION['user_login'])&& isset($_SESSION['cart'])) echo count($_SESSION['cart']);
                                            ?>
                                        </span></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>

        <!-- Start Search Popap -->
        <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input placeholder="Search here... " type="text" name = "search" required>
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
        <!-- End Header Area -->