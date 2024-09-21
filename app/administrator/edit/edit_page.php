<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getpage_detail = $getdata->my_sql_query($connect, NULL, "list", "id='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-md-4 col-sm-12">
            <label for="edit_page_name">ชื่อไฟล์ </label>
            <input type="text" name="edit_page_name" id="edit_page_name" class="form-control" value="<?php echo $getpage_detail->cases; ?>">
            <font style="color: red;">*** ใส่เฉพาะชื่อไฟล์ไม่ต้องมี .php ***</font>
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="edit_folder">หมวดหมู่</label>
            <input type="text" name="edit_folder" id="edit_folder" class="form-control" value="<?php echo $getpage_detail->menu; ?>">
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="edit_link">Part File</label>
            <input type="text" name="edit_link" id="edit_link" class="form-control" value="<?php echo $getpage_detail->pages; ?>">
        </div>

    </div>
</div>
<input type="text" name="id_link" hidden value="<?php echo $getpage_detail->id; ?>">