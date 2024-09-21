<?php
require_once("../../core/mysql_restore.core.php");
require_once("../../core/config.core.php");
$restore_obj = new mysqli_Restore();
$restore_obj->server = DB_HOST;
$restore_obj->username = DB_USERNAME;
$restore_obj->password = DB_PASSWORD;
$restore_obj->database = DB_NAME;
if (!$restore_obj->Execute('../../backup/'.htmlspecialchars($_GET['fn']),MSR_FILE, false, false))
{
	die($restore_obj->error);
	// print_r($restore_obj);
	// exit();
}
?>
<script language="javascript">
	alert("กู้คืนข้อมูล สำเร็จ.");
	window.location="../index.php?p=setting_backup&sts=rcomp";
</script>