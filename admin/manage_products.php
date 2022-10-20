<?php 
   include_once("top.inc.php");

   // Display Category Name form categories table for Product
   $sql = "SELECT * FROM categories";
   $res = mysqli_query($con, $sql);
    
   // Adding Product to Database
   if(isset($_POST['add_product'])) {

      // prx($_FILES);
      // All values
      $categories_id = get_safe_value($con, $_POST['categories_id']);
      $sub_categories_id = get_safe_value($con, $_POST['sub_categories_id']);
      $name = get_safe_value($con, $_POST['product']);
      $mrp = get_safe_value($con, $_POST['mrp']);
      $price = get_safe_value($con, $_POST['price']);
      $qty = get_safe_value($con, $_POST['qty']);
      $image = get_safe_value($con, $_FILES['image']['name']);

      $tmp_image = $_FILES['image']['tmp_name'];

      $short_desc = get_safe_value($con, $_POST['short_dsc']);
      $description = get_safe_value($con, $_POST['description']);
      $best_seller = get_safe_value($con, $_POST['best_seller']);
      $meta_title = get_safe_value($con, $_POST['meta_title']);
      $meta_desc = get_safe_value($con, $_POST['meta_desc']);
      $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);


      // Checking duplicate product
      $sql_dupli = "SELECT * FROM product WHERE name = '$name'";
      $duplicate = mysqli_fetch_assoc(mysqli_query($con, $sql_dupli));


      $sql = "INSERT into product(categories_id, sub_categories_id, name, mrp, price, qty, image, short_desc, 
      description, best_seller, meta_title, meta_desc, meta_keyword, status) 
      VALUES ('$categories_id', '$sub_categories_id', '$name', '$mrp', '$price', '$qty', '$image', '$short_desc',
      '$description', '$best_seller', '$meta_title', '$meta_desc', '$meta_keyword', '1')";


      // prx($_FILES['image']['type']);
      // request to db
      // if($_FILES['image']['type'] != '' && ($_FILES['image']['type'] != 'image/png' || 
      // $_FILES['image']['type'] != 'image/jpg' || $_FILES['image']['type'] != 'image/jpeg')) {
         
      //    prx($_FILES['image']);
      //    $msg_img = "Please select png or jpg or jpeg image format"; //checking image format
      //    // header("location: manage_products.php");

      // }else

      if($duplicate > 0) {

         $msg = "This product already exist!!";

      }elseif(mysqli_query($con, $sql)) {
         
         // added image to upload folder
         move_uploaded_file($tmp_image, "../media/product/".$image);

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
                           <div class="card-header"><strong>product</strong><small> Form</small></div>
                           <div class="card-body card-block">
                                <!-- Categories Names of Product from categories table of DB -->
                                <div class="form-group">
                                   <label for="categories_id" class=" form-control-label">Categories</label>
                                   <select name="categories_id" class = "form-control" 
                                   onchange = "get_sub_cat()" id = "categories_id" required>
                                   <option value="">Select Category</option>
                                        <?php while($row = mysqli_fetch_assoc($res)) { ?>
                                            <option value="<?php echo $row['id']; ?>">
                                                <?php echo $row['categories'] ?>
                                            </option>
                                        <?php } ?>
                                   </select>
                                </div>

                                 <!-- Sub Categories Names of Product from sub categories table of DB -->
                                <div class="form-group">
                                   <label for="sub_categories_id" class=" form-control-label">Sub Categories</label>
                                   <select name="sub_categories_id" class = "form-control" id = "sub_categories_id" required>
                                   <option value="">Select Sub Category</option>
                                   </select>
                                </div>

                                <!-- Product Name -->
                                <div class="form-group">
                                   <label for="product" class=" form-control-label">Product Name</label>
                                   <input type="text" name = "product" placeholder="Enter new product name" 
                                        class="form-control py-4 mb-4 mt-2" required
                                   />
                                </div>

                                <!-- Product MRP -->
                                <div class="form-group">
                                   <label for="mrp" class=" form-control-label">Product MRP</label>
                                   <input type="number" name = "mrp" placeholder="Enter product mrp" 
                                        class="form-control py-4 mb-4 mt-2" required
                                    />
                                </div>

                                <!-- Product Price -->
                                <div class="form-group">
                                   <label for="price" class=" form-control-label">Product Price</label>
                                   <input type="number" name = "price" placeholder="Enter product price" 
                                        class="form-control py-4 mb-4 mt-2" required
                                    />
                                </div>

                                <!-- Product quantity -->
                                <div class="form-group">
                                   <label for="qty" class=" form-control-label">Product Quantity</label>
                                   <input type="number" name = "qty" placeholder="Enter product quantity" 
                                        class="form-control py-4 mb-4 mt-2" required
                                    />
                                </div>

                                <!-- Product Image -->
                                <div class="form-group">
                                   <label for="image" class=" form-control-label">Product Image</label>
                                   <input type="file" name = "image" class = "form-control" required />
                                </div>
                                 <!-- Image Format Message -->
                                <div class="form-group field_error">
                                        <?php if(isset($msg_img)) {echo $msg_img;} ?> 
                                </div>

                                <!-- Product Short description -->
                                <div class="form-group">
                                   <label for="short_dsc" class=" form-control-label">Short Description</label>
                                   <textarea name="short_dsc" placeholder = "Enter short description" class = "form-control" required></textarea>
                                </div>

                                <!-- Product description -->
                                <div class="form-group">
                                   <label for="description" class=" form-control-label">Description</label>
                                   <textarea name="description" placeholder = "Enter description" class = "form-control py-4 mb-4 mt-2" required></textarea>
                                </div>
                                
                                <!-- Best Seller -->
                                <div class="form-group">
                                   <label for="best_seller" class=" form-control-label">Best Seller</label>
                                   <select name="best_seller" class = "form-control" id = "best_seller" required>
                                       <option value="">Select</option>
                                       <option value="1">Yes</option>
                                       <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Meta Title -->
                                <div class="form-group">
                                   <label for="meta_title" class=" form-control-label">Product Meta Title</label>
                                   <textarea name="meta_title" placeholder = "Enter product meta title" class = "form-control"></textarea>
                                </div>

                                <!-- Meta Description -->
                                <div class="form-group">
                                   <label for="meta_desc" class=" form-control-label">Product Meta Description</label>
                                   <textarea name="meta_desc" placeholder = "Enter product meta description" class = "form-control"></textarea>
                                </div>
                            
                                <!-- Meta Keyword -->
                                <div class="form-group">
                                   <label for="meta_keyword" class=" form-control-label">Product Meta Keyword</label>
                                   <textarea name="meta_keyword" placeholder = "Enter product meta keyword" class = "form-control"></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                <button class ="btn btn-lg btn-info btn-block" name = "add_product">Submit</button>
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

         <!-- Fetching Sub Categories using AJAX -->
         <script>
            function get_sub_cat() {
               var categories_id = jQuery("#categories_id").val();
               console.log(categories_id);
               jQuery.ajax({
                  url: "get_sub_cat.php",
                  type: "POST",
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