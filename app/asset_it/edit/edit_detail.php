<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$userdata = $getdata->my_sql_query($connect, NULL, "user", "user_key='" . $_SESSION['ukey'] . "'");
mysqli_set_charset($connect, "utf8");

$getuse_detail = $getdata->my_sql_query($connect, NULL, "card_info", "card_key='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
   <div class="form-group row">
      <div class="col-md-3">
         <label for="card_code">Code Asset</label>
         <input type="text" name="card_code" id="card_code" readonly class="form-control input-sm" value="<?php echo @$getuse_detail->card_code; ?>">
      </div>
      <div class="col-md-3">
         <label for="asset_code">รหัสสินทรัพย์</label>
         <input type="text" name="asset_code" id="asset_code" class="form-control input-sm" required value="<?php echo @$getuse_detail->asset_code ?>">
         <div class="invalid-feedback">
            ระบุ รหัสสินทรัพย์.
         </div>
      </div>
      <div class="col-md-3">
         <label for="company">สินทรัพย์ของบริษัท</label>
         <select name="company" id="company" class="form-control select2bs4 input-sm" required="">
            <option value="">--- เลือกข้อมูล ---</option>
            <?php
            $getcompany = $getdata->my_sql_select($connect, NULL, "company", "id AND cp_status = '1' AND show_it = '1'");
            while ($showprefix = mysqli_fetch_object($getcompany)) {
               if ($showprefix->id == $getuse_detail->card_company) {
                  echo '<option value="' . $showprefix->id . '" selected>' . $showprefix->company_name . '</option>';
               } else {
                  echo '<option value="' . $showprefix->id . '">' . $showprefix->company_name . '</option>';
               }
            }
            ?>
         </select>
         <div class="invalid-feedback">
            เลือก สินทรัพย์ของบริษัท.
         </div>
      </div>
      <div class="col-md-3">
         <label for="card_possess">ผู้ครอบครองสินทรัพย์</label>
         <input type="text" name="edit_card_possess" id="card_possess" class="form-control input-sm" placeholder="Asset Possess" required value="<?php echo $getuse_detail->card_possess; ?>">
         <div class="invalid-feedback">
            ระบุ ผู้ครอบครองสินทรัพย์.
         </div>
      </div>
   </div>
   <hr>
   <div class="form-group row">
      <div class="col-md-6">
         <label for="edit_card_cus_name">ชื่อและนามสกุลผู้ใช้งาน</label>
         <select name="edit_card_cus_name" id="edit_card_cus_name" class="form-control select2bs4 input-sm">
            <option value="">--- เลือกข้อมูล ---</option>
            <?php
            $getgroup = $getdata->my_sql_select($connect, NULL, "employee", "card_key <> 'hidden' AND em_status = '1' ORDER BY title_name");
            while ($showgroup = mysqli_fetch_object($getgroup)) {
               if ($showgroup->card_key == $getuse_detail->card_customer_name) {
                  echo '<option value="' . $showgroup->card_key . '" selected>' . @prefixConvertor($showgroup->title_name) . '&nbsp;' . $showgroup->name . '&nbsp;' . $showgroup->lastname . '</option>';
               } else {
                  echo '<option value="' . $showgroup->card_key . '">' . @prefixConvertor($showgroup->title_name) . '&nbsp;' . $showgroup->name . '&nbsp;' . $showgroup->lastname . '</option>';
               }
            }
            ?>
         </select>
         <div class="invalid-feedback">
            เลือก ชื่อและนามสกุลผู้ใช้งาน.
         </div>
      </div>
      <div class="col-md-6">
         <label for="edit_department_id2">บริษัท</label>
         <input name="department_id" value="<?php echo @getemployee_company($getuse_detail->card_customer_name); ?>" class="form-control input-sm" readonly>
      </div>
   </div>
   <div class="form-group row">
      <div class="col-md-6">
         <label for="edit_position">ตำแหน่ง</label>
         <input name="position" value="<?php echo @getemployee_position($getuse_detail->card_customer_name); ?>" class="form-control input-sm" readonly>
      </div>
      <div class="col-md-6">
         <label for="edit_department">แผนก</label>
         <input name="department" value="<?php echo @getemployee_department($getuse_detail->card_customer_name); ?>" class="form-control input-sm" readonly>
      </div>
   </div>
   <hr>
   <div class="form-group row">
      <div class="col-md-3">
         <label for="edit_card_insert">วันที่เริ่มใช้งาน</label>
         <input type="date" name="edit_card_insert" id="edit_card_insert" class="form-control input-sm" value="<?php echo @$getuse_detail->card_insert; ?>">
      </div>
      <div class="col-md-3">
         <label for="card_date_buy">วันที่ซื้อ</label>
         <input type="date" name="card_date_buy" id="card_date_buy" class="form-control input-sm" value="<?php echo @$getuse_detail->card_date_buy; ?>">
      </div>
      <div class="col-md-3">
         <label for="edit_card_ex">รับประกัน</label>
         <input type="text" name="edit_card_ex" id="edit_card_ex" class="form-control input-sm" placeholder="เช่น : 3 ปี / 3 เดือน" value="<?php echo @$getuse_detail->card_ex; ?>">
      </div>
      <div class="col-md-3">
         <label for="edit_card_sum">จำนวน</label>
         <input type="number" name="edit_card_sum" id="edit_card_sum" class="form-control input-sm" placeholder="ชิ้น / ชุด" value="<?php echo @$getuse_detail->card_sum; ?>" min="1" max="99">
      </div>
   </div>
   <div class="form-group row">
      <div class="col-md-3">
         <label for="edit_card_customer_phone">เบอร์โทรติดต่อ Supplier</label>
         <input type="text" name="edit_card_customer_phone" id="edit_card_customer_phone" class="form-control input-sm" placeholder="เบอร์โทรศัพท์" value="<?php echo @$getuse_detail->card_customer_phone; ?>">
      </div>
      <div class="col-md-3">
         <label for="edit_card_email">E-mail Supplier</label>
         <input type="email" name="edit_card_email" id="edit_card_email" class="form-control input-sm" placeholder="อีเมล" value="<?php echo @$getuse_detail->card_customer_email; ?>">
      </div>
      <div class="col-md-3">
         <label for="edit_card_note">ชื่อเครื่อง / ชื่ออุปกรณ์</label>
         <input type="text" name="edit_card_note" id="edit_card_note" class="form-control input-sm" value="<?php echo @$getuse_detail->card_note; ?>">
      </div>
      <div class="col-md-3">
         <label for="edit_card_price">ราคาอุปกรณ์</label>
         <input type="text" name="edit_card_price" id="edit_card_price" class="form-control input-sm" value="<?php echo @$getuse_detail->card_price; ?>" data-type="currency" placeholder="0.00">
      </div>
   </div>
   <!-- <div class="form-group row">
      <div class="col-12">
         <label for="license">รายละเอียดระบบปฏิบัติการ</label>&nbsp
         <input type="radio" name="ck_license" value="1" required="" <?php if (@$getuse_detail->ck_license == '1') {
                                                                        echo "checked";
                                                                     } ?>>
         <label for="ck_license">
            <font color="green">License</font>
         </label>&nbsp
         <input type="radio" name="ck_license" value="0" required="" <?php if (@$getuse_detail->ck_license == '0') {
                                                                        echo "checked";
                                                                     }
                                                                     ?>>
         <label for="ck_license">
            <font color="red">No license</font>
         </label>


      </div>
   </div>
   <div class="form-group row">
      <div class="col-6">
         <input type="text" name="license_name" id="os" class="form-control input-sm" placeholder="Windows / Other" value="<?php echo @$getuse_detail->license_name; ?>" required>
         <div class="invalid-feedback">
            Input Windows, Programs Or Other.
         </div>
      </div>
      <div class="col-6">

         <input type="text" name="license_key" id="key" class="form-control input-sm" placeholder="License key : xxxxx-xxxxx-xxxxx-xxxxx-xxxxx" value="<?php echo @$getuse_detail->license_key; ?>" required <?php if (@$getuse_detail->ck_license == '0') {
                                                                                                                                                                                                                  echo "disabled";
                                                                                                                                                                                                               }
                                                                                                                                                                                                               ?>>
         <div class="invalid-feedback">
            License key.
         </div>
      </div>
   </div>

   <div class="form-group row">
      <div class="col-12">
         <label for="license">รายละเอียดโปรแกรม</label>&nbsp
         <input type="radio" name="p_ck_license" value="1" required="" <?php if (@$getuse_detail->p_ck_license == '1') {
                                                                           echo "checked";
                                                                        } ?>>
         <label for="p_ck_license">
            <font color="green">License</font>
         </label>&nbsp
         <input type="radio" name="p_ck_license" value="0" required="" <?php if (@$getuse_detail->p_ck_license == '0') {
                                                                           echo "checked";
                                                                        }
                                                                        ?>>
         <label for="p_ck_license">
            <font color="red">No license</font>
         </label>


      </div>
   </div>
   <div class="form-group row">
      <div class="col-6">
         <input type="text" name="p_license_name" id="program" class="form-control input-sm" placeholder="Program" value="<?php echo @$getuse_detail->p_license_name; ?>" required>
         <div class="invalid-feedback">
            Input Programs Or Other.
         </div>
      </div>
      <div class="col-6">

         <input type="text" name="p_license_key" id="programkey" class="form-control input-sm" placeholder="License key : xxxxx-xxxxx-xxxxx-xxxxx-xxxxx" value="<?php echo @$getuse_detail->p_license_key; ?>" required <?php if (@$getuse_detail->p_ck_license == '0') {
                                                                                                                                                                                                                           echo "disabled";
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                        ?>>
         <div class="invalid-feedback">
            License key.
         </div>
      </div>
   </div> -->


   <div class="form-group">
      <input name="card_key" value="<?php echo @htmlspecialchars($_GET['key']); ?>" hidden>
      <input name="user_update" value="<?php echo @$userdata->user_key; ?>" hidden>
   </div>
</div>

<script>
   $('input[name="ck_license"]').on('click', function() {
      if ($(this).val() === '1') {
         $('#os').prop('disabled', false).val('<?php echo @$getuse_detail->license_name; ?>');
         $('#key').prop('disabled', false).val('<?php echo @$getuse_detail->license_key; ?>');
      } else {
         $('#key').prop("disabled", true).val('');
      }
   });

   $('input[name="p_ck_license"]').on('click', function() {
      if ($(this).val() === '1') {
         $('#program').prop('disabled', false).val('<?php echo @$getuse_detail->p_license_name; ?>');
         $('#programkey').prop('disabled', false).val('<?php echo @$getuse_detail->p_license_key; ?>');
      } else {
         $('#programkey').prop("disabled", true).val('');
      }
   });

   $('.select2bs4').select2({
      theme: 'bootstrap4',
      width: '100%'
   });
</script>

<script src="asset_it/currency.js"></script>