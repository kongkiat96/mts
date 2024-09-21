<?php require_once 'procress/dataSetting.php'; ?>
<?php echo @$alert; ?>
<div class="row">
    <div class="col-12">
        <h1 class="page-header"><i class="fa fa-user-friends fa-fw"></i> ข้อมูลการอนุมัติสิทธิ์สำหรับเจ้าหน้าที่</h1>
    </div>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
    <ol class="breadcrumb breadcrumb-inverse">
        <li class="breadcrumb-item">
            <a href="index.php">หน้าแรก</a>
        </li>
        <li class="breadcrumb-item" aria-current="page"><a href="index.php?p=setting">ตั้งค่า</a></li>
        <li class="breadcrumb-item active" aria-current="page">จัดการสิทธิ์อนุมัติ (เจ้าหน้าที่)</li>
    </ol>
</nav>

<div class="modal fade" id="add_approve" role="dialog" aria-labelledby="modal_add_approve" aria-hidden="true">
    <form method="post" class="needs-validation" novalidate>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">เพิ่มรายผู้อนุมัติสิทธิ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="list_admin">รายชื่อเจ้าหน้าที่</label>
                        <select name="list_admin" id="list_admin" class="form-control select2bs4" width="100%" required>
                            <option value="">--- เลือก รายชื่อเจ้าหน้าที่ ---</option>
                            <?php $getuser = $getdata->my_sql_select($connect, NULL, "user", "user_status = '1' AND user_class IN ('3','2')");
                            while ($showUser = mysqli_fetch_object($getuser)) {
                                echo '<option value="' . $showUser->user_key . '">' .  getemployee($showUser->user_key) . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            เลือก รายชื่อเจ้าหน้าที่
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="approve_menu">เมนูรายการอนุมัติ</label>
                        <select name="approve_menu" id="approve_menu" class="form-control select2bs4" width="100%" required>
                            <option value="">--- เลือก เมนูรายการอนุมัติ ---</option>
                            <option value="approve_all">เลือกทั้งหมด</option>
                            <option value="approve_mts">กลุ่มงาน ฝ่ายอาคาร</option>
                            <option value="approve_cts">กลุ่มงาน เฟอร์นิเจอร์</option>

                        </select>
                        <div class="invalid-feedback">
                            เลือก เมนูรายการอนุมัติ
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button class="btn btn-success btn-xs" type="submit" name="save_list_admin_approve">
                            <span class="fas fa-save"> บันทึก</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="edit_list_approve" role="dialog" aria-labelledby="modal_edit_list_approve" aria-hidden="true">
    <form method="post" class="needs-validation" novalidate>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold">แก้ไขข้อมูล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="edit_list_approve">

                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button class="btn btn-warning btn-xs" type="submit" name="edit_list_admin_approve">
                            <span class="fas fa-save"> บันทึก</span>
                        </button>
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
                <a class="nav-link text-primary active" id="access-tab" data-toggle="tab" href="#access" role="tab" aria-controls="access" aria-selected="true">รายการข้อมูลผู้อนุมัติสิทธิ์</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-panel fade show active" id="service" role="tabpanel" aria-labelledby="service-tab">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-end">
                            <button class="btn btn-success btn-xs m-3" data-toggle="modal" data-target="#add_approve"><i class="fa fa-plus fa-fw"></i> เพิ่มเจ้าหน้าที่</button>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover text-center" width="100%">
                                <thead class="table-primary font-weight-bold">
                                    <tr>
                                        <td width="5%">ลำดับ</td>
                                        <td>ชื่อ - นามสกุล</td>
                                        <td width="40%">Username</td>
                                        <td>รายการเข้าถึงเมนู</td>
                                        <td width="15%">จัดการ</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $a = 0;
                                    $get_list_approve = $getdata->my_sql_select($connect, null, "list_admin_approve", "deleted = 0 ORDER BY id DESC");
                                    while ($showlist_admin = mysqli_fetch_object($get_list_approve)) {
                                        $a++;
                                    ?>
                                        <tr>
                                            <td><?php echo @$a; ?></td>

                                            <td><?php echo getemployee($showlist_admin->user_key); ?></td>
                                            <td><?php echo @Userlogin($showlist_admin->user_key); ?></td>
                                            <td>
                                                <?php
                                                if ($showlist_admin->approve_menu == 'approve_all') {
                                                    echo '<span class="badge bg-info">เข้าถึงทั้งหมด</span>';
                                                } else if ($showlist_admin->approve_menu == 'approve_mts') {
                                                    echo '<span class="badge bg-primary">กลุ่มงาน ฝ่ายอาคาร</span>';
                                                } else {
                                                    echo '<span class="badge bg-warning">กลุ่มงาน เฟอร์นิเจอร์</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_list_approve" data-whatever="<?php echo @$showlist_admin->id; ?>" title="แก้ไข"><i class="fa fa-edit fa-fw"></i></button>
                                                <a href="#" onclick="deleteAdminApprove('<?php echo @$showlist_admin->id; ?>');" class="btn btn-sm btn-danger" title="ลบรายการนี้"><i class="fa fa-times"></i></a>
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

<script type="text/javascript">
    function deleteAdminApprove(id) {
        Swal.fire({
            title: 'ต้องการลบข้อมูลนี้ใช่หรือไม่',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันการลบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: "Deleted !!!",
                    html: "<h4>กำลังลบข้อมูล...</h4>",
                    showConfirmButton: false
                })
                window.location = "function.php?type=delete_admin_approve&key=" + id;
            }
        })
    }

    $('#edit_list_approve').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'key=' + recipient;

        $.ajax({
            type: "GET",
            url: "settings/edit/edit_list_approve.php",
            data: dataString,
            cache: false,
            success: function(data) {
                modal.find('.edit_list_approve').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    })
</script>