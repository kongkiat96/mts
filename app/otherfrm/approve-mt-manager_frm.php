<?php
session_start();
error_reporting(0);
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$chk_case = $getdata->my_sql_query($connect, NULL, "building_list", "ticket='" . htmlspecialchars($_GET['key']) . "'");
$get_admin = $getdata->my_sql_query($connect, NULL, "user", "user_key = '" . $_SESSION['ukey'] . "'");

?>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="ticket">Ticket Number</label>
            <input type="text" class="form-control" name="ticket" id="ticket" value="<?php echo @$chk_case->ticket; ?>" readonly>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="approve_status">สถานะ</label>
            <select name="approve_status" id="approve_status" class="form-control select2bs4" required>
                <option value="" selected>--- เลือกข้อมูล ---</option>

                <option value="Y">ผ่าน / ดำเนินงานเรียบร้อย</option>
                <option value="reject">ไม่ผ่าน / ดำเนินงานไม่เรียบร้อย</option>

            </select>
            <div class="invalid-feedback">
                เลือก สถานะ.
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <label for="comment">รายละเอียดเพิ่มเติม</label>
            <?php
            if ($_SESSION['uclass'] != 1) {
                echo '<textarea class="form-control" name="comment" id="comment"></textarea>';
            } else {
                echo '<textarea class="form-control" name="comment" id="comment" required></textarea>';
            }
            ?>
            <div class="invalid-feedback">
                ระบุ รายละเอียด.
            </div>
        </div>
    </div>
    <hr class="sidebar-divider d-none d-md-block">
  <div class="form-group row">
    <div class="col-12">
      <label for="asset_code">รหัสสินทรัพย์</label>
      <input type="text" id="asset_code" class="form-control" disabled value="<?php echo $chk_case->as_code; ?>">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-6 col-sm-12">
      <label for="service">หมวดหมู่</label>
      <select name="show_case_maintenance" id="show_case_maintenance" class="form-control" disabled>
        <?php
        $select_service = $getdata->my_sql_select($connect, NULL, "service", "se_id");
        while ($show_service = mysqli_fetch_object($select_service)) {
          if ($show_service->se_id == $chk_case->se_id) {
            echo '<option value="' . $show_service->se_id . '">' . $show_service->se_name . '</option>';
          }
        }
        ?>
      </select>
    </div>

    <div class="col-md-6 col-sm-12">
      <label for="service_list">ปัญหาที่พบ</label>
      <select name="show_case_maintenance" id="show_case_maintenance" class="form-control" disabled>
        <?php
        $select_service_list = $getdata->my_sql_select($connect, NULL, "service_list", "se_li_id");
        while ($show_service_list = mysqli_fetch_object($select_service_list)) {
          if ($show_service_list->se_li_id == $chk_case->se_li_id) {
            echo '<option value="' . $show_service_list->se_li_id . '">' . $show_service_list->se_li_name . '</option>';
          }
        }
        ?>
      </select>
    </div>

  </div>
  <?php
  if ($chk_case->se_other != NULL) { ?>
    <div class="form-group row">

      <div class="col-12">
        <label for="other">เพิ่มเติม</label>
        <textarea name="other" id="other" class="form-control" readonly><?php echo $chk_case->se_other; ?></textarea>
      </div>

    </div>
  <?php } ?>
  <div class="form-group row">
    <div class="col-md-6 col-sm-12">
      <label for="namecall">ชื่อผู้แจ้ง</label>
      <?php
      // if(getemployee($chk_case->se_namecall) == null) {
      //   $chkName = getemployee($chk_case->se_namecall);
      // } else {
      //   $chkName = $chk_case->se_namecall;
      // }
      $search = $getdata->my_sql_query($connect, NULL, "employee", "card_key ='" . $chk_case->se_namecall . "'");
      if (!$search || !is_array($search) || COUNT($search) == 0) {
        $chkName = $chk_case->se_namecall;
      } else {
        $chkName = getemployee($chk_case->se_namecall);
      }
      ?>
      <input type="text" name="namecall" id="namecall" class="form-control" readonly value="<?php echo $chkName; ?>">
    </div>
    <div class="col-md-6 col-sm-12">
      <label for="location">สาขา</label>
      <input type="text" name="location" id="location" class="form-control" readonly value="<?php echo @prefixbranch($chk_case->se_location); ?>">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-12">
      <label for="approve">ผู้อนุมัติ</label>
      <input type="text" class="form-control" name="approve" id="approve" readonly value="<?php echo $chk_case->se_approve; ?>">
    </div>

  </div>
</div>
<div class="modal-footer">

    <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" type="submit" name="save_approve_success" data-style="expand-left">
        <span class="fas fa-save"> บันทึก</span>
        <span class="ladda-spinner"></span>
    </button>
</div>
<input type="text" name="card_key" id="card_key" hidden value="<?php echo @htmlspecialchars($_GET['key']); ?>">
<input type="text" name="name_user" id="name_user" hidden value="<?php echo @getemployee($chk_case->user_key); ?>">
<input type="text" name="admin" hidden value="<?php echo @getemployee($get_admin->user_key); ?>">
<input type="text" name="namecall" hidden value="<?php echo $chk_case->se_namecall; ?>">
<input type="text" name="detail" hidden value="<?php echo $chk_case->se_other; ?>">
<input type="text" name="location" hidden value="<?php echo $chk_case->se_location; ?>">
<?php if ($chk_case->se_after != NULL) { ?>
    <input type="text" name="pic_log" value="<?php echo $chk_case->se_after; ?>">
<?php } ?>

<script>
    $('.select2bs4').select2({
        theme: 'bootstrap4',
        width: '100%'
    });
</script>

<script src="service/currency.js"></script>