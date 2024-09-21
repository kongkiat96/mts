<?php

$getch = $getdata->my_sql_show_rows($connect, "user", "user_key = '" . $_POST['card_key'] . "'"); //แสดงจำนวนที่ส่งค่ามาว่ามีกี่จำนวน
$chusername = $getdata->my_sql_show_rows($connect, "user", "username = '" . $_POST['code_em'] . "'");

$getcontrol = $getdata->my_sql_show_rows($connect, "employee", "card_key <> 'hidden'"); // นับข้อมูลใน database


if (isset($_POST['save_employee'])) {
    if ($getcontrol < 999) {
        if (htmlspecialchars($_POST['code_em']) != NULL) {
            if ($chusername == 0) {
                $mbkey = md5(rand() . time("now"));
                $getdata->my_sql_insert(
                    $connect,
                    "employee",
                    "card_key='" . $mbkey . "',
                    title_name='" . htmlspecialchars($_POST['prefixname']) . "',
                    name = '" . htmlspecialchars($_POST['name']) . "',
                    lastname = '" . htmlspecialchars($_POST['lastname']) . "',
                    user_position='" . htmlspecialchars($_POST['position']) . "',
                    user_department='" . htmlspecialchars($_POST['department']) . "',
                    department_id='" . htmlspecialchars($_POST['company']) . "'"
                );


                $getdata->my_sql_insert(
                    $connect,
                    "user",
                    "user_key='" . $mbkey . "',
    name='" . htmlspecialchars($_POST['name']) . "',
    lastname = '" . htmlspecialchars($_POST['lastname']) . "',
    username='" . htmlspecialchars($_POST['code_em']) . "',
    password = '" . md5(htmlspecialchars($_POST['pass_em'])) . "',
    email = '" . htmlspecialchars($_POST['email']) . "'"
                );
                $alert = $success;
            } else {
                $alert = $ch_user;
            }
        } else {
            $alert = $warning;
        }
    } else {
        $alert = $warning;
    }
}



if (isset($_POST['save_edit_employee'])) {
    if (htmlspecialchars($_POST['ed_code']) != NULL) {
        $getdata->my_sql_update(
            $connect,
            "employee",
            "title_name='" . htmlspecialchars($_POST['ed_prefix']) . "',
            name = '" . htmlspecialchars($_POST['ed_name']) . "',
            lastname = '" . htmlspecialchars($_POST['ed_lastname']) . "',
            user_position = '" . htmlspecialchars($_POST['ed_position']) . "',
            user_department = '" . htmlspecialchars($_POST['ed_department']) . "',
            department_id ='" . htmlspecialchars($_POST['ed_company']) . "'",
            "card_key='" . htmlspecialchars($_POST['card_key']) . "'"
        );

        if ($getch == 0) { //ทำการตรวจสอบหากไม่มีข้อมูลให้ทำการเพิ่มเข้าไป
            $getdata->my_sql_insert(
                $connect,
                "user",
                "user_key='" . htmlspecialchars($_POST['card_key']) . "',
                name='" . htmlspecialchars($_POST['ed_name']) . "',
                lastname = '" . htmlspecialchars($_POST['ed_lastname']) . "',
                username='" . htmlspecialchars($_POST['ed_code']) . "',
                email = '" . htmlspecialchars($_POST['ed_email']) . "'"
            );
        }
        // มีข้อมูลแล้้วให้ทำการแก้ไข
        $getdata->my_sql_update(
            $connect,
            "user",
            "name='" . htmlspecialchars($_POST['ed_name']) . "',
                lastname = '" . htmlspecialchars($_POST['ed_lastname']) . "',
                username='" . htmlspecialchars($_POST['ed_code']) . "',
                email = '" . htmlspecialchars($_POST['ed_email']) . "'",
            "user_key='" . htmlspecialchars($_POST['card_key']) . "'"
        );

        $alert = $success;
    } else {
        $alert = $warning;
    }
}
