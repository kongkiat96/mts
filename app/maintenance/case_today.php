<?php
include_once 'procress/dataSave.php';
?>
<?php
$date_start = $_POST['date_start'];
$date_end = $_POST['date_end'];
if (isset($_POST['search'])) {
    if ($_POST['date_start'] != null && $_POST['date_end'] != null) {
        $getquery =  $getdata->my_sql_select($connect, null, "building_list", "date_update >= '" . $date_start . "'  AND date_update <= '" . $date_end . "' ORDER BY ticket DESC");
    } elseif ($_POST['date_start'] != null && $_POST['date_end'] == null) {
        $getquery =  $getdata->my_sql_select($connect, null, "building_list", "date_update >= '" . $date_start . "' ORDER BY ticket DESC");
    } elseif ($_POST['date_start'] == null && $_POST['date_end'] != null) {
        $getquery =  $getdata->my_sql_select($connect, null, "building_list", "date_update <= '" . $date_end . "' ORDER BY ticket DESC");
    } else {
        $getquery =  $getdata->my_sql_select($connect, null, "building_list", "date_update = '" . date('Y-m-d') . "' ORDER BY ticket DESC");
    }
}

?>
<?php $getmenus = $getdata->my_sql_query($connect, null, 'menus', "menu_status ='1' AND menu_case = 'maintenance' AND menu_key != 'c6c8729b45d1fec563f8453c16ff03b8'"); ?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fas fa-clipboard-list fa-2x"></i> ตรวจสอบรายการแล้วเสร็จ ประจำวันที่ <?php echo @dateConvertor(date('Y-m-d')); ?></h3>
    </div>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
    <ol class="breadcrumb breadcrumb-inverse">
        <li class="breadcrumb-item">
            <a href="index.php">หน้าแรก</a>
        </li>
        <li class="breadcrumb-item"><a href="index.php?p=maintenance"> <?php echo '<span>' . $getmenus->menu_name . '</span>'; ?></a></li>
        <li class="breadcrumb-item active" aria-current="page">รายการแล้วเสร็จวันนี้</li>
    </ol>
</nav>


<div class="modal fade" id="showcase_today" tabindex="-1" role="dialog" aria-labelledby="modal_showcase_today" aria-hidden="true">
    <form method="post" action="<?php echo $SERVER_NAME; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="showcase_today">

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



