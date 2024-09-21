<?php

if (isset($_POST['export'])) {

    if ($_POST['department'] != NULL) {
        $department = $_POST['department'];


        $getexport = $getdata->my_sql_select($connect, NULL, "card_info", "card_customer_name = '" . @getemployee_department($department) . "' AND card_delete = '1' ORDER BY card_equipment", "card_key");
    } else {
        $getexport = $getdata->my_sql_select($connect, NULL, "card_info", "card_key <> 'hidden' ORDER BY card_equipment DESC");
    }


    $log_key = substr(md5(time("now")), 8, 16);
    $getdata->my_sql_insert($connect, "logs_keep", "
    ls_key = '" . $log_key . "',
    ls_text = 'ออกรายงานสินทรัพย์ IT',
    ls_user = '" . $_SESSION['ukey'] . "'
    ");
}
?>
<div class=" card-default text-center">
    <form method="post" action="<?php echo $SERVER_NAME; ?>" class="needs-validation" novalidate id="waitsave" require>

        <div class="form-group row">

            <div class="col-12">
                <label for="department">ค้นหาแผนก</label>
                <select name="department" id="department" class="form-control select2bs4" style="width: 100%;">
                    <option value="" selected>--- เลือกข้อมูล ---</option>
                    <?php
                    $getdepart = $getdata->my_sql_select($connect, NULL, "department_name", "department_status = '1' ORDER BY id ASC");
                    while ($show = mysqli_fetch_object($getdepart)) {
                        echo '<option value="' . $show->id . '">' . $show->department_name . '</option>';
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

            <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" data-style="expand-left" type="submit" name="export">
                <span class="fas fa-filter"> ค้นหา</span>
                <span class="ladda-spinner"></span>
            </button>
        <?php } else { ?>

            <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" data-style="expand-left" type="submit" name="export">
                <span class="fas fa-filter"> ค้นหา</span>
                <span class="ladda-spinner"></span>
            </button>
        <?php } ?>

    </form>
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

                            <td>รหัสสินทรัพย์</td>
                            <td>ผู้ยืม / ผู้ใช้งาน</td>
                            <td>ผู้ครอบครองสินทรัพย์</td>
                            <td>E-mail Supplier</td>
                            <td>สินทรัพย์ของบริษัท / สังกัด</td>
                            <td>ชื่อเครื่อง</td>
                            <td>อุปกรณ์</td>
                            <td>ยี่ห้อ</td>
                            <td>รุ่น</td>
                            <td>ราคา</td>

                            <td>สถานะ</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;

                        while ($show_total = mysqli_fetch_object($getexport)) {
                            $i++; ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <?php
                                    if (@$show_total->asset_code != NULL) {
                                        echo @$show_total->asset_code;
                                    } else {
                                        echo '<span class="badge badge-warning">ไม่ระบุ</span>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo @getemployee($show_total->card_customer_name); ?></td>
                                <td><?php echo $show_total->card_possess; ?></td>
                                <td><?php echo $show_total->card_customer_email; ?></td>
                                <td><?php echo @prefixConvertorCompany($show_total->card_company); ?></td>
                                <td><?php echo $show_total->card_note; ?></td>
                                <td><?php echo @prefixConvertorequipment($show_total->card_equipment); ?></td>
                                <td class="text-center"><?php echo $show_total->card_brand; ?></td>
                                <td class="text-center"><?php echo $show_total->card_model; ?></td>
                                <td><?php echo $show_total->card_price; ?></td>

                                <td><?php echo @cardStatus($show_total->card_status); ?></td>

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