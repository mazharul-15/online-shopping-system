<?php 
    include_once("top.inc.php"); 

    // Add Category into Database;
    if(isset($_POST['add_sub_categories'])) {
        $sub_categories = get_safe_value($con, $_POST['sub_categories']);
        $categories_id = get_safe_value($con, $_POST['categories_id']);
        // prx($_POST);

        // Checking duplicate sub categories from db
        $sql_dupli = "SELECT * FROM sub_categories WHERE sub_categories.sub_categories = '$sub_categories' and 
        categories_id = $categories_id";

        $duplicate = mysqli_fetch_assoc(mysqli_query($con, $sql_dupli));

        $sql = "INSERT into sub_categories(categories_id, sub_categories, status) VALUES ('$categories_id', '$sub_categories', '1')";

        // request to db
        if($duplicate > 0) {

            $msg = "This Sub Categories already exist!!";

        }elseif(mysqli_query($con, $sql)) {

            // Successfully added & redirect to sub_categories.php page
            header("location: sub_categories.php");
            die();

        }
    }

    // fetching categories form db
    $sql = "SELECT * FROM categories";
    $res = mysqli_query($con, $sql);
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                    <form action="" method = "POST">
                        <div class="card">
                           <div class="card-header"><strong>Sub Categories</strong><small> Form</small></div>
                           <div class="card-body card-block">

                                <!-- Categories Name -->
                                <div class="form-group">
                                    <label for="categories" class=" form-control-label">Categories</label>
                                    <select name="categories_id" id=""class = "form-control" required>
                                        <option value="">Select Categories</option>
                                        <!-- displaying categories options -->
                                        <?php
                                            while($row = mysqli_fetch_assoc($res)) { ?>
                                                <option value="<?php echo $row['id']; ?>">
                                                    <?php echo $row['categories']; ?>
                                                </option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>

                                <!-- Sub Category Name -->
                                <div class="form-group">
                                    <label for="sub_categories" class=" form-control-label">Sub Categories</label>
                                    <input type="text" name = "sub_categories" placeholder="Enter new sub category name" class="form-control py-4 mb-4 mt-2" required>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button class ="btn btn-lg btn-info btn-block" name = "add_sub_categories">Submit</button>
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