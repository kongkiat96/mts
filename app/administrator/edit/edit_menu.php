<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getmenu_detail = $getdata->my_sql_query($connect, NULL, "menus", "menu_key='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-md-5 col-sm-12">
            <label for="edit_menu_name">ชื่อเมนู</label>
            <input type="text" id="edit_menu_name" name="edit_menu_name" class="form-control" value="<?php echo $getmenu_detail->menu_name; ?>">
        </div>
        <div class="col-md-5 col-sm-12">
            <label for="edit_menu_icon">เปลี่ยนแปลงไอคอนเมนู <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank"><i class="fa fa-question-circle"></i></a></label>
            <input type="text" id="edit_menu_icon" name="edit_menu_icon" class="form-control" value="<?php echo $getmenu_detail->menu_icon; ?>" placeholder="Ex. fa-home">
        </div>
        <div class="col-md-2 col-sm-12">
            <label>Icon Menu</label>
            <p>
                <i class="fa <?php echo @$getmenu_detail->menu_icon; ?>"></i>
            </p>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-5 col-sm-12">
            <label for="edit_menu_folder">โฟลเดอร์</label>
            <input type="text" id="edit_menu_folder" name="edit_menu_folder" class="form-control" value="<?php echo $getmenu_detail->menu_case; ?>">
        </div>
        <div class="col-md-5 col-sm-12">
            <label for="edit_menu_link">Link menu</label>
            <input type="text" id="edit_menu_link" name="edit_menu_link" class="form-control" value="<?php echo $getmenu_detail->menu_link; ?>" placeholder="Ex. ?p=index">
        </div>
        <div class="col-md-2 col-sm-12">
            <label for="sorting">ลำดับเมนู</label>
            <input type="number" id="sorting" name="sorting" class="form-control" min="1" max="99" value="<?php echo $getmenu_detail->menu_sorting; ?>">
        </div>
    </div>
</div>
<input type="text" name="menu_key" hidden value="<?php echo $getmenu_detail->menu_key; ?>">