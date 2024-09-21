<?php
$name_key = $userdata->user_key; // show key md5 name
$fullname = @prefixConvertorUsername($name_key);

$getemployee  = $getdata->my_sql_query($connect, NULL, "employee", "card_key = '" . $_SESSION['ukey'] . "'");
$getalert = $getdata->my_sql_query($connect, NULL, "system_alert", NULL);
$getticket_bu = $getdata->my_sql_show_rows($connect, "building_list", "ID AND date LIKE '%" . date("Y-m") . "%'"); // นับข้อมูลใน database โดยเลือก ปี เดือน วัน ปัจจุบัน
if ($getticket_bu < 999) {
    $runticket_bu = 'PM' . date("Y-m") . '-W' . sprintf('%02s', $getticket_bu + 1); // ถ้าวันปัจจุบันมีการนับน้อยกว่า 999 ให้ปัจจุบัน +1 
}
if (isset($_POST['save_casebu'])) {
    if (htmlspecialchars($_POST['service_list']) != NULL) {
        if (!defined('pic')) {
            define('pic', '../resource/bu/delevymo/');
        }
        if (is_uploaded_file($_FILES['pic']['tmp_name'])) {
            $remove_charname = array(' ', '`', '"', '\'', '\\', '/', '_');
            $pic = str_replace($remove_charname, '', $_FILES['pic']['name']);
            $fixname_pic = $runticket_bu . '-' . $pic;
            $File_tmpname = $_FILES['pic']['tmp_name'];

            if (move_uploaded_file($File_tmpname, (pic . $fixname_pic)));
        }

        resizepic($pic, $fixname_pic);

        // $chkManager =  $getdata->my_sql_query($connect, NULL, "manager", "user_key = '" . $_SESSION['ukey'] . "'");

        $getApproveDep = in_array($_POST['se_id'], ['13', '16']) ? 'HR' : 'IT';
            if (empty($_POST['approve'] || $_POST['approve'] == '-')) {
                $chkManager =  $getdata->my_sql_query($connect, NULL, "manager", "user_key = '" . $_SESSION['ukey'] . "' LIMIT 1");
            } else if (!empty($_POST['approve'] || $_POST['approve'] != '-')) {
                $chkManager =  $getdata->my_sql_query($connect, NULL, "manager", "user_key = '" . $_POST['namecall'] . "' LIMIT 1");
            } else {
                $chkManager =  $getdata->my_sql_query($connect, NULL, "manager", "user_key = '" . $_SESSION['ukey'] . "' LIMIT 1");
            }

        if (COUNT($chkManager) == 0) {
            $getdata->my_sql_insert($connect, "building_list", "
        ticket='" . $runticket_bu . "',
        user_key ='" . $_SESSION['ukey'] . "',
        department ='" . htmlspecialchars($_POST['department']) . "',
        company = '" . htmlspecialchars($_POST['company']) . "',
        se_id ='" . htmlspecialchars($_POST['se_id']) . "',
        se_li_id ='" . htmlspecialchars($_POST['service_list']) . "',
        as_code = '" . htmlspecialchars($_POST['as_code']) . "',
        pic_before = '" . $fixname_pic . "',
        se_other = '" . htmlspecialchars($_POST['other']) . "',
        se_namecall = '" . $_SESSION['ukey'] . "',
        se_approve = '" . htmlspecialchars($_POST['approve']) . "',
        se_location = '" . htmlspecialchars($_POST['location']) . "',
        date = '" . date("Y-m-d") . "',
        time_start = '" . date("H:i:s") . "'");
        } else {
            $getdata->my_sql_insert($connect, "building_list", "
            ticket='" . $runticket_bu . "',
            user_key ='" . $_SESSION['ukey'] . "',
            department ='" . htmlspecialchars($_POST['department']) . "',
            company = '" . htmlspecialchars($_POST['company']) . "',
            se_id ='" . htmlspecialchars($_POST['se_id']) . "',
            se_li_id ='" . htmlspecialchars($_POST['service_list']) . "',
            as_code = '" . htmlspecialchars($_POST['as_code']) . "',
            pic_before = '" . $fixname_pic . "',
            se_other = '" . htmlspecialchars($_POST['other']) . "',
            se_namecall = '" . $chkManager->user_key . "',
            se_approve = '" . getemployee($chkManager->manager_user_key) . "',
            se_location = '" . htmlspecialchars($_POST['location']) . "',
            card_status = 'wait_approve',
            manager_approve = '" . $chkManager->manager_user_key . "',
            manager_approve_status = 'N',
            date = '" . date("Y-m-d") . "',
            time_start = '" . date("H:i:s") . "'");
        }

        // ส่งข้อมูลเข้าไลน์

        $remove_charname = array('&', '!', '"', '%');
        $rc_other = str_replace($remove_charname, '-', htmlspecialchars($_POST['other']));
        $rc_department = str_replace($remove_charname, '-', htmlspecialchars($_POST['gt_department']));


        $name_user = $_POST['name_em'];
        $department = $rc_department;
        $company = $_POST['company'];
        $type = $_POST['se_id'];
        $list = $_POST['service_list'];
        $other = $rc_other;
        // $namecall = @getemployee($_POST['namecall']);
        $namecall = $name_user;
        // $approve = $_POST['approve'];
        $setNameMg = COUNT($chkManager) == 0 ? '-' : getemployee($chkManager->manager_user_key);
        $location = @prefixbranch($_POST['location']);
        $date_send = date('d/m/Y');

        $line_token = $getalert->alert_line_token; // Token
        $line_text = "
     ------------------------
     Ticket : {$runticket_bu}
     ------------------------
     {$name_user}
     แผนก : {$department}
     ผู้แจ้ง : {$namecall}
     สาขา : {$location}
     ผู้อนุมัติ : {$setNameMg}
     ------------------------
     ประเภท : " . @prefixConvertorService($type) . "
     รายการ : " . @prefixConvertorServiceList($list) . "
     รายละเอียด : {$other}

     วันที่ : {$date_send}
     Link : " . @urllink() . "
     ";



        lineNotify($line_text, $line_token); // เรียกใช้ Functions line

        $alert = $success;
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    } else {
        $alert = $warning;
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    }
}

if (isset($_POST['save_offcase_building'])) {
    if (htmlspecialchars($_POST['off_case_status']) != NULL) {
        $getdata->my_sql_update(
            $connect,
            "building_list",
            "card_status='" . htmlspecialchars($_POST['off_case_status']) . "',
      admin_update='" . $name_key . "',
      date_update='" . htmlspecialchars($_POST['date_off_case']) . "',
      time_update = '" . date("H:i:s") . "'", //เพิ่ม เวลา
            "ticket='" . htmlspecialchars($_POST['card_key']) . "'"
        );

        // ส่งข้อมูลเข้าไลน์
        $ticket = $_POST['ticket'];
        $name_user = $_POST['name_user'];
        $other = $_POST['comment'];
        $date_send = date('d/m/Y');

        $line_token = $getalert->alert_line_token; // Token
        $line_text = "
             /*** Please Check Again ***/
             ------------------------
             Ticket: {$ticket}
             ------------------------
             คุณ {$name_user}
             ------------------------
             รายละเอียด: {$other}

             วันที่: {$date_send}
             ";

        lineNotify($line_text, $line_token); // เรียกใช้ Functions line

        $alert = $success;
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    } else {
        $alert = $warning;
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
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
            "se_asset = '" . htmlspecialchars($_POST['se_asset']) . "',
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

if (isset($_POST['save_approve'])) {
    if (!empty($_POST['approve_status'])) {
        $getFlag = $_POST['approve_status'] == "Y" ? 'approve' : $_POST['approve_status'];
        $getdata->my_sql_update(
            $connect,
            "building_list",
            "card_status='" . $getFlag . "',
            manager_approve_status = 'Y',
      date_update='" . date("Y-m-d") . "',
      time_update='" . date("H:i:s") . "'", //เพิ่ม เวลา
            "ticket='" . htmlspecialchars($_POST['card_key']) . "'"
        );

        $getdata->my_sql_insert(
            $connect,
            "building_comment",
            "card_status='" . $getFlag . "',
      admin_update='" . $name_key . "',
      comment='" . htmlspecialchars($_POST['comment']) . "',
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
        $location = @prefixbranch($_POST['location']);
        $detail = $_POST['detail'];
        $line_token = $getalert->alert_line_token; // Token
        $line_text = "
         /*** อนุมัติจากผู้บังคับบัญชา ***/
         ------------------------
         Ticket : $ticket
         ------------------------
         ผู้ดำเนินการ : $name_admin
         สถานะ :  อนุมัติจากผู้บังคับบัญชา
         ผู้แจ้ง : $namecall
         สาขา : $location
         รายละเอียด : $detail
         ------------------------
         วันที่: {$date_send}
         เวลา: {$time_send}
         ";

        lineNotify($line_text, $line_token); // เรียกใช้ Functions line

        $alert = $success;
    }
}

if (isset($_POST['save_approve_do'])) {
    if (!empty($_POST['approve_status'])) {
        $getFlag = $_POST['approve_status'] == "Y" ? 'approve_do' : $_POST['approve_status'];
        $getdata->my_sql_update(
            $connect,
            "building_list",
            "card_status='" . $getFlag . "',
            manager_approve_status = 'Y',
      date_update='" . date("Y-m-d") . "',
      time_update='" . date("H:i:s") . "'", //เพิ่ม เวลา
            "ticket='" . htmlspecialchars($_POST['card_key']) . "'"
        );

        $getdata->my_sql_insert(
            $connect,
            "building_comment",
            "card_status='" . htmlspecialchars($_POST['off_case_status']) . "',
      admin_update='" . $name_key . "',
      comment='" . htmlspecialchars($_POST['comment']) . "',
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
        $location = @prefixbranch($_POST['location']);
        $detail = $_POST['detail'];
        $line_token = $getalert->alert_line_token; // Token
        $line_text = "
         /*** อนุมัติจาก MT Manager ***/
         ------------------------
         Ticket : $ticket
         ------------------------
         ผู้ดำเนินการ : $name_admin
         สถานะ :  อนุมัติการแจ้งซ่อม
         ผู้แจ้ง : $namecall
         สาขา : $location
         รายละเอียด : $detail
         ------------------------
         วันที่: {$date_send}
         เวลา: {$time_send}
         ";

        lineNotify($line_text, $line_token); // เรียกใช้ Functions line

        $alert = $success;
    }
}

if (isset($_POST['save_approve_success'])) {
    if (!empty($_POST['approve_status'])) {
        // $getFlag = $_POST['approve_status'] == "Y" ? '33831963cbe86c4e544c5a999984aa7b' : $_POST['approve_status'];

        if ($_POST['approve_status'] == "Y") {
            $getFlag = '33831963cbe86c4e544c5a999984aa7b';
            $work_flag = 'success';
            $mapText = " - ตรวจสอบงานเสร็จสิ้น";
        } else {
            $getFlag = 'reject';
            $work_flag = null;
            $mapText = " - ตรวจสอบงานไม่เรียบร้อย";
        }

        $getdata->my_sql_update(
            $connect,
            "building_list",
            "card_status='" . $getFlag . "',
            work_flag = '" . $work_flag . "',
      date_update='" . date("Y-m-d") . "',
      time_update='" . date("H:i:s") . "'", //เพิ่ม เวลา
            "ticket='" . htmlspecialchars($_POST['card_key']) . "'"
        );

        $getdata->my_sql_insert(
            $connect,
            "building_comment",
            "card_status='" . $getFlag . "',
      admin_update='" . $name_key . "',
      comment='" . $_POST['comment'] . $mapText . "',
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
        $location = @prefixbranch($_POST['location']);
        $detail = $_POST['detail'];
        $line_token = $getalert->alert_line_token; // Token
        $line_text = "
         /*** อนุมัติปิดงานจาก MT Manager ***/
         ------------------------
         Ticket : $ticket
         ------------------------
         ผู้ดำเนินการ : $name_admin
         สถานะ :  ดำเนินงานเรียบร้อย
         ผู้แจ้ง : $namecall
         สาขา : $location
         รายละเอียด : $detail
         ------------------------
         วันที่: {$date_send}
         เวลา: {$time_send}
         ";

        lineNotify($line_text, $line_token); // เรียกใช้ Functions line

        $alert = $success;
    }
}

if (isset($_POST['save_reopen_case'])) {
    if (!empty($_POST['reopen_case'])) {
        if ($_POST['reopen_case'] == 'Y') {
            $getFlag = "wait_approve";
            $status = 'แจ้งดำเนินงานจากผู้ใช้งานอีกครั้ง';
            $detail = $_POST['comment'] . ' - ' . $status;
            $work_flag = 'work_success';
        }
        $getdata->my_sql_update(
            $connect,
            "building_list",
            "card_status='" . $getFlag . "',
            work_flag = '" . $work_flag . "'",

            "ticket='" . htmlspecialchars($_POST['card_key']) . "'"
        );

        $getdata->my_sql_insert(
            $connect,
            "building_comment",
            "card_status='" . $getFlag . "',
      admin_update='" . $name_key . "',
      comment='" . $detail . "',
      date ='" . date("Y-m-d H:i:s") . "',
      ticket='" . htmlspecialchars($_POST['card_key']) . "'"
        );


        // ส่งข้อมูลเข้าไลน์
        $ticket = $_POST['ticket'];
        $name_admin = $_POST['admin'];

        // $status = $_POST['off_case_status'];
        $date_send = date('d/m/Y');
        $time_send = date("H:i");
        $namecall = $_POST['namecall'];
        $location = $_POST['location'];
        $detail = $_POST['detail'];
        $line_token = $getalert->alert_line_token; // Token
        $line_text = "
         /*** " . $status . " ***/
         ------------------------
         Ticket : $ticket
         ------------------------
         สถานะ :  $status 
         ผู้แจ้ง : " . $namecall . "
         สาขา : $location
         รายละเอียด : $detail
         ------------------------
         วันที่: {$date_send}
         เวลา: {$time_send}
         ";

        lineNotify($line_text, $line_token); // เรียกใช้ Functions line

        $alert = $success;
    }
}
