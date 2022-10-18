<?php
    // including top.inc.php
    include_once("top.inc.php");

    // getting subcategories name
    if(isset($_GET['status'])) {
        if($_GET['status'] == 'edit') {

            $sub_categories_id = $_GET['id'];

            //sql
            $sql = "SELECT sub_categories.*, categories.categories FROM sub_categories, categories 
            WHERE sub_categories.id = $sub_categories_id and sub_categories.categories_id = categories.id";
            
            // requsting to DB
            $get_sub_categories = mysqli_fetch_assoc(mysqli_query($con, $sql));
            // prx($get_sub_categories);

        }
    }

    // Add Category into Database;
    if(isset($_POST['edit_sub_categories'])) {
        $sub_categories_name= get_safe_value($con, $_POST['sub_categories_name']);
        $categories_id = get_safe_value($con, $_POST['categories_id']);
        $sub_categories_id = get_safe_value($con, $_POST['sub_categories_id']);
        // prx($_POST);

        // Checking duplicate sub categories from db
        // $sql_dupli = "SELECT * FROM sub_categories, categories
        // WHERE sub_categories.sub_categories = '$sub_categories' and categories.id = $categories_id";

        $sql_dupli = "SELECT * FROM sub_categories WHERE categories_id = $categories_id and 
        sub_categories = '$sub_categories_name'";

        $duplicate = mysqli_fetch_assoc(mysqli_query($con, $sql_dupli));

        $sql = "UPDATE sub_categories set categories_id = '$categories_id', sub_categories = '$sub_categories_name' WHERE id = $sub_categories_id";

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
                           <div class="card-header"><strong>Edit Sub Categories</strong><small> Form</small></div>
                           <div class="card-body card-block">

                                <!-- Exist Categories Name -->
                                <div class="form-group">
                                    <label for="categories" class=" form-control-label">Categories</label>
                                    <select name="categories_id" id=""class = "form-control" required>
                                        <option value="<?php echo $get_sub_categories['categories_id']; ?>"><?php echo $get_sub_categories['categories']; ?></option>
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
                                    <label for="sub_categories_name" class=" form-control-label">Sub Categories</label>
                                    <input type="text" name = "sub_categories_name" value = "<?php echo $get_sub_categories['sub_categories']; ?>" class="form-control py-4 mb-4 mt-2" required>
                                </div>

                                <!-- Sub Categories ID -->
                                <input type="hidden" name="sub_categories_id" value = "<?php echo $get_sub_categories['id']; ?>">

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button class ="btn btn-lg btn-info btn-block" name = "edit_sub_categories">Edit Sub Categories</button>
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
    // including fooer.inc.php
    include_once("footer.inc.php");
?>