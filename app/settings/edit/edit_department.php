<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getdepartment = $getdata->my_sql_query($connect, NULL, "department_name", "id='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
	<div class="form-group row">
		<div class="col-8">
			<label for="edit_department">ชื่อแผนก</label>
			<input type="text" name="edit_department" id="edit_department" class="form-control" value="<?php echo @$getdepartment->department_name; ?>">
		</div>

		<div class="col-4">
			<label for="">สถานะการแสดง</label>
			<h2 class="forn-control">
				<?php
				if (@$getdepartment->department_status == 1) {
					echo '<button type="button" class="btn btn-success btn-sm" id="btn-' . @$getdepartment->id . '" onclick="changeUsingdep(\'' . @$getdepartment->id . '\');"><i class="fa fa-unlock-alt" id="icon-' . @$getdepartment->id . '"></i> <span id="text-' . @$getdepartment->id . '">แสดง</span></button>';
				} else {
					echo '<button type="button" class="btn btn-danger btn-sm" id="btn-' . @$getdepartment->id . '" onclick="changeUsingdep(\'' . @$getdepartment->id . '\');"><i class="fa fa-lock" id="icon-' . @$getdepartment->id . '"></i> <span id="text-' . @$getdepartment->id . '">ซ่อน</span></button>';
				}
				?>
			</h2>

		</div>
		<input type="hidden" name="dep_id" id="dep_id" value="<?php echo @$getdepartment->id; ?>">
	</div>
</div>