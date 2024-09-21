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
$card_detail = $getdata->my_sql_query($connect, NULL, "card_info", "card_key='" . htmlspecialchars($_GET['key']) . "'");
//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = '../../plugins/phpqrcode/temp/';
$PNG_WEB_DIR = '../../plugins/phpqrcode/temp/';
require("../../plugins/phpqrcode/qrlib.php");
//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
  mkdir($PNG_TEMP_DIR);

$filename = '../../plugins/phpqrcode/temp/card' . md5(@urlcard() . $card_detail->card_code . '|' . 'H' . '|' . '2') . '.png';
QRcode::png(@urlcard() . $card_detail->card_code, $filename, 'H', 2, 2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="../../assets/css/sleek.css" />


  <title><?php echo @$card_detail->card_code; ?></title>
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
      <h5><b> แบบฟอร์มยืมสินทรัพย์ของแผนก IT</b></h5>
    </div>
    <div class="card-body">
      <table width="100%" class="table">
        <tr>
          <td><strong>รหัสสินทรัพย์ :</strong></td>
          <td>
            <?php
            if (@$card_detail->asset_code != NULL) {
              # code...
              echo @$card_detail->asset_code;
            } else {
              echo '<strong><font color="#E81600">ยังไม่ระบุ</font></strong>';
            }
            ?>
          </td>
          <td colspan="2" rowspan="3" style="text-align:center;">
            <font style="text-decoration-line: underline;">QR Code สแกนเพื่อตรวจสอบ</font><br />
            <?php echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" /><br/>';
            echo $card_detail->card_code; ?><br>
            <!-- <img src="../../plugins/barcode/barcode.php?text=<?php echo @$card_detail->card_code; ?>&orientation=orientation" alt="<?php echo @$card_detail->card_code; ?>" width="20" height="120" /> -->
            <!-- <font style="text-decoration-line: underline;">หรือ ลิงค์สำหรับตรวจสอบ</font><br />
            <?php echo @urlqr() . $card_detail->card_code;  ?> -->

          </td>

        </tr>
        <tr>
          <td width="23%"><strong>วันที่เริ่มใช้งาน :</strong></td>
          <td width="27%"><?php echo @dateConvertor($card_detail->card_insert); ?></td>
        </tr>
        <tr>
          <td><strong>ผู้ใช้งาน :</strong></td>
          <td>
            <?php echo @getemployee($card_detail->card_customer_name); ?>
          </td>
        </tr>
        <tr>
          <td><strong>บริษัท / สังกัด :</strong></td>
          <td><?php echo @getemployee_company($card_detail->card_customer_name); ?></td>
          <td><strong>สินทรัพย์ของ :</strong></td>
          <td><?php echo @prefixConvertorCompany($card_detail->card_company); ?></td>
        </tr>
        <tr>
          <td><strong>ตำแหน่ง :</strong></td>
          <td><?php echo @getemployee_position($card_detail->card_customer_name); ?></td>
          <td><strong>อุปกรณ์ :</strong></td>
          <td><?php echo @prefixConvertorequipment($card_detail->card_equipment); ?></td>
        </tr>
        <tr>
          <td><strong>แผนก :</strong></td>
          <td><?php echo @getemployee_department($card_detail->card_customer_name); ?></td>

          <td><strong>จำนวน :</strong></td>
          <td><?php echo @$card_detail->card_sum; ?> ชิ้น / ชุด</td>
        </tr>
        <tr>
          <td width="23%"><strong>อีเมล :</strong></td>
          <td width="27%">
            <?php echo @($card_detail->card_customer_email != '') ? $card_detail->card_customer_email : '<strong><div style="color: #F00D0D">ไม่ระบุ</div></strong>'; ?>
          </td>

          <td><strong>เบอร์โทรติดต่อ Supplier :</strong></td>
          <td>
            <?php echo @($card_detail->card_customer_phone != '') ? $card_detail->card_customer_phone : '<strong><div style="color: #F00D0D">ไม่ระบุ</div></strong>'; ?>
          </td>


        </tr>
        <tr>
          <td><strong>ระบบปฏิบัติการ :</strong></td>
          <td>
            <?php
            if (@$card_detail->license_name == NULL && @$card_detail->ck_license == 0) {
              # code...
              echo '<strong><font color="red">ไม่มีข้อมูล</font></strong>';
            } else {

              echo '<strong><font color="blue">' . @$card_detail->license_name . '</font></strong>';
            }
            ?>
          </td>

          <td><strong>ลิขสิทธิ์ :</strong></td>
          <td>
            <?php
            if (@$card_detail->ck_license == 1) {
              # code...
              echo '<strong><font color="green">License</font></strong>';
            } else {
              echo '<strong><font color="red">No License</font></strong>';
            }
            ?>
          </td>
        </tr>
        <tr>
          <td><strong>โปรแกรม :</strong></td>
          <td>
            <?php
            if (@$card_detail->p_license_name == NULL && @$card_detail->p_ck_license == 0) {
              # code...
              echo '<strong><font color="red">ไม่มีข้อมูล</font></strong>';
            } else {

              echo '<strong><font color="blue">' . @$card_detail->p_license_name . '</font></strong>';
            }
            ?>
          </td>

          <td><strong>ลิขสิทธิ์ :</strong></td>
          <td>
            <?php
            if (@$card_detail->p_ck_license == 1) {
              # code...
              echo '<strong><font color="green">License</font></strong>';
            } else {
              echo '<strong><font color="red">No License</font></strong>';
            }
            ?>
          </td>
        </tr>
        <tr>
          <td><strong>วันที่ซื้อ :</strong></td>
          <td><?php echo @($card_detail->card_date_buy != '0000-00-00') ? dateConvertor($card_detail->card_date_buy) : '<strong><div style="color: #F00D0D">ไม่ระบุ</div></strong>'; ?></td>

          <td><strong>ระยะเวลาการรับประกัน :</strong></td>
          <td><?php echo @($card_detail->card_ex != '' || $card_detail->card_ex = "-") ? $card_detail->card_ex : '<strong><div style="color: #F00D0D">ไม่ระบุ</div></strong>'; ?></td>

        </tr>
        <tr>
          <td><strong>ชื่ออุปกรณ์ :</strong></td>
          <td><?php echo @$card_detail->card_note; ?></td>
          <td><strong>เจ้าหน้าที่บันทึกในระบบ :</strong></td>
          <td><?php echo @getemployee($card_detail->user_key); ?></td>
        </tr>
      </table>

      <hr>
      <div class="row mb-2">
        <div class="col-12 text-center">
          <strong>รายการภายในอุปกรณ์</strong>
        </div>

      </div>
      <table width="100%" class="table table-bordered text-center">
        <thead class="font-weight-bold" style="color: black;">
          <tr>
            <td width="11%">ลำดับ</td>
            <td width="26%">อุปกรณ์</td>
            <td width="43%">รายละเอียดอุปกรณ์</td>
            <td width="20%">จำนวน</td>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $getitem = $getdata->my_sql_select($connect, NULL, "card_item", "card_key='" . $card_detail->card_key . "' ORDER BY item_insert");
          while ($showitem = mysqli_fetch_object($getitem)) {
            $i++
          ?>
            <tr id="<?php echo @$showitem->item_key; ?>">
              <td><?php echo $i; ?></td>
              <td><?php echo @$showitem->item_name; ?></td>
              <td>
                <?php echo @$showitem->item_note; ?>
              </td>
              <td>
                <?php
                if ($showitem->item_price_aprox == 0) {
                  echo '1';
                } else {
                  echo $showitem->item_price_aprox;
                }
                ?>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer text-center">
      <br>
      <div class="form-group row">
        <div class="col-6">
          <label>ผู้ขอใช้สินทรัพย์ IT</label>
        </div>
        <div class="col-6">
          <label>ผู้อนุมัติ</label>
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
      <br><br>
      <div class="form-group row">
        <div class="col-6">
          <label>ผู้คืนสินทรัพย์ IT</label>
        </div>
        <div class="col-6">
          <label>ผู้ตรวจสอบ</label>
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