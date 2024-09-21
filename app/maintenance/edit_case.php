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
        <div class="col-md-4 col-sm-12">
            <label for="ticket">Ticket Number</label>
            <input type="text" class="form-control" name="ticket" id="ticket" value="<?php echo @$chk_case->ticket; ?>" readonly>
        </div>
        <div class="col-md-8 col-sm-12">
            <label for="se_asset">รหัสสินทรัพย์</label>
            <input type="text" name="se_asset" id="se_asset" class="form-control" value="<?php echo $chk_case->as_code; ?>">

        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="se_id">หมวดหมู่</label>
            <select class="form-control select2bs4" style="width: 100%;" name="se_id" id="se_id" onchange="getServiceList(this.value)" required>
                <option value="">--- เลือก หมวดหมู่ ---</option>
                <?php
                $getprefix = $getdata->my_sql_select($connect, NULL, "service", "se_id AND se_status ='1' ORDER BY se_sort");
                while ($showservice = mysqli_fetch_object($getprefix)) {
                    if ($chk_case->se_id == $showservice->se_id) {
                        echo '<option value="' . $showservice->se_id . '" selected>' . $showservice->se_name . '</option>';
                    } else {
                        echo '<option value="' . $showservice->se_id . '">' . $showservice->se_name . '</option>';
                    }
                }
                ?>
            </select>
            <div class="invalid-feedback">
                เลือก หมวดหมู่ .
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="se_li">ปัญหาที่พบ</label>
            <select class="form-control select2bs4" style="width: 100%;" name="se_li" id="se_li" required>
                <?php
                $select_service_list = $getdata->my_sql_select($connect, NULL, "service_list", "se_li_id AND se_li_status ='1' ORDER BY se_li_id");
                while ($show_service_list = mysqli_fetch_object($select_service_list)) {
                    if ($show_service_list->se_li_id == $chk_case->se_li_id) {
                        echo '<option value="' . $show_service_list->se_li_id . '" selected>' . $show_service_list->se_li_name . '</option>';
                    } else if ($chk_case->se_id == $show_service_list->se_id) {
                        echo '<option value="' . $show_service_list->se_li_id . '">' . $show_service_list->se_li_name . '</option>';
                    }
                }
                ?>

            </select>
            <div class="invalid-feedback">
                เลือก ปัญหาที่พบ .
            </div>
        </div>
    </div>


    <?php
    if ($chk_case->se_other != NULL) { ?>
        <div class="form-group row">

            <div class="col-12">
                <label for="other">เพิ่มเติม</label>
                <textarea name="other" id="other" class="form-control"><?php echo $chk_case->se_other; ?></textarea>
            </div>

        </div>
    <?php } ?>
    <div class="form-group row">
        <div class="col-12">

            <label for="pic">แก้ไขรูปภาพ Insert Pic (.PNG, .JPG).</label>
            <input type="file" name="pic" id="pic" class="form-control" value="<?php echo $chk_case->pic_before; ?>">


        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            <?php
            if ($chk_case->pic_before == null) {
                echo '<img class="img-thumbnail" src="../resource/bu/file_pic_now/no-img.png" width="100%">';
            } else {
                echo '<img class="img-thumbnail" src="../resource/bu/delevymo/' . $chk_case->pic_before . '" width="100%">';
            }
            ?>
        </div>

    </div>

</div>

<input type="text" name="card_key" id="card_key" hidden value="<?php echo @htmlspecialchars($_GET['key']); ?>">
<input type="text" name="name_user" id="name_user" hidden value="<?php echo @getemployee($chk_case->user_key); ?>">
<input type="text" name="admin" hidden value="<?php echo $get_admin->name . " " . $get_admin->lastname; ?>">
<input type="text" name="namecall" hidden value="<?php echo $chk_case->se_namecall; ?>">
<input type="text" name="location" hidden value="<?php echo $chk_case->se_location; ?>">
<input type="text" name="detail" hidden value="<?php echo $chk_case->se_other; ?>">
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