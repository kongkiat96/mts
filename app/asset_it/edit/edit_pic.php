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
            <input type="text" name="asset_code" id="asset_code" class="form-control input-sm" required value="<?php echo @$getuse_detail->asset_code ?>" readonly>
            <div class="invalid-feedback">
                ระบุ รหัสสินทรัพย์.
            </div>
        </div>
        <div class="col-md-3">
            <label for="company">สินทรัพย์ของบริษัท</label>
            <select name="company" id="company" class="form-control select2bs4 input-sm" disabled>
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
            <input type="text" name="edit_card_possess" id="card_possess" class="form-control input-sm" placeholder="Asset Possess" disabled value="<?php echo $getuse_detail->card_possess; ?>">
            <div class="invalid-feedback">
                ระบุ ผู้ครอบครองสินทรัพย์.
            </div>
        </div>
    </div>
    <hr>
    <div class="form-group row">
        <div class="col-12">
            <label for="asset_pic">รูปภาพ</label>
            <input type="file" name="asset_pic_edit" id="asset_pic" class="form-control input-sm">
        </div>
    </div>
    <div class="form-group">
        <input name="card_key" value="<?php echo @htmlspecialchars($_GET['key']); ?>" hidden>
        <input name="asset_pic_edit_log" value="<?php echo $getuse_detail->card_pic; ?>" hidden>
        <input name="user_update" value="<?php echo @$userdata->user_key; ?>" hidden>

    </div>