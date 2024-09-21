<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$show_menu = $getdata->my_sql_query($connect, null, "access_list", "access_key ='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-header">
    <h5 class="modal-title font-weight-bold"> ผู้ใช้งานงานเมนู <u><?php echo @$show_menu->access_name; ?></u></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        <table class="table table-bordered table-hover text-center" width="100%" id="dataTablesFixwidht">
            <thead class="table-info text-center font-weight-bold">
                <tr>
                    <td>#</td>
                    <td>รายชื่อผู้ใช้งาน</td>
                    <td>UserLogin</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $u = 0;
                $getaccess = $getdata->my_sql_select($connect, null, "access_user", "access_key ='" . htmlspecialchars($_GET['key']) . "'");

                while ($showaccess_user = mysqli_fetch_object($getaccess)) {
                    $u++;
                ?>
                    <tr>
                        <td><?php echo $u; ?></td>
                        <td><?php echo @getemployee($showaccess_user->user_key); ?></td>
                        <td><?php echo @Userlogin($showaccess_user->user_key); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>
<input type="text" name="key" hidden value="<?php echo $show_menu->user_key; ?>">
<script>
    $(document).ready(function() {

        $('#dataTablesFixwidht', '').dataTable({
            "autoWidth": false,
            "ordering": false,
        });
    });
</script>