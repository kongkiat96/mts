<?php
session_start();
error_reporting(0);
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$chk_case = $getdata->my_sql_query($connect, NULL, "building_list", "ticket='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-header">
  <h5 class="modal-title">ตรวจสอบข้อมูลและสถานะ</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="card">
    <div class="card-body">
      <ul class="nav nav-pills nav-justified nav-style-fill" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true">รายละเอียด </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="false">รูปภาพก่อนแจ้ง</a>
        </li>
        <?php if ($chk_case->pic_after != NULL) { ?>
          <li class="nav-item">
            <a class="nav-link" id="image-after-tab" data-toggle="tab" href="#image-after" role="tab" aria-controls="image-after" aria-selected="false">รูปภาพหลังแจ้ง</a>
          </li>
        <?php } ?>
      </ul>
      <div class="tab-content" id="myTabContent4">
        <div class="tab-pane pt-3 fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
          <div class="form-group row">
            <div class="col-6">
              <label for="ticket">Ticket Number</label>
              <input type="text" class="form-control" id="ticket" value="<?php echo @$chk_case->ticket; ?>" readonly />
            </div>
            <div class="col-6">
              <label for="status">สถานะ</label>
              <h2 class="form-control"><?php
                                        if (@$chk_case->card_status == NULL) {
                                          echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                      } else if ($chk_case->card_status == 'wait_approve') {
                                          echo '<span class="badge badge-info">รออนุมัติแจ้งงาน</span>';
                                      } else if ($chk_case->card_status == 'approve') {
                                          echo '<span class="badge badge-primary">รออนุมัติงานซ่อม</span>';
                                      } else if ($chk_case->card_status == '2e34609794290a770cb0349119d78d21') {
                                          echo '<span class="badge badge-info">รอตรวจสอบงาน / ปิดงาน</span>';
                                      } else {
                                          if ($chk_case->card_status == 'approve_do') {
                                              echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                          } else if ($chk_case->card_status == 'reject') {
                                              echo '<span class="badge badge-danger">ตรวจสอบงานอีกครั้ง</span>';
                                          } else {
                                              echo @cardStatus($chk_case->card_status);
                                          }
                                      }
                                        ?></h2>

            </div>
          </div>
          <div class="form-group row">
            <div class="col-12">
              <label for="asset_code">รหัสสินทรัพย์</label>
              <input type="text" id="asset_code" class="form-control" disabled value="<?php echo $chk_case->as_code; ?>">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6 col-sm-12">
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

            <div class="col-md-6 col-sm-12">
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
          <?php
          if ($chk_case->se_other != NULL) { ?>
            <div class="form-group row">

              <div class="col-12">
                <label for="other">เพิ่มเติม</label>
                <textarea name="other" id="other" class="form-control" readonly><?php echo $chk_case->se_other; ?></textarea>
              </div>

            </div>
          <?php } ?>
          <div class="form-group row">
            <div class="col-md-6 col-sm-12">
              <label for="namecall">ชื่อผู้แจ้ง</label>
              <?php
              // if(getemployee($chk_case->se_namecall) == null) {
              //   $chkName = getemployee($chk_case->se_namecall);
              // } else {
              //   $chkName = $chk_case->se_namecall;
              // }
              $search = $getdata->my_sql_query($connect, NULL, "employee", "card_key ='" . $chk_case->se_namecall . "'");
              if (COUNT($search) == 0) {
                $chkName = $chk_case->se_namecall;
              } else {
                $chkName = getemployee($chk_case->se_namecall);
              }
              ?>
              <input type="text" name="namecall" id="namecall" class="form-control" readonly value="<?php echo $chkName; ?>">
            </div>
            <?php if (!empty($chk_case->se_location)) { ?>
              <div class="col-md-6 col-sm-12">
                <label for="location">สาขา</label>
                <input type="text" name="location" id="location" class="form-control" readonly value="<?php echo @prefixbranch($chk_case->se_location); ?>">
              </div>
            <?php } ?>
          </div>
          <div class="form-group row">
            <div class="col-12">
              <label for="approve">ผู้อนุมัติ</label>
              <input type="text" class="form-control" name="approve" id="approve" readonly value="<?php echo $chk_case->se_approve; ?>">
            </div>

          </div>
        </div>
        <div class="tab-pane pt-3 fade" id="image" role="tabpanel" aria-labelledby="image-tab">
          <?php
          if ($chk_case->pic_before == null) {
            echo '<img class="img-thumbnail" src="../resource/bu/file_pic_now/no-img.png" width="100%">';
          } else {
            echo '<img class="img-thumbnail" src="../resource/bu/delevymo/' . $chk_case->pic_before . '" width="100%">';
          }
          ?>
        </div>
        <div class="tab-pane pt-3 fade" id="image-after" role="tabpanel" aria-labelledby="image-after-tab">
          <?php
          if ($chk_case->pic_after == null) {
            echo '<img class="img-thumbnail" src="../resource/bu/file_pic_now/no-img.png" width="100%">';
          } else {
            echo '<img class="img-thumbnail" src="../resource/bu/delevymo/' . $chk_case->pic_after . '" width="100%">';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<input hidden name="card_key" id="card_key" value="<?php echo @htmlspecialchars($_GET['key']); ?>">
<div class="modal-footer">


  <button class="ladda-button btn btn-primary btn-square btn-ladda bg-secondary" type="button" data-dismiss="modal" data-style="expand-left">
    <span class="fas fa-times-circle"> ปิด</span>
    <span class="ladda-spinner"></span>
  </button>

</div>