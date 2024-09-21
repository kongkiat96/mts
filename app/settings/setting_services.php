<?php
require_once 'procress/dataSetting.php';
?>
<?php echo @$alert; ?>
<div class="row">
    <div class="col-12">
        <h1 class="page-header"><i class="fa fa-sliders-h fa-fw"></i> ตั้งค่าประเภทการแจ้งซ่อม</h1>
    </div>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
    <ol class="breadcrumb breadcrumb-inverse">
        <li class="breadcrumb-item">
            <a href="index.php">หน้าแรก</a>
        </li>
        <li class="breadcrumb-item" aria-current="page"><a href="index.php?p=setting">ตั้งค่า</a></li>
        <li class="breadcrumb-item active" aria-current="page">ตั้งค่าประเภทการแจ้งซ่อม</li>
    </ol>
</nav>
<!-- Insert & Edit Service -->
<div class="modal fade" id="modal_new_service" role="dialog" aria-labelledby="modal_new_service" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" action="<?php echo $SERVER_NAME; ?>" class="was-validated" id="waitsave3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">เพิ่มหมวดหมู่</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-8">
                            <label for="service_name">ชื่อหมวดหมู่</label>
                            <input type="text" name="service_name" id="service_name" class="form-control" autocomplete="off" required>
                            <div class="invalid-feedback">
                                ระบุ ชื่อหมวดหมู่
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="service_sort">ลำดับรายการ</label>
                            <input type="number" name="service_sort" id="service_sort" class="form-control" min="1" max="99" required>
                            <div class="invalid-feedback">
                                ระบุ ลำดับรายการ
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="service_group">กลุ่มการใช้งาน</label>
                        <select name="service_group" id="service_group" class="form-control select2bs4" width="100%" required>
                            <option value="">--- เลือก กลุ่มการใช้งาน ---</option>
                            <option value="1">แผนก IT</option>
                        </select>
                        <div class="invalid-feedback">
                            เลือก กลุ่มการใช้งาน
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">

                        <button class="ladda-button btn btn-primary btn-square btn-ladda bg-success" type="submit" name="save_service" data-style="expand-left">
                            <span class="fas fa-save"> บันทึก</span>
                            <span class="ladda-spinner"></span>
                        </button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </form><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit_service" role="dialog" aria-labelledby="modal_edit_service" aria-hidden="true">
    <form method="post" action="<?php echo $SERVER_NAME; ?>" class="was-validated" id="waitsave">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">แก้ไขข้อมูล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="edit_service">

                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button class="ladda-button btn btn-primary btn-square btn-ladda bg-warning" type="submit" name="save_edit_service" data-style="expand-left">
                            <span class="fas fa-save"> บันทึก</span>
                            <span class="ladda-spinner"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form><!-- /.modal-dialog -->
</div>
<!-- End Service -->
<!-- Insert & Edit Service list -->
<div class="modal fade" id="modal_new_service_list" role="dialog" aria-labelledby="modal_new_service_list" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" action="<?php echo $SERVER_NAME; ?>" class="was-validated" id="waitsave4">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">เพิ่มรายการ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <label for="service_id">เลือกหมวดหมู่</label>
                            <select name="service_id" id="service_id" class="form-control select2bs4" width="100%" required>
                                <option value="">--- เลือกข้อมูล ---</option>
                                <?php $getservice = $getdata->my_sql_select($connect, NULL, "service", "se_status ='1'");

                                while ($showservice = mysqli_fetch_object($getservice)) {
                                    echo '
                                    <option value="' . $showservice->se_id . '">' . $showservice->se_name . '</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                เลือก หมวดหมู่
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="service_list_name">ชื่อรายการ</label>
                            <input type="text" name="service_list_name" id="service_list_name" class="form-control" autocomplete="off" required>
                            <div class="invalid-feedback">
                                ระบุ ชื่อรายการ
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">

                        <button class="ladda-button btn btn-primary btn-square btn-ladda bg-success" type="submit" name="save_service_list" data-style="expand-left">
                            <span class="fas fa-save"> บันทึก</span>
                            <span class="ladda-spinner"></span>
                        </button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </form><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="edit_service_list" role="dialog" aria-labelledby="modal_edit_service_list" aria-hidden="true">
    <form method="post" action="<?php echo $SERVER_NAME; ?>" class="was-validated" id="waitsave2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">แก้ไขข้อมูล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="edit_service_list">

                </div>
                <div class="modal-footer">
                    <div class="col text-center">

                        <button class="ladda-button btn btn-primary btn-square btn-ladda bg-warning" type="submit" name="save_edit_service_list" data-style="expand-left">
                            <span class="fas fa-save"> บันทึก</span>
                            <span class="ladda-spinner"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form><!-- /.modal-dialog -->
</div>
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>ข้อมูลประเภทแจ้งซ่อม </h2>
    </div>

    <div class="card-body">

        <button class="btn btn-success btn-xs float-right btn-outline mb-2 ml-2" data-toggle="modal" data-target="#modal_new_service_list"><i class="fa fa-tasks fa-fw"></i> เพิ่มรายการ</button>
        <button class="btn btn-success btn-xs float-right btn-outline mb-2" data-toggle="modal" data-target="#modal_new_service"><i class="fa fa-list-ul fa-fw"></i> เพิ่มหมวดหมู่</button>
        <div class="table-responsive" style="height: 500px;">
            <!-- Table -->
            <table class="table table-bordered table-hover text-center">
                <thead class="table-success text-center font-weight-bold">
                    <tr>
                        <th width="3%">#</th>
                        <th colspan="3">ชื่อเมนู</th>
                        <th width="10%">ตัวจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getmenu = $getdata->my_sql_select($connect, NULL, "service", "se_id AND se_status ='1' ORDER BY se_sort");
                    while ($showmenu = mysqli_fetch_object($getmenu)) {
                        $x++;
                    ?>
                        <tr>
                            <td align="center"><?php echo $showmenu->se_sort; ?></td>
                            <td colspan="2" align="left"><?php echo @$showmenu->se_name; ?></td>
                            <td>
                            <td align="center">
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_service" data-whatever="<?php echo @$showmenu->se_id; ?>" data-top="toptitle" data-placement="top" title="แก้ไข"><i class="fa fa-edit fa-fw"></i></button>

                                <!-- <a data-toggle="modal" data-target="#edit_service" data-whatever="<?php echo @$showmenu->se_id; ?>" class="btn btn-sm btn-success btn-outline" data-toptitle="title" title="แก้ไขหมวดหมู่"><i class="fa fa-pencil-square-o"></i></a> -->
                                <!-- <a onClick="javascript:delete_service('<?php echo @$showmenu->se_id; ?>');" class="btn btn-sm btn-danger btn-outline" data-toptitle="title" title="ลบหมวดหมู่"><i class="fa fa-trash-alt fa-fw"></i></a> -->

                                <?php
                                if (@$showmenu->se_status == '1') {
                                    echo '<button type="button" class="btn btn-success btn-sm" id="btn-' . @$showmenu->se_id . '" onclick="javascript:UseService(\'' . @$showmenu->se_id . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-eye fa-fw" id="icon-' . @$showmenu->se_id . '"></i> <span id="text-' . @$showmenu->se_id . '"></span></button>';
                                } else {
                                    echo '<button type="button" class="btn btn-danger btn-sm" id="btn-' . @$showmenu->se_id . '" onclick="javascript:UseService(\'' . @$showmenu->se_id . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-eye-slash fa-fw" id="icon-' . @$showmenu->se_id . '"></i> <span id="text-' . @$showmenu->se_id . '"></span></button>';
                                }
                                ?>

                                <button type="button" class="btn btn-danger btn-sm" onClick="javascript:nousing_service('<?php echo @$showmenu->se_id; ?>');" data-top="toptitle" data-placement="top" title="ลบรายการ"><i class="fa fa-trash-alt fa-fw"></i></button>
                            </td>
                            </td>
                        </tr>
                        <?php
                        $i = 0;
                        $getsubmenu = $getdata->my_sql_select($connect, NULL, "service_list", "se_id='" . @$showmenu->se_id . "' AND se_li_status ='1' ORDER BY se_id DESC");
                        while ($showsubmenu = mysqli_fetch_object($getsubmenu)) {
                            $i++;
                        ?>
                            <tr>
                                <td colspan="2" align="center" width="5%"><?php echo $i; ?></td>

                                <td width="60%" bgcolor="#EEEEEE">&nbsp;<?php echo @$showsubmenu->se_li_name; ?></td>

                                <td width="10%" align="center" bgcolor="#EEEEEE">
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_service_list" data-whatever="<?php echo @$showsubmenu->se_li_id; ?>" data-top="toptitle" data-placement="top" title="แก้ไข"><i class="fa fa-edit fa-fw"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" onClick="javascript:nousing_service_li('<?php echo @$showsubmenu->se_li_id; ?>');" data-top="toptitle" data-placement="top" title="ลบรายการ"><i class="fa fa-trash-alt fa-fw"></i></button>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-center">
        <a class="btn btn-md btn-outline-info" href="index.php?p=setting"><i class="fas fa-arrow-circle-left"></i> กลับ</a>
    </div>
    <!-- End Set Service -->
</div>