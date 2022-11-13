<?php 
    include_once("top.inc.php");

    // Add Category into Database;
    if(isset($_POST['add_banner'])) {
        //  prx($_FILES);
        // prx($_POST);
        $heading1 = get_safe_value($con, $_POST['heading1']);
        $heading2 = get_safe_value($con, $_POST['heading2']);
        $btn_text = get_safe_value($con, $_POST['btn-text']);
        $btn_link = get_safe_value($con, $_POST['btn-link']);
        $image = get_safe_value($con, $_FILES['image']['name']);
        $img_tmp = $_FILES['image']['tmp_name'];
        // prx($img_tmp);
        // Checking duplicate banner
        $sql_dupli = "SELECT * FROM banner WHERE heading1 = '$heading1' OR heading2 = '$heading2' 
        OR image = '$image'";
        $duplicate = mysqli_fetch_assoc(mysqli_query($con, $sql_dupli));

        // request to db
        if($duplicate > 0) {

            $msg = "This Banner already exist!!";

        }else {
            $sql = "INSERT INTO banner(heading1, heading2, btn_text, btn_link, image, status) 
            VALUES('$heading1', '$heading2', '$btn_text', '$btn_link', '$image', '1')";

            if(mysqli_query($con, $sql)) {
                move_uploaded_file($img_tmp, "../media/banner/".$image);
                $msg = "Successfully added banner";
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

                              <!-- Heading1 -->
                              <div class="form-group">
                                   <label for="heading1" class=" form-control-label">Heading1</label>
                                   <input type="text" name = "heading1" placeholder="Enter heading1" class="form-control py-4 mb-4 mt-2" required>
                               </div>

                               <!-- Heading2 -->
                              <div class="form-group">
                                   <label for="heading2" class=" form-control-label">Heading2</label>
                                   <input type="text" name = "heading2" placeholder="Enter heading2" class="form-control py-4 mb-4 mt-2" required>
                               </div>

                               <!-- Button Text -->
                              <div class="form-group">
                                   <label for="btn-text" class=" form-control-label">Button Text</label>
                                   <input type="text" name = "btn-text" placeholder="Enter button text" class="form-control py-4 mb-4 mt-2" required>
                               </div>

                               <!-- Button Link-->
                              <div class="form-group">
                                   <label for="btn-link" class=" form-control-label">Button Link</label>
                                   <input type="text" name = "btn-link" placeholder="Enter button link" class="form-control py-4 mb-4 mt-2" required>
                               </div>

                               <!-- Image -->
                              <div class="form-group">
                                   <label for="image" class=" form-control-label">Select Image</label>
                                   <input type="file" name="image" id="image" required>
                               </div>

                               <!-- Submit Button -->
                               <div class="form-group">
                               <button class ="btn btn-lg btn-info btn-block" name = "add_banner">Submit</button>
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