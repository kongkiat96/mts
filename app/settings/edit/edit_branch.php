<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getbranch = $getdata->my_sql_query($connect, NULL, "branch", "id='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
    <div class="form-group row">
        <input type="hidden" name="dep_id" id="dep_id" value="<?php echo @$getbranch->id; ?>">
        <div class="col-8">
            <label for="edit_branch">ชื่อสาขา</label>
            <input type="text" name="edit_branch" id="edit_branch" class="form-control" value="<?php echo @$getbranch->branch_name; ?>">
        </div>
        <div class="col-4">
            <label for="">สถานะการแสดง</label>
            <h2 class="forn-control">
                <?php
                if (@$getbranch->status == 1) {
                    echo '<button type="button" class="btn btn-success btn-sm" id="btn-' . @$getbranch->id . '" onclick="changeUsingbranch(\'' . @$getbranch->id . '\');"><i class="fa fa-unlock-alt" id="icon-' . @$getbranch->id . '"></i> <span id="text-' . @$getbranch->id . '">แสดง</span></button>';
                } else {
                    echo '<button type="button" class="btn btn-danger btn-sm" id="btn-' . @$getbranch->id . '" onclick="changeUsingbranch(\'' . @$getbranch->id . '\');"><i class="fa fa-lock" id="icon-' . @$getbranch->id . '"></i> <span id="text-' . @$getbranch->id . '">ซ่อน</span></button>';
                }
                ?>
            </h2>
        </div>
    </div>
</div>