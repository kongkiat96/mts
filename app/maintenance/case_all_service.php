<?php
$card_detail = $getdata->my_sql_query($connect, NULL, "building_list", "ticket='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="row">
  <div class="col-6">
    <h3 class="page-header">
      <i class="fa fa-history fa-fw"></i> ประวัติการบันทึกสถานะ [<?php echo @$card_detail->ticket; ?>]
    </h3>
  </div>
  <?php if ($card_detail->date_update != '0000-00-00') { ?>
    <div class="col-6">
      <h3 class="page-header" style="float: right;">
        วันที่แล้วเสร็จ
        <span class=" badge badge-success"><?php echo @dateConvertor($card_detail->date_update); ?></span>
      </h3>
    </div>
  <?php } ?>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
  <ol class="breadcrumb breadcrumb-inverse">
    <li class="breadcrumb-item">
      <a href="index.php">หน้าแรก</a>
    </li>

    <li class="breadcrumb-item active" aria-current="page">ประวัติการบันทึกสถานะ</li>
  </ol>
</nav>


<div class="card border-info">
  <div class="card-header bg-info text-white text-center font-weight-bold">
    รายละเอียด
  </div>

  <div class="card-body m-3">
    <div class="responsive-data-table-cus">
      <table id="responsive-data-table-cus" class="table dt-responsive nowrap hover text-center" width="100%">
        <thead class="bg-info text-white font-weight-bold">
          <tr>
            <td width="17%">วันที่อัพเดต</td>
            <td width="10%">สถานะ</td>
            <td width="40%">หมายเหตุ</td>
            <td width="11%">ค่าใช้จ่าย</td>

            <td width="15%">ผู้บันทึกรายการ</td>
          </tr>
        </thead>
        <tbody>
          <?php
          // $getcard_status = $getdata->my_sql_select($connect, NULL, "building_comment,card_type", "building_comment.ticket='" . $card_detail->ticket . "' AND building_comment.card_status=card_type.ctype_key OR  ORDER BY building_comment.date DESC");
          $getcard_status = $getdata->my_sql_select($connect, NULL, "building_comment", "ticket='" . $card_detail->ticket . "' ORDER BY ID DESC");

          while ($showcard_status = mysqli_fetch_object($getcard_status)) {
          ?>
            <tr style="font-weight:bold;">
              <td align="center"><?php echo @dateTimeConvertor($showcard_status->date); ?></td>
              <td align="center">
                <?php 
                if (@$showcard_status->card_status == NULL) {
                    echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                } else if ($showcard_status->card_status == 'wait_approve') {
                    echo '<span class="badge badge-info">รออนุมัติแจ้งงาน</span>';
                } else if ($showcard_status->card_status == 'approve') {
                    echo '<span class="badge badge-primary">อนุมัติแจ้งงานซ่อม</span>';
                } else {
                    if ($showcard_status->card_status == 'approve_do') {
                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                    } else if ($showcard_status->card_status == 'reject'){
                      echo '<span class="badge badge-danger">ตรวจสอบงานอีกครั้ง</span>';
                  }else {
                        echo @cardStatus($showcard_status->card_status);
                    }
                }
    
                ?>
                <!-- echo @cardStatus($showcard_status->card_status); 
                ?> -->
              </td>
              <td style="text-align: center;">
                <?php
                if (@$showcard_status->comment != NULL) {
                  # code...
                  echo @$showcard_status->comment;
                } else {
                  echo '<strong><font color="#E81600">ไม่มีข้อมูล</font></strong>';
                }
                ?>
              </td>
              <td>
                <?php
                if ($showcard_status->price != NULL) {
                  echo number_format("$showcard_status->price", 2);
                } else {
                  echo '<strong><font color="#E81600">ไม่มีข้อมูล</font></strong>';
                }
                ?>
              </td>

              <td align="center"><?php echo @getemployee($showcard_status->admin_update); ?></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>


  <div class="card-footer text-center">
    <a href="#" class="btn btn-xs btn-outline-danger" onclick="history.back();"><i class="fa fa-reply"></i> กลับ</a>
  </div>
  <hr class="sidebar-divider d-none d-block">
  <?php

  require("detail.php");

  ?>
</div>