<?php
    include_once("top.inc.php");

    // Display a Category by Specific Id form DB
    if(isset($_GET['status'])) {
           $status = get_safe_value($con, $_GET['status']);
           $id = get_safe_value($con, $_GET['id']);
        if($status == 'edit') {
            $sql = "SELECT * FROM categories WHERE id = $id";
            $res = mysqli_fetch_assoc(mysqli_query($con, $sql));
        }
    }

    // Edit a Category
    if(isset($_POST['edit_categories'])) {
        $name = get_safe_value($con, $_POST['categories']);
        $id = get_safe_value($con, $_POST['id']);

        // Fetch all Categories to Check duplicate 
        $sql_dupli = "SELECT * FROM categories WHERE categories = '$name'";
        $duplicate = mysqli_fetch_assoc(mysqli_query($con, $sql_dupli));

        // sql for updating categories
        $sql = "UPDATE categories SET categories = '$name' WHERE id = $id";

        if($duplicate > 0) {

            $msg = "This Category already exist!!"; // message for duplicate exist

        }elseif(mysqli_query($con, $sql) > 0) {
            
            header("location: categories.php"); // successfully update & redirect to categoires page
            die();       

        }else {

            header("location: categories.php"); // redirect to categoires page
            die();   

        }
        /*if(mysqli_query($con, $sql) > 0) {
            header("location: categories.php");
            die();
        }else {
            header("location: categories.php");
            die();           
        }*/
        // mysqli_query($con, $sql);
        // header("location: categories.php");
        // die();
    }
?>

<!-- Form Data for Editing , Getting by Specific ID -->
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                    <form action="" method = "POST">
                        <div class="card">
                           <div class="card-header"><strong>Edit Category</strong></div>
                           <div class="card-body card-block">
                                <!-- Categoy Name -->
                              <div class="form-group">
                                   <label for="categories" class=" form-control-label">Edit Category Name</label>
                                   <input type="text" name = "categories"  class="form-control py-4 mb-4 mt-2" value = "<?php echo $res['categories']?>" required>
                               </div>

                               <!-- Category id -->
                               <div class="form-group">
                                   <input type="hidden" name = "id" value ="<?php echo $res['id']?>">
                               </div>

                               <!-- Submit button -->
                               <div class="form-group">
                               <button class ="btn btn-lg btn-info btn-block" name = "edit_categories">Submit</button>
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