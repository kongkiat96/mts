<?php
if (htmlspecialchars($_GET['key']) == NULL) {
    echo '<script>window.location="?p=asset_it";</script>';
} else {
    $card_detail = $getdata->my_sql_query($connect, NULL, "card_info", "card_key='" . htmlspecialchars($_GET['key']) . "'");
}

if (isset($_POST['save_item'])) {
    if (htmlspecialchars($_POST['device_name']) != NULL && htmlspecialchars($_POST['device_detail']) != NULL) {
        $item_key = md5(htmlspecialchars($_POST['device_name']) . time("now") . rand());
        if (htmlspecialchars($_POST['device_num']) != NULL) {
            $price_aprox = htmlspecialchars($_POST['device_num']);
        } else {
            $price_aprox = 0;
        }

        $getdata->my_sql_insert(
            $connect,
            "card_item",
            "item_key='" . $item_key . "',
    card_key='" . $card_detail->card_key . "',
    item_name='" . htmlspecialchars($_POST['device_name']) . "',
    item_note='" . htmlspecialchars($_POST['device_detail']) . "',
    item_price_aprox='" . $price_aprox . "'"
        );

        $alert = $success;
        // echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    } else {
        $alert = $warning;
        // echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    }
}
if (isset($_POST['save_edit_item'])) {
    if (
        htmlspecialchars($_POST['edit_device_name']) != NULL &&
        htmlspecialchars($_POST['edit_device_detail']) != NULL
    ) {
        $getdata->my_sql_update(
            $connect,
            "card_item",
            "item_name='" . htmlspecialchars($_POST['edit_device_name']) . "',
      item_note='" . htmlspecialchars($_POST['edit_device_detail']) . "',
      item_price_aprox='" . htmlspecialchars($_POST['edit_device_num']) . "'",
            "item_key='" . htmlspecialchars($_POST['item_key']) . "'"
        );

        $alert = $success;
        // echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    } else {
        $alert = $warning;
        // echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    }
}
if (isset($_POST['save_edit_detail'])) {
    if (
        htmlspecialchars($_POST['asset_code']) != NULL &&
        htmlspecialchars($_POST['company']) != NULL &&
        htmlspecialchars($_POST['edit_card_cus_name'] != NULL)
    ) {
        $getdata->my_sql_update(
            $connect,
            "card_info",
            "card_customer_name='" . htmlspecialchars($_POST['edit_card_cus_name']) . "',
     card_company='" . htmlspecialchars($_POST['company']) . "',
     card_possess = '" . htmlspecialchars($_POST['edit_card_possess']) . "',
     card_customer_email='" . htmlspecialchars($_POST['edit_card_email']) . "',
     card_ex='" . htmlspecialchars($_POST['edit_card_ex']) . "',
     card_sum='" . htmlspecialchars($_POST['edit_card_sum']) . "',
     card_insert='" . htmlspecialchars($_POST['edit_card_insert']) . "',
     card_date_buy='" . htmlspecialchars($_POST['card_date_buy']) . "',
     asset_code='" . htmlspecialchars($_POST['asset_code']) . "',
     card_customer_phone = '" . htmlspecialchars($_POST['edit_card_customer_phone']) . "',
     card_price = '" . htmlspecialchars($_POST['edit_card_price']) . "',
     user_update='" . htmlspecialchars($_POST['user_update']) . "',
     card_note='" . htmlspecialchars($_POST['edit_card_note']) . "'",
            "card_key='" . htmlspecialchars($_POST['card_key']) . "'"
        );

        $alert = $success;
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    } else {
        $alert = $warning;
        // echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    }
}

if (isset($_POST['save_pic'])) {
    if (!defined('pic')) {
        $pic_key = md5(htmlspecialchars($_POST['pic']) . time("now") . rand());

        if (!defined('pic')) {
            define('pic', '../resource/asset/delevymo/');
        }
        if (is_uploaded_file($_FILES['pic']['tmp_name'])) {
            $remove_charname = array(' ', '`', '"', '\'', '\\', '/', '_');
            $pic = str_replace($remove_charname, '', $_FILES['pic']['name']);
            $fixname_pic = htmlspecialchars($_POST['card_code']) . '-more-' . $pic;
            $File_tmpname = $_FILES['pic']['tmp_name'];

            if (move_uploaded_file($File_tmpname, (pic . $fixname_pic)));
        }

        resizepicasset($pic, $fixname_pic);


        $getdata->my_sql_insert(
            $connect,
            "card_pic",
            "pic_key='" . $pic_key . "',
      card_key='" . $card_detail->card_key . "',
      pic_name='" . $fixname_pic . "'"
        );

        $alert = $success;
        // echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    } else {
        $alert = $warning;
        // echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    }
}

if (isset($_POST['save_edit_detail_pic'])) {
    if (
        htmlspecialchars($_POST['asset_code']) != NULL
    ) {
        if (!defined('asset_pic_edit')) {
            if (!defined('asset_pic_edit')) {
                define('asset_pic_edit', '../resource/asset/delevymo/');
            }
            if (is_uploaded_file($_FILES['asset_pic_edit']['tmp_name'])) {
                $remove_charname = array(' ', '`', '"', '\'', '\\', '/', '_');
                $asset_pic = str_replace($remove_charname, '', $_FILES['asset_pic_edit']['name']);
                $fixname_pic = $_POST['card_code'] . '-edit-' . $asset_pic;
                $File_tmpname = $_FILES['asset_pic_edit']['tmp_name'];
                if (move_uploaded_file($File_tmpname, (asset_pic_edit . $fixname_pic)));
                resizepicasset($asset_pic, $fixname_pic);
                $getdata->my_sql_update($connect, 'card_info', "card_pic='" . $fixname_pic . "'", "card_key='" . htmlspecialchars($_POST['card_key']) . "'");
            }
        } else {
            $editpic = $_POST['asset_pic_edit_log'];
            $getdata->my_sql_update($connect, 'card_info', "card_pic='" . $editpic . "'", "card_key='" . htmlspecialchars($_POST['card_key']) . "'");
        }

        $alert = $success;
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    } else {
        $alert = $warning;
        // echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    }
}


if (isset($_POST['save_confirm_card'])) {
    if (htmlspecialchars($_POST['card_done_aprox']) != NULL) {
        $card_done_aprox = htmlspecialchars($_POST['card_done_aprox']);
    } else {
        $card_done_aprox = '0000-00-00';
    }
    $getdata->my_sql_update($connect, "card_info", "card_done_aprox='" . @$card_done_aprox . "',card_status='" . htmlspecialchars($_REQUEST['card_status']) . "',user_update='" . $_SESSION['ukey'] . "'", "card_key='" . $card_detail->card_key . "'");
    $cstatus_key = md5(htmlspecialchars($_REQUEST['card_status']) . rand() . time("now"));

    $getdata->my_sql_insert(
        $connect,
        "card_status",
        "cstatus_key='" . $cstatus_key . "',
card_key='" . $card_detail->card_key . "',
card_status='" . htmlspecialchars($_REQUEST['card_status']) . "',
card_status_note='" . htmlspecialchars($_POST['card_status_note']) . "',
user_key='" . $_SESSION['ukey'] . "'"
    );

    echo '<script type="text/javascript">
  Swal.fire({
      icon: "success",
      title: "บันทึกเรียบร้อย...",
      timer: 1000,  
      showConfirmButton: false
  })
      setTimeout(function () {
          window.location="?p=asset_it";
       }, 1500);
  </script>';
}
