<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getdetail_line = $getdata->my_sql_query($connect, NULL, "alert_line", "alert_key_line ='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="edit_alertname_line">ชื่อการแจ้งเตือน</label>
            <input type="text" name="edit_alertname_line" id="edit_alertname_line" class="form-control" value="<?php echo $getdetail_line->alert_name; ?>" required autocomplete="off">
            <div class="invalid-feedback">
                ระบุ ชื่อการแจ้งเตือน.
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="edit_page">ใช้สำหรับหน้า</label>
            <select name="edit_page" id="edit_page" class="form-control select2bs4" required>
                <option value="">--- เลือกข้อมูล ---</option>
                <?php $getmenu = $getdata->my_sql_select($connect, null, 'list', "case_status = '1' ORDER BY menu ASC");
                while ($showmenu = mysqli_fetch_object($getmenu)) {
                    if ($showmenu->id == $getdetail_line->use_menu) {
                        echo '<option value="' . $showmenu->id . '" selected>' . $showmenu->pages . '</option>';
                    } else {
                        echo '<option value="' . $showmenu->id . '">' . $showmenu->pages . '</option>';
                    }
                }
                ?>
            </select>
            <div class="invalid-feedback">
                เลือก เมนูสำหรับการแจ้งเตือน.
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <label for="line_token">Line Token</label>
            <input type="text" name="line_token" id="line_token" class="form-control" value="<?php echo $getdetail_line->line_token; ?>" required autocomplete="off">
            <div class="invalid-feedback">
                ระบุ Linetoken.
            </div>
        </div>
    </div>
</div>
<input type="text" name="id_link" hidden value="<?php echo $getdetail_line->id; ?>">
<script>
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
</script>