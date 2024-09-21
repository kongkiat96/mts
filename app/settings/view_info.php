<?php
$getmember_info = $getdata->my_sql_query($connect, null, 'user', "user_key='" . $_SESSION['ukey'] . "'");
$getemployee_info = $getdata->my_sql_query($connect, null, 'employee', "card_key ='" . $_SESSION['ukey'] . "'");

if (isset($_POST['save_mail'])) {
    if (htmlspecialchars($_POST['mail']) != NULL) {
        $getdata->my_sql_update(
            $connect,
            'user',
            "email='" . htmlspecialchars($_POST['mail']) . "'",
            "user_key='" . $_SESSION['ukey'] . "'"
        );
        $alert = $success;
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
    } else {
        $alert = $warning;
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
    }
}

if (isset($_POST['password_edit'])) {
    if ($getmember_info->password != md5(htmlspecialchars($_POST['old_password']))) {
        $alert = $wrongPassword;
        //echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
    } else {
        if (md5(htmlspecialchars($_POST['new_password'])) != md5(htmlspecialchars($_POST['conf_password']))) {
            $alert = $ck_pass;
            //echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
        } else {
            if (htmlspecialchars($_POST['new_password']) != null && htmlspecialchars($_POST['conf_password']) != null) {
                $getdata->my_sql_update($connect, 'user', "
                password='" . md5(htmlspecialchars($_POST['new_password'])) . "'", "user_key='" . $_SESSION['ukey'] . "'");
                $alert = $success;
                //echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
            } else {
                $alert = $warning;
                //echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
            }
        }
    }
}

echo @$alert;
?>
<div class="row">
    <div class="col-12">
        <h1 class="page-header"><i class="fa fa-user-tie fa-fw"></i> ข้อมูลส่วนตัว</h1>
    </div>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
    <ol class="breadcrumb breadcrumb-inverse">
        <li class="breadcrumb-item">
            <a href="index.php">หน้าแรก</a>
        </li>
        <li class="breadcrumb-item" aria-current="page"><a href="index.php?p=setting">ตั้งค่า</a></li>
        <li class="breadcrumb-item active" aria-current="page">ข้อมูลส่วนตัว</li>
    </ol>
</nav>
<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-left text-info">ตรวจสอบข้อมูลส่วนตัว <i class="fa fa-user-tie fa-fw"></i></h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-2 col-sm-12">
                <label for="prefix_name">คำนำหน้า</label>
                <input type="text" class="form-control" id="prefix_name" value="<?php echo @prefixConvertor($getemployee_info->title_name); ?>" readonly>
            </div>
            <div class="form-group col-md-5 col-sm-12">
                <label for="name">ชื่อ</label>
                <input type="text" class="form-control" id="name" value="<?php echo $getemployee_info->name; ?>" readonly>
            </div>
            <div class="form-group col-md-5 col-sm-12">
                <label for="lastname">นามสกุล</label>
                <input type="text" class="form-control" id="lastname" value="<?php echo $getemployee_info->lastname; ?>" readonly>
            </div>
        </div>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="row">
            <div class="form-group col-md-6 col-sm-12">
                <label for="position">ตำแหน่ง</label>
                <input type="text" class="form-control" id="position" value="<?php echo $getemployee_info->user_position; ?>" readonly>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="department">แผนก</label>
                <input type="text" class="form-control" id="department" value="<?php echo @prefixConvertorDepartment($getemployee_info->user_department); ?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 col-sm-12">
                <label for="company">บริษัท / สังกัด</label>
                <input type="text" class="form-control" id="company" value="<?php echo @prefixConvertorCompany($getemployee_info->department_id); ?>" readonly>
            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="mail">E-mail</label>
                <?php if ($getmember_info->email != NULL) { ?>
                    <input type="text" class="form-control" id="mail" value="<?php echo $getmember_info->email; ?>" readonly>
                <?php } else { ?>
                    <form method="post" enctype="multipart/form-data" class="was-validated" id="waitsave">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="mail" id="mail" value="<?php echo $getmember_info->email; ?>" required>
                            <div class=" input-group-append">
                                <button class="btn btn-outline-primary" type="submit" name="save_mail"><i class="fa fa-save fa-fw"></i></button>
                            </div>
                            <div class="invalid-feedback">
                                ระบุ E-mail.
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
        <hr class="sidebar-divider d-none d-md-block">
        <form method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="form-group col-md-4 col-sm-12">
                    <label for="old_password">รหัสผ่านเก่า</label>
                    <input id="old_password" type="password" class="form-control" name="old_password" value="">
                    <span toggle="#old_password" class="fa fa-fw fa-eye field-icon old_password"></span>
                </div>
                <div class="form-group col-md-4 col-sm-12">
                    <label for="new_password">รหัสผ่านใหม่</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" value="" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}" title="กำหนดรหัสผ่านอย่างน้อย 6 หลักโดยมีตัวเล็ก,ตัวใหญ่และตัวเลข">
                    <span toggle="#new_password" class="fa fa-fw fa-eye field-icon new_password"></span>
                </div>
                <div class="form-group col-md-4 col-sm-12">
                    <label for="conf_password">ยืนยันรหัสผ่านใหม่</label>
                    <input type="password" class="form-control" name="conf_password" id="conf_password" value="" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}" title="กำหนดรหัสผ่านอย่างน้อย 6 หลักโดยมีตัวเล็ก,ตัวใหญ่และตัวเลข">
                    <span toggle="#conf_password" class="fa fa-fw fa-eye field-icon conf_password"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-outline-primary mb-2 btn-pill" name="password_edit"><span class="fas fa-key"></span> Update Password</button>
                </div>
            </div>
        </form>

    </div>
    <div class="card-footer text-center">
        <a class="btn btn-xs btn-outline-info" href="index.php?p=setting"><i class="fa fa-reply"></i> กลับ</a>
    </div>
</div>