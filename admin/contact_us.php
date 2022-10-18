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

    // category: Active / Deactive/ Edit / Delete
    if(isset($_GET['status'])) {
        $status = get_safe_value($con, $_GET['status']);
        $id = get_safe_value($con, $_GET['id']);

        if($status == 'delete') {
            $sql = "DELETE FROM contact_us WHERE id = $id";
        }

        // sent query to database
        mysqli_query($con, $sql);
    }

    // sql query for categories from database
    $sql = "SELECT * FROM contact_us";
    $res = mysqli_query($con, $sql);
?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Contact Us</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                       <th class = "serial">#</th>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Mobile</th>
                                       <th>Query</th>
                                       <th>Date</th>
                                       <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $id = 1;
                                        while($row = mysqli_fetch_assoc($res)) {?>
                                    <tr>
                                        <td class = "serial"><?php echo $id++; ?></td>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['mobile']; ?></td>
                                        <td><?php echo $row['comment']; ?></td>
                                        <td><?php echo $row['added_on']; ?></td>
                                        <td>
                                            <?php 
                                                echo "<span class= 'badge badge-delete'><a href='?status=delete&id=".$row['id']."'>Delete</a></span>";
                                            ?>
                                        </td>
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