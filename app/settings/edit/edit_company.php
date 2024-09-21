<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getcompany = $getdata->my_sql_query($connect, NULL, "company", "id='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
	<div class="form-group row">
		<input type="hidden" name="dep_id" id="dep_id" value="<?php echo @$getcompany->id; ?>">
		<div class="col-8">
			<label for="edit_company">ชื่อบริษัท</label>
			<input type="text" name="edit_company" id="edit_company" class="form-control" value="<?php echo @$getcompany->company_name; ?>">
		</div>
		<div class="col-4">
			<label for="">สถานะการแสดง</label>
			<h2 class="forn-control">
				<?php
				if (@$getcompany->cp_status == 1) {
					echo '<button type="button" class="btn btn-success btn-sm" id="btn-' . @$getcompany->id . '" onclick="changeUsingcompany(\'' . @$getcompany->id . '\');"><i class="fa fa-unlock-alt" id="icon-' . @$getcompany->id . '"></i> <span id="text-' . @$getcompany->id . '">แสดง</span></button>';
				} else {
					echo '<button type="button" class="btn btn-danger btn-sm" id="btn-' . @$getcompany->id . '" onclick="changeUsingcompany(\'' . @$getcompany->id . '\');"><i class="fa fa-lock" id="icon-' . @$getcompany->id . '"></i> <span id="text-' . @$getcompany->id . '">ซ่อน</span></button>';
				}
				?>
			</h2>

		</div>

	</div>

</div>