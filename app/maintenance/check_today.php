<?php
session_start();
error_reporting(0);
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");

$show_case = $getdata->my_sql_query($connect, null, "building_list", "date_update ='" . htmlspecialchars($_GET['key']) . "'");
?>
<div class="modal-header">
    <h5 class="modal-title font-weight-bold"> วันที่ <u><?php echo @dateConvertor(date("Y-m-d")); ?></u></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        <table class="table table-bordered table-hover text-center" width="100%" id="dataTablesFixwidht">
            <thead class="table-info text-center font-weight-bold">
                <tr>
                    <td>#</td>
                    <td>Ticket</td>
                    <td>ชื่อผู้แจ้งปัญหา</td>
                    <td>สาขา</td>
                    <td>วันที่แจ้ง</td>
                    <td>วันที่แล้วเสร็จ</td>
                    <td>สถานะ</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $u = 0;
                $getcase = $getdata->my_sql_select($connect, null, "building_list", "date_update ='" . htmlspecialchars($_GET['key']) . "' AND card_status != '33831963cbe86c4e544c5a999984aa7b'");

                while ($showcase = mysqli_fetch_object($getcase)) {
                    $u++;
                ?>
                    <tr>
                        <td><?php echo $u; ?></td>
                        <td><?php echo $showcase->ticket; ?></td>
                        <td><?php
                            $search = $getdata->my_sql_query($connect, NULL, "employee", "card_key ='" . $showcase->se_namecall . "'");
                            if (COUNT($search) == 0) {
                                $chkName = $showcase->se_namecall;
                            } else {
                                $chkName = getemployee($showcase->se_namecall);
                            }

                            echo $chkName;
                            ?></td>
                        <td><?php echo @prefixbranch($showcase->se_location); ?></td>
                        <td><?php echo @dateConvertor($showcase->date); ?></td>
                        <td><?php echo @dateConvertor($showcase->date_update); ?></td>
                        <td><?php if (@$showcase->card_status == NULL) {
                                        echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                    } else if ($showcase->card_status == 'wait_approve') {
                                        echo '<span class="badge badge-info">รออนุมัติแจ้งงาน</span>';
                                    } else if ($showcase->card_status == 'approve') {
                                        echo '<span class="badge badge-primary">รออนุมัติงานซ่อม</span>';
                                    } else if ($showcase->card_status == '2e34609794290a770cb0349119d78d21') {
                                        echo '<span class="badge badge-info">รอตรวจสอบงาน / ปิดงาน</span>';
                                    } else {
                                        if ($showcase->card_status == 'approve_do') {
                                            echo '<span class="badge badge-warning">รอดำเนินการแก้ไข</span>';
                                        } else if ($showcase->card_status == 'reject') {
                                            echo '<span class="badge badge-danger">ตรวจสอบงานอีกครั้ง</span>';
                                        } else {
                                            echo @cardStatus($showcase->card_status);
                                        }
                                    } ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>
<input type="text" name="key" hidden value="<?php echo $show_menu->user_key; ?>">
<script>
    $(document).ready(function() {

        $('#dataTablesFixwidht', '').dataTable({
            "autoWidth": false,
            "ordering": false,
        });
    });
</script>