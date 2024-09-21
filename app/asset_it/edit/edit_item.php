<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getitem_detail = $getdata->my_sql_query($connect, NULL, "card_item", "item_key='" . htmlspecialchars($_GET['key']) . "'");

?>

<div class="modal-body">
  <div class="form-grou row">
    <div class="col-9">
      <label for="edit_device_name">อุปกรณ์</label>
      <input type="text" name="edit_device_name" id="edit_device_name" class="form-control" value="<?php echo @$getitem_detail->item_name; ?>" autofocus>
    </div>
    <div class="col-3">
      <label for="edit_device_num">จำนวน</label>
      <input type="number" name="edit_device_num" id="edit_device_num" class="form-control" value="<?php echo @$getitem_detail->item_price_aprox; ?>" min="1" max="99">
    </div>
  </div>
  <div class="form-group">
    <label for="edit_device_detail">รายละเอียด</label>
    <textarea name="edit_device_detail" id="edit_device_detail" class="form-control"><?php echo @$getitem_detail->item_note; ?></textarea>

    <input type="hidden" name="item_key" id="item_key" value="<?php echo @htmlspecialchars($_GET['key']); ?>">
  </div>

</div>
<div class="modal-footer">
  <!-- <div id="showload" style="display: none;"><span class="spinner-border text-primary spinner-sm" role="status" aria-hidden="true"></span></div>

  <button class="btn btn-outline-primary btn-sm" type="submit" name="save_edit_item" id="save_edit_item"><i class="fa fa-save fa-fw"></i>บันทึก</button> -->

  <button class="ladda-button btn btn-success btn-square btn-ladda" style="background-color: green;" data-style="contract" type="submit" name="save_edit_item">
    <span class="fas fa-sync-alt"> บันทึก</span>
    <span class="ladda-spinner"></span>
  </button>
</div>