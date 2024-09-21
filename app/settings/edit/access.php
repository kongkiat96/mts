<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$showuser_detail = $getdata->my_sql_query($connect, NULL, "user", "user_key='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-info text-center font-weight-bold">
                <tr>
                    <td>การเข้าถึง</td>
                    <td>ชื่อรายการเมนู</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $getaccess  = $getdata->my_sql_select($connect, NULL, "access_list", "access_status='1' ORDER BY access_name");
                while ($showaccess = mysqli_fetch_object($getaccess)) {
                    $nowaccess = $getdata->my_sql_show_rows($connect, "access_user", "user_key='" . htmlspecialchars($_GET['key']) . "' AND access_key='" . $showaccess->access_key . "'");
                    if ($nowaccess != 0) { ?>
                        <tr>
                            <td><input type="checkbox" name="access_list[]" value="<?php echo $showaccess->access_key; ?>" checked="checked"></td>
                            <td><?php echo $showaccess->access_name; ?></td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td><input type="checkbox" name="access_list[]" value="<?php echo $showaccess->access_key; ?>"></td>
                            <td><?php echo $showaccess->access_name; ?></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
        <input type="text" name="key" hidden value="<?php echo $showuser_detail->user_key; ?>">
        <input type="text" name="showclass" hidden value="<?php echo $showuser_detail->user_class; ?>">
    </div>
</div>