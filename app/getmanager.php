<?php
session_start();
error_reporting(0);
require '../core/config.core.php';
require '../core/connect.core.php';
require '../core/functions.core.php';
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, 'utf8');
date_default_timezone_set('Asia/Bangkok');

//require("../core/online.core.php");
if(isset($_POST['value'])) {
    $selectedValue = $_POST['value'];
// echo $selectedValue;
    $chkManager =  $getdata->my_sql_query($connect, NULL, "manager", "user_key = '" . $selectedValue . "'");

    if(COUNT($chkManager) == 0) {
        echo null;
    } else {
        echo getemployee($chkManager->manager_user_key);
    }
    
}
?>