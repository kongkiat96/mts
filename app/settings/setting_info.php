<?php
if (isset($_POST['password_save'])) {
  if ($userdata->password != md5(htmlspecialchars($_POST['old_password']))) {
    $alert = $warning;
    echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
  } else {
    if (md5(htmlspecialchars($_POST['new_password'])) != md5(htmlspecialchars($_POST['re_new_password']))) {
      $alert = $ck_pass;
      echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
    } else {
      if (htmlspecialchars($_POST['new_password']) != null && htmlspecialchars($_POST['re_new_password']) != null) {
        $getdata->my_sql_update($connect, 'user', "password='" . md5(htmlspecialchars($_POST['new_password'])) . "'", "user_key='" . $_SESSION['ukey'] . "'");
        $alert = $success;
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
      } else {
        $alert = $warning;
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
      }
    }
  }
}

$getmember_info = $getdata->my_sql_query($connect, null, 'user', "user_key='" . $_SESSION['ukey'] . "'");
echo @$alert;
?>
<div class="row">
  <div class="col-12">
    <h1 class="page-header"><i class="fa fa-key fa-fw"></i> เปลี่ยนแปลงรหัสผ่าน</h1>
  </div>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
  <ol class="breadcrumb breadcrumb-inverse">
    <li class="breadcrumb-item">
      <a href="index.php">หน้าแรก</a>
    </li>
    <li class="breadcrumb-item" aria-current="page"><a href="index.php?p=setting">ตั้งค่า</a></li>
    <li class="breadcrumb-item active" aria-current="page">เปลี่ยนแปลงรหัสผ่าน</li>
  </ol>
</nav>
<div class="card shadow">
  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-left text-warning">เปลี่ยนแปลงรหัสผ่าน <i class="fa fa-key fa-fw"></i></h6>
  </div>
  <form method="post" enctype="multipart/form-data" class="was-validated" id="waitsave">
    <div class="card-body">
      <div class="row">
        <div class="form-group col-md-6 col-sm-12">
          <label for="musername">Username <i class="fa fa-user fa-fw"></i></label>
          <input class="form-control" type="text" value="<?php echo @$getmember_info->username; ?>" readonly>
        </div>
        <div class="form-group col-md-6 col-sm-12 text-danger">
          <label for="old_password">รหัสผ่านเก่า</label>
          <input type="password" name="old_password" id="old_password" class="form-control" required>
          <div class="invalid-feedback">
            ระบุ รหัสผ่านเก่า.
          </div>
        </div>
      </div>
      <hr class="sidebar-divider d-none d-md-block">
      <div class="row">
        <div class="form-group col-md-6 col-sm-12 text-warning">
          <label for="new_password">รหัสผ่านใหม่</label>
          <input type="password" name="new_password" id="new_password" class="form-control" required>
          <div class="invalid-feedback">
            ระบุ รหัสผ่านใหม่.
          </div>
        </div>
        <div class="form-group col-md-6 col-sm-12 text-warning">
          <label for="re_new_password">ยืนยันรหัสผ่านใหม่อีกครั้ง</label>
          <input type="password" name="re_new_password" id="re_new_password" class="form-control" required>
          <div class="invalid-feedback">
            ยืนยันรหัสผ่านใหม่อีกครั้ง.
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer text-center">
      <div id="showload" style="display: none;"><span class="spinner-border text-primary spinner-sm" role="status" aria-hidden="true"></span></div>
      <div id="hidden">
        <a class="btn btn-xs btn-outline-info" href="index.php?p=setting"><i class="fa fa-reply"></i> กลับ</a>
        <button class="btn btn-outline-warning" type="submit" name="password_save"><i class="fa fa-unlock-alt fa-fw"></i>บันทึก</button>

      </div>
    </div>
  </form>
</div>