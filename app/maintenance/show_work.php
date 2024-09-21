<!-- <META HTTP-EQUIV='Refresh' CONTENT='120; URL=' <?php $SERVER_NAME; ?>'> -->
<?php
$getalert = $getdata->my_sql_query($connect, NULL, "system_alert", NULL);
if (isset($_POST['save_offcase'])) {
    if (htmlspecialchars($_POST['off_case_status']) != NULL && htmlspecialchars($_POST['date_off_case']) != NULL) {
        $getdata->my_sql_update(
            $connect,
            "building_list",
            "card_status='" . htmlspecialchars($_POST['off_case_status']) . "',
      admin_update='" . $name_key . "',
      date_update='" . htmlspecialchars($_POST['date_off_case']) . "',
      time_update='" . date("H:i:s") . "'", //เพิ่ม เวลา
            "ticket='" . htmlspecialchars($_POST['card_key']) . "'"
        );

        $getdata->my_sql_insert(
            $connect,
            "building_comment",
            "card_status='" . htmlspecialchars($_POST['off_case_status']) . "',
      admin_update='" . $name_key . "',
      comment='" . htmlspecialchars($_POST['comment']) . "',
      date ='" . date("Y-m-d H:i:s") . "',
      ticket='" . htmlspecialchars($_POST['card_key']) . "'"
        );

        // ส่งข้อมูลเข้าไลน์
        $ticket = $_POST['ticket'];
        $name_admin = $_POST['admin'];
        $status = $_POST['off_case_status'];
        $date_send = date('d/m/Y');
        $time_send = date("H:i");

        $line_token = $getalert->alert_line_token; // Token
        $line_text = "
         /*** ตอบรับการดำเนินการ ***/
         ------------------------
         Ticket: {$ticket}
         ------------------------
         ผู้ดำเนินการ: {$name_admin}
         สถานะ: { " . @cardStatus_for_line($status) . " }
         ------------------------
         วันที่: {$date_send}
         เวลา: {$time_send}
         ";

        lineNotify($line_text, $line_token); // เรียกใช้ Functions line

        $alert = $success;
        echo "<META HTTP-EQUIV='Refresh' CONTENT = '1; URL='" . $SERVER_NAME . "'>";
    } else {
        $alert = $warning;
    }
}
?>
<?php $getmenus = $getdata->my_sql_query($connect, null, 'menus', "menu_status ='1' AND menu_case = 'maintenance' AND menu_key != 'c6c8729b45d1fec563f8453c16ff03b8'"); ?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-chart-bar fa-2x"></i> สรุปการทำงานเดือน <u><?php echo @month(); ?></u></h3>
    </div>
</div>

<?php echo $alert; ?>
<nav aria-label="breadcrumb" class="mt-3 mb-3">
    <ol class="breadcrumb breadcrumb-inverse">
        <li class="breadcrumb-item">
            <a href="index.php">หน้าแรก</a>
        </li>
        <li class="breadcrumb-item">
            <a href="index.php?p=maintenance"><?php echo '<span>' . $getmenus->menu_name . '</span>'; ?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">สรุปการทำงาน</li>
    </ol>
</nav>


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



