<?php

if (isset($_POST['export'])) {


    // if ($_POST['month_case'] != NULL && $_POST['year_case'] == NULL) {
    //     $month_case = $_POST['month_case'];
    //     $getcaseshow = $getdata->my_sql_select($connect, NULL, "building_list", "ID <> 'hidden' AND date LIKE '%" . date("Y-" . $month_case . "") . "%' ORDER BY ticket", "ID");
    // }
    // if ($_POST['year_case'] != NULL && $_POST['month_case'] == NULL) {
    //     $year_case = $_POST['year_case'];
    //     $getcaseshow = $getdata->my_sql_select($connect, NULL, "building_list", "ID <> 'hidden' AND date LIKE '%" . date($year_case . "-m-" .  "") . "%' ORDER BY ticket", "ID");
    // }
    // if ($_POST['year_case'] != NULL && $_POST['month_case'] != NULL) {
    //     $month_case = $_POST['month_case'];
    //     $year_case = $_POST['year_case'];
    //     $getcaseshow = $getdata->my_sql_select($connect, NULL, "building_list", "ID <> 'hidden' AND date LIKE '%" . date($year_case . "-" . $month_case . "-" .  "") . "%' ORDER BY ticket", "ID");
    // }
    // if ($_POST['year_case'] == NULL && $_POST['month_case'] == NULL) {
    //     $getcaseshow = $getdata->my_sql_select($connect, NULL, "building_list", "ID <> 'hidden' ORDER BY ticket DESC");
    // }

    $month_case = isset($_POST['month_case']) ? $_POST['month_case'] : null;
    $year_case = isset($_POST['year_case']) ? $_POST['year_case'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;

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
    }
    $getcaseshow = $getdata->my_sql_select($connect, null, "building_list", $whereClause . " ORDER BY ticket ASC");


    $log_key = substr(md5(time("now")), 8, 16);
    $getdata->my_sql_insert($connect, "logs_keep", "
    ls_key = '" . $log_key . "',
    ls_text = 'ออกรายงานแจ้งซ่อม อาคาร',
    ls_user = '" . $_SESSION['ukey'] . "'
    ");
}
?>
<?php $getmenus = $getdata->my_sql_query($connect, null, 'menus', "menu_status ='1' AND menu_case = 'maintenance' AND menu_key != 'c6c8729b45d1fec563f8453c16ff03b8'"); ?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-file-download fa-2x"></i> ออกรายงาน <u> ฝ่ายอาคาร</u></h3>
    </div>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
    <ol class="breadcrumb breadcrumb-inverse">
        <li class="breadcrumb-item">
            <a href="index.php">หน้าแรก</a>
        </li>
        <li class="breadcrumb-item"><a href="index.php?p=maintenance"> <?php echo '<span>' . $getmenus->menu_name . '</span>'; ?></a></li>
        <li class="breadcrumb-item active" aria-current="page">ออกรายงาน</li>
    </ol>
</nav>

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-md font-weight-bold text-primary text-uppercase mb-1">จำนวนรายการแจ้งปัญหาเดือน <u><?php echo @month(); ?></u></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php @$getall = $getdata->my_sql_show_rows($connect, "building_list", "ID <> 'hidden' AND (date LIKE '%" . date("Y-m") . "%' )");
                                                                            echo @number_format($getall); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-md font-weight-bold text-info text-uppercase mb-1">จำนวนรายการแจ้งปัญหาวันนี้</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php @$getall = $getdata->my_sql_show_rows($connect, "building_list", "ID <> 'hidden' AND (date LIKE '%" . date("Y-m-d") . "%' )");
                                                                            echo @number_format($getall); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-md font-weight-bold text-success text-uppercase mb-1">จำนวนรายการแจ้งปัญหาที่เสร็จแล้ว</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php @$getall = $getdata->my_sql_show_rows($connect, "building_list", "card_status = '33831963cbe86c4e544c5a999984aa7b' AND (date LIKE '%" . date("Y-m") . "%' )");
                                                                            echo @number_format($getall); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-md font-weight-bold text-warning text-uppercase mb-1">จำนวนรายการแจ้งปัญหารอการแก้ไข</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php @$getwait = $getdata->my_sql_show_rows($connect, "building_list", "card_status IS NULL");
                                                                            echo @number_format($getwait); ?></div>
                    </div>
                    <div class="col-auto">
                        <?php
                        if ($getwait == 0) {
                            echo '<i class="fas fa-tools fa-2x text-gray-300"></i>';
                        } else {
                            echo '<div class="spinner-grow text-warning" role="status"></div>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">

                        <div class=" mb-0 font-weight-bold text-gray-800"><a href="?p=report_maintenance" class="text-danger">ออกรายงาน</a></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cloud-download-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">

                        <div class=" mb-0 font-weight-bold text-gray-800"><a href="?p=maintenance_show_work" class="text-primary">สรุปต่าง ๆ แยกตามประเภท</a></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="card card-default md-4 showdow text-center">
    <div class="card-header card-header-border-bottom justify-content-center">
        <h5 class="m-0 font-weight-bold text-center text-danger">ออกรายงาน</h5>
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo $SERVER_NAME; ?>" class="needs-validation">

            <div class="form-group row d-flex justify-content-center">
                <div class="col-md-4 col-sm-12">
                    <label for="month_case">ระบุเดือน</label>
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

                <div class="col-md-4 col-sm-12">
                    <label for="year_case">ระบุปี</label>
                    <?php
                    // Sets the top option to be the current year. (IE. the option that is chosen by default).
                    $currently_selected = date('Y');
                    // Year to start available options at
                    $earliest_year = 2020;
                    // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
                    $latest_year = date('Y');

                    print '<select name="year_case" id="year_case" class="form-control select2bs4">';
                    // Loops over each int[year] from current year, back to the $earliest_year [2020]
                    print '<option value="" selected>--- เลือกข้อมูล ---</option>';
                    foreach (range($latest_year, $earliest_year) as $i) {
                        // Prints the option with the next year in range.
                        print '<option value="' . $i . '"' . ($i === $currently_selected ?: '') . '>' . $i . '</option>';
                    }
                    print '</select>';
                    ?>
                </div>

                <div class="col-md-4 col-sm-12">
                    <label for="status">ระบุสถานะงาน</label>
                    <select name="status" id="status" class="form-control select2bs4">
                        <option value="" selected>--- เลือกข้อมูล ---</option>
                        <?php
                        $select_status = $getdata->my_sql_select($connect, NULL, "card_type", "ctype_status ='1' ORDER BY ctype_insert");

                        while ($show_status = mysqli_fetch_object($select_status)) {

                            echo '<option value="' . $show_status->ctype_key . '">' . $show_status->ctype_name . '</option>';
                        }



                        ?>
                    </select>
                </div>
            </div>

            <?php if (isset($_POST['export'])) { ?>

                <button class="ladda-button btn btn-primary btn-square btn-ladda bg-danger" onclick="reloadPage()" data-style="expand-left">
                    <span class="fas fa-trash-alt"> ล้างค่า</span>
                    <span class="ladda-spinner"></span>
                </button>

                <button class="ladda-button btn btn-primary btn-square btn-ladda bg-warning" data-style="expand-left" type="submit" name="export">
                    <span class="fas fa-file-download"> ออกรายงาน</span>
                    <span class="ladda-spinner"></span>
                </button>
            <?php } else { ?>
                <button class="ladda-button btn btn-primary btn-square btn-ladda bg-warning" data-style="expand-left" type="submit" name="export">
                    <span class="fas fa-file-download"> ค้นหา</span>
                    <span class="ladda-spinner"></span>
                </button>
            <?php } ?>
        </form>
    </div>
</div>

<?php if (isset($_POST['export'])) { ?>
    <div class="card">
        <div class="card-body">
            <div class="responsive-data-table">

                <table id="ForExport" class="table dt-responsive nowrap hover" style="font-family: sarabun; font-size: 14px;
    text-align: center;" width="100%">
                    <thead class="font-weight-bold text-center">
                        <tr>
                            <td>ลำดับ</td>
                            <td>Ticket</td>
                            <td>รหัสทรัพย์สิน</td>
                            <td>ชื่อผู้แจ้ง</td>
                            <td>สาขา</td>
                            <td>ผู้อนุมัติ</td>
                            <td>หมวดหมู่</td>
                            <td>รายละเอียด</td>
                            <td>สถานะ</td>
                            <td>ค่าใช้จ่าย</td>
                            <td>วันที่แจ้ง</td>
                            <td>เวลาที่แจ้ง</td>
                            <td>วันที่แล้วเสร็จ</td>
                            <td>ช่างผู้ดำเนินงาน</td>
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
                                <!-- <td><?php echo $i; ?></td> -->
                                <td><?php echo $show_total->ID; ?></td>
                                <td><?php echo $show_total->ticket; ?></td>
                                <td><?php if ($show_total->as_code != NULL) {
                                        echo $show_total->as_code;
                                    } else {
                                        echo '-';
                                    } ?></td>
                                <!-- <td><?php echo @getemployee($show_total->user_key); ?></td>
                                <td><?php echo @getemployee_department($show_total->user_key); ?></td> -->
                                <td><?php
                                    $search = $getdata->my_sql_query($connect, NULL, "employee", "card_key ='" . $show_total->se_namecall . "'");
                                    if (COUNT($search) == 0) {
                                        $chkName = $show_total->se_namecall;
                                    } else {
                                        $chkName = getemployee($show_total->se_namecall);
                                    }

                                    echo $chkName;
                                    ?></td>
                                <td><?php echo @prefixbranch($show_total->se_location) ?></td>
                                <td><?php echo $show_total->se_approve; ?></td>
                                <td><?php echo @service($show_total->se_id); ?></td>
                                <td><?php echo $show_total->se_other; ?></td>
                                <td class="text-center">
                                    <?php
                                    if (@$show_total->card_status == NULL) {
                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                    } else if ($show_total->card_status == 'wait_approve') {
                                        echo '<span class="badge badge-info">รออนุมัติแจ้งงาน</span>';
                                    } else if ($show_total->card_status == 'approve') {
                                        echo '<span class="badge badge-primary">รออนุมัติงานซ่อม</span>';
                                    } else {
                                        if ($show_total->card_status == 'approve_do') {
                                            echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                        } else if ($show_total->card_status == 'reject') {
                                            echo '<span class="badge badge-danger">ตรวจสอบงานอีกครั้ง</span>';
                                        } else {
                                            echo @cardStatus($show_total->card_status);
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
                                    } elseif ($show_total->card_status == "57995055c28df9e82476a54f852bd214") {
                                        echo @cardStatus($show_total->card_status);
                                    } else {
                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo !empty($show_total->name_mt) ? str_replace(",", ", ", $show_total->name_mt) : '-';?>
                                </td>

                                <td>
                                    <?php
                                    if ($show_total->card_status == "57995055c28df9e82476a54f852bd214") {
                                        echo @cardStatus($show_total->card_status);
                                    } else if (@$show_total->admin_update == NULL) {
                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                    } else {
                                        echo @getemployee($show_total->admin_update);
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