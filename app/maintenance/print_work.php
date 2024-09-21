<?php session_start();
error_reporting(0);

require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");

$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");
date_default_timezone_set('Asia/Bangkok');
$system_info = $getdata->my_sql_query($connect, null, 'system_info', null);
$chk_case = $getdata->my_sql_query($connect, NULL, "building_list", "ticket='" . htmlspecialchars($_GET['key']) . "'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="../../assets/css/sleek.css" />


    <title><?php echo @$card_detail->ticket; ?></title>
</head>
<style type="text/css">
    body {
        font-size: 16px;
        -webkit-print-color-adjust: exact;
    }

    @media print {
        .footerx {
            page-break-after: always;
        }

    }

    strong {
        color: black;
    }

    .card-footer {
        background-color: #fffcfca6;
    }
</style>

<!--   onLoad="javascript:window.print();" -->

<body onLoad="javascript:window.print();">

    <div class="card broder-success">
        <div class="card-header">
            <h5><b> แบบฟอร์มใบงานฝ่ายอาคาร</b></h5>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <div class="col-6">
                    <label for="ticket">Ticket Number</label>
                    <input type="text" class="form-control" id="ticket" value="<?php echo @$chk_case->ticket; ?>" readonly />
                </div>
                <div class="col-6">
                    <label for="asset_code">รหัสสินทรัพย์</label>
                    <input type="text" id="asset_code" class="form-control" disabled value="<?php echo $chk_case->as_code; ?>">

                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label for="user">ผู้แจ้ง</label>
                    <input type="text" class="form-control" id="user" value="<?php echo @getemployee($chk_case->user_key); ?>" readonly />
                </div>
                <div class="col-6">
                    <label for="date">วันที่แจ้งปัญหา</label>
                    <input type="text" id="date" class="form-control" disabled value="<?php echo @dateConvertor($chk_case->date); ?>">

                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label for="service">หมวดหมู่</label>
                    <select name="show_case_maintenance" id="show_case_maintenance" class="form-control" disabled>
                        <?php
                        $select_service = $getdata->my_sql_select($connect, NULL, "service", "se_id");
                        while ($show_service = mysqli_fetch_object($select_service)) {
                            if ($show_service->se_id == $chk_case->se_id) {
                                echo '<option value="' . $show_service->se_id . '">' . $show_service->se_name . '</option>';
                            }
                        }
                        ?>
                    </select>

                </div>
                <div class="col-6">
                    <label for="service_list">ปัญหาที่พบ</label>
                    <select name="show_case_maintenance" id="show_case_maintenance" class="form-control" disabled>
                        <?php
                        $select_service_list = $getdata->my_sql_select($connect, NULL, "service_list", "se_li_id");
                        while ($show_service_list = mysqli_fetch_object($select_service_list)) {
                            if ($show_service_list->se_li_id == $chk_case->se_li_id) {
                                echo '<option value="' . $show_service_list->se_li_id . '">' . $show_service_list->se_li_name . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                    <label for="namecall">ชื่อผู้แจ้ง</label>
                    <input type="text" name="namecall" id="namecall" class="form-control" readonly value="<?php
                  $search = $getdata->my_sql_query($connect, NULL, "employee", "card_key ='" . $chk_case->se_namecall . "'");
                  if (COUNT($search) == 0) {
                    $chkName = $chk_case->se_namecall;
                  } else {
                    $chkName = getemployee($chk_case->se_namecall);
                  }

                  echo $chkName;
                  ?>">
                </div>
                <div class="col-md-6 col-sm-12">
                    <label for="location">สาขา</label>
                    <input type="text" name="location" id="location" class="form-control" readonly value="<?php echo @prefixbranch($chk_case->se_location); ?>">
                </div>


            </div>

            <?php
            if ($chk_case->se_other != NULL) { ?>
                <div class="form-group row ">

                    <div class="col-12">
                        <label for="other">รายละเอียดเพิ่มเติม</label>
                        <textarea name="other" id="other" class="form-control" rows="5" readonly><?php echo $chk_case->se_other; ?></textarea>
                    </div>

                </div><?php } ?>
            <?php
            if ($chk_case->se_approve != NULL) { ?>
                <div class="form-group row ">

                    <div class="col-12">
                        <label for="approve">ผู้อนุมัติ</label>
                        <input name="approve" id="approve" class="form-control" value="<?php echo $chk_case->se_approve; ?>" readonly></input>
                    </div>

                </div><?php } ?>

            <div class="form-group row ">
                <div class="col-3">
                    <label for="">รูปภาพก่อนแจ้ง</label>
                </div>
                <div class="col-9 text-center">

                    <?php
                    if ($chk_case->pic_before == null) {
                        echo '<img class="img-thumbnail" src="../../resource/bu/file_pic_now/no-img.png" width="70%">';
                    } else {
                        echo '<img class="img-thumbnail" src="../../resource/bu/delevymo/' . $chk_case->pic_before . '" width="70%">';
                    }
                    ?>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-6">
                    <label for="admin">ผู้พิมพ์เอกสาร</label>
                    <input type="text" class="form-control" id="admin" value="<?php echo @getemployee($_SESSION['ukey']); ?>" readonly />
                </div>
                <div class="col-6">
                    <?php $datetime = date("Y-m-d H:i:s"); ?>
                    <label for="date">วันที่พิมพ์เอกสาร</label>
                    <input type="text" id="date" class="form-control" disabled value="<?php echo @dateTimeConvertor($datetime); ?>">

                </div>

            </div>

        </div>
        <div class="card-footer text-center">
            <br>
            <div class="form-group row">
                <div class="col-6">
                    <label>ผู้ปฏิบัติงาน</label>
                </div>
                <div class="col-6">
                    <label>ผู้ขอใช้บริการ</label>
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-6">
                    (.........................................................................)
                </div>
                <div class="col-6">
                    (.........................................................................)
                </div>
            </div>
            <br>
            <hr>

            <br>
            <div class="form-group row text-left ">
                <div class="col-2 text-right">
                    <label>หมายเหตุเพิ่มเติม :</label>
                </div>
                <div class="col-10">
                    ..................................................................................................................................................................
                </div>
            </div>
        </div>
    </div>



</body>
<script src="../../assets/js/sleek.bundle.js"></script>

</html>