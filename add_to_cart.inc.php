<?php
    class add_to_cart {

        // adding product
        function addProduct($pid, $qty) {
            $_SESSION['cart'][$pid]['qty'] = $qty;
        }

        // update product list
        function updateProduct($pid, $qty) {
            if(isset($_SESSION['cart'][$pid])) {
                $_SESSION['cart'][$pid]['qty'] = $qty;
            }
        }

        // remove product from list
        function removeProduct($pid) {
            if(isset($_SESSION['cart'][$pid])) {
                unset($_SESSION['cart'][$pid]);
            }
        }

        // empty the product list
        function emptyProduct() {
            unset($_SESSION['cart']);
        }

        // count total product
        function totalProduct() {
            if(isset($_SESSION['cart'])) {

                return count($_SESSION['cart']);
            }else {
                return 0;
            }
        }
    }
?> 