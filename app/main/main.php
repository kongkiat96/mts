<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-home fa-fw"></i> สินทรัพย์ของ IT และรายละเอียดอุปกรณ์</h1>
  </div>
</div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Home</li>
  </ol>
</nav>
<?php
if (isset($_POST['save_card'])) {
  if (htmlspecialchars($_POST['card_customer_name']) != NULL && htmlspecialchars($_POST['asset_code']) != NULL) {
    $card_key = md5(htmlspecialchars($_POST['card_customer_name']) . htmlspecialchars($_POST['card_code']) . time("now"));

    $getdata->my_sql_insert($connect, "card_info", "card_key='" . $card_key . "',
      card_code='" . htmlspecialchars($_POST['card_code']) . "',
      asset_code='" . htmlspecialchars($_POST['asset_code']) . "',
      card_customer_name='" . htmlspecialchars($_POST['card_customer_name']) . "',
      
      
      card_company='" . htmlspecialchars($_POST['company']) . "',
      card_customer_phone='" . htmlspecialchars($_POST['card_customer_phone']) . "',
      card_customer_email='" . htmlspecialchars($_POST['card_customer_email']) . "',
      card_note='" . htmlspecialchars($_POST['card_note']) . "',
      card_equipment='" . htmlspecialchars($_POST['card_device_id']) . "',
      card_brand='" . htmlspecialchars($_POST['card_brand']) . "',
      card_model='" . htmlspecialchars($_POST['card_model']) . "',
      card_serial='" . htmlspecialchars($_POST['card_serial']) . "',
      card_sum='" . htmlspecialchars($_POST['card_sum']) . "',
      card_date_buy='" . htmlspecialchars($_POST['card_date_buy']) . "',
      card_ex='" . htmlspecialchars($_POST['card_ex']) . "',
      ck_license='" . htmlspecialchars($_POST['ck_license']) . "',
      license_name='" . htmlspecialchars($_POST['name_license']) . "',
      license_key='" . htmlspecialchars($_POST['key_license']) . "', 
      card_done_aprox='" . date("Y-m-d") . "',user_key='" . $_SESSION['ukey'] . "',
      card_status='',card_insert='" . date("Y-m-d H:i:s") . "'");

    echo '<script>window.location="?p=card_create_detail&key=' . $card_key . '";</script>';
  } else {
    $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
  }
}
?>


<!-- Modal -->
<div class="modal fade" id="newAssetIt" tabindex="-1" role="dialog" aria-labelledby="newAssetIt" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form method="post" enctype="multipart/form-data" class="was-validated" id="waitsave">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">เพิ่มรายการสินทรัพย์ - ขอใช้สินทรัพย์ IT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-md-3">
              <label for="card_code">Code Asset</label>
              <input type="text" name="card_code" id="card_code" value="<?php echo @RandomString(4, 'C', 7); ?>" class="form-control" readonly>
            </div>
            <div class="col-md-3">
              <label for="asset_code">รหัสสินทรัพย์</label>
              <input type="text" name="asset_code" id="asset_code" class="form-control" autofocus required>
              <div class="invalid-feedback">
                ระบุ รหัสสินทรัพย์.
              </div>
            </div>

            <div class="col-md-6">
              <label for="company">สินทรัพย์ของบริษัท</label>
              <select name="company" id="company" class="form-control select2bs4" style="width: 100%;" required>
                <option value="" selected>--- เลือกข้อมูล ---</option>
                <?php
                $getprefix = $getdata->my_sql_select($connect, NULL, "department");
                while ($showprefix = mysqli_fetch_object($getprefix)) {
                  echo '<option value="' . $showprefix->id . '">' . $showprefix->department_name . '</option>';
                }
                ?>
              </select>
              <div class="invalid-feedback">
                เลือก สินทรัพย์ของบริษัท.
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="card_customer_name">ชื่อและนามสกุลผู้ใช้งาน</label>
              <select name="card_customer_name" id="card_customer_name" class="form-control select2bs4" style="width: 100%;" required>
                <option value="" selected>--- เลือกข้อมูล ---</option>
                <?php
                $getgroup = $getdata->my_sql_select($connect, NULL, "employee", "card_key ORDER BY title_name");
                while ($showgroup = mysqli_fetch_object($getgroup)) {

                  echo '<option value="' . $showgroup->card_key . '">' . @prefixConvertor($showgroup->title_name) . '&nbsp;' . $showgroup->name . '&nbsp;' . $showgroup->lastname . '</option>';
                }
                ?>
              </select>
              <div class="invalid-feedback">
                เลือก ผู้ใช้งาน.
              </div>
            </div>

            <div class="col-md-6">
              <label for="card_date_buy">วันที่ซื้อ / วันที่ขอใช้สินทรัพย์</label>
              <input type="date" name="card_date_buy" id="card_date_buy" class="form-control" required>
              <div class="invalid-feedback">
                ระบุ วันที่.
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="card_device_id">อุปกรณ์</label>
              <select name="card_device_id" id="card_device_id" class="form-control select2bs4" style="width: 100%;" required>
                <option value="">--- เลือกข้อมูล ---</option>
                <?php $getprefix = $getdata->my_sql_select($connect, NULL, "device_type");
                while ($showprefix = mysqli_fetch_object($getprefix)) {
                  echo '<option value="' . $showprefix->id . '">' . $showprefix->device_type . '</option>';
                }
                ?>
              </select>
              <div class="invalid-feedback">
                เลือก อุปกรณ์.
              </div>
            </div>
            <div class="col-md-3">
              <label for="card_ex">ระยะเวลาการรับประกัน</label>
              <input type="text" name="card_ex" id="card_ex" class="form-control" autocomplete="off" placeholder="3 ปี / 3 เดือน" required>
              <div class="invalid-feedback">
                ระบุ ระยะเวลาการรับประกัน.
              </div>
            </div>
            <div class="col-md-3">
              <label for="card_sum">จำนวน</label>
              <input type="number" name="card_sum" id="card_sum" class="form-control" autocomplete="off" placeholder="ชิ้น / ชุด" required="" min="1" max="99">
              <div class="invalid-feedback">
                ระบุ จำนวน.
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
              <label for="card_brand">ยี่ห้อ</label>
              <input type="text" name="card_brand" id="card_brand" class="form-control" autofocus="off" placeholder="Brand name" required>
              <div class="invalid-feedback">
                ระบุ ยี่ห้อ.
              </div>
            </div>
            <div class="col-md-4">
              <label for="card_model">รุ่น</label>
              <input type="text" name="card_model" id="card_model" class="form-control" autofocus="off" placeholder="Model name" required>
              <div class="invalid-feedback">
                ระบุ รุ่น.
              </div>
            </div>
            <div class="col-md-4">
              <label for="card_serial">Service tag / Serial number</label>
              <input type="text" name="card_serial" id="card_serial" class="form-control" autocomplete="off" placeholder="S/T | S/N" required>
              <div class="invalid-feedback">
                ระบุ Service tag / Serial number.
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
              <label for="card_customer_phone">เบอร์โทรติดต่อ</label>
              <input type="text" name="card_customer_phone" id="card_customer_phone" class="form-control" required>
              <div class="invalid-feedback">
                ระบุ เบอร์โทรติดต่อ.
              </div>
            </div>
            <div class="col-md-4"> <label for="card_customer_email">E-mail</label>
              <input type="text" name="card_customer_email" id="card_customer_email" class="form-control" required>
              <div class="invalid-feedback">
                ระบุ E-mail.
              </div>
            </div>
            <div class="col-md-4">
              <label for="card_note">ชื่อเครื่อง / ชื่ออุปกรณ์</label>
              <input type="text" name="card_note" id="card_note" class="form-control" required>
              <div class="invalid-feedback">
                ระบุ ชื่อเครื่อง / อุปกรณ์.
              </div>
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <div class="col-md-7">
              <label for="license">รายละเอียดระบบปฏิบัติการ</label>&nbsp
              <input type="radio" name="ck_license" value="1" required>
              <label for="ck_license">
                <font color="green">License</font>
              </label>&nbsp
              <input type="radio" name="ck_license" value="0" required>
              <label for="ck_license">
                <font color="red">No license</font>
              </label>
              <input type="text" name="name_license" id="os" class="form-control" disabled="disabled" placeholder="Windows / Other" required>
              <div class="invalid-feedback">
                Input Windows, Programs Or Other.
              </div>
            </div>
            <div class="col-md-5">
              <label for="license">License key </label>
              <input type="text" name="key_license" id="key" class="form-control" disabled="disabled" placeholder="xxxxx-xxxxx-xxxxx-xxxxx-xxxxx" required>
              <div class="invalid-feedback">
                Key license.
              </div>
            </div>

          </div>

        </div>
        <div class="modal-footer">

          <div id="showload" style="display: none;"><span class="spinner-border text-primary spinner-sm" role="status" aria-hidden="true"></span></div>
          <div id="hidden">
            <button class="btn btn-outline-primary btn-sm" type="submit" name="save_card"><i class="fa fa-save fa-fw"></i>บันทึก</button>
          </div>




        </div>
      </div>
    </form>
  </div>
</div>
<!-- End Modal -->
<?php
echo @$alert; ?>
<?php if (@$_SESSION['uclass'] == 3 || @$_SESSION['uclass'] == 2) {
  echo '<button type="button" class="btn btn-warning btn-xl" data-toggle="modal" data-target="#newAssetIt"><i class="fa fa-plus fa-fw"></i><b> เพิ่มรายการขอใช้ - ยืมอุปกรณ์ IT </b></button>
<br><br>';
} ?>

<div class="row">

  <!-- All Asset IT -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">จำนวนสินทรัพย์ IT ทั้งหมด</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_status <> 'hidden' AND card_delete ='1'");
                                                                echo @number_format($getall); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-laptop fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Asset Using -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-md font-weight-bold text-uppercase mb-1"><a href="?p=card" class="text-success">กำลังใช้งาน</a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_status = '2e34609794290a770cb0349119d78d21' <> 'hidden' AND card_delete ='1'");
                                                                echo @number_format($getall); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-check-square fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-md font-weight-bold text-info text-uppercase mb-1">สำรอง</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_status = '9ba0f256a5f620136568c6b47dcb24bd' AND card_delete ='1'");
                                                                          echo @number_format($getall); ?></div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-list-ol fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $checkget = $getdata->my_sql_show_rows($connect, "card_info", "card_status = ' ' <> 'hidden' AND card_delete ='1'");
  if ($checkget != 0) {
  ?>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-uppercase mb-1"><a href="?p=card_create" class="text-warning">ข้อมูลไม่สมบูรณ์</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_status = ' ' <> 'hidden' AND card_delete ='1'");
                                                                  echo @number_format($getall); ?></div>
            </div>
            <div class="col-auto">
              <div class="spinner-grow text-warning" role="status">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-center text-primary">รายการเครื่องที่ว่าง</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered text-center" width="100%" id="dataTable" cellspacing="0">
        <thead>
          <tr class="font-weight-bold bg-warning" style="color:#FFF;">
            <td width="8%">ลำดับ</td>
            <td width="15%">รหัสสินทรัพย์</td>
            <td width="15%">วันที่รับคืน</td>
            <td>อุปกรณ์</td>
            <td>ชื่ออุปกรณ์</td>
            <td>สินทรัพย์ของบริษัท</td>
            <?php
            if (@$_SESSION['uclass'] == 3 || @$_SESSION['uclass'] == 2) {
              echo '<td width="10%">จัดการ</td>';
            }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $get_total = $getdata->my_sql_select($connect, NULL, "card_info", "card_status = '9ba0f256a5f620136568c6b47dcb24bd' ORDER BY card_company DESC");
          while ($show_total = mysqli_fetch_object($get_total)) {
            $i++;
          ?>
            <tr id="<?php echo @$show_total->card_key; ?>" style="text-align: center;">
              <td><?php echo @$i; ?></td>
              <td>
                <?php
                if (@$show_total->asset_code != NULL) {
                  # code...
                  echo @$show_total->asset_code;
                } else {
                  echo '<strong><div style="color: #E81600">ยังไม่ระบุ</div></strong>';
                }
                ?>
              </td>
              <td>
                <?php
                if (@$show_total->card_done_aprox == '0000-00-00') {
                  echo '<strong><div style="color: #E81600">ไม่มีข้อมูล</div></strong>';
                } else {
                  echo @dateConvertor($show_total->card_done_aprox);
                }
                ?>
              </td>
              <td><?php echo @prefixConvertorequipment($show_total->card_equipment); ?></td>
              <td><?php echo @$show_total->card_note; ?></td>
              <td>
                <?php
                if (@$show_total->card_company != NULL) {

                  echo @prefixConvertoraddress($show_total->card_company);
                } else {
                  echo '<strong><div style="color: #E81600">ยังไม่ระบุ</div></strong>';
                }
                ?>
              </td>
              <?php
              if (@$_SESSION['uclass'] == 3 || @$_SESSION['uclass'] == 2) {
                echo '<td>
                  <a href="?p=card_all_status&key=' . @$show_total->card_key . '" class="btn btn-xs btn-success" data-toptitle="title" title="นำกลับมาใช้งาน"><i class="fa fa-history"></i></a>
                  </td>';
              }
              ?>

            </tr>
          <?php
          }
          ?>
        </tbody>

      </table>
    </div>
  </div>
</div>