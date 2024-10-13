<?php
require_once 'procress/save_user.php';
require_once 'procress/save_service_building.php';
echo @$alert;
?>
<script>
    function refreshData() {
        $.ajax({
            url: 'auto/sum_case_building.php',
            success: function(data) {
                $('#get_sum_building').html(data);
            }
        });
        $.ajax({
            url: 'auto/table_building_user.php',
            success: function(data) {
                $('#get_table_building').html(data);
            }
        });
        $.ajax({
            url: 'auto/list_approve.php',
            success: function(data) {
                $('#list_approve').html(data);
            }
        });
        $.ajax({
            url: 'auto/list_checkwork.php',
            success: function(data) {
                $('#list_checkwork').html(data);
            }
        });

        $.ajax({
            url: 'auto/list_check.php',
            success: function(data) {
                $('#list_check').html(data);
            }
        });

        $.ajax({
            url: 'auto/list_checkwork_ct.php',
            success: function(data) {
                $('#list_checkwork_ct').html(data);
            }
        });

        $.ajax({
            url: 'auto/list_check_ct.php',
            success: function(data) {
                $('#list_check_ct').html(data);
            }
        });

        $.ajax({
            url: 'auto/list_checkwork_user.php',
            success: function(data) {
                $('#list_checkwork_user').html(data);
            }
        });
    }

    $(document).ready(function() {
        refreshData(); // Call on document ready to load the data initially
        var refreshInterval = 10000; // Adjust the time interval as needed.
        setInterval(refreshData, refreshInterval);
    });
</script>


<!-- Modal Case Building -->
<div class="modal fade" id="newcasebuilding" role="dialog" aria-labelledby="AddNewCaseBuilding" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ขอใช้บริการแจ้งซ่อมฝ่ายอาคาร </h5>&nbsp;
                    <h4><span class="badge badge-success"><?php echo $runticket_bu; ?></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form add data -->
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="se_id">ประเภท</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="se_id" id="se_ids" onchange="getBuildingList(this.value)" required>
                                <option value="">--- เลือก ประเภท ---</option>
                                <?php
                                if ($_SESSION['uclass'] != 1) {
                                    $map = "('admin','user')";
                                } else {
                                    $map = "('user')";
                                }
                                $getprefix = $getdata->my_sql_select($connect, NULL, "service", "se_id AND se_status ='1' AND use_case IN $map ORDER BY se_sort");
                                while ($showservice = mysqli_fetch_object($getprefix)) {
                                    echo '<option value="' . $showservice->se_id . '">' . $showservice->se_name . '</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                เลือก ประเภท .
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="service_list">ปัญหาที่พบ</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="service_list" id="service_list" required>
                                <option value="">--- กรุณาเลือก ปัญหาที่พบ ---</option>
                            </select>
                            <div class="invalid-feedback">
                                เลือก ปัญหาที่พบ .
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-sm-12">
                            <label for="asset_code">รหัสสินทรัพย์</label>
                            <input type="text" name="as_code" id="asset_code" class="form-control" required>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="m_pic">รูปภาพประกอบ</label>
                            <input type="file" name="pic" id="m_pic" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="other">รายละเอียดเพิ่มเติม</label>
                            <textarea name="other" id="other" class="form-control" required></textarea>
                            <div class="invalid-feedback">
                                ระบุ รายละเอียดเพิ่มเติม .
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <div class="col-12">
                            <label for="condition">ข้อมูลการแจ้งการแจ้ง</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <input type="radio" name="case" id="case_me" value="me">
                            <label for="case_me">แจ้งสำหรับตนเอง</label>
                        </div>
                        <div class="col-6">
                            <input type="radio" name="case" id="case_other" value="other">
                            <label for="case_other">แจ้งให้ผู้อื่น</label>
                        </div>
                    </div> -->
                    <hr>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="namecall" id="namecallLabel">เลือกชื่อผู้แจ้ง <span class="text-danger">(กรณีแจ้งแทนผู้อื่น)</span></label>
                            <!-- <input type="text" class="form-control input-sm" name="namecall" id="namecall" required> -->
                            <select name="namecall" id="namecall" class="form-control select2bs4" style="width: 100%;">
                                <option value="">--- เลือกข้อมูล ---</option>
                                <?php $getuser = $getdata->my_sql_select($connect, NULL, "user", "user_status = '1'");
                                while ($showUser = mysqli_fetch_object($getuser)) {
                                    echo '<option value="' . $showUser->user_key . '">' .  getemployee($showUser->user_key) . '</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                เลือก ข้อมูล.
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="location" id="locationLabel">สาขา <span class="text-danger">(กรณีแจ้งแทนผู้อื่น)</span></label>
                            <select class="form-control select2bs4" style="width: 100%;" name="location" id="location">
                                <option value="">--- เลือก สาขา ---</option>
                                <?php
                                $getbranch = $getdata->my_sql_select($connect, NULL, "branch", "id AND status ='1' ORDER BY id ");
                                while ($showbranch = mysqli_fetch_object($getbranch)) {
                                    echo '<option value="' . $showbranch->id . '">' . $showbranch->branch_name . '</option>';
                                }
                                ?>
                            </select>

                            <div class="invalid-feedback">
                                เลือก สาขา.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="approve">ผู้อนุมัติ</label>
                            <!-- <input type="text" class="form-control" name="approve" id="approve"> -->
                            <input type="text" class="form-control input-sm" id="approve" name="approve">
                            <div class="invalid-feedback">
                                ระบุ สาขา.
                            </div>
                        </div>
                    </div>
                    <input type="text" hidden name="name_em" id="name_em" value="<?php echo @getemployee($getemployee->card_key); ?>" readonly>
                    <input type="text" hidden name="gt_department" id="gt_department" value="<?php echo @prefixConvertorDepartment($getemployee->user_department); ?>" readonly>
                    <input type="text" hidden name="department" id="department" value="<?php echo $getemployee->user_department; ?>" readonly>
                    <input type="text" hidden name="company" id="company" value="<?php echo $getemployee->department_id; ?>" readonly>
                </div> <!-- /.Form add data -->
                <div class="modal-footer justify-content-center">


                    <button class="ladda-button btn btn-primary btn-square btn-ladda bg-danger" type="submit" name="save_casebu" data-style="expand-left">
                        <span class="fas fa-paper-plane"> ส่งข้อมูล</span>
                        <span class="ladda-spinner"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>

<!-- End Modal new Case -->
<div class="modal fade" id="show_case_maintenance" role="dialog" aria-labelledby="show_case_maintenance" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate id="waitsave">
            <div class="modal-content">

                <div class="show_case">

                </div>
            </div>
        </form>
    </div>
</div>
<!-- End View -->

<div class="modal fade" id="approve-frm" role="dialog" aria-labelledby="approve-frm" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" enctype="multipart/form-data" class="was-validated" id="waitsave2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">อนุมัติรายการแจ้งซ่อม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="approve-frm">

                </div>

            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="reopen_case" role="dialog" aria-labelledby="reopen_case" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate id="waitsave">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แจ้งงานใหม่อีกครั้ง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="reopen_case">

                </div>
                <div class="modal-footer">

                    <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" type="submit" name="save_reopen_case" data-style="expand-left">
                        <span class="fas fa-save"> บันทึก</span>
                        <span class="ladda-spinner"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="mt-manager-frm" role="dialog" aria-labelledby="mt-manager-frm" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" enctype="multipart/form-data" class="was-validated" id="waitsave2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">อนุมัติรายการแจ้งซ่อม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="mt-manager-frm">

                </div>

            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="approve-mt-manager-frm" role="dialog" aria-labelledby="approve-mt-manager-frm" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" enctype="multipart/form-data" class="was-validated" id="waitsave2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เปลี่ยนแปลง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="approve-mt-manager-frm">

                </div>

            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="approve-mt-user-frm" role="dialog" aria-labelledby="approve-mt-user-frm" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" enctype="multipart/form-data" class="was-validated" id="waitsave2">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เปลี่ยนแปลง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="approve-mt-user-frm">

                </div>

            </div>
        </form>
    </div>
</div>

<!-- Cancel -->

<div class="modal fade" id="off_case_building" role="dialog" aria-labelledby="off_case_building" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate id="waitsave">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ดำเนินการ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="off_case_user">

                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Cancel -->
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

<div class="bg-white border rounded">
    <div class="row no-gutters">
        <div class="col-lg-3 col-xl-3">
            <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
                <div class="card text-center widget-profile px-0 border-0">
                    <div class="card-img mx-auto rounded-circle">
                        <img src="../assets/img/user/noimg.jpg" width="100%" alt="user image">
                    </div>
                    <div class="card-body">
                        <h4 class="py-2 text-dark"><?php echo @getemployee($userdata->user_key); ?></h4>
                        <p><?php echo @$userdata->email; ?></p>

                    </div>
                </div>

                <hr class="w-100">
                <div class="contact-info">
                    <h5 class="text-dark mb-1" style="text-transform: uppercase;">About Information</h5>
                    <p class="text-dark font-weight-medium pt-4 mb-2" style="text-decoration: underline;">Email address</p>
                    <p><?php echo @$userdata->email; ?></p>
                    <p class="text-dark font-weight-medium pt-4 mb-2" style="text-decoration: underline;">User ID</p>
                    <p><?php echo @$userdata->username; ?></p>
                    <p class="text-dark font-weight-medium pt-4 mb-2" style="text-decoration: underline;">แผนก</p>
                    <p><?php echo @getemployee_department($userdata->user_key); ?></p>
                </div>
                <hr class="w-100">
                <?php if ($_SESSION['uclass'] == 2 || $_SESSION['uclass'] == 3) { ?>
                    <?php @$gettoday = $getdata->my_sql_show_rows($connect, "building_list", "date_update LIKE '%" . date("Y-m-d") . "%' AND manager_approve_status = 'Y' AND card_status NOT IN ('wait_approve','approve','33831963cbe86c4e544c5a999984aa7b','57995055c28df9e82476a54f852bd214')"); ?>
                    <?php if ($gettoday >= '1') { ?>
                        <div class="contact-info">
                            <div class="alert alert-danger" role="alert">
                                <div class="col mr-2">
                                    <div class="text-md font-weight-bold text-danger text-uppercase mb-1" style="font-size: 14px"><a href="?p=maintenance_casetoday" class="text-danger">จำนวนรายการแจ้งปัญหาที่ต้องแล้วเสร็จวันนี้</a> </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @number_format($gettoday); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>





        </div>
        <div class="col-lg-8 col-xl-9">
            <div class="profile-content-right py-5">



                <ul class="nav nav-pills  px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" id="building-tab" data-toggle="tab" href="#building" role="tab" aria-controls="building" aria-selected="false">Ticket ของฉัน</a>
                    </li>
                    <?php
                    $chkManager =  $getdata->my_sql_query($connect, NULL, "manager", "manager_user_key = '" . $userdata->user_key . "'");

                    if (COUNT($chkManager->id) >= 1) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" id="approve-list-tab" data-toggle="tab" href="#approve-list" role="tab" aria-controls="approve-list" aria-selected="false">
                                รายการอนุมัติ</a>
                        </li>
                    <?php } ?>

                    <?php
                    $get_list_approve = $getdata->my_sql_query($connect, NULL, "list_admin_approve", "user_key = '" . $userdata->user_key . "' AND deleted = '0'");

                    if ($get_list_approve->approve_menu == 'approve_mts') { ?>
                        <li class="nav-item">
                            <a class="nav-link" id="checkwork-list-tab" data-toggle="tab" href="#checkwork-list" role="tab" aria-controls="checkwork-list" aria-selected="false">
                                รายการงานอนุมัติซ่อม ฝ่ายอาคาร</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="check-list-tab" data-toggle="tab" href="#check-list" role="tab" aria-controls="check-list" aria-selected="false">
                                รายการตรวจงานซ่อม ฝ่ายอาคาร</a>
                        </li>
                    <?php } else if ($get_list_approve->approve_menu == 'approve_cts') { ?>
                        <li class="nav-item">
                            <a class="nav-link" id="checkwork-list-ct-tab" data-toggle="tab" href="#checkwork-list-ct" role="tab" aria-controls="checkwork-list-ct" aria-selected="false">
                                รายการงานอนุมัติซ่อม เฟอร์นิเจอร์</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="check-list-ct-tab" data-toggle="tab" href="#check-list-ct" role="tab" aria-controls="check-list-ct" aria-selected="false">
                                รายการตรวจงานซ่อม เฟอร์นิเจอร์</a>
                        </li>
                    <?php } else if ($get_list_approve->approve_menu == 'approve_all') { ?>
                        <li class="nav-item">
                            <a class="nav-link" id="checkwork-list-tab" data-toggle="tab" href="#checkwork-list" role="tab" aria-controls="checkwork-list" aria-selected="false">
                                รายการงานอนุมัติซ่อม ฝ่ายอาคาร</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="check-list-tab" data-toggle="tab" href="#check-list" role="tab" aria-controls="check-list" aria-selected="false">
                                รายการตรวจงานซ่อม ฝ่ายอาคาร</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="checkwork-list-ct-tab" data-toggle="tab" href="#checkwork-list-ct" role="tab" aria-controls="checkwork-list-ct" aria-selected="false">
                                รายการงานอนุมัติซ่อม เฟอร์นิเจอร์</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="check-list-ct-tab" data-toggle="tab" href="#check-list-ct" role="tab" aria-controls="check-list-ct" aria-selected="false">
                                รายการตรวจงานซ่อม เฟอร์นิเจอร์</a>
                        </li>
                    <?php } ?>

                    <?php if ($_SESSION['uclass'] == '1') { ?>
                        <li class="nav-item">
                            <a class="nav-link" id="list-check-user-tab" data-toggle="tab" href="#list-check-user" role="tab" aria-controls="list-check-user" aria-selected="false">
                                รายการตรวจงานซ่อม</a>
                        </li>
                    <?php } ?>
                </ul>
                <hr>
                <div class="tab-content px-3 px-xl-5" id="myTabContent">

                    <div class="tab-pane fade show active" id="building" role="tabpanel" aria-labelledby="building-tab">
                        <div class="mt-3">

                        </div>
                        <div class="mt-3">
                            <div class="row" id="get_sum_building">
                                <div class="card-body d-flex align-items-center justify-content-center" style="height: 160px">
                                    <div class="sk-cube-grid">
                                        <div class="sk-cube sk-cube1"></div>
                                        <div class="sk-cube sk-cube2"></div>
                                        <div class="sk-cube sk-cube3"></div>
                                        <div class="sk-cube sk-cube4"></div>
                                        <div class="sk-cube sk-cube5"></div>
                                        <div class="sk-cube sk-cube6"></div>
                                        <div class="sk-cube sk-cube7"></div>
                                        <div class="sk-cube sk-cube8"></div>
                                        <div class="sk-cube sk-cube9"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="button" class="btn btn-danger mb-2 ml-3 btn-lg btn-pill" data-toggle="modal" data-target="#newcasebuilding"><span class="fas fa-toolbox"></span> แจ้งปัญหา</button>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="basic-data-table">
                                        <table class="table nowrap text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Case ID</th>
                                                    <th>Ticket</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Date success</th>
                                                    <th>ประวัติ</th>
                                                </tr>
                                            </thead>

                                            <tbody id="get_table_building">

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="approve-list" role="tabpanel" aria-labelledby="approve-list-tab">
                        <div class="mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="basic-data-table">
                                        <table class="table nowrap text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Case ID</th>
                                                    <th>Ticket</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Date success</th>

                                                    <th>จัดการ</th>
                                                </tr>
                                            </thead>

                                            <tbody id="list_approve">

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="checkwork-list" role="tabpanel" aria-labelledby="checkwork-list-tab">
                        <div class="mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="basic-data-table">
                                        <table class="table nowrap text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Case ID</th>
                                                    <th>Ticket</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Date success</th>

                                                    <th>จัดการ</th>
                                                </tr>
                                            </thead>

                                            <tbody id="list_checkwork">

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="check-list" role="tabpanel" aria-labelledby="check-list-tab">
                        <div class="mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="basic-data-table">
                                        <table class="table nowrap text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Case ID</th>
                                                    <th>Ticket</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Date success</th>

                                                    <th>จัดการ</th>
                                                </tr>
                                            </thead>

                                            <tbody id="list_check">

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="checkwork-list-ct" role="tabpanel" aria-labelledby="checkwork-list-ct-tab">
                        <div class="mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="basic-data-table">
                                        <table class="table nowrap text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Case ID</th>
                                                    <th>Ticket</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Date success</th>

                                                    <th>จัดการ</th>
                                                </tr>
                                            </thead>

                                            <tbody id="list_checkwork_ct">

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="check-list-ct" role="tabpanel" aria-labelledby="check-list-ct-tab">
                        <div class="mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="basic-data-table">
                                        <table class="table nowrap text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Case ID</th>
                                                    <th>Ticket</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Date success</th>

                                                    <th>จัดการ</th>
                                                </tr>
                                            </thead>

                                            <tbody id="list_check_ct">

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="list-check-user" role="tabpanel" aria-labelledby="list-check-user-tab">
                        <div class="mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="basic-data-table">
                                        <table class="table nowrap text-center" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Case IDs</th>
                                                    <th>Ticket</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th>Date success</th>

                                                    <th>จัดการ</th>
                                                </tr>
                                            </thead>

                                            <tbody id="list_checkwork_user">

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<hr class="sidebar-divider d-none d-md-block">
<div class="card">
    <div class="card-header">
        <h5>Ticket ของทีม</h5>
    </div>
    <div class="card-body m-3">
        <div class="responsive-data-table-home">
            <table id="for-home" class="table dt-responsive display nowrap hover" style="font-family: sarabun; font-size: 14px; text-align: center;" width="100%">
                <thead class="font-weight-bold text-center">
                    <tr>
                        <td>ลำดับ</td>
                        <td>Tickets</td>
                        <td>ชื่อผู้แจ้ง</td>
                        <td>สาขา</td>
                        <td>วันที่แจ้ง</td>

                        <td>สถานะ</td>

                        <td>วันที่แล้วเสร็จ</td>
                        <td>ผู้ดำเนินการ</td>
                        <td>ดำเนินการ</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    if ($_SESSION['uclass'] == 3 || $_SESSION['uclass'] == 2) {
                        $get_total = $getdata->my_sql_select($connect, NULL, "building_list", "card_status NOT IN ('wait_approve','approve') AND manager_approve_status = 'Y' ORDER BY ID desc LIMIT 100");
                    } else {
                        $get_total = $getdata->my_sql_select($connect, NULL, "building_list", "card_status NOT IN ('wait_approve','approve') AND manager_approve_status = 'Y' AND (user_key = '" . $_SESSION['ukey'] . "' OR manager_approve = '" . $_SESSION['ukey'] . "') AND work_flag NOT IN ('user_approve') ORDER BY ID desc LIMIT 100");
                    }

                    while ($show_total = mysqli_fetch_object($get_total)) {
                        $i++
                    ?>
                        <tr>
                            <td><?php echo $i;
                                @$show_total->ID; ?></td>
                            <td><?php echo @$show_total->ticket; ?></td>


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


                            <td><?php echo @dateConvertor($show_total->date); ?></td>


                            <td class="text-center">
                                <?php
                                if (@$show_total->card_status == NULL) {
                                    echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                } else if ($show_total->card_status == 'wait_approve') {
                                    echo '<span class="badge badge-info">รออนุมัติแจ้งงาน</span>';
                                } else if ($show_total->card_status == 'approve') {
                                    echo '<span class="badge badge-primary">รออนุมัติงานซ่อม</span>';
                                } else if ($show_total->card_status == '2e34609794290a770cb0349119d78d21') {
                                    echo '<span class="badge badge-info">รอตรวจสอบงาน / ปิดงาน</span>';
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

                            <td class="text-center">
                                <?php
                                if ($show_total->date_update != "0000-00-00" && $show_total->card_status != "57995055c28df9e82476a54f852bd214") {
                                    echo @dateConvertor($show_total->date_update);
                                } else if ($show_total->card_status == "57995055c28df9e82476a54f852bd214") {
                                    echo @cardStatus($show_total->card_status);
                                } else {
                                    echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                }
                                ?>
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
                            <td>
                                <?php if ($show_total->card_status == '57995055c28df9e82476a54f852bd214') {
                                    echo '<a href="#" data-toggle="modal" data-target="#reopen_case" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-danger  btn-outline" title="แจ้งงานอีกครั้ง"><i class="fa fa-retweet"></i></a>';
                                } ?>
                                <?php
                                echo '<a href="#" data-toggle="modal" data-target="#show_case_maintenance" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-info" title="ตรวจสอบ"><i class="fa fa-search"></i></a>&nbsp';
                                echo '<a href="?p=maintenance_case_all_service&key=' . @$show_total->ticket . '" class="btn btn-sm btn-success" title="ประวัติดำเนินงาน"><span class="fa fa-list-ul"></span></a>&nbsp';
                                ?>
                                <a href="maintenance/print_work.php?key=<?php echo @$show_total->ticket; ?>" target="_blank" class="btn btn-sm btn-outline-danger" title="พิมพ์ใบงาน"><i class="fa fa-print"></i></a>
                                <?php if ($_SESSION['uclass'] == '3' || $_SESSION['uclass'] == '2') {
                                    echo '<a href="#" data-toggle="modal" data-target="#edit_case" data-whatever="' . @$show_total->ticket . '" class="btn btn-sm btn-secondary  btn-outline" title="ดำเนินการ"><i class="fa fa-edit"></i></a>';
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
<script>
    $(document).ready(function() {
        $("#namecall").change(function() {
            var selectedValue = $(this).val();

            // ส่งค่าที่เลือกไปยัง PHP
            $.post("getmanager.php", {
                value: selectedValue
            }, function(data) {
                // แสดงผลลัพธ์ใน input
                $("#approve").val(data);
            });
        });
    });
    $(".old_password, .new_password, .conf_password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        input.attr("type", input.attr("type") === "password" ? "text" : "password");
    });

    $('#reopen_case').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'key=' + recipient;

        $.ajax({
            type: "GET",
            url: "otherfrm/reopen_case.php",
            data: dataString,
            cache: false,
            success: function(data) {
                modal.find('.reopen_case').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    // document.addEventListener('DOMContentLoaded', function() {
    //     // เรียกฟังก์ชันเมื่อมีการเปลี่ยนแปลงใน radio buttons
    //     document.querySelectorAll('input[type=radio][name="case"]').forEach(function(radio) {
    //         radio.addEventListener('change', function() {
    //             if (this.value === 'me') {
    //                 document.getElementById('namecallLabel').innerText = 'เลือกชื่อผู้แจ้ง';
    //                 document.getElementById('locationLabel').innerText = 'สาขา';
    //             } else if (this.value === 'other') {
    //                 document.getElementById('namecallLabel').innerText = 'เลือกชื่อผู้ที่จะแจ้งให้';
    //                 document.getElementById('locationLabel').innerText = 'สาขาที่จะแจ้ง';
    //             }
    //         });
    //     });
    // });
</script>