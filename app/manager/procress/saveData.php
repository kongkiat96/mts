<?php
if (isset($_POST['save_setmanager'])) {
    if (!empty($_POST['manager']) && !empty($_POST['under_manager'])) {

        $getdata->my_sql_insert(
            $connect,
            "manager",
            "manager_user_key='" . htmlspecialchars($_POST['manager']) . "',
                user_key = '" . htmlspecialchars($_POST['under_manager']) . "',
                created = '".date('Y-m-d H:i:s')."'"
        );

        $alert = $success;
    } else {
        $alert = $warning;
    }
}
