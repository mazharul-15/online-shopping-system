<?php 
    include_once("top.inc.php");

    // Accessing data from database
    if(isset($_GET)) {
        $id = get_safe_value($con, $_GET['id']);
        if($_GET['status'] == 'edit' && is_numeric($id)) {
            $sql = "SELECT * FROM banner WHERE id = $id";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($res);
        }
    }

    // Add Category into Database;
    if(isset($_POST['edit_banner'])) {
        //  prx($_FILES);
        // prx($_POST);
        $id = get_safe_value($con, $_POST['id']);
        $heading1 = get_safe_value($con, $_POST['heading1']);
        $heading2 = get_safe_value($con, $_POST['heading2']);
        $btn_text = get_safe_value($con, $_POST['btn-text']);
        $btn_link = get_safe_value($con, $_POST['btn-link']);
        $image = get_safe_value($con, $_FILES['image']['name']);
        $order_no = get_safe_value($con, $_POST['order-no']);
        $img_tmp = $_FILES['image']['tmp_name'];
        $edit_image = get_safe_value($con, $_POST['edit_image']);
        // prx($img_tmp);
        // Checking duplicate banner
        $sql_dupli = "SELECT * FROM banner WHERE heading1 = '$heading1' and heading2 = '$heading2' 
        and image = '$image'";
        $duplicate = mysqli_fetch_assoc(mysqli_query($con, $sql_dupli));

        // request to db
        if($duplicate > 0) {

            $msg = "This Banner already exist!!";

        }else {
            $sql = "UPDATE banner SET heading1 = '$heading1', heading2 = '$heading2', 
            btn_text = '$btn_text', btn_link = '$btn_link', image = '$image', order_no = '$order_no' 
            WHERE id = $id";

            if(mysqli_query($con, $sql)) {
                if($edit_image != $image) {
                    // moving new image
                    move_uploaded_file($img_tmp, "../media/banner/".$image);
                    // unlink the previous image
                    unlink("../media/banner/".$edit_image);
                }
                $msg = "Successfully Edited banner";
            }
        }
    }
?>

<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                    <form action="" method = "POST" enctype = "multipart/form-data">
                        <div class="card">
                            <div class="card-header"><strong>Banner</strong><small> Form</small></div>
                            <div class="card-body card-block">
                                <!-- Duplicate Message -->
                                <div class="form-group field_error">
                                    <?php if(isset($msg)) {echo $msg;} ?> 
                                </div>
                                
                                <!-- Banner Id -->
                                <input type="hidden" name="id" value = "<?php echo $row['id']; ?>">

                                <!-- Heading1 -->
                                <div class="form-group">
                                    <label for="heading1" class=" form-control-label">Heading1</label>
                                    <input type="text" name = "heading1" value = "<?php echo $row['heading1']; ?>" class="form-control py-4 mb-4 mt-2" required>
                                </div>

                                <!-- Heading2 -->
                                <div class="form-group">
                                    <label for="heading2" class=" form-control-label">Heading2</label>
                                    <input type="text" name = "heading2" value = "<?php echo $row['heading2']; ?>" class="form-control py-4 mb-4 mt-2" required>
                                </div>

                                <!-- Button Text -->
                                <div class="form-group">
                                    <label for="btn-text" class=" form-control-label">Button Text</label>
                                    <input type="text" name = "btn-text" value = "<?php echo $row['btn_text']; ?>" class="form-control py-4 mb-4 mt-2" required>
                                </div>

                                <!-- Button Link-->
                                <div class="form-group">
                                    <label for="btn-link" class=" form-control-label">Button Link</label>
                                    <input type="text" name = "btn-link" value = "<?php echo $row['btn_link']; ?>" class="form-control py-4 mb-4 mt-2" required>
                                </div>

                                <!-- Image -->
                                <div class="form-group">
                                    <input type="hidden" name="edit_image"  value = "<?php echo $row['image']; ?>" >
                                    <img src="../media/banner/<?php echo $row['image']; ?>" alt="Banner Image" style = "width: 250px; height: 150px;">
                                    <label for="image" class=" form-control-label">Select new Image</label>
                                    <input type="file" name="image" id="image" required>
                                </div>

                                <!-- Banner Order No-->
                                <div class="form-group">
                                    <label for="order-no" class=" form-control-label">Order No.</label>
                                    <input type = "number" name = "order-no" value = "<?php echo $row['order_no'];?>" class="form-control py-4 mb-4 mt-2" required>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                <button class ="btn btn-lg btn-info btn-block" name = "edit_banner">Submit</button>
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