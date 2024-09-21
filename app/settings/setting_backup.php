<?php
if (isset($_POST['backup'])) {
  require("../core/mysql_dump.core.php");
  $myFile = "../backup/" . date("Y-m-d.bk") . ".sql";
  $fn = date("Y-m-d.bk") . ".sql";
  $fh = fopen($myFile, 'w') or die("can't open file");
  $showresult = $getdata->my_sql_string($connect, "SHOW TABLES");

  while ($row = mysqli_fetch_row($showresult)) {
    $table = $row[0];
    // dump data
    datadump($table, true, true);
    $stringData = datadump($table, true, true);
    fwrite($fh, $stringData);
  }
  fclose($fh);
  $bk = md5($fn . time("now"));
  $getdata->my_sql_insert($connect, "backup_logs", "backup_key='" . $bk . "',backup_file='" . $fn . "',user_key='" . $_SESSION['ukey'] . "'");
  $alert = $success;
}
echo @$alert;
?>
<div class="row">
  <div class="col-12">
    <h1 class="page-header"><i class="fa fa-database fa-fw"></i> สำรองฐานข้อมูล</h1>
  </div>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
  <ol class="breadcrumb breadcrumb-inverse">
    <li class="breadcrumb-item">
      <a href="index.php">หน้าแรก</a>
    </li>
    <li class="breadcrumb-item" aria-current="page"><a href="index.php?p=setting">ตั้งค่า</a></li>
    <li class="breadcrumb-item active" aria-current="page">สำรองฐานข้อมูล</li>
  </ol>
</nav>


<div class="card mb-2">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link text-warning active" id="backup-tab" data-toggle="tab" href="#backup" role="tab" aria-controls="backup" aria-selected="true">สำรองฐานข้อมูล</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="backup" role="tabpanel" aria-labelledby="backup-tab">
        <div class="card shadow">
          <div class="card-body m-2">
            <div class="row">

              <form method="post" action="">
                <button type="submit" name="backup" class="btn btn-danger btn-xs float-right mb-2"><i class="fa fa-database fa-fw"></i> สำรองฐานข้อมูล</button>
              </form>

            </div>


            <div class="responsive-data-table-1">
              <table id="responsive-data-table-1" class="table dt-responsive nowrap hover text-center" width="100%">
                <thead class="bg-danger text-white font-weight-bold">
                  <tr>
                    <td>ลำดับครั้งที่สำรองฐานข้อมูล</td>
                    <td>ชื่อฐานข้อมูล</td>
                    <td>วันที่</td>
                    <td>ผู้ดำเนินการ</td>
                    <td>จัดการ</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 0;
                  $getbackup = $getdata->my_sql_select($connect, NULL, "backup_logs,user", "backup_logs.user_key=user.user_key ORDER BY backup_date DESC");
                  while ($showbackup = mysqli_fetch_object($getbackup)) {
                    $i++;
                  ?>
                    <tr>
                      <td align="center"><?php echo @$i; ?></td>
                      <td>&nbsp;<?php echo @$showbackup->backup_file; ?></td>
                      <td align="center"><?php echo @dateTimeConvertor($showbackup->backup_date); ?></td>
                      <td align="center">
                        <?php echo "คุณ " . @$showbackup->name . "&nbsp;&nbsp;" . $showbackup->lastname; ?>
                      </td>
                      <td align="center">

                        <a href="function.php?type=download_backup&key=<?php echo @$showbackup->backup_key; ?>" class="btn btn-success btn-sm" data-top="toptitle" data-placement="top" title="Download"><i class="fa fa-download fa-fw"></i></a>

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
      <div class="tab-pane fade" id="restore" role="tabpanel" aria-labelledby="restore-tab">

      </div>
    </div>
  </div>
  <div class="card-footer text-center">
    <a class="btn btn-md btn-outline-info" href="index.php?p=setting"><i class="fas fa-arrow-circle-left"></i> กลับ</a>
  </div>
</div>
<script language="javascript">
  function deleteBackup(nkey) {
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById(nkey).innerHTML = '';
      }
    }
    xmlhttp.open("GET", "function.php?type=delete_backup&key=" + nkey, true);
    xmlhttp.send();
  }
</script>