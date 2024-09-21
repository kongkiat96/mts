<?php
require 'inc_file.php';

$getticket_bu = $getdata->my_sql_show_rows($connect, "building_list", "ID AND date LIKE '%" . date("Y-m") . "%'"); // นับข้อมูลใน database โดยเลือก ปี เดือน วัน ปัจจุบัน
if ($getticket_bu < 999) {
    $runticket_bu = 'PM' . date("Y-m") . '-W' . sprintf('%02s', $getticket_bu + 1); // ถ้าวันปัจจุบันมีการนับน้อยกว่า 999 ให้ปัจจุบัน +1 
}
