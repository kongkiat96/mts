<div class="card card-default">
  <div class="card-header card-header-border-bottom">
    <h2>ข้อมูลเพิ่มเติม</h2>
  </div>
  <div class="card-body">
    <ul class="nav nav-pills nav-justified nav-style-fill" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home3-tab" data-toggle="tab" href="#home3" role="tab" aria-controls="home3" aria-selected="true">รายละเอียด</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pic-before-tab" data-toggle="tab" href="#pic-before" role="tab" aria-controls="pic-before" aria-selected="false">รูปภาพก่อนแจ้ง</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pic-after-tab" data-toggle="tab" href="#pic-after" role="tab" aria-controls="pic-after" aria-selected="false">รูปภาพหลังแจ้ง</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent4">
      <div class="tab-pane pt-3 fade show active" id="home3" role="tabpanel" aria-labelledby="home3-tab">
        <div class="row m-2">
          <h5 class="font-weight-bold">ชื่อผู้คีย์เข้าระบบ : <u><?php echo @getemployee($card_detail->user_key); ?></u></h5>
        </div>
        <div class="row m-2">
          <h5 class="font-weight-bold">หมวดหมู่การแจ้งปัญหา : <u><?php echo @prefixConvertorService($card_detail->se_id); ?></u></h5>
        </div>
        <div class="row m-2">
          <h5 class="font-weight-bold">พบปัญหา : <u><?php echo @prefixConvertorServiceList($card_detail->se_li_id); ?></u></h5>
        </div>
        <div class="row m-2">
          <h5 class="font-weight-bold">เพิ่มเติม : <u><?php if (@$card_detail->se_other != NULL) {
                                                        echo $card_detail->se_other;
                                                      } else {
                                                        echo '-';
                                                      } ?></u></h5>
        </div>
        <div class="row m-2">
        <h5 class="font-weight-bold">ชื่อผู้แจ้ง : <u><?php
                  $search = $getdata->my_sql_query($connect, NULL, "employee", "card_key ='" . $card_detail->se_namecall . "'");
                  if (COUNT($search) == 0) {
                    $chkName = $card_detail->se_namecall;
                  } else {
                    $chkName = getemployee($card_detail->se_namecall);
                  }

                  echo $chkName;
                  ?></u></h5>
        </div>
        <div class="row m-2">
          <h5 class="font-weight-bold">สาขา : <u><?php echo @prefixbranch($card_detail->se_location); ?></u></h5>
        </div>
        <div class="row m-2">
          <h5 class="font-weight-bold">ผู้อนุมัติ : <u><?php echo $card_detail->se_approve; ?></u></h5>
        </div>
      </div>
      <div class="tab-pane pt-3 fade text-center" id="pic-before" role="tabpanel" aria-labelledby="pic-before-tab">
        <?php
        if ($card_detail->pic_before == null) {
          echo '<img class="img-thumbnail" src="../resource/bu/file_pic_now/no-img.png" width="70%">';
        } else {
          echo '<img class="img-thumbnail" src="../resource/bu/delevymo/' . $card_detail->pic_before . '" width="70%">';
        }
        ?>
      </div>
      <div class="tab-pane pt-3 fade text-center" id="pic-after" role="tabpanel" aria-labelledby="pic-after-tab">
        <?php
        if ($card_detail->pic_after == null) {
          echo '<img class="img-thumbnail" src="../resource/bu/file_pic_now/no-img.png" width="70%">';
        } else {
          echo '<img class="img-thumbnail" src="../resource/bu/delevymo/' . $card_detail->pic_after . '" width="70%">';
        }
        ?>
      </div>
    </div>
  </div>
</div>