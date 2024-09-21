<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getprefix_detail = $getdata->my_sql_query($connect, NULL, "service_list", "se_li_id='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group">
        <label>หมวดหมู่</label>
        <select class="form-control select2bs4" name="se_id" id="se_id">
            <?php $select_status = $getdata->my_sql_select($connect, NULL, "service", "se_id");

            while ($show_status = mysqli_fetch_object($select_status)) {
                if ($show_status->se_id == $getprefix_detail->se_id) {
                    echo '<option value="' . $show_status->se_id . '" selected>' . $show_status->se_name . '</option>';
                } else {
                    echo '<option value="' . $show_status->se_id . '">' . $show_status->se_name . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>รายการหมวดหมู่</label>
        <!-- <input type="text" name="edit_se_li_name" id="edit_se_li_name" class="form-control" value="<?php echo @$getprefix_detail->se_li_name; ?>"> -->
        <input hidden name="se_li_id" value="<?php echo @$getprefix_detail->se_li_id; ?>">

        <textarea class="form-control" name="edit_se_li_name" id="edit_se_li_name" cols="30" rows="5"><?php echo @$getprefix_detail->se_li_name; ?></textarea>
    </div>
</div>
<script>
    $('.select2bs4').select2({
        theme: 'bootstrap4',
        width: '100%'
    });
</script>