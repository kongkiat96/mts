<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$detail = $getdata->my_sql_query($connect, NULL, "user", "user_key='" . htmlspecialchars($_GET['key']) . "'");
$getmember_detail = $getdata->my_sql_query($connect, NULL, "employee", "card_key='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
  <div class="form-group row">
    <div class="col-md-4 col-sm-12">
      <label for="ed_code">ผู้ใช้งาน</label>
      <input type="text" name="ed_code" id="ed_code" class="form-control input-sm" value="<?php echo @$detail->username; ?>" required>
      <div class="invalid-feedback">
        ระบุ ผู้ใช้งาน.
      </div>
    </div>
    <div class="col-md-4 col-sm-12">
      <label for="ed_company">บริษัท / สังกัด</label>
      <select name="ed_company" id="ed_company" class="form-control select2bs4" required style="width: 100%;">
        <option value="">--- เลือกข้อมูล ---</option>
        <?php
        $getprefix = $getdata->my_sql_select($connect, NULL, "company", "id <> 'hidden' AND cp_status = '1'");

        while ($showprefix = mysqli_fetch_object($getprefix)) {
          if ($showprefix->id == $getmember_detail->department_id) {
            echo '<option value="' . $showprefix->id . '" selected>' . $showprefix->company_name . '</option>';
          } else {
            echo '<option value="' . $showprefix->id . '">' . $showprefix->company_name . '</option>';
          }
        }
        ?>
      </select>
      <div class="invalid-feedback">
        เลือก บริษัท / สังกัด.
      </div>
    </div>

    <div class="col-md-4 col-sm-12">
      <label for="email">อีเมล</label>
      <input type="email" name="ed_email" id="email" class="form-control input-sm" value="<?php echo @$detail->email; ?>" required>
      <div class="invalid-feedback">
        ระบุ อีเมล.
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-4 col-sm-12">
      <label for="ed_prefix">คำนำหน้า</label>
      <select name="ed_prefix" id="ed_prefix" class="form-control select2bs4" required style="width: 100%;">
        <option value="">--- เลือกข้อมูล ---</option>
        <?php
        $getprefix = $getdata->my_sql_select($connect, NULL, "members_prefix", "prefix_status ='1' ORDER BY prefix_code");
        while ($showprefix = mysqli_fetch_object($getprefix)) {
          if ($showprefix->prefix_code == $getmember_detail->title_name) {
            echo '<option value="' . $showprefix->prefix_code . '" selected>' . $showprefix->prefix_title . '</option>';
          } else {
            echo '<option value="' . $showprefix->prefix_code . '">' . $showprefix->prefix_title . '</option>';
          }
        }
        ?>
      </select>
      <div class="invalid-feedback">
        เลือก คำนำหน้า.
      </div>
    </div>
    <div class="col-md-4 col-sm-12">
      <label for="ed_name">ชื่อ</label>
      <input type="text" name="ed_name" id="ed_name" class="form-control input-sm" value="<?php echo @$getmember_detail->name; ?>" required>
      <div class="invalid-feedback">
        ระบุ ชื่อ.
      </div>
    </div>
    <div class="col-md-4 col-sm-12">
      <label for="ed_lastname">นามสกุล</label>
      <input type="text" name="ed_lastname" id="ed_lastname" class="form-control input-sm" value="<?php echo @$getmember_detail->lastname; ?>" required>
      <div class="invalid-feedback">
        ระบุ นามสกุล.
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-6 col-sm-12">
      <label for="ed_position">ตำแหน่ง</label>
      <input type="text" name="ed_position" id="ed_position" class="form-control input-sm" value="<?php echo @$getmember_detail->user_position; ?>" required>
      <div class="invalid-feedback">
        ระบุ ตำแหน่ง.
      </div>
    </div>
    <div class="col-md-6 col-sm-12">
      <label for="ed_department">แผนก</label>
      <select name="ed_department" id="ed_department" class="form-control select2bs4" required style="width: 100%;">
        <option value="">--- เลือกข้อมูล ---</option>
        <?php
        $getprefix = $getdata->my_sql_select($connect, NULL, "department_name", "id <> 'hidden' AND department_status = '1'");
        while ($showprefix = mysqli_fetch_object($getprefix)) {
          if ($showprefix->id == $getmember_detail->user_department) {
            echo '<option value="' . $showprefix->id . '" selected>' . $showprefix->department_name . '</option>';
          } else {
            echo '<option value="' . $showprefix->id . '">' . $showprefix->department_name . '</option>';
          }
        }
        ?>
      </select>
      <div class="invalid-feedback">
        เลือก แผนก.
      </div>
    </div>
  </div>

  <input hidden name="card_key" id="card_key" value="<?php echo @htmlspecialchars($_GET['key']); ?>">

  <script>
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  </script>