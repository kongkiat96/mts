<?php
if (isset($_POST['password_edit'])) {
    if ($userdata->password != md5(htmlspecialchars($_POST['old_password']))) {
        $alert = $warning;
        //echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
    } else {
        if (md5(htmlspecialchars($_POST['new_password'])) != md5(htmlspecialchars($_POST['re_new_password']))) {
            $alert = $ck_pass;
            //echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
        } else {
            if (htmlspecialchars($_POST['new_password']) != null && htmlspecialchars($_POST['re_new_password']) != null) {
                $getdata->my_sql_update($connect, 'user', "
                password='" . md5(htmlspecialchars($_POST['new_password'])) . "'", "user_key='" . $_SESSION['ukey'] . "'");
                $alert = $success;
                //echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
            } else {
                $alert = $warning;
                //echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
            }
        }
    }
}
if (isset($_POST['email_edit'])) {
    if (htmlspecialchars($_POST['email']) != null) {
        $getdata->my_sql_update($connect, 'user', "
        email = '" . htmlspecialchars($_POST['email']) . "'", "user_key='" . $_SESSION['ukey'] . "'");

        $alert = $success;
        //echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    }
}
