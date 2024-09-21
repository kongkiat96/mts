<div class="row">
    <div class="col-12">
        <h1 class="page-header"><i class="fa fa-street-view fa-fw"></i> [ผู้ดูแลระบบ] ตรวจสอบข้อมูลการเข้าถึง</h1>
    </div>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
    <ol class="breadcrumb breadcrumb-inverse">
        <li class="breadcrumb-item">
            <a href="index.php">หน้าแรก</a>
        </li>
        <li class="breadcrumb-item" aria-current="page"><a href="index.php?p=setting">ตั้งค่า</a></li>
        <li class="breadcrumb-item active" aria-current="page">ตรวจสอบข้อมูลการเข้าถึง</li>
    </ol>
</nav>

<div class="modal fade" id="showaccess_user" tabindex="-1" role="dialog" aria-labelledby="modal_showaccess_user" aria-hidden="true">
    <form method="post" action="<?php echo $SERVER_NAME; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="showaccess_user">

                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i>ปิด</button>
                    </div>
                </div>
            </div>
        </div>
    </form><!-- /.modal-dialog -->
</div>


<div class="card mb-2">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item font-weight-bold">
                <a class="nav-link text-danger active" id="access-tab" data-toggle="tab" href="#access" role="tab" aria-controls="access" aria-selected="true">ข้อมูลการเข้าถึงเมนู</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-panel fade show active" id="service" role="tabpanel" aria-labelledby="service-tab">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-center" width="100%">
                                <thead class="table-danger font-weight-bold">
                                    <tr>
                                        <td width="5%">ลำดับ</td>
                                        <td>Access Key</td>
                                        <td width="40%">ชื่อเมนู</td>
                                        <td width="15%">จำนวนผู้เข้าถึง</td>
                                        <td width="15%">จัดการ</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $a = 0;
                                    $getaccess = $getdata->my_sql_select($connect, null, "access_list", "access_key <> '' AND access_status != '2' ORDER BY access_name");
                                    while ($showaccess = mysqli_fetch_object($getaccess)) {
                                        $a++;
                                    ?>
                                        <tr>
                                            <td><?php echo @$a; ?></td>
                                            <td><?php echo @$showaccess->access_key; ?></td>
                                            <td>&nbsp;<span data-toggle="tooltip" data-placement="right" title="<?php echo $showaccess->access_detail; ?>"><?php echo @$showaccess->access_name; ?></span></td>
                                            <td><?php echo @number_format($getdata->my_sql_show_rows($connect, "access_user", "access_key='" . $showaccess->access_key . "'")); ?></td>
                                            <td>
                                                <?php if ($_SESSION['ukey'] === 'k0ngk1at') { ?>
                                                    <?php

                                                    if ($showaccess->access_status == '1') {
                                                        echo '<button type="button" class="btn btn-success btn-sm" id="btn-' . @$showaccess->access_key . '" onclick="javascript:Accesslock(\'' . @$showaccess->access_key . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-unlock-alt fa-fw" id="icon-' . @$showaccess->access_key . '"></i> <span id="text-' . @$showaccess->access_key . '"></span></button>';
                                                    } else {
                                                        echo '<button type="button" class="btn btn-danger btn-sm" id="btn-' . @$showaccess->access_key . '" onclick="javascript:Accesslock(\'' . @$showaccess->access_key . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-lock fa-fw" id="icon-' . @$showaccess->access_key . '"></i> <span id="text-' . @$showaccess->access_key . '"></span></button>';
                                                    }
                                                    ?>
                                                <?php } ?>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#showaccess_user" data-whatever="<?php echo @$showaccess->access_key; ?>" data-top="toptitle" data-placement="top" title="ตรวจสอบการเข้าถึง"><i class="fa fa-user-shield fa-fw"></i></button>
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
        <a class="btn btn-md btn-outline-info" href="index.php?p=setting"><i class="fas fa-arrow-circle-left"></i> กลับ</a>
    </div>
</div>