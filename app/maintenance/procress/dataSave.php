<?php
$name_key = $userdata->user_key; // show key md5 name
$fullname = @prefixConvertorUsername($name_key);
$getalert = $getdata->my_sql_query($connect, NULL, "system_alert", NULL);
if (isset($_POST['save_offcase'])) {
    if (htmlspecialchars($_POST['off_case_status']) != NULL && htmlspecialchars($_POST['date_off_case']) != NULL) {

        if (!defined('pic')) {
            if (!defined('pic')) {
                define('pic', '../resource/bu/delevymo/');
            }
            if (is_uploaded_file($_FILES['pic']['tmp_name'])) {
                $remove_charname = array(' ', '`', '"', '\'', '\\', '/', '_');
                $pic = str_replace($remove_charname, '', $_FILES['pic']['name']);
                $fixname_pic = $_POST['card_key'] . '-after-' . $pic;
                $File_tmpname = $_FILES['pic']['tmp_name'];
                if (move_uploaded_file($File_tmpname, (pic . $fixname_pic)));
                resizepic($pic, $fixname_pic);
                $getdata->my_sql_update($connect, 'building_list', "pic_after ='" . $fixname_pic . "'", "ticket='" . htmlspecialchars($_POST['card_key']) . "'");
            }
        } else {
            $editpic = $_POST['pic_log'];
            $getdata->my_sql_update($connect, 'building_list', "pic_after ='" . $editpic . "'", "ticket='" . htmlspecialchars($_POST['card_key']) . "'");
        }

        $name_mt = implode(",", $_POST['name_mt']);

        // if($_POST['work_flag'] == 'success'){
        //     $setFlag = 'work_success';
        // } else {
        //     $setFlag = $_POST['work_flag'];
        // }

        if($_POST['off_case_status'] == '2e34609794290a770cb0349119d78d21'){
            $setFlag = 'user_approve';
        }
        $getdata->my_sql_update(
            $connect,
            "building_list",
            "card_status='" . htmlspecialchars($_POST['off_case_status']) . "',
            se_price = '" . htmlspecialchars($_POST['price']) . "',
            name_mt = '" . htmlspecialchars($name_mt) . "',
      admin_update='" . $name_key . "',
      date_update='" . htmlspecialchars($_POST['date_off_case']) . "',
      work_flag='" . $setFlag . "',
      time_update='" . date("H:i:s") . "'", //เพิ่ม เวลา
            "ticket='" . htmlspecialchars($_POST['card_key']) . "'"
        );

        $getdata->my_sql_insert(
            $connect,
            "building_comment",
            "card_status='" . htmlspecialchars($_POST['off_case_status']) . "',
      admin_update='" . $name_key . "',
      comment='" . htmlspecialchars($_POST['comment']) . ' - ช่างผู้ดำเนินงาน ' . htmlspecialchars($name_mt) . "',
      price = '" . htmlspecialchars($_POST['price']) . "',
      date ='" . date("Y-m-d H:i:s") . "',
      ticket='" . htmlspecialchars($_POST['card_key']) . "'"
        );


        // ส่งข้อมูลเข้าไลน์
        $ticket = $_POST['ticket'];
        $name_admin = $_POST['admin'];
        $status = $_POST['off_case_status'];
        $date_send = date('d/m/Y');
        $time_send = date("H:i");
        $namecall = @getemployee($_POST['namecall']);
        $location =  @prefixbranch($_POST['location']);
        $detail = $_POST['detail'];
        $line_token = $getalert->alert_line_token; // Token
        $line_text = "
         /*** ตอบรับการดำเนินการ ***/
         ------------------------
         Ticket : $ticket
         ------------------------
         ผู้ดำเนินการ : $name_admin
         สถานะ :  " . @cardStatus_for_line($status) . " 
         ผู้แจ้ง : $namecall
         สาขา : $location
         รายละเอียด : $detail
         ------------------------
         ช่างผู้ดำเนินงาน : $name_mt
         ------------------------
         วันที่: {$date_send}
         เวลา: {$time_send}
         ";

        lineNotify($line_text, $line_token); // เรียกใช้ Functions line

        $alert = $success;
    } else {
        $alert = $warning;
    }
}
if (isset($_POST['save_editcase'])) {
    if (htmlspecialchars($_POST['ticket']) != NULL && htmlspecialchars($_POST['se_asset']) != NULL) {

        if (!defined('pic')) {
            if (!defined('pic')) {
                define('pic', '../resource/bu/delevymo/');
            }
            if (is_uploaded_file($_FILES['pic']['tmp_name'])) {
                $remove_charname = array(' ', '`', '"', '\'', '\\', '/', '_');
                $pic = str_replace($remove_charname, '', $_FILES['pic']['name']);
                $fixname_pic = $_POST['card_key'] . '-after-' . $pic;
                $File_tmpname = $_FILES['pic']['tmp_name'];
                if (move_uploaded_file($File_tmpname, (pic . $fixname_pic)));
                resizepic($pic, $fixname_pic);
                $getdata->my_sql_update($connect, 'building_list', "pic_before ='" . $fixname_pic . "'", "ticket='" . htmlspecialchars($_POST['card_key']) . "'");
            }
        } else {
            $editpic = $_POST['pic_log'];
            $getdata->my_sql_update($connect, 'building_list', "pic_before ='" . $editpic . "'", "ticket='" . htmlspecialchars($_POST['card_key']) . "'");
        }


        $getdata->my_sql_update(
            $connect,
            "building_list",
            "as_code = '" . htmlspecialchars($_POST['se_asset']) . "',
            se_id = '" . htmlspecialchars($_POST['se_id']) . "',
            se_li_id = '" . htmlspecialchars($_POST['se_li']) . "',
            se_other = '" . htmlspecialchars($_POST['other']) . "',
            admin_edit='" . $name_key . "'", //เพิ่ม เวลา
            "ticket='" . htmlspecialchars($_POST['card_key']) . "'"
        );


        $alert = $success;
    } else {
        $alert = $warning;
    }
}
