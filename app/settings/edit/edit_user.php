<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getuser = $getdata->my_sql_query($connect, NULL, "user", "id='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group row">
        <?php if ($_SESSION['uclass'] == 3) { ?>
            <div class="col-6">
                <label for="edit_username">ชื่อผู้ใช้งาน</label>
                <input type="text" name="edit_username" id="edit_username" class="form-control" value="<?php echo @$getuser->username; ?>" required>
            </div>
        <?php } else { ?>
            <div class="col-12">
                <label for="edit_username">ชื่อผู้ใช้งาน</label>
                <input type="text" name="edit_username" id="edit_username" class="form-control" readonly value="<?php echo @$getuser->username; ?>" required>
            </div>
        <?php }
        if ($_SESSION['uclass'] == 3) { ?>
            <div class="col-6">
                <label for="edit_class">ระดับสิทธิ์การใช้งาน</label>
                <select name="edit_class" id="edit_class" class="form-control">
                    <?php if ($getuser->user_class == 3) { ?>
                        <option value="3" selected>ผู้ดูแลระบบ</option>
                        <option value="2">เจ้าหน้าที่</option>
                        <option value="1">ผู้ใช้งาน</option>
                    <?php } elseif ($getuser->user_class == 2) { ?>
                        <option value="3">ผู้ดูแลระบบ</option>
                        <option value="2" selected>เจ้าหน้าที่</option>
                        <option value="1">ผู้ใช้งาน</option>
                    <?php } elseif ($getuser->user_class == 1) { ?>
                        <option value="3">ผู้ดูแลระบบ</option>
                        <option value="2">เจ้าหน้าที่</option>
                        <option value="1" selected>ผู้ใช้งาน</option>
                    <?php } else { ?>
                        <option value="" selected>--- เลือกข้อมูล ---</option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>
    </div>
    <hr>
    <legend class="text-danger font-weight-bold">รีเซ็ตรหัสผ่าน</legend>
    <div class="form-group row text-danger">
        <div class="col-6">
            <label for="edit_password">รหัสผ่านใหม่</label>
            <input type="password" class="form-control" id="edit_password" name="edit_password">
        </div>
        <div class="col-6">
            <label for="edit_repassword">ยืนยันรหัสผ่านใหม่อีกครั้ง</label>
            <input type="password" class="form-control" id="edit_repassword" name="edit_repassword">
        </div>
    </div>
    <input type="hidden" name="id_user" id="id_user" value="<?php echo @$getuser->id; ?>">
    <input type="text" name="showclass" hidden value="<?php echo $getuser->user_class; ?>">
</div>

<script>
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
</script>