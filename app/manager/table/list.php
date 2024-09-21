<div class=" card-default text-center">
    <div class="responsive-data-table">
        <table id="responsive-data-table-it-use" class="table dt-responsive nowrap hover" style="width:100%">
            <thead class="font-weight-bold text-center">
                <tr>
                    <td>ลำดับ</td>
                    <td>ผู้บังคับบัญชา</td>
                    <td>ใต้ผู้บังคับบัญชา</td>
                    <td>จัดการ</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $getmanager = $getdata->my_sql_select($connect, NULL, "manager",NULL);
                while ($showData = mysqli_fetch_object($getmanager)) {
                    $x++;
                ?>
                    <tr>
                        <td align="center"><?php echo @$x; ?></td>
                        <td align="center"><?php echo @getemployee($showData->manager_user_key); ?></td>
                        <td align="center"><?php echo @getemployee($showData->user_key); ?></td>
                        
                        <td>
                            <!-- <a href="#" data-toggle="modal" data-target="#edit_employee" data-whatever="<?php echo @$showData->id; ?>" class="btn btn-sm btn-info" data-top="toptitle" data-placement="top" title="แก้ไขข้อมูล"><i class="fa fa-edit"></i></a> -->
                            <a href="#" onclick="deleteManager('<?php echo @$showData->id; ?>');" class="btn btn-sm btn-danger" data-toggle="toptitle" data-placement="top" title="ลบข้อมูล"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>