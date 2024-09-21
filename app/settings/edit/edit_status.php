<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getctype_detail = $getdata->my_sql_query($connect, NULL, "card_type", "ctype_key='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-12">
            <label for="edit_name_status">ชื่อสถานะ</label>
            <input type="text" name="edit_name_status" id="edit_name_status" class="form-control" value="<?php echo @$getctype_detail->ctype_name; ?>">
        </div>
        <div class="col-12">
            <label for="edit_color_status">Color Tag</label>
            <input type="color" name="edit_color_status" id="edit_color_status" class="form-control" value="<?php echo @$getctype_detail->ctype_color; ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <select name="edit_status_use" id="edit_status_use" class="form-control">
                <?php if ($getctype_detail->ctype_use == 3) { ?>
                    <option value="3" selected>ใช้งานทุกระบบ</option>
                <?php } else { ?>
                    <option value="" selected>--- เลือกข้อมูล ---</option>
                <?php } ?>
            </select>

        </div>
    </div>
    <input name="ctype_key" value="<?php echo @htmlspecialchars($_GET['key']); ?>" hidden>
</div>