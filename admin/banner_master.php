<?php
    // including header file
    include_once("top.inc.php");

    // $sql = "SELECT * FROM categories ORDER BY categories desc";
    // $res = mysqli_query($con, $sql);

    // Categories Active/Deactive/Delete/Edit
    /*if(isset($_GET['type']) && $_GET['type'] != ''){

        $type = get_safe_value($con, $_GET['type']);

        if($type == 'status') {

            $operation = get_safe_value($con, $_GET['operation']);
            $id = get_safe_value($con, $_GET['id']);

            if($operation == "active") {
                $status = 1;
            } else {
                $status = 0;
            }

            $sql = "UPDATE categories set status = $status WHERE id = $id";
            mysqli_query($con, $sql);
        }
    } */


    // for edit it goes to "edit_category.php"

    // category: Active / Deactive/ Delete
    if(isset($_GET['status'])) {
        $status = get_safe_value($con, $_GET['status']);
        $id = get_safe_value($con, $_GET['id']);

        if($status == 'active') {

            // sql for banner table
            $sql = "UPDATE banner SET status = 1 WHERE id = $id";

        } elseif($status == 'deactive') {

            // sql for banner table
            $sql = "UPDATE banner SET status = 0 WHERE id = $id";


        }elseif($status == 'delete') {

            // sql for banner table
            $sql = "DELETE FROM banner WHERE id = $id";

            // retrive image name for deleting
            $sql_image = "SELECT image FROM banner WHERE id = $id";
            $res_image = mysqli_query($con, $sql_image);
            $image = mysqli_fetch_assoc($res_image);
            unlink("../media/banner/".$image);
        }

        // sent query to database
        mysqli_query($con, $sql);
    }

    // sql query for Banner from database
    $sql = "SELECT * FROM banner ORDER BY id desc";
    $res = mysqli_query($con, $sql);
?>
<style>
    .button {
        display: block;
        margin: 1px;
    }
</style>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Banner Master</h4>
                        <h4 class="box-link"><a href="manage_banner.php">Add banner</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                       <th >#</th>
                                       <th>Heading1</th>
                                       <th>Heading2</th>
                                       <th>Btn-text</th>
                                       <th>Btn-link</th>
                                       <th>Image</th>
                                       <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $id = 1;
                                        while($row = mysqli_fetch_assoc($res)) {?>
                                        <tr>
                                            <td class = "serial"><?php echo $id++; ?></td>
                                            <td><?php echo $row['heading1']; ?></td>
                                            <td><?php echo $row['heading2']; ?></td>
                                            <td><?php echo $row['btn_text']; ?></td>
                                            <td><?php echo $row['btn_link']; ?></td>
                                            <td><img src="../media/banner/<?php echo $row['image']; ?>" alt="banner"></td>
                                            <td><?php 
                                                if($row['status'] == 1) {
                                                    echo "<span class= 'badge badge-complete button' ><a href='?status=deactive&id=".$row['id']."'>Active</a></span>&nbsp";
                                                }else {
                                                    echo "<span class= 'badge badge-pending button'><a href='?status=active&id=".$row['id']."'>Deactive</a></span>&nbsp";
                                                }
                                                echo "<span class= 'badge badge-edit button'><a href='edit_banner.php?status=edit&id=".$row['id']."'>Edit</a></span>&nbsp";
                                                echo "<span class= 'badge badge-delete button'><a href='?status=delete&id=".$row['id']."'>Delete</a></span>";
                                            ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    // including footer file
    include_once("footer.inc.php");
?>