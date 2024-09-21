<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Bangkok');
require("config.core.php");
require("connect.core.php");
require("logs.core.php");
$loginclass = new clear_db();
$connect = $loginclass->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$check = $loginclass->my_sql_show_rows($connect, 'user', 'email="' . htmlspecialchars($_POST['username']) . '" OR username="' . htmlspecialchars($_POST['username']) . '" AND user_status="1"');
if ($check == 0) {
	echo "<script>window.location=\"../index.php?c=nouser\"</script>";
} else {
	$info = $loginclass->my_sql_select($connect, NULL, 'user', 'email="' . htmlspecialchars($_POST['username']) . '" OR username="' . htmlspecialchars($_POST['username']) . '"AND user_status="1"');
	while ($getinfo = mysqli_fetch_object($info)) {
		$getpassword = md5(htmlspecialchars($_POST['password']));
		if ($getinfo->password != $getpassword) {
			echo "<script>window.location=\"../index.php?c=nouser\"</script>";
		} else {
			$_SESSION['uname'] = $getinfo->username;
			$_SESSION['uclass'] = $getinfo->user_class;
			$_SESSION['lang'] = $getinfo->user_language;
			$_SESSION['ukey'] = $getinfo->user_key;
			insertLogs($getinfo->username . " เข้าสู่ระบบ.", $_SERVER['REMOTE_ADDR'], $getinfo->user_key);
			// echo "OK";
			if ($getinfo->user_class <= 3 && $getinfo->user_status == 1) {
				echo "<script>window.location=\"../app/\"</script>";
			} else {
				echo "<script>window.location=\"../index.php?c=nouser\"</script>";
			}
		}
	}
}
$loginclass->my_sql_close($connect);
