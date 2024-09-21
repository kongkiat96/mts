<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getprefix_detail = $getdata->my_sql_query($connect, NULL, "members_prefix", "prefix_key='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
  <div class="form-group row">
    <div class="col-8">
      <label for="edit_prefix_title">ชื่อคำนำหน้านาม</label>
      <input type="text" name="edit_prefix_title" id="edit_prefix_title" class="form-control" value="<?php echo @$getprefix_detail->prefix_title; ?>">
    </div>
    <div class="col-4">
      <label for="">สถานะการแสดง</label>
      <h2 class="forn-control">
        <?php
        if (@$getprefix_detail->prefix_status == 1) {
          echo '<button type="button" class="btn btn-success btn-sm" id="btn-' . @$getprefix_detail->prefix_key . '" onclick="changeUsingprefix(\'' . @$getprefix_detail->prefix_key . '\');"><i class="fa fa-unlock-alt" id="icon-' . @$getprefix_detail->prefix_key . '"></i> <span id="text-' . @$getprefix_detail->prefix_key . '">แสดง</span></button>';
        } else {
          echo '<button type="button" class="btn btn-danger btn-sm" id="btn-' . @$getprefix_detail->prefix_key . '" onclick="changeUsingprefix(\'' . @$getprefix_detail->prefix_key . '\');"><i class="fa fa-lock" id="icon-' . @$getprefix_detail->prefix_key . '"></i> <span id="text-' . @$getprefix_detail->prefix_key . '">ซ่อน</span></button>';
        }
        ?>
      </h2>

    </div>


    <input type="text" name="prefix_key" id="prefix_key" value="<?php echo @$getprefix_detail->prefix_key; ?>" hidden readonly>
  </div>
</div>