<div class="modal fade" id="show_case_maintenance" role="dialog" aria-labelledby="show_case_maintenance" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="show_case">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="off_case_maintenance" role="dialog" aria-labelledby="off_case_maintenance" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate id="waitsave">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ดำเนินการ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="offcase">

                </div>
                <div class="modal-footer">

                    <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" type="submit" name="save_offcase" data-style="expand-left">
                        <span class="fas fa-save"> บันทึก</span>
                        <span class="ladda-spinner"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_case" role="dialog" aria-labelledby="edit_case" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate id="waitsave">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ดำเนินการ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="editcase">

                </div>
                <div class="modal-footer">

                    <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" type="submit" name="save_editcase" data-style="expand-left">
                        <span class="fas fa-save"> บันทึก</span>
                        <span class="ladda-spinner"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php echo @$alert; ?>

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
    <?php if ($_SESSION['uclass'] == 2 || $_SESSION['uclass'] == 3) { ?>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-danger text-uppercase mb-1"><a href="?p=maintenance_casetoday" class="text-danger">จำนวนรายการแจ้งปัญหาที่ต้องแล้วเสร็จวันนี้</a> <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#showcase_today" data-whatever="<?php echo date("Y-m-d"); ?>" data-top="toptitle" data-placement="top" title="วันที่ <?php echo @dateConvertor(date("Y-m-d")); ?>"> <i class="fa fa-search fa-fw"></i></button></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php @$gettoday = $getdata->my_sql_show_rows($connect, "building_list", "ID <> 'hidden' AND (date_update LIKE '%" . date("Y-m-d") . "%' )");
                                                                                echo @number_format($gettoday); ?></div>
                        </div>
                        <div class="col-auto">

                            <?php if ($gettoday == '0') { ?>

                                <i class="fas fa-tasks fa-2x text-gray-300"></i>
                            <?php } else { ?>
                                <div class="sk-double-bounce">
                                    <div class="double-bounce1" style="background-color: red"></div>
                                    <div class="double-bounce2"></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php if ($_SESSION['uclass'] == 2 || $_SESSION['uclass'] == 3) { ?>
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
                            <div class="text-md font-weight-bold text-warning text-uppercase mb-1"><a href="?p=maintenance" class="text-warning">จำนวนรายการแจ้งปัญหารอการแก้ไข</a></div>
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

                            <div class=" mb-0 font-weight-bold text-gray-800"><a href="?p=report_maintenance" class="text-secondary">ออกรายงาน</a></div>
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
    <div class="card card-default md-4 showdow">
        <div class="card-header card-header-border-bottom justify-content-center">
            <h5 class="m-0 font-weight-bold text-center text-info">กรณีต้องการตรวจสอบระหว่างช่วงวัน</h5>
        </div>
        <div class="card-body">
            <div class="col-12 text-center">
                <form action="<?php echo $SERVER_NAME; ?>" method="post">
                    <div class="form-group row">
                        <div class="col-md-2 col-sm-12">
                            <label for="date_start">วันที่เริ่มต้น</label>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <input type="date" name="date_start" id="date_start" class="form-control" onfocus="this.value=''" value="<?php echo $date_start; ?>">
                        </div>
                        <div class="col-2"><label for="to">ถึง</label></div>
                        <div class="col-md-2 col-sm-12">
                            <label for="date_end">วันที่สิ้นสุด</label>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <input type="date" name="date_end" id="date_end" class="form-control" placeholder="" onfocus="this.value=''" value="<?php echo $date_end; ?>">
                        </div>
                    </div>
                    <?php if (isset($_POST['search'])) { ?>
                        <button class="ladda-button btn btn-primary btn-square btn-ladda bg-danger" onclick="reloadPage()" data-style="expand-left">
                            <span class="fas fa-trash-alt"> ล้างค่า</span>
                            <span class="ladda-spinner"></span>
                        </button>

                        <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" data-style="expand-left" type="submit" name="search">
                            <span class="fas fa-search"> ตรวจสอบ</span>
                            <span class="ladda-spinner"></span>
                        </button>
                    <?php } else { ?>
                        <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" data-style="expand-left" type="submit" name="search">
                            <span class="fas fa-search"> ตรวจสอบ</span>
                            <span class="ladda-spinner"></span>
                        </button>
                    <?php } ?>
                </form>

            </div>
        </div>
    </div>

    <div class="card card-default md-4 showdow">
        <div class="card-header card-header-border-bottom justify-content-center">
            <h5 class="m-0 font-weight-bold text-center text-danger">รายการแจ้งปัญหาที่ต้องแล้วเสร็จวันนี้</h5>
        </div>

        <div class="card-body">
            <div class="responsive-data-table">
                <table id="responsive-data-table-summary" class="table dt-responsive nowrap hover" style="width:100%">
                    <thead class="font-weight-bold text-center">
                        <tr>
                            <td>ลำดับ</td>
                            <td>Tickets</td>
                            <td>ชื่อผู้แจ้ง</td>
                            <td>สาขา</td>
                            <td>วันที่แจ้ง</td>
                            <td>เวลา</td>
                            <td>สถานะ</td>
                            <td>ค่าใช้จ่าย</td>
                            <td>ดำเนินการ</td>
                            <td>ผู้ดำเนินการ</td>
                            <td>วันที่แล้วเสร็จ</td>
                            <td>ประวัติรับผิดชอบ</td>

                        </tr>
                    </thead>
                    <?php if (isset($_POST['search'])) { ?>
                        <tbody>
                        <?php
                        $i = 0;
                        // $get_total = $getdata->my_sql_select($connect, NULL, "building_list", "ID AND card_status NOT IN ('2e34609794290a770cb0349119d78d21','57995055c28df9e82476a54f852bd214') OR card_status IS NULL ORDER BY ticket DESC");
                        $get_total = $getdata->my_sql_select($connect, NULL, "building_list", "date LIKE '%" . date('Y') . "%' AND card_status NOT IN ('wait_approve','approve','57995055c28df9e82476a54f852bd214') AND work_flag NOT IN ('work_success') OR card_status IS NULL OR card_status = 'approve_do' ORDER BY ticket DESC");
                        while ($show_total = mysqli_fetch_object($get_total)) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo @$i; ?></td>
                                <td><?php echo @$show_total->ticket; ?></td>

                                <!-- <td><?php echo @getemployee($show_total->user_key); ?></td> -->
                                <td><?php
                                    $search = $getdata->my_sql_query($connect, NULL, "employee", "card_key ='" . $show_total->se_namecall . "'");
                                    if (COUNT($search) == 0) {
                                        $chkName = $show_total->se_namecall;
                                    } else {
                                        $chkName = getemployee($show_total->se_namecall);
                                    }

                                    echo $chkName;
                                    ?></td>
                                <!-- <td><?php echo @getemployee_department($show_total->user_key); ?></td> -->
                                <td><?php echo @prefixbranch($show_total->se_location) ?></td>


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

                                <td class="text-center">
                                    <?php
                                    if (@$show_total->card_status == NULL || @$show_total->card_status == 'approve_do') {
                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                    }  else if ($show_total->card_status == 'reject'){
                                        echo '<span class="badge badge-danger">ตรวจสอบงานอีกครั้ง</span>';
                                    }else {
                                         if ($show_total->card_status == '2e34609794290a770cb0349119d78d21') {
                                            echo '<span class="badge badge-info">รอตรวจสอบงาน / ปิดงาน</span>';
                                        } else {
                                            echo @cardStatus($show_total->card_status);
                                        }
                                    }

                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($show_total->se_price != NULL) {
                                        echo number_format("$show_total->se_price", 2);
                                    } else {
                                        echo '<strong class="badge badge-danger">ไม่มีข้อมูล</font></strong>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo '<a href="#" data-toggle="modal" data-target="#show_case_maintenance" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-info" data-top="toptitle" data-placement="top" title="ตรวจสอบ"><i class="fa fa-search"></i></a>&nbsp';

                                    if (@$show_total->admin_update == NULL) {
                                        echo '<a href="#" data-toggle="modal" data-target="#off_case_maintenance" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-warning btn-outline" data-top="toptitle" data-placement="top" title="ดำเนินการ"><i class="fa fa-check-circle"></i></a>';
                                    } else if (@$show_total->date_update == '0000-00-00') {
                                        echo '<a href="#" data-toggle="modal" data-target="#off_case_maintenance" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-success btn-outline" data-top="toptitle" data-placement="top" title="ดำเนินการ"><i class="fa fa-check-circle"></i></a>';
                                    } else {
                                        echo '<a href="#" data-toggle="modal" data-target="#off_case_maintenance" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-success btn-outline" data-top="toptitle" data-placement="top" title="ดำเนินการ"><i class="fa fa-check-circle"></i></a>';
                                    }
                                    ?>
                                    <a href="maintenance/print_work.php?key=<?php echo @$show_total->ticket; ?>" target="_blank" class="btn btn-sm btn-outline-danger" data-toggle="toptitle" data-placement="top" title="พิมพ์ใบงาน"><i class="fa fa-print"></i></a>
                                    <?php if ($_SESSION['uclass'] == '3' || $_SESSION['uclass'] == '2') {
                                        echo '<a href="#" data-toggle="modal" data-target="#edit_case" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-secondary  btn-outline" data-top="toptitle" data-placement="top" title="ดำเนินการ"><i class="fa fa-edit"></i></a>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (@$show_total->admin_update == NULL) {
                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                    } else {
                                        echo @getemployee($show_total->admin_update);
                                    }

                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if (@$show_total->date_update == '0000-00-00') {
                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                    } else {
                                        echo @dateConvertor($show_total->date_update);
                                    } ?>
                                </td>
                                <td class="text-center"> <?php echo '
                <a href="?p=maintenance_case_all_service&key=' . @$show_total->ticket . '" class="btn btn-sm btn-success" data-top="toptitle" data-placement="top" title="ตรวจสอบ"><span class="fa fa-list-ul"></span></a>'; ?>

                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <?php } else { ?>
                        <tbody>
                        <?php
                        $i = 0;
                        // $get_total = $getdata->my_sql_select($connect, NULL, "building_list", "ID AND card_status NOT IN ('2e34609794290a770cb0349119d78d21','57995055c28df9e82476a54f852bd214') OR card_status IS NULL ORDER BY ticket DESC");
                        $get_total = $getdata->my_sql_select($connect, NULL, "building_list", "date LIKE '%" . date('Y') . "%' AND card_status NOT IN ('wait_approve','approve','57995055c28df9e82476a54f852bd214') AND work_flag NOT IN ('work_success') OR card_status IS NULL OR card_status = 'approve_do' ORDER BY ticket DESC");
                        while ($show_total = mysqli_fetch_object($get_total)) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo @$i; ?></td>
                                <td><?php echo @$show_total->ticket; ?></td>

                                <!-- <td><?php echo @getemployee($show_total->user_key); ?></td> -->
                                <td><?php
                                    $search = $getdata->my_sql_query($connect, NULL, "employee", "card_key ='" . $show_total->se_namecall . "'");
                                    if (COUNT($search) == 0) {
                                        $chkName = $show_total->se_namecall;
                                    } else {
                                        $chkName = getemployee($show_total->se_namecall);
                                    }

                                    echo $chkName;
                                    ?></td>
                                <!-- <td><?php echo @getemployee_department($show_total->user_key); ?></td> -->
                                <td><?php echo @prefixbranch($show_total->se_location) ?></td>


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

                                <td class="text-center">
                                    <?php
                                    if (@$show_total->card_status == NULL || @$show_total->card_status == 'approve_do') {
                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                    }  else if ($show_total->card_status == 'reject'){
                                        echo '<span class="badge badge-danger">ตรวจสอบงานอีกครั้ง</span>';
                                    }else {
                                         if ($show_total->card_status == '2e34609794290a770cb0349119d78d21') {
                                            echo '<span class="badge badge-info">รอตรวจสอบงาน / ปิดงาน</span>';
                                        } else {
                                            echo @cardStatus($show_total->card_status);
                                        }
                                    }

                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($show_total->se_price != NULL) {
                                        echo number_format("$show_total->se_price", 2);
                                    } else {
                                        echo '<strong class="badge badge-danger">ไม่มีข้อมูล</font></strong>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo '<a href="#" data-toggle="modal" data-target="#show_case_maintenance" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-info" data-top="toptitle" data-placement="top" title="ตรวจสอบ"><i class="fa fa-search"></i></a>&nbsp';

                                    if (@$show_total->admin_update == NULL) {
                                        echo '<a href="#" data-toggle="modal" data-target="#off_case_maintenance" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-warning btn-outline" data-top="toptitle" data-placement="top" title="ดำเนินการ"><i class="fa fa-check-circle"></i></a>';
                                    } else if (@$show_total->date_update == '0000-00-00') {
                                        echo '<a href="#" data-toggle="modal" data-target="#off_case_maintenance" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-success btn-outline" data-top="toptitle" data-placement="top" title="ดำเนินการ"><i class="fa fa-check-circle"></i></a>';
                                    } else {
                                        echo '<a href="#" data-toggle="modal" data-target="#off_case_maintenance" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-success btn-outline" data-top="toptitle" data-placement="top" title="ดำเนินการ"><i class="fa fa-check-circle"></i></a>';
                                    }
                                    ?>
                                    <a href="maintenance/print_work.php?key=<?php echo @$show_total->ticket; ?>" target="_blank" class="btn btn-sm btn-outline-danger" data-toggle="toptitle" data-placement="top" title="พิมพ์ใบงาน"><i class="fa fa-print"></i></a>
                                    <?php if ($_SESSION['uclass'] == '3' || $_SESSION['uclass'] == '2') {
                                        echo '<a href="#" data-toggle="modal" data-target="#edit_case" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-secondary  btn-outline" data-top="toptitle" data-placement="top" title="ดำเนินการ"><i class="fa fa-edit"></i></a>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (@$show_total->admin_update == NULL) {
                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                    } else {
                                        echo @getemployee($show_total->admin_update);
                                    }

                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if (@$show_total->date_update == '0000-00-00') {
                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                    } else {
                                        echo @dateConvertor($show_total->date_update);
                                    } ?>
                                </td>
                                <td class="text-center"> <?php echo '
                <a href="?p=maintenance_case_all_service&key=' . @$show_total->ticket . '" class="btn btn-sm btn-success" data-top="toptitle" data-placement="top" title="ตรวจสอบ"><span class="fa fa-list-ul"></span></a>'; ?>

                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
<?php } elseif ($_SESSION['uclass'] == 1) { ?>

    <div class=" row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2><span class="mdi mdi-format-list-checks"></span>
                        รายการแจ้งปัญหาของคุณทั้งหมด</h2>
                </div>

                <div class="card-body">
                    <div class="basic-data-table">
                        <table id="data-home-it" class="table hover nowrap text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ticket</th>
                                    <th>วันที่</th>
                                    <th>ผู้ดำเนินการ</th>
                                    <th>สถานะ</th>
                                    <th>วันที่อัพเดต</th>
                                    <th>ดำเนินการ</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 0;
                                $get_total = $getdata->my_sql_select($connect, NULL, "building_list", "user_key = '" . $_SESSION['ukey'] . "'ORDER BY ticket ASC");
                                while ($show_total = mysqli_fetch_object($get_total)) {
                                    $i++;
                                ?>
                                    <tr>
                                        <td><?php echo @$i; ?></td>
                                        <td><?php echo @$show_total->ticket; ?></td>
                                        <td><?php echo @dateConvertor($show_total->date); ?></td>
                                        <td>
                                            <?php
                                            if (@$show_total->admin_update == NULL) {
                                                echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                            } else {
                                                echo @getemployee($show_total->admin_update);
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (@$show_total->card_status == NULL) {
                                                echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                            } else {
                                                echo @cardStatus($show_total->card_status);
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (@$show_total->date_update == '0000-00-00') {
                                                echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                            } else {
                                                echo @dateConvertor($show_total->date_update);
                                            }  ?>
                                        </td>
                                        <td>
                                            <a href="?p=case_all_service&key=<?php echo @$show_total->ticket; ?>" target="_blank" class="btn btn-sm btn-success" data-top="toptitle" data-placement="top" title="ตรวจสอบ"><span class="mdi mdi-timeline-text-outline"></span></a>
                                        </td>

                                    </tr>


                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>

<?php } ?>