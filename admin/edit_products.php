<?php 
    include_once("top.inc.php");
    
    // Display Category Name form categories table for Product
    $sql = "SELECT * FROM categories";
    $res = mysqli_query($con, $sql);

    //Editing Product by id
    if(isset($_GET['status'])) {
        // header("location: contact_us.php");
        $status = get_safe_value($con, $_GET['status']);
        $id = get_safe_value($con, $_GET['id']);

        if($status == 'edit') {
            $sql1 = "SELECT product.*, categories.categories, sub_categories.sub_categories  
            FROM product, categories, sub_categories 
            WHERE product.id = '$id' and product.categories_id = categories.id and 
            product.sub_categories_id = sub_categories.id";

            $res1 = mysqli_fetch_assoc(mysqli_query($con, $sql1));
            // prx($res1);

            $product_id = $res1['id'];
            $categories = $res1['categories'];
            $categories_id = $res1['categories_id'];
            $sub_categories_id = $res1['sub_categories_id'];
            $sub_categories = $res1['sub_categories'];
            $name = $res1['name'];
            $mrp = $res1['mrp'];
            $price = $res1['price'];
            $qty = $res1['qty'];
            $image_edit = $res1['image'];
            $short_desc = $res1['short_desc'];
            $description = $res1['description'];
            $best_seller = $res1['best_seller'];
            $meta_title = $res1['meta_title'];
            $meta_desc = $res1['meta_desc'];
            $meta_keyword = $res1['meta_keyword'];
            

        }else {
            die();
            header("location: manage_product.php");
        }
    }



    // Adding Product to Database
    if(isset($_POST['edit_product'])) {
      //prx($_POST);

        // All values
        $id = get_safe_value($con, $_POST['id']);
        $categories_id = get_safe_value($con, $_POST['categories_id']);
        $sub_categories_id = get_safe_value($con, $_POST['sub_categories_id']);
        $name = get_safe_value($con, $_POST['product']);
        $mrp = get_safe_value($con, $_POST['mrp']);
        $price = get_safe_value($con, $_POST['price']);
        $qty = get_safe_value($con, $_POST['qty']);
        $image = get_safe_value($con, $_FILES['image']['name']);

        $tmp_image = $_FILES['image']['tmp_name'];
        $image_edit = get_safe_value($con, $_POST['image_edit']);

        $short_desc = get_safe_value($con, $_POST['short_dsc']);
        $description = get_safe_value($con, $_POST['description']);
        $best_seller = get_safe_value($con, $_POST['$best_seller']);
        $meta_title = get_safe_value($con, $_POST['meta_title']);
        $meta_desc = get_safe_value($con, $_POST['meta_desc']);
        $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);

        // Checking duplicate product
        /*$sql_dupli = "SELECT * FROM product WHERE categories_id = $categories_id and 
        sub_categories_id = $sub_categories_id and name = '$name'";
        $duplicate = mysqli_fetch_assoc(mysqli_query($con, $sql_dupli)); */

        $sql = "UPDATE product SET categories_id = '$categories_id', sub_categories_id = '$sub_categories_id', 
        name = '$name', mrp = '$mrp', price = '$price', qty = '$qty', image = '$image', short_desc = '$short_desc',
        description = '$description', best_seller = '$best_seller' ,meta_title = '$meta_title', meta_desc = '$meta_desc', meta_keyword = '$meta_keyword', status = '1'
        WHERE id = $id";

        // request to db
        /*if($duplicate > 0) {

            $msg = "This product already exist!!";

        }else */

        // send database of updating info of product
        if(mysqli_query($con, $sql)) {
            // added image to upload folder
            move_uploaded_file($tmp_image, "../media/product/".$image);
            // unlink the previous uploaded image
            if($image != $image_edit) {

               unlink("../media/product/".$image_edit);
            }
            // Successfully added & redirect to product.php page
            header("location: product_master.php");
            die();

        }
    }
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                    <form action="" method = "POST" enctype = "multipart/form-data">
                        <div class="card">
                           <div class="card-header"><strong>Edit Product</strong></div>
                           <div class="card-body card-block">
                                <!-- Categories Names of Product from categories table of DB -->
                                <div class="form-group">
                                   <label for="categories_id" class=" form-control-label">Categories</label>
                                   <select name="categories_id" class = "form-control" id = "categories_id" 
                                   onchange = "get_sub_cat()" required>
                                   <option value="<?php echo $categories_id; ?>"><?php echo $categories; ?></option>
                                        <?php while($row = mysqli_fetch_assoc($res)) { ?>
                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo $row['categories'] ?>
                                            </option>
                                        <?php } ?>
                                   </select>
                                </div>

                                 <!-- Sub categories name & id -->
                                <div class="form-group">
                                   <label for="sub_categories_id" class=" form-control-label">Sub Categories</label>
                                   <select name="sub_categories_id" class = "form-control" id = "sub_categories_id" required>
                                       <option value="<?php echo $sub_categories_id; ?>"><?php echo $sub_categories; ?></option>
                                   </select>
                                </div>

                                <!-- Product ID -->
                                <input type="hidden" name="id" value = "<?php echo $product_id; ?>">
                                <!-- Product Name -->
                                <div class="form-group">
                                   <label for="product" class=" form-control-label">Product Name</label>
                                   <input type="text" name = "product" class="form-control py-4 mb-4 mt-2" required value = "<?php echo $name;?>"/>
                                </div>

                                <!-- Product MRP -->
                                <div class="form-group">
                                   <label for="mrp" class=" form-control-label">Product MRP</label>
                                   <input type="number" name = "mrp" class="form-control py-4 mb-4 mt-2" required value = "<?php echo $mrp;?>"/>
                                </div>

                                <!-- Product Price -->
                                <div class="form-group">
                                   <label for="price" class=" form-control-label">Product Price</label>
                                   <input type="number" name = "price" class="form-control py-4 mb-4 mt-2" required value = "<?php echo $price;?>"/>
                                </div>

                                <!-- Product quantity -->
                                <div class="form-group">
                                   <label for="qty" class=" form-control-label">Product Quantity</label>
                                   <input type="number" name = "qty" class="form-control py-4 mb-4 mt-2" required value = "<?php echo $qty;?>"/>
                                </div>

                                <!-- Product Image -->
                                <div class="form-group">
                                   <label for="image" class=" form-control-label">Product Image</label>
                                   <img src="../media/product/<?php echo $image_edit;?>" alt="product image" style = "width: 250px; height: 150px;">
                                   <input type="hidden" name="image_edit" value = "<?php echo $image_edit;?>">
                                   <input type="file" name = "image" class = "form-control" required/>
                                </div>

                                <!-- Product Short description -->
                                <div class="form-group">
                                   <label for="short_dsc" class=" form-control-label">Short Description</label>
                                   <textarea name="short_dsc" class = "form-control" required ><?php echo $short_desc;?></textarea>
                                </div>

                                <!-- Product description -->
                                <div class="form-group">
                                   <label for="description" class=" form-control-label">Description</label>
                                   <textarea name="description" class = "form-control py-4 mb-4 mt-2" required ><?php echo $description;?></textarea>
                                </div>

                                <!-- Best Seller -->
                                <div class="form-group">
                                   <label for="best_seller" class=" form-control-label">Best Seller</label>
                                   <select name="best_seller" class = "form-control" id = "best_seller" required>
                                       <option value="<?php echo $best_seller; ?>">
                                          <?php
                                             if($best_seller == 1) {
                                                echo "Yes";
                                             }else {
                                                echo "No";
                                             }
                                             
                                          ?>
                                       </option>
                                       <option value="1">Yes</option>
                                       <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Meta Title -->
                                <div class="form-group">
                                   <label for="meta_title" class=" form-control-label">Product Meta Title</label>
                                   <textarea name="meta_title" class = "form-control"><?php echo $meta_title;?></textarea>
                                </div>

                                <!-- Meta Description -->
                                <div class="form-group">
                                   <label for="meta_desc" class=" form-control-label">Product Meta Description</label>
                                   <textarea name="meta_desc"class = "form-control"><?php echo $meta_desc;?></textarea>
                                </div>
                            
                                <!-- Meta Keyword -->
                                <div class="form-group">
                                   <label for="meta_keyword" class=" form-control-label">Product Meta Keyword</label>
                                   <textarea name="meta_keyword" class = "form-control" ><?php echo $meta_keyword;?></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                <button class ="btn btn-lg btn-info btn-block" name = "edit_product">Edit Product</button>
                                </div>

                                <!-- Duplicate Message -->
                                <div class="form-group field_error">
                                        <?php if(isset($msg)) {echo $msg;} ?> 
                                </div>
                           </div>
                        </div>
                    </form>
                  </div>
               </div>
            </div>
         </div>

         <script>
            function get_sub_cat() {
               var categories_id = jQuery("#categories_id").val();
               console.log(categories_id);
               jQuery.ajax({
                  url: 'get_sub_cat.php',
                  type: 'POST',
                  data: 'categories_id='+categories_id,
                  success: function(result) {
                     jQuery("#sub_categories_id").html(result);
                  }
               });
            }
         </script>

<?php
    include_once("footer.inc.php");
?>