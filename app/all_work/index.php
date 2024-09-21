<?php

if (isset($_POST['export'])) {
    $month_case = isset($_POST['month_case']) ? $_POST['month_case'] : null;
    $year_case = isset($_POST['year_case']) ? $_POST['year_case'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;
    $permission = isset($_POST['permission']) ? $_POST['permission'] : null;
    $whereClause = "ID <> 'hidden'";
    if ($month_case != null && $year_case == null) {
        $whereClause .= " AND date LIKE '%" . date("Y-$month_case") . "%'";
    } elseif ($year_case != null && $month_case == null) {
        $whereClause .= " AND date LIKE '%" . date("$year_case") . "%'";
    } elseif ($year_case != null && $month_case != null) {
        $whereClause .= " AND date LIKE '%" . date("$year_case-$month_case") . "%'";
    }
    if ($status != null) {
        $whereClause .= " AND card_status = '$status'";

        // if ($_POST['status'] == 'fe8ae3ced9e7e738d78589bf6610c4da') {
        //     $whereClause .= " AND card_status = '$status' AND work_flag = 'work_success'";
        //     $whereClause .= " AND card_status = '$status' AND work_flag = 'work_success'";
        // } else if ($_POST['status'] == 'chekwork_sm'){
        //     $whereClause .= " AND card_status = 'fe8ae3ced9e7e738d78589bf6610c4da' AND (work_flag IN ('work_cctv','work_hr') OR work_flag IS NULL)";
        // }else {
        //     // $whereClause .= " AND card_status = '$status'";
        //     $whereClause .= " AND card_status IN ('57995055c28df9e82476a54f852bd214','9b5292adfe68103f2a31b5cfbba64fd7')";
        // }
    } else {
            $whereClause .= " AND card_status IN ('33831963cbe86c4e544c5a999984aa7b')";

    }

    if ($permission != null) {
        if ($_POST['permission'] == '99') {
            $whereClause .= " AND se_id NOT IN ('8','13')";
        } else {
            $whereClause .= " AND se_id = '$permission'";
        }
    }

    $getcaseshow = $getdata->my_sql_select($connect, null, "building_list", $whereClause . " ORDER BY ticket", "ID");
}
?>

<?php $getmenus = $getdata->my_sql_query($connect, null, 'menus', "menu_status ='1' AND menu_case = 'all_work' AND menu_key != 'c6c8729b45d1fec563f8453c16ff03b8'"); ?>
<style>
    .dataTables_filter {
        float: right !important;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-list-ul fa-2x"></i> ค้นหาและตรวจสอบงาน</h3>
    </div>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
    <ol class="breadcrumb breadcrumb-inverse">
        <li class="breadcrumb-item">
            <a href="index.php">หน้าแรก</a>
        </li>
        <li class="breadcrumb-item active"><?php echo '<span>' . $getmenus->menu_name . '</span>'; ?></li>
    </ol>
</nav>



<div class="card card-default md-4 showdow text-center">
    <div class="card-header card-header-border-bottom justify-content-center">
        <h5 class="m-0 font-weight-bold text-center">ค้นหารายการข้อมูล</h5>
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo $SERVER_NAME; ?>" class="needs-validation">

            <div class="form-group row d-flex justify-content-center">
                <div class="col-md-3 col-sm-12">
                    <label for="month_case">เดือน</label>
                    <select name="month_case" id="month_case" class="form-control select2bs4">
                        <option value="" selected>--- เลือกข้อมูล ---</option>
                        <option value="01">มกราคม</option>
                        <option value="02">กุมภาพันธ์</option>
                        <option value="03">มีนาคม</option>
                        <option value="04">เมษายน</option>
                        <option value="05">พฤษภาคม</option>
                        <option value="06">มิถุนายน</option>
                        <option value="07">กรกฏาคม</option>
                        <option value="08">สิงหาคม</option>
                        <option value="09">กันยายน</option>
                        <option value="10">ตุลาคม</option>
                        <option value="11">พฤศจิกายน</option>
                        <option value="12">ธันวาคม</option>
                    </select>
                </div>

                <div class="col-md-3 col-sm-12">
                    <label for="year_case">ปี</label>
                    <?php
                    $currently_selected = date('Y');
                    $earliest_year =    2024;
                    $latest_year = date('Y');
                    print '<select name="year_case" id="year_case" class="form-control select2bs4">';
                    print '<option value="" selected>--- เลือกข้อมูล ---</option>';
                    foreach (range($latest_year, $earliest_year) as $i) {
                        print '<option value="' . $i . '"' . ($i === $currently_selected ?: '') . '>' . $i . '</option>';
                    }
                    print '</select>';
                    ?>
                </div>

                <div class="col-md-3 col-sm-12">
                    <label for="status">สถานะงาน</label>
                    <select name="status" id="status" class="form-control select2bs4">
                        <option value="" selected>--- เลือกข้อมูล ---</option>
                        <!-- <option value="wait_checkwork">รอตรวจสอบงานจากผู้ใช้งาน</option> -->
                        <!-- <option value="wait_approve_hr">รออนุมัติจาก HR</option> -->
                        <!-- <option value="approve_mg">รอดำเนินการ</option> -->
                        <!-- <option value="chekwork_sm">รอ Support Manager ตรวจสอบ</option> -->
                        <!-- <option value="wait_approve">รออนุมัติแจ้งงาน</option>
                        <option value="wait_approve_it">รออนุมัติจาก IT support</option>
                        <option value="wait_approve_cctv">รออนุมัติจาก CCTV</option>
                        <option value="wait_approve_erp">รออนุมัติจาก Erp & POS</option> -->
                        <?php
                        $select_status = $getdata->my_sql_select($connect, NULL, "card_type", "ctype_status ='1' AND ctype_key IN ('33831963cbe86c4e544c5a999984aa7b') ORDER BY ctype_insert");

                        while ($show_status = mysqli_fetch_object($select_status)) {

                            echo '<option value="' . $show_status->ctype_key . '">' . $show_status->ctype_name . '</option>';
                        }



                        ?>
                    </select>
                </div>

                <!-- <div class="col-md-3 col-sm-12">
                    <label for="permission">ลักษณะงาน</label>
                    <select name="permission" id="permission" class="form-control select2bs4">
                        <option value="" selected>--- เลือกข้อมูล ---</option>
                        <option value="99">งาน IT support</option>
                        <option value="13">ข้อมูลเข้าถึง Erp & POS</option>
                        <option value="8">ข้อมูลเข้าถึง CCTV</option>
                    </select>
                </div> -->

            </div>

            <button class="btn btn-danger  " onclick="reloadPage()" data-style="expand-left">
                <span class="fas fa-sync-alt"> ล้างค่า</span>
                <span class="ladda-spinner"></span>
            </button>

            <button class="btn btn-primary  " data-style="expand-left" type="submit" name="export">
                <span class="fas fa-search"> ค้นหารายการ</span>
                <span class="ladda-spinner"></span>
            </button>
        </form>
    </div>
</div>

<?php if (isset($_POST['export'])) { ?>
    <div class="card">
        <div class="card-body">
            <div class="responsive-data-table">

                <table id="all-work" class="table dt-responsive nowrap hover" style="font-family: sarabun; font-size: 14px;
    text-align: center;" width="100%">
                    <thead class="font-weight-bold text-center">
                        <tr>
                            <td>ลำดับ</td>
                            <td>Ticket</td>
                            <td>รหัสสินทรัพย์</td>
                            <td>ชื่อผู้แจ้ง</td>
                            <td>สาขา</td>
                            <td>หมวดหมู่</td>
                            <td>รายละเอียด</td>
                            <td>ผู้อนุมัติ</td>
                            <td>สถานะ</td>
                            <td>ค่าใช้จ่าย</td>
                            <td>วันที่แจ้ง</td>
                            <td>เวลาที่แจ้ง</td>
                            <td>วันที่แล้วเสร็จ</td>
                            <td>เวลาที่แล้วเสร็จ</td>
                            <td>ผู้ทำรายการ</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        //$get_total = $getdata->my_sql_select($connect, null, 'asset', "as_keyID <> 'hidden' AND status = '1' ORDER BY date_insert DESC LIMIT 25");
                        while ($show_total = mysqli_fetch_object($getcaseshow)) {
                            $i++; ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><a href="?p=maintenance_case_all_service&key=<?php echo $show_total->ticket; ?>" target="_blank"><?php echo $show_total->ticket; ?></a> </td>
                                <!-- <td><?php echo @getemployee($show_total->user_key); ?></td>
                                <td><?php echo @getemployee_department($show_total->user_key); ?></td> -->
                                <td><?php echo $show_total->as_code; ?></td>
                                <td><?php
                                    $search = $getdata->my_sql_query($connect, NULL, "employee", "card_key ='" . $show_total->se_namecall . "'");
                                    if (COUNT($search) == 0) {
                                        $chkName = $show_total->se_namecall;
                                    } else {
                                        $chkName = getemployee($show_total->se_namecall);
                                    }

                                    echo $chkName;
                                    ?></td>
                                <td><?php echo @prefixbranch($show_total->se_location); ?></td>
                                <td><?php echo @service($show_total->se_id); ?></td>
                                <td><?php echo $show_total->se_other; ?></td>
                                <td><?php echo $show_total->se_approve; ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($show_total->se_id == '8' && $show_total->se_li_id == '154' && $show_total->manager_approve_status == 'Y' && $show_total->card_status == NULL) {
                                        echo '<span class="badge badge-info">รอ Support Manager อนุมัติ</span>';
                                    } else if (@$show_total->card_status == 'approve_mg' && ($show_total->approve_department == 'IT' ||  $show_total->approve_department != 'HR') || $show_total->card_status == 'work_cctv' || $show_total->card_status == 'work_hr') {
                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                    } else if ($show_total->card_status == 'wait_approve' && $show_total->approve_department == 'IT') {
                                        echo '<span class="badge badge-info">รออนุมัติแจ้งงาน</span>';
                                    } else if ($show_total->card_status  == 'wait_approve_hr' && $show_total->approve_department == 'HR') {
                                        echo '<span class="badge badge-info">รอการอนุมัติจาก HR</span>';
                                    } else if ($show_total->card_status == 'over_work') {
                                        echo '<span class="badge badge-danger">ปิดงานอัตโนมัติ</span>';
                                    } else if ($show_total->card_status == 'reject') {
                                        echo '<span class="badge badge-warning">ตรวจสอบอีกครั้ง</span>';
                                    } else if ($show_total->card_status == null && $show_total->work_flag == null) {
                                        echo '<span class="badge badge-danger">ยกเลิกงานโดยผู้แจ้ง</span>';
                                    } else {
                                        if (in_array($show_total->card_status, ['2e34609794290a770cb0349119d78d21', 'fe8ae3ced9e7e738d78589bf6610c4da']) && $show_total->work_flag != 'work_success') {
                                            echo '<span class="badge badge-info">รอ Support Manager ตรวจสอบ</span>';
                                        } else if ($show_total->card_status == 'approve_workcheck') {
                                            echo '<span class="badge badge-warning">รออนุมัติงานเสร็จ</span>';
                                        } else {
                                            if ($show_total->card_status == 'wait_approve') {
                                                echo '<span class="badge badge-info">รออนุมัติแจ้งงาน</span>';
                                            } else if ($show_total->card_status == 'wait_checkwork') {
                                                echo '<span class="badge badge-primary">รอตรวจสอบงานเสร็จจากผู้แจ้ง</span>';
                                            } else {
                                                echo @cardStatus($show_total->card_status);
                                            }
                                        }
                                    }

                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($show_total->se_price != NULL) {
                                        echo $show_total->se_price;
                                    } else {
                                        echo '<strong class="badge badge-danger">ไม่มีข้อมูล</font></strong>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo @dateConvertor($show_total->date); ?></td>
                                <td>
                                    <?php
                                    if (@$show_total->time_start != NULL & @$show_total->time_start != "00:00:00") {
                                        echo @$show_total->time_start;
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td><?php
                                    if ($show_total->date_update != "0000-00-00" && $show_total->card_status != "57995055c28df9e82476a54f852bd214") {
                                        echo @dateConvertor($show_total->date_update);
                                    } else if ($show_total->date_update == '0000-00-00') {
                                        echo @cardStatus($show_total->card_status);
                                    } else {
                                        if ($show_total->se_id == '8' && $show_total->se_li_id == '154' && $show_total->manager_approve_status == 'Y' && $show_total->card_status == NULL) {
                                            echo '<span class="badge badge-info">รอ Support Manager อนุมัติ</span>';
                                        } else if (@$show_total->card_status == 'approve_mg' && ($show_total->approve_department == 'IT' ||  $show_total->approve_department != 'HR') || $show_total->card_status == 'work_cctv' || $show_total->card_status == 'work_hr') {
                                            echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                        } else if ($show_total->card_status == 'wait_approve' && $show_total->approve_department == 'IT') {
                                            echo '<span class="badge badge-info">รออนุมัติแจ้งงาน</span>';
                                        } else if ($show_total->card_status  == 'wait_approve_hr' && $show_total->approve_department == 'HR') {
                                            echo '<span class="badge badge-info">รอการอนุมัติจาก HR</span>';
                                        } else if ($show_total->card_status == 'over_work') {
                                            echo '<span class="badge badge-danger">ปิดงานอัตโนมัติ</span>';
                                        } else if ($show_total->card_status == 'reject') {
                                            echo '<span class="badge badge-warning">ตรวจสอบอีกครั้ง</span>';
                                        } else if ($show_total->card_status == null && $show_total->work_flag == null) {
                                            echo '<span class="badge badge-danger">ยกเลิกงานโดยผู้แจ้ง</span>';
                                        }  else {
                                            if (in_array($show_total->card_status, ['2e34609794290a770cb0349119d78d21', 'fe8ae3ced9e7e738d78589bf6610c4da']) && $show_total->work_flag != 'work_success') {
                                                echo '<span class="badge badge-info">รอ Support Manager ตรวจสอบ</span>';
                                            } else if ($show_total->card_status == 'approve_workcheck') {
                                                echo '<span class="badge badge-warning">รออนุมัติงานเสร็จ</span>';
                                            } else {
                                                if ($show_total->card_status == 'wait_approve') {
                                                    echo '<span class="badge badge-info">รออนุมัติแจ้งงาน</span>';
                                                } else if ($show_total->card_status == 'wait_checkwork') {
                                                    echo '<span class="badge badge-primary">รอตรวจสอบงานเสร็จจากผู้แจ้ง</span>';
                                                } else {
                                                    echo @cardStatus($show_total->card_status);
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?php
                                    if ($show_total->card_status == "2e34609794290a770cb0349119d78d21" && $show_total->card_status != "57995055c28df9e82476a54f852bd214") {
                                        echo @$show_total->time_update;
                                    } elseif ($show_total->card_status == "57995055c28df9e82476a54f852bd214") {
                                        echo @cardStatus($show_total->card_status);
                                    } else {
                                        // echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                        echo @$show_total->time_update;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($show_total->admin_update != null) {
                                        echo @getemployee($show_total->admin_update);
                                    } else {
                                        if ($show_total->se_id == '8' && $show_total->se_li_id == '154' && $show_total->manager_approve_status == 'Y' && $show_total->card_status == NULL) {
                                            echo '<span class="badge badge-info">รอ Support Manager อนุมัติ</span>';
                                        } else if (@$show_total->card_status == 'approve_mg' && ($show_total->approve_department == 'IT' ||  $show_total->approve_department != 'HR') || $show_total->card_status == 'work_cctv' || $show_total->card_status == 'work_hr') {
                                            echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                        } else if ($show_total->card_status == 'wait_approve' && $show_total->approve_department == 'IT') {
                                            echo '<span class="badge badge-info">รออนุมัติแจ้งงาน</span>';
                                        } else if ($show_total->card_status  == 'wait_approve_hr' && $show_total->approve_department == 'HR') {
                                            echo '<span class="badge badge-info">รอการอนุมัติจาก HR</span>';
                                        } else if ($show_total->card_status == 'over_work') {
                                            echo '<span class="badge badge-danger">ปิดงานอัตโนมัติ</span>';
                                        } else if ($show_total->card_status == 'reject') {
                                            echo '<span class="badge badge-warning">ตรวจสอบอีกครั้ง</span>';
                                        } else if ($show_total->card_status == null && $show_total->work_flag == null) {
                                            echo '<span class="badge badge-danger">ยกเลิกงานโดยผู้แจ้ง</span>';
                                        } else {
                                            if (in_array($show_total->card_status, ['2e34609794290a770cb0349119d78d21', 'fe8ae3ced9e7e738d78589bf6610c4da']) && $show_total->work_flag != 'work_success') {
                                                echo '<span class="badge badge-info">รอ Support Manager ตรวจสอบ</span>';
                                            } else if ($show_total->card_status == 'approve_workcheck') {
                                                echo '<span class="badge badge-warning">รออนุมัติงานเสร็จ</span>';
                                            } else {
                                                if ($show_total->card_status == 'wait_approve') {
                                                    echo '<span class="badge badge-info">รออนุมัติแจ้งงาน</span>';
                                                } else if ($show_total->card_status == 'wait_checkwork') {
                                                    echo '<span class="badge badge-primary">รอตรวจสอบงานเสร็จจากผู้แจ้ง</span>';
                                                } else {
                                                    echo @cardStatus($show_total->card_status);
                                                }
                                            }
                                        }
                                    }

                                    ?>
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

<?php } ?>