<?php 
    include_once("top.inc.php");

    // Add Category into Database;
    if(isset($_POST['add_categories'])) {
        $category = get_safe_value($con, $_POST['categories']);

        // Checking duplicate categories
        $sql_dupli = "SELECT * FROM categories WHERE categories = '$category'";
        $duplicate = mysqli_fetch_assoc(mysqli_query($con, $sql_dupli));

        $sql = "INSERT into categories(categories, status) VALUES ('$category', '1')";
        // request to db
        if($duplicate > 0) {

            $msg = "This Categories already exist!!";

        }elseif(mysqli_query($con, $sql)) {

            // Successfully added & redirect to categories.php page
            header("location: categories.php");
            die();

        }
    }
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                    <form action="" method = "POST">
                        <div class="card">
                           <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                           <div class="card-body card-block">
                                <!-- Category Name -->
                              <div class="form-group">
                                   <label for="categories" class=" form-control-label">Categories</label>
                                   <input type="text" name = "categories" placeholder="Enter new category name" class="form-control py-4 mb-4 mt-2" required>
                               </div>

                               <!-- Submit Button -->
                               <div class="form-group">
                               <button class ="btn btn-lg btn-info btn-block" name = "add_categories">Submit</button>
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

<?php
    include_once("footer.inc.php");
?>