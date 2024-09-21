<?php
session_start();
error_reporting(0);
require("../../../core/config.core.php");
require("../../../core/connect.core.php");
require("../../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$getprefix_detail = $getdata->my_sql_query($connect, NULL, "service", "se_id='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-body">
	<div class="form-group row">
		<div class="col-8">
			<label for="edit_se_name">ชื่อหมวดหมู่</label>
			<input type="text" name="edit_se_name" id="edit_se_name" class="form-control" value="<?php echo @$getprefix_detail->se_name; ?>" autocomplete="off">
		</div>
		<div class="col-4">
			<label for="edit_se_sort">ลำดับรายการ</label>
			<input type="number" name="edit_se_sort" id="edit_se_sort" class="form-control" min="1" max="99" value="<?php echo @$getprefix_detail->se_sort; ?>">
		</div>

	</div>
	<input hidden name="se_id" value="<?php echo @$getprefix_detail->se_id; ?>">
</div>
<script>
	$('.select2bs4').select2({
		theme: 'bootstrap4',
		width: '100%'
	});
</script>