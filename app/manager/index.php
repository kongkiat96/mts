<?php $getmenus = $getdata->my_sql_query($connect, null, 'menus', "menu_status ='1' AND menu_case = '" . $_GET['p'] . "' AND menu_key != 'c6c8729b45d1fec563f8453c16ff03b8'"); ?>
<?php require_once 'procress/saveData.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><?php echo '<i class="fas ' . $getmenus->menu_icon . ' fa-2x"></i> <span>' . $getmenus->menu_name . '</span>'; ?></h3>
    </div>
</div>
<nav aria-label="breadcrumb" class="mt-3 mb-3">
    <ol class="breadcrumb breadcrumb-inverse">
        <li class="breadcrumb-item">
            <a href="index.php">หน้าแรก</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo '<span>' . $getmenus->menu_name . '</span>'; ?></li>
    </ol>
</nav>
<?php echo $alert; ?>
<!-- Modal Edit Employee -->
<div class="modal fade" id="edit_employee" role="dialog" aria-labelledby="edit_employee" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate id="waitsave3">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขข้อมูลพนักงาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="employee">

                </div>
                <div class="modal-footer">
                    <button class="ladda-button btn btn-info btn-square btn-ladda bg-info" data-style="expand-left" type="submit" name="save_edit_employee">
                        <span class="fas fa-sync-alt"> บันทึก</span>
                        <span class="ladda-spinner"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Modal -->

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2><?php echo '<span>' . $getmenus->menu_name . '</span>'; ?></h2>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="ipills-summary" role="tabpanel" aria-labelledby="ipills-summary-tab">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <ul class="nav nav-pills nav-stacked flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" id="employee-tab" data-toggle="tab" href="#employee" role="tab" aria-controls="employee" aria-selected="true"><i class="fas fa-address-book"></i> รายการพนักงาน</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="newemployee-tab" data-toggle="tab" href="#newemployee" role="tab" aria-controls="newemployee" aria-selected="false"><i class="fas fa-user-plus"></i> เพิ่มข้อมูลในระบบ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content col-md-10" id="myTabContent3">
                        <div class="tab-pane pt-3 fade show active" id="employee" role="tabpanel" aria-labelledby="employee-tab">
                            <div class="row">
                                <div class="col-12">
                                    <?php require_once 'table/list.php'; ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane pt-3 fade " id="newemployee" role="tabpanel" aria-labelledby="newemployee-tab">
                            <div class="row">
                                <div class="col-12">
                                    <?php require_once 'form/setmanager.php'; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>