<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ipills-summary-tab" data-toggle="pill" href="#ipills-summary" role="tab" aria-controls="ipills-summary" aria-selected="true">
                    <i class="mdi mdi-file-chart mr-1"></i> Summary</a>
            </li>

        </ul>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="ipills-summary" role="tabpanel" aria-labelledby="ipills-summary-tab">
            <div class="card-body">
                <div class="row ">
                    <div class="col-sm-4">
                        <ul class="nav nav-pills nav-stacked flex-column">
                            <li class="nav-item">
                                <a href="#all_company" class="nav-link active" data-toggle="tab" aria-expanded="true">
                                    <i class="mr-1 fas fa-home"></i> จำนวนแจ้งแต่ละบริษัท</a>
                            </li>
                            <li class="nav-item">
                                <a href="#all_department" class="nav-link" data-toggle="tab" aria-expanded="true">
                                    <i class="mr-1 fas fa-object-ungroup"></i> จำนวนแจ้งแต่ละแผนก</a>
                            </li>
                            <li class="nav-item">
                                <a href="#all_success" class="nav-link" data-toggle="tab" aria-expanded="false">
                                    <i class="mr-1 fas fa-clipboard-check"></i> จำนวนที่เสร็จสิ้น</a>
                            </li>
                            <li class="nav-item">
                                <a href="#all_wait" class="nav-link" data-toggle="tab">
                                    <i class="mr-1 fas fa-clock"></i> จำนวนที่รอแก้ไข</a>
                            </li>
                            <li class="nav-item">
                                <a href="#all_cancel" class="nav-link" data-toggle="tab">
                                    <i class="mr-1 fas fa-times-circle"></i> จำนวนยกเลิก</a>
                            </li>
                        </ul>
                    </div>


                    <div class="tab-content col-sm-8">
                        <div class="tab-pane fade show active" id="all_company" aria-expanded="true">
                            <div class="responsive-data-table">
                                <table id="responsive-data-table-summary" class="table dt-responsive nowrap" style="width:100%">
                                    <thead class="font-weight-bold text-center">
                                        <tr>
                                            <td>บริษัท</td>
                                            <td><i class="fa fa-clipboard-list" data-top="toptitle" data-placement="top" title="จำนวนรายการปัญหา"></i></td>
                                            <td><i class="fa fa-calendar-check" data-top="toptitle" data-placement="top" title="จำนวนที่แก้ไขแล้ว"></i></td>
                                            <td><i class="fa fa-cogs" data-top="toptitle" data-placement="top" title="จำนวนที่กำลังแก้ไข"></i></td>
                                            <td><i class="fa fa-user-clock" data-top="toptitle" data-placement="top" title="จำนวนที่รอการแก้ไข"></i></td>
                                            <td><i class="fa fa-user-times" data-top="toptitle" data-placement="top" title="จำนวนที่ยกเลิกแจ้ง"></i></td>
                                            <td>รายละเอียด</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $get_total = $getdata->my_sql_select($connect, NULL, "company", "id <> 'hidden' AND cp_status ='1' AND show_it = '1'");
                                        while ($show_total = mysqli_fetch_object($get_total)) {
                                            //จำนวนการแจ้งปัญหา 2
                                            $getc_all = $getdata->my_sql_show_rows($connect, "building_list", "company = '" . $show_total->id . "' AND (date LIKE '%" . date("Y-m") . "%' )");
                                            //จำนวนที่แก้ไขแล้ว 3
                                            $getc_success = $getdata->my_sql_show_rows($connect, "building_list", "company = '" . $show_total->id . "' AND card_status = '2e34609794290a770cb0349119d78d21' AND (date LIKE '%" . date("Y-m") . "%' )");
                                            //กำลังแก้ไข 4
                                            $getc_doing = $getdata->my_sql_show_rows($connect, "building_list", "company = '" . $show_total->id . "' AND card_status != '2e34609794290a770cb0349119d78d21' AND card_status != '57995055c28df9e82476a54f852bd214' AND (date LIKE '%" . date("Y-m") . "%' )");
                                            //รอการแก้ไข 5
                                            $getc_wait = $getdata->my_sql_show_rows($connect, "building_list", "company = '" . $show_total->id . "' AND (card_status IS NULL AND date LIKE '%" . date("Y-m") . "%' )");
                                            //ยกเลิกโดยผู้ใช้ 6
                                            $getc_cancel = $getdata->my_sql_show_rows($connect, "building_list", "company = '" . $show_total->id . "' AND card_status = '57995055c28df9e82476a54f852bd214' AND (date LIKE '%" . date("Y-m") . "%' )");
                                        ?>
                                            <tr>
                                                <td><?php echo @prefixConvertorCompany(@$show_total->id); ?></td>
                                                <td>
                                                    <?php
                                                    if (@$getc_all != 0) {
                                                        echo '<span class="badge badge-info">' . @number_format($getc_all) . '</span>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (@$getc_success != 0) {
                                                        echo '<span class="badge badge-success">' . @number_format($getc_success) . '</span>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (@$getc_doing != 0) {
                                                        echo '<span class="badge badge-primary">' . @number_format($getc_doing) . '</span>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (@$getc_wait != 0) {
                                                        echo '<span class="badge badge-warning">' . @number_format($getc_wait) . '</span>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (@$getc_cancel != 0) {
                                                        echo '<span class="badge badge-danger">' . @number_format($getc_cancel) . '</span>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    echo '<a href="?p=maintenance_case_all_company&key=' . @$show_total->id . '" target="_blank" class="btn btn-sm btn-primary btn-outline" data-top="toptitle" data-placement="top" title="ตรวจสอบเพิ่มเติม"><i class="fa fa-search-plus"></i></a>';
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <?php
                                    $getcase = $getdata->my_sql_show_rows($connect, "building_list", "ticket AND (date LIKE '%" . date("Y-m") . "%' )");
                                    $get_success = $getdata->my_sql_show_rows($connect, "building_list", "ticket AND card_status = '2e34609794290a770cb0349119d78d21' AND (date LIKE '%" . date("Y-m") . "%' )");
                                    $get_doing = $getdata->my_sql_show_rows($connect, "building_list", "ticket AND card_status != '2e34609794290a770cb0349119d78d21' AND card_status != '57995055c28df9e82476a54f852bd214' AND (date LIKE '%" . date("Y-m") . "%' )");
                                    $get_wait = $getdata->my_sql_show_rows($connect, "building_list", "ticket AND (card_status IS NULL AND date LIKE '%" . date("Y-m") . "%' )");
                                    $get_cancel = $getdata->my_sql_show_rows($connect, "building_list", "ticket AND card_status = '57995055c28df9e82476a54f852bd214' AND (date LIKE '%" . date("Y-m") . "%' )");
                                    ?>

                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="all_department" aria-expanded="true">
                            <div class="responsive-data-table">
                                <table id="responsive-data-table-summary-2" class="table dt-responsive nowrap" style="width:100%">
                                    <thead class="font-weight-bold text-center">
                                        <tr>
                                            <td>แผนก</td>
                                            <td><i class="fa fa-clipboard-list" data-top="toptitle" data-placement="top" title="จำนวนรายการปัญหา"></i></td>
                                            <td><i class="fa fa-calendar-check" data-top="toptitle" data-placement="top" title="จำนวนที่แก้ไขแล้ว"></i></td>
                                            <td><i class="fa fa-cogs" data-top="toptitle" data-placement="top" title="จำนวนที่กำลังแก้ไข"></i></td>
                                            <td><i class="fa fa-user-clock" data-top="toptitle" data-placement="top" title="จำนวนที่รอการแก้ไข"></i></td>
                                            <td><i class="fa fa-user-times" data-top="toptitle" data-placement="top" title="จำนวนที่ยกเลิกแจ้ง"></i></td>
                                            <td>รายละเอียด</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $get_total = $getdata->my_sql_select($connect, NULL, "department_name", "id <> 'hidden' AND department_status ='1'");
                                        while ($show_total = mysqli_fetch_object($get_total)) {
                                            //จำนวนการแจ้งปัญหา 2
                                            $getc_all = $getdata->my_sql_show_rows($connect, "building_list", "department = '" . $show_total->id . "' AND (date LIKE '%" . date("Y-m") . "%' )");
                                            //จำนวนที่แก้ไขแล้ว 3
                                            $getc_success = $getdata->my_sql_show_rows($connect, "building_list", "department = '" . $show_total->id . "' AND card_status = '2e34609794290a770cb0349119d78d21' AND (date LIKE '%" . date("Y-m") . "%' )");
                                            //กำลังแก้ไข 4
                                            $getc_doing = $getdata->my_sql_show_rows($connect, "building_list", "department = '" . $show_total->id . "' AND card_status != '2e34609794290a770cb0349119d78d21' AND card_status != '57995055c28df9e82476a54f852bd214' AND (date LIKE '%" . date("Y-m") . "%' )");
                                            //รอการแก้ไข 5
                                            $getc_wait = $getdata->my_sql_show_rows($connect, "building_list", "department = '" . $show_total->id . "' AND (card_status IS NULL AND date LIKE '%" . date("Y-m") . "%' )");
                                            //ยกเลิกโดยผู้ใช้ 6
                                            $getc_cancel = $getdata->my_sql_show_rows($connect, "building_list", "department = '" . $show_total->id . "' AND card_status = '57995055c28df9e82476a54f852bd214' AND (date LIKE '%" . date("Y-m") . "%' )");
                                        ?>
                                            <tr>
                                                <td><?php echo @prefixConvertorDepartment(@$show_total->id); ?></td>
                                                <td>
                                                    <?php
                                                    if (@$getc_all != 0) {
                                                        echo '<span class="badge badge-info">' . @number_format($getc_all) . '</span>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (@$getc_success != 0) {
                                                        echo '<span class="badge badge-success">' . @number_format($getc_success) . '</span>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (@$getc_doing != 0) {
                                                        echo '<span class="badge badge-primary">' . @number_format($getc_doing) . '</span>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (@$getc_wait != 0) {
                                                        echo '<span class="badge badge-warning">' . @number_format($getc_wait) . '</span>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (@$getc_cancel != 0) {
                                                        echo '<span class="badge badge-danger">' . @number_format($getc_cancel) . '</span>';
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    echo '<a href="?p=maintenance_case_all_department&key=' . @$show_total->id . '" target="_blank" class="btn btn-sm btn-primary btn-outline" data-top="toptitle" data-placement="top" title="ตรวจสอบเพิ่มเติม"><i class="fa fa-search-plus"></i></a>';
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <?php
                                    $getcase = $getdata->my_sql_show_rows($connect, "building_list", "ticket AND (date LIKE '%" . date("Y-m") . "%' )");
                                    $get_success = $getdata->my_sql_show_rows($connect, "building_list", "ticket AND card_status = '2e34609794290a770cb0349119d78d21' AND (date LIKE '%" . date("Y-m") . "%' )");
                                    $get_doing = $getdata->my_sql_show_rows($connect, "building_list", "ticket AND card_status != '2e34609794290a770cb0349119d78d21' AND card_status != '57995055c28df9e82476a54f852bd214' AND (date LIKE '%" . date("Y-m") . "%' )");
                                    $get_wait = $getdata->my_sql_show_rows($connect, "building_list", "ticket AND (card_status IS NULL AND date LIKE '%" . date("Y-m") . "%' )");
                                    $get_cancel = $getdata->my_sql_show_rows($connect, "building_list", "ticket AND card_status = '57995055c28df9e82476a54f852bd214' AND (date LIKE '%" . date("Y-m") . "%' )");
                                    ?>

                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="all_success" aria-expanded="false">
                            <div class="responsive-data-table">
                                <table id="responsive-data-table-it-success" class="table dt-responsive nowrap" style="width:100%">
                                    <thead class="font-weight-bold text-center">
                                        <tr>
                                            <td>Ticket</td>
                                            <td>ผู้แจ้ง</td>
                                            <td>แผนก</td>
                                            <td>วันที่แจ้ง</td>
                                            <td>วันที่แล้วเสร็จ</td>
                                            <td>สถานะ</td>
                                            <td><i class="mdi mdi-settings mdi-spin"></i></td>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $get_total = $getdata->my_sql_select($connect, NULL, "building_list", "card_status = '2e34609794290a770cb0349119d78d21' AND (date LIKE '%" . date("Y-m") . "%' ) ORDER BY ticket DESC");
                                        while ($show_total = mysqli_fetch_object($get_total)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo  $show_total->ticket;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo @getemployee($show_total->user_key); ?>
                                                </td>
                                                <td><?php echo @getemployee_department($show_total->user_key); ?></td>
                                                <td><?php echo @dateConvertor($show_total->date); ?></td>
                                                <td>
                                                    <?php
                                                    echo @dateConvertor($show_total->date_update);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo @cardStatus($show_total->card_status);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo '<a href="?p=maintenance_case_all_service&key=' . @$show_total->ticket . '" target="_blank" class="btn btn-sm btn-outline-success" data-top="toptitle" data-placement="top" title="ตรวจสอบเพิ่มเติม"><i class="fas fa-search-plus"></i></a>';
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
                        <div class="tab-pane fade" id="all_wait" aria-expanded="false">
                            <div class="responsive-data-table">
                                <table id="responsive-data-table-it-wait" class="table dt-responsive nowrap" style="width:100%">
                                    <thead class="font-weight-bold text-center">
                                        <tr>
                                            <td>Ticket</td>
                                            <td>ผู้แจ้ง</td>
                                            <td>แผนก</td>
                                            <td>วันที่แจ้ง</td>
                                            <td>สถานะ</td>
                                            <td><i class="mdi mdi-settings mdi-spin"></i></td>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $get_total = $getdata->my_sql_select($connect, NULL, "building_list", "card_status IS NULL AND date LIKE '%" . date("Y") . "%' ORDER BY ticket DESC");
                                        while ($show_total = mysqli_fetch_object($get_total)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo  $show_total->ticket;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo @getemployee($show_total->user_key); ?>
                                                </td>
                                                <td><?php echo @getemployee_department($show_total->user_key); ?></td>
                                                <td><?php echo @dateConvertor($show_total->date); ?></td>
                                                <td>
                                                    <?php
                                                    if (@$show_total->card_status == NULL) {
                                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo '<a href="#" data-toggle="modal" data-target="#off_case_maintenance" target="_blank" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-warning btn-outline" data-top="toptitle" data-placement="top" title="ดำเนินการ"><i class="fa fa-check-circle"></i></a>';
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
                        <div class="tab-pane fade" id="all_cancel" aria-expanded="false">
                            <div class="responsive-data-table">
                                <table id="responsive-data-table-it-cancel" class="table dt-responsive nowrap" style="width:100%">
                                    <thead class="font-weight-bold text-center">
                                        <tr>
                                            <td>Ticket</td>
                                            <td>ผู้แจ้ง</td>
                                            <td>แผนก</td>
                                            <td>วันที่แจ้ง</td>
                                            <td>สถานะ</td>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $get_total = $getdata->my_sql_select($connect, NULL, "building_list", "card_status = '57995055c28df9e82476a54f852bd214' AND date LIKE '%" . date("Y") . "%' ORDER BY ticket DESC");
                                        while ($show_total = mysqli_fetch_object($get_total)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo  $show_total->ticket;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo @getemployee($show_total->user_key); ?>
                                                </td>
                                                <td><?php echo @getemployee_department($show_total->user_key); ?></td>
                                                <td><?php echo @dateConvertor($show_total->date); ?></td>
                                                <td>
                                                    <?php
                                                    echo @cardStatus($show_total->card_status);
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
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer card-footer-border-bottom text-center">
        <a href="?p=maintenance" class="btn btn-md btn-outline-primary"><i class="fas fa-arrow-circle-left"></i> กลับ</a>
    </div>
</div>

<?php
$m1 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-01%'");
$m2 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-02%'");
$m3 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-03%'");
$m4 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-04%'");
$m5 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-05%'");
$m6 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-06%'");
$m7 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-07%'");
$m8 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-08%'");
$m9 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-09%'");
$m10 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-10%'");
$m11 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-11%'");
$m12 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-12%'");

?>

<script>
    var ctx = document.getElementById('workmonth').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['จำนวนการแจ้งปัญหา'],
            datasets: [{
                label: 'เดือน มกราคม',
                data: [
                    <?php echo $m1 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', // 12
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // 12
                ],
                borderWidth: 1
            }, {
                label: 'เดือน กุมภาพันธ์',
                data: [
                    <?php echo $m2 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน มีนาคม',
                data: [
                    <?php echo $m3 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน เมษายน',
                data: [
                    <?php echo $m4 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน พฤษภาคม',
                data: [
                    <?php echo $m5 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 15, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 15, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน มิถุนายน',
                data: [
                    <?php echo $m6 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(163, 15, 52, 0.2)',
                ],
                borderColor: [
                    'rgba(163, 15, 52, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน กรกฎาคม',
                data: [
                    <?php echo $m7 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(15, 163, 144, 0.2)',
                ],
                borderColor: [
                    'rgba(15, 163, 144, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน สิงหาคม',
                data: [
                    <?php echo $m8 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(126, 163, 15, 0.2)',
                ],
                borderColor: [
                    'rgba(126, 163, 15, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน กันยายน',
                data: [
                    <?php echo $m9 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(15, 163, 109, 0.2)',
                ],
                borderColor: [
                    'rgba(15, 163, 109, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน ตุลาคม',
                data: [
                    <?php echo $m10 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(15, 30, 163,  0.2)',
                ],
                borderColor: [
                    'rgba(15, 30, 163,  1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน พฤศจิกายน',
                data: [
                    <?php echo $m11 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(163, 141, 15, 0.2)',
                ],
                borderColor: [
                    'rgba(163, 141, 15, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน ธันวาคม',
                data: [
                    <?php echo $m12 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(163, 15, 124, 0.2)',
                ],
                borderColor: [
                    'rgba(163, 15, 124, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>