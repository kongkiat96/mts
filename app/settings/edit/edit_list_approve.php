<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$get_list_approve = $getdata->my_sql_query($connect, NULL, "list_admin_approve", "id ='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-12">
            <label for="showname">ชื่อ - นามสกุล</label>
            <input type="text" name="showname" id="showname" class="form-control" value="<?php echo prefixConvertorUsername($get_list_approve->user_key); ?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <label for="edit_approve_menu">เมนูรายการอนุมัติ</label>
            <select name="edit_approve_menu" id="edit_approve_menu" class="form-control select2bs4" width="100%" required>
                <option value="">--- เลือก เมนูรายการอนุมัติ ---</option>
                <option value="approve_all" <?php if (@$get_list_approve->approve_menu == 'approve_all') echo 'selected' ?>>เลือกทั้งหมด</option>
                <option value="approve_mts" <?php if (@$get_list_approve->approve_menu == 'approve_mts') echo 'selected' ?>>กลุ่มงาน ฝ่ายอาคาร</option>
                <option value="approve_cts" <?php if (@$get_list_approve->approve_menu == 'approve_cts') echo 'selected' ?>>กลุ่มงาน เฟอร์นิเจอร์</option>
            </select>
            <div class="invalid-feedback">
                เลือก เมนูรายการอนุมัติ
            </div>
        </div>
    </div>
    <input type="text" name="list_approve_id" id="list_approve_id" value="<?php echo @$get_list_approve->id; ?>" hidden readonly>
</div>

<script type="text/javascript">
    $('.select2bs4').select2({
        theme: 'bootstrap4',
        width: '100%'
    });
</script>