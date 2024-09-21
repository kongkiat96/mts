<div class="row">
  <div class="col-12">
    <h1 class="page-header"><i class="fa fa-bezier-curve"></i> [ผู้ดูแลระบบ] ตรวจสอบข้อมูลการใช้าน</h1>
  </div>
</div>
<nav aria-label="breadcrumb" class="mt-3 mb-3">
  <ol class="breadcrumb breadcrumb-inverse">
    <li class="breadcrumb-item">
      <a href="index.php">หน้าแรก</a>
    </li>
    <li class="breadcrumb-item" aria-current="page"><a href="index.php?p=setting">ตั้งค่า</a></li>
    <li class="breadcrumb-item active" aria-current="page">ตรวจสอบข้อมูลการใช้าน</li>
  </ol>
</nav>

<div class="card card-default">
  <div class="card-header card-header-border-bottom">
    <h2>ข้อมูลการใช้งาน <span class="text-danger">จำกัดการแสดง 200 การใช้งานล่าสุด</span></h2>
  </div>
  <div class="card-body">
    <ul class="nav nav-pills nav-justified nav-style-fill" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">เข้าสู่ระบบ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="alert-tab" data-toggle="tab" href="#alert" role="tab" aria-controls="alert" aria-selected="false">การออกรายงาน</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent4">
      <div class="tab-pane pt-3 fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
        <div class="card shadow">
          <div class="card-body m-2">

            <div class="responsive-data-table2">

              <table id="ForExport" class="table dt-responsive nowrap hover" style="font-family: sarabun; font-size: 14px; text-align: center;" width="100%">
                <thead class="bg-danger text-white font-weight-bold">
                  <tr>
                    <td width="5%">ลำดับ</td>
                    <td>เวลา</td>
                    <td>IP Address</td>
                    <td>ข้อมูล</td>
                    <td>ผู้ใช้งาน</td>
                    <td>ชื่อ - นามสกุลผู้ใช้งาน</td>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $l = 0;
                  $getlogs = $getdata->my_sql_select($connect, NULL, "logs", "log_key ORDER BY log_date DESC LIMIT 200");
                  while ($showlogs = mysqli_fetch_object($getlogs)) {
                    $l++;
                  ?>
                    <tr>
                      <td><?php echo @$l; ?></td>
                      <td><?php echo @dateTimeConvertor($showlogs->log_date); ?></td>
                      <td><?php echo @$showlogs->log_ipaddress; ?></td>
                      <td><?php echo @$showlogs->log_text; ?></td>
                      <td>

                        <?php echo @Userlogin($showlogs->log_user); ?>
                      </td>
                      <td>
                        <?php echo @getemployee($showlogs->log_user); ?>
                      </td>



                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane pt-3 fade" id="alert" role="tabpanel" aria-labelledby="profile3-tab">
        <div class="card-body shadow">
          <div class="responsive-data-table-2">

            <table id="ForExport2" class="table dt-responsive nowrap hover" style="font-family: sarabun; font-size: 14px; text-align: center;" width="100%">
              <thead class="bg-danger text-white font-weight-bold">
                <tr>
                  <td width="5%">ลำดับ</td>
                  <td>เวลา</td>

                  <td>ข้อมูล</td>
                  <td>ผู้ใช้งาน</td>
                  <td>ชื่อ - นามสกุลผู้ใช้งาน</td>

                </tr>
              </thead>
              <tbody>
                <?php
                $l = 0;
                $getlogs = $getdata->my_sql_select($connect, NULL, "logs_keep", "ls_key ORDER BY ls_date DESC LIMIT 200");
                while ($showlogs = mysqli_fetch_object($getlogs)) {
                  $l++;
                ?>
                  <tr>
                    <td><?php echo @$l; ?></td>
                    <td><?php echo @dateTimeConvertor($showlogs->ls_date); ?></td>

                    <td><?php echo @$showlogs->ls_text; ?></td>
                    <td>

                      <?php echo @Userlogin($showlogs->ls_user); ?>
                    </td>
                    <td>
                      <?php echo @getemployee($showlogs->ls_user); ?>
                    </td>



                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer text-center">
    <a class="btn btn-md btn-outline-info" href="index.php?p=setting"><i class="fas fa-arrow-circle-left"></i> กลับ</a>
  </div>
</div>