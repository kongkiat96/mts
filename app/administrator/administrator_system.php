<?php
$countmail = $getdata->my_sql_show_rows($connect, "alert_mail", "alert_name='" . htmlspecialchars($_POST['alertname_mail']) . "'");
$countline = $getdata->my_sql_show_rows($connect, "alert_line", "alert_name='" . htmlspecialchars($_POST['alertname_line']) . "'");
if (isset($_POST['save_new_alert_mail'])) {
    if (htmlspecialchars($_POST['alertname_mail']) != NULL) {
        $genkey_mail = md5(htmlspecialchars($_POST['alertname_mail']));
        if ($countmail < 1) {
            $getdata->my_sql_insert(
                $connect,
                "alert_mail",
                "alert_key_mail = '" . $genkey_mail . "',
                alert_name = '" . htmlspecialchars($_POST['alertname_mail']) . "',
                alert_email = '" . htmlspecialchars($_POST['alertmail']) . "',
                alert_email_pass = '" . htmlspecialchars($_POST['passmail']) . "',
                use_menu = '" . htmlspecialchars($_POST['menu_mail']) . "'"
            );
            $alert = $success;
        } else {
            $alert = $counterror;
        }
    } else {
        $alert = $warning;
    }
}

if (isset($_POST['save_new_alert_line'])) {
    if (htmlspecialchars($_POST['alertname_line']) != NULL) {
        $genkey_line = md5(htmlspecialchars($_POST['alertname_line']));
        if ($countline < 1) {
            $getdata->my_sql_insert(
                $connect,
                "alert_line",
                "alert_key_line = '" . $genkey_line . "',
                alert_name = '" . htmlspecialchars($_POST['alertname_line']) . "',
            line_token = '" . htmlspecialchars($_POST['line_token']) . "',
            use_menu = '" . htmlspecialchars($_POST['page_line']) . "'"
            );
            $alert = $success;
        } else {
            $alert = $counterror;
        }
    } else {
        $alert = $warning;
    }
}

if (isset($_POST['save_edit_line'])) {
    if (htmlspecialchars($_POST['edit_alertname_line']) != NULL) {
    }
}

?>
<?php echo @$alert; ?>
<div class="row">
    <div class="col-12">
        <h1 class="page-header"><i class="fa fa-bell"></i> [ผู้ดูแลระบบ] ตั้งค่าการแจ้งเตือนระบบ</h1>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">หน้าแรก</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="index.php?p=setting">ตั้งค่า</a></li>
        <li class="breadcrumb-item active" aria-current="page">ตั้งค่าการแจ้งเตือนระบบ</li>
    </ol>
</nav>
<!-- New Alert -->
<div class="modal fade" id="modal_new_alert_mail" tabindex="-1" role="dialog" aria-labelledby="modal_new_alert" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" action="<?php echo $SERVER_NAME; ?>" class="was-validated" id="waitsave">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">เพิ่มรายการแจ้งเตือนระบบ E-mail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6 col-sm-12">
                            <label for="alertname_mail">ชื่อการแจ้งเตือน</label>
                            <input type="text" name="alertname_mail" id="alertname_mail" class="form-control" required autocomplete="off">
                            <div class="invalid-feedback">
                                ระบุ ชื่อการแจ้งเตือน.
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="menu_mail">ใช้สำหรับระบบ</label>
                            <select name="menu_mail" id="menu_mail" class="form-control select2bs4" required>
                                <option value="">--- เลือกข้อมูล ---</option>
                                <?php $getmenu = $getdata->my_sql_select($connect, null, 'menus', "menu_status = '1' ORDER BY menu_sorting ASC");
                                while ($showmenu = mysqli_fetch_object($getmenu)) {
                                    echo '<option value="' . $showmenu->menu_key . '">' . $showmenu->menu_name . '</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                เลือก เมนูสำหรับการแจ้งเตือน.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-sm-12">
                            <label for="alertmail">E-mail Account</label>
                            <input type="email" name="alertmail" id="alertmail" class="form-control" autocomplete="off">
                            <div class="invalid-feedback">
                                ระบุ E-mail Account ให้ถูกต้อง.
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="passmail">Password E-mail</label>
                            <input type="text" name="passmail" id="passmail" class="form-control" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <div id="showload" style="display: none;"><span class="spinner-border text-primary spinner-sm" role="status" aria-hidden="true"></span></div>
                        <div id="hidden">
                            <button class="btn btn-outline-success btn-sm" type="submit" name="save_new_alert_mail"><i class="fa fa-save fa-fw"></i>บันทึก</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </form><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_new_alert_line" tabindex="-1" role="dialog" aria-labelledby="modal_new_alert" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" action="<?php echo $SERVER_NAME; ?>" class="was-validated" id="waitsave2">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">เพิ่มรายการแจ้งเตือนระบบ Line</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6 col-sm-12">
                            <label for="alertname_line">ชื่อการแจ้งเตือน</label>
                            <input type="text" name="alertname_line" id="alertname_line" class="form-control" required autocomplete="off">
                            <div class="invalid-feedback">
                                ระบุ ชื่อการแจ้งเตือน.
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="page_line">ใช้สำหรับหน้า</label>
                            <select name="page_line" id="page_line" class="form-control select2bs4" required>
                                <option value="">--- เลือกข้อมูล ---</option>
                                <?php $getmenu = $getdata->my_sql_select($connect, null, 'list', "case_status = '1' ORDER BY menu ASC");
                                while ($showmenu = mysqli_fetch_object($getmenu)) {
                                    echo '<option value="' . $showmenu->id . '">' . $showmenu->pages . '</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                เลือก หน้าสำหรับการแจ้งเตือน.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="line_token">Line Token</label>
                            <input type="text" name="line_token" id="line_token" class="form-control" required autocomplete="off">
                            <div class="invalid-feedback">
                                ระบุ Linetoken.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <div id="showload2" style="display: none;"><span class="spinner-border text-primary spinner-sm" role="status" aria-hidden="true"></span></div>
                        <div id="hidden2">
                            <button class="btn btn-outline-success btn-sm" type="submit" name="save_new_alert_line"><i class="fa fa-save fa-fw"></i>บันทึก</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </form><!-- /.modal-dialog -->
</div>
<!-- End New Alert -->

<!-- Edit Page list -->
<div class="modal fade" id="edit_line" tabindex="-1" role="dialog" aria-labelledby="modal_edit_line" aria-hidden="true">
    <form method="post" action="<?php echo $SERVER_NAME; ?>" class="was-validated" id="waitsave3">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">แก้ไขข้อมูล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="edit_line">

                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <div id="showload3" style="display: none;"><span class="spinner-border text-primary spinner-sm" role="status" aria-hidden="true"></span></div>
                        <div id="hidden3">
                            <button class="btn btn-outline-primary btn-sm" type="submit" name="save_edit_line"><i class="fa fa-save fa-fw"></i>บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form><!-- /.modal-dialog -->
</div>
<!-- End edit Page list -->
<div class="card mb-2">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item font-weight-bold">
                <a class="nav-link text-success active" id="alert_line-tab" data-toggle="tab" href="#alert_line" role="tab" aria-controls="alert_line" aria-selected="true">รายการแจ้งเตือนระบบ Line</a>
            </li>
            <li class="nav-item font-weight-bold">
                <a class="nav-link text-pimary" id="alert_mail-tab" data-toggle="tab" href="#alert_mail" rol="tab" aria-controls="alert_mail" aria-selected="false">รายการแจ้งเตือนระบบ E-mail</a>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="alert_line" role="tabpanel" aria-labelledby="alert_line-tab">
                <div class="card shadow">
                    <div class="card-body">
                        <button class="btn btn-success btn-xs float-right mb-2 btn-outline" data-toggle="modal" data-target="#modal_new_alert_line"><i class="fa fa-plus fa-fw"></i> เพิ่มรายการแจ้งเตือนระบบ Line</button>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-center" width="100%" id="dataTablesFixwidht">
                                <thead class="table-danger font-weight-bold">
                                    <tr>
                                        <td>#</td>
                                        <td>ชื่อการแจ้งเตือน</td>
                                        <td>Line token</td>
                                        <td>ใช้สำหรับหน้า</td>
                                        <td>Status for line</td>
                                        <td>จัดการ</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $l = 0;
                                    $getalert = $getdata->my_sql_select($connect, NULL, "alert_line", "status_line !='2' ORDER BY date_time DESC");
                                    while ($showalert_line = mysqli_fetch_object($getalert)) {
                                        $l++;
                                    ?>
                                        <tr>
                                            <td><?php echo @$l; ?></td>
                                            <td><?php echo @$showalert_line->alert_name; ?></td>
                                            <td><?php echo @$showalert_line->line_token; ?></td>
                                            <td><?php echo @getmenu($showalert_line->use_menu); ?></td>
                                            <td>
                                                <?php
                                                if ($showalert_line->status_line == '1') {
                                                    echo '<button type="button" class="btn btn-success btn-sm" id="btn-' . @$showalert_line->status_line . '" onclick="javascript:DisabledLink(\'' . @$showalert_line->alert_key . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-unlock-alt fa-fw" id="icon-' . @$showalert_line->status_line . '"></i> <span id="text-' . @$showalert_line->status_line . '"></span></button>';
                                                } else {
                                                    echo '<button type="button" class="btn btn-danger btn-sm" id="btn-' . @$showalert_line->status_line . '" onclick="javascript:DisabledLink(\'' . @$showalert_line->alert_key . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-lock fa-fw" id="icon-' . @$showalert_line->status_line . '"></i> <span id="text-' . @$showalert_line->status_line . '"></span></button>';
                                                }
                                                ?>
                                            </td>


                                            <td>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_line" data-whatever="<?php echo @$showalert_line->alert_key_line; ?>" data-top="toptitle" data-placement="top" title="แก้ไข"><i class="fa fa-edit fa-fw"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="javascript:delect_link('<?php echo @$showalert_line->alert_key; ?>');" data-top="toptitle" data-placement="top" title="ลบรายการ"><i class="fa fa-trash-alt fa-fw"></i></button>
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
            <div class="tab-pane fade" id="alert_mail" role="tabpanel" aria-labelledby="alert_mail-tab">
                <div class="card shadow">
                    <div class="card-body">
                        <button class="btn btn-primary btn-xs float-right mb-2 ml-2 btn-outline" data-toggle="modal" data-target="#modal_new_alert_mail"><i class="fa fa-plus fa-fw"></i> เพิ่มรายการแจ้งเตือนระบบ E-mail</button>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-center" width="100%" id="dataTablesFixwidht-2">
                                <thead class="table-danger font-weight-bold">
                                    <tr>
                                        <td>#</td>
                                        <td>ชื่อการแจ้งเตือน</td>
                                        <td>E-mail</td>
                                        <td>Password e-mail</td>
                                        <td>ใช้สำหรับเมนู</td>
                                        <td>Status for e-mail</td>
                                        <td>จัดการ</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $m = 0;
                                    $getalert = $getdata->my_sql_select($connect, NULL, "alert_mail", "status_mail !='2' ORDER BY date_time DESC");
                                    while ($showalert_mail = mysqli_fetch_object($getalert)) {
                                        $m++;
                                    ?>
                                        <tr>
                                            <td><?php echo @$m; ?></td>
                                            <td><?php echo @$showalert_mail->alert_name; ?></td>
                                            <td><?php echo @$showalert_mail->alert_email; ?></td>
                                            <td><?php echo @$showalert_mail->alert_email_pass; ?></td>
                                            <td><?php echo @getmenu($showalert_mail->use_menu); ?></td>
                                            <td>
                                                <?php
                                                if ($showalert_mail->status_mail == '1') {
                                                    echo '<button type="button" class="btn btn-success btn-sm" id="btn-' . @$showalert_mail->status_mail . '" onclick="javascript:DisabledLink(\'' . @$showalert_mail->alert_key . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-unlock-alt fa-fw" id="icon-' . @$showalert_mail->status_mail . '"></i> <span id="text-' . @$showalert_mail->status_mail . '"></span></button>';
                                                } else {
                                                    echo '<button type="button" class="btn btn-danger btn-sm" id="btn-' . @$showalert_mail->status_mail . '" onclick="javascript:DisabledLink(\'' . @$showalert_mail->alert_key . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-lock fa-fw" id="icon-' . @$showalert_mail->status_mail . '"></i> <span id="text-' . @$showalert_mail->status_mail . '"></span></button>';
                                                }
                                                ?>
                                            </td>


                                            <td>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_mail" data-whatever="<?php echo @$showalert_mail->alert_key; ?>" data-top="toptitle" data-placement="top" title="แก้ไข"><i class="fa fa-edit fa-fw"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="javascript:delect_link('<?php echo @$showalert_mail->alert_key; ?>');" data-top="toptitle" data-placement="top" title="ลบรายการ"><i class="fa fa-trash-alt fa-fw"></i></button>
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
    </div>
    <div class="card-footer text-center">
        <a class="btn btn-xs btn-outline-info" href="index.php?p=setting"><i class="fa fa-reply"></i> กลับ</a>
    </div>
</div>