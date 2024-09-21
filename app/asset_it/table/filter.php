<?php
if (isset($_POST['filter_device'])) {


    if ($_POST['device'] != NULL && $_POST['employee'] == NULL) {
        $device = $_POST['device'];

        $getsearch = $getdata->my_sql_select($connect, NULL, "card_info", "card_key <> 'hidden' AND card_equipment = '" . $device . "' AND card_delete = '1' ORDER BY card_customer_name DESC", "card_key");
    }
    if ($_POST['employee'] != NULL && $_POST['device'] == NULL) {
        $employee = $_POST['employee'];
        $getsearch = $getdata->my_sql_select($connect, NULL, "card_info", "card_key <> 'hidden' AND card_customer_name = '" . $employee . "' AND card_delete = '1' ORDER BY card_customer_name DESC", "card_key");
    }
    if ($_POST['device'] != NULL && $_POST['employee'] != NULL) {
        $device = $_POST['device'];
        $employee = $_POST['employee'];
        $getsearch = $getdata->my_sql_select($connect, NULL, "card_info", "card_key <> 'hidden' AND card_customer_name = '" . $employee . "' AND card_equipment = '" . $device . "' AND card_delete = '1' ORDER BY card_customer_name DESC", "card_key");
    }
    if ($_POST['device'] == NULL && $_POST['employee'] == NULL) {
        $getsearch = $getdata->my_sql_select($connect, NULL, "card_info", "card_key <> 'hidden' ORDER BY card_customer_name DESC");
    }

    $log_key = substr(md5(time("now")), 8, 16);
    $getdata->my_sql_insert($connect, "logs_keep", "
    ls_key = '" . $log_key . "',
    ls_text = 'ค้นหารายการแยกตามอุปกรณ์',
    ls_user = '" . $_SESSION['ukey'] . "'
    ");
}
?>

<!-- <div class="row mt-3 mb-0">
    <div class="col-md-3 col-sm-6">
        <div class="media widget-media p-4 bg-white border">
            <i class="mdi mdi-desktop-tower text-blue mr-4"></i>
            <div class="media-body align-self-center">
                <h4 class="text-primary mb-2"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_key <> 'hidden' AND card_equipment = '1'");
                                                echo @number_format($getall); ?></h4>
                <p>จำนวนคอมพิวเตอร์</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="media widget-media p-4 rounded bg-white border">
            <i class="mdi mdi-monitor text-success mr-4"></i>
            <div class="media-body align-self-center">
                <h4 class="text-success mb-2"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_status <> 'hidden' AND card_equipment = '2'");
                                                echo @number_format($getall); ?></h4>
                <p>จำนวนจอภาพ</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="media widget-media p-4 rounded bg-white border">
            <i class="mdi mdi-laptop-windows text-warning mr-4"></i>
            <div class="media-body align-self-center">
                <h4 class="text-warning mb-2"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_status <> 'hidden' AND card_equipment = '3'");
                                                echo @number_format($getall); ?></h4>
                <p>จำนวนโน๊ตบุ๊ค</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="media widget-media p-4 rounded bg-white border">
            <i class="mdi mdi-desktop-mac-dashboard text-warning mr-4"></i>
            <div class="media-body align-self-center">
                <h4 class="text-warning mb-2"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_status <> 'hidden' AND card_equipment = '4'");
                                                echo @number_format($getall); ?></h4>
                <p>จำนวน All in One</p>
            </div>
        </div>
    </div>

</div> -->



<div class=" card-default text-center">
    <form method="post" action="<?php echo $SERVER_NAME; ?>" class="needs-validation" novalidate id="waitsave" require>

        <div class="form-group row">

            <div class="col-6">
                <label for="device">ค้นหาอุปกรณ์</label>
                <select name="device" id="device" class="form-control select2bs4" style="width: 100%;">
                    <option value="" selected>--- เลือกข้อมูล ---</option>
                    <?php
                    $getdevice = $getdata->my_sql_select($connect, NULL, "device_type", "device_status = '1' ORDER BY id ASC");
                    while ($show = mysqli_fetch_object($getdevice)) {
                        echo '<option value="' . $show->id . '">' . $show->device_type . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-6">
                <label for="employee">ค้นหาผู้ใช้งาน</label>
                <select name="employee" id="employee" class="form-control select2bs4" style="width: 100%;">
                    <option value="" selected>--- เลือกข้อมูล ---</option>
                    <?php
                    $getemployee = $getdata->my_sql_select($connect, NULL, "employee", "card_key <> 'hidden' AND em_status = '1' ORDER BY title_name ASC");
                    while ($show = mysqli_fetch_object($getemployee)) {
                        echo '<option value="' . $show->card_key . '">' . @getemployee($show->card_key) . '</option>';
                    }
                    ?>
                </select>
            </div>

        </div>


        <?php if (isset($_POST['filter_device'])) { ?>

            <button class="ladda-button btn btn-primary btn-square btn-ladda bg-danger" onclick="reloadPage()" data-style="expand-left">
                <span class="fas fa-trash-alt"> ล้างค่า</span>
                <span class="ladda-spinner"></span>
            </button>

            <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" data-style="expand-left" type="submit" name="filter_device">
                <span class="fas fa-filter"> ค้นหา</span>
                <span class="ladda-spinner"></span>
            </button>
        <?php } else { ?>

            <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" data-style="expand-left" type="submit" name="filter_device">
                <span class="fas fa-filter"> ค้นหา</span>
                <span class="ladda-spinner"></span>
            </button>
        <?php } ?>

    </form>
</div>
<?php if (isset($_POST['filter_device'])) { ?>
    <div class="responsive-data-table">
        <table id="responsive-data-table-it-use" class="table dt-responsive nowrap hover" style="width:100%">
            <thead class="font-weight-bold text-center">
                <tr>
                    <td>ลำดับ</td>
                    <td>รหัสสินทรัพย์</td>
                    <td>ผู้ใช้งาน</td>
                    <td>สินทรัพย์ของบริษัท / สังกัด</td>
                    <td>ผู้ครอบครองสินทรัพย์</td>
                    <td>ชื่อเครื่อง</td>
                    <td>อุปกรณ์</td>
                    <td>ยี่ห้อ</td>
                    <td>สถานะ</td>
                    <td>ดำเนินการ</td>
                </tr>
            </thead>
            <tbody>

                <?php
                $l = 0;

                while ($showcard = mysqli_fetch_object($getsearch)) {
                    $l++;
                ?>
                    <tr>
                        <td class="text-center"><?php echo @$l; ?></td>
                        <td>
                            <?php
                            if (@$showcard->asset_code != NULL) {
                                echo @$showcard->asset_code;
                            } else {
                                echo '<span class="badge badge-warning">ไม่ระบุ</span>';
                            }
                            ?>
                        </td>
                        <td><?php echo @getemployee($showcard->card_customer_name); ?></td>
                        <td><?php echo @prefixConvertorCompany($showcard->card_company); ?></td>
                        <td><?php echo @$showcard->card_possess; ?></td>
                        <td><?php echo $showcard->card_note; ?></td>
                        <td><?php echo @prefixConvertorequipment($showcard->card_equipment); ?></td>
                        <td class="text-center"><?php echo $showcard->card_brand; ?></td>
                        <td><?php echo @cardStatus($showcard->card_status); ?></td>
                        <?php if (@$_SESSION['uclass'] == 3 || @$_SESSION['uclass'] == 2) { ?>
                            <td>
                                <a href="?p=asset_it_create_detail&key=<?php echo @$showcard->card_key; ?>" class="btn btn-sm btn-outline-warning" data-toggle="toptitle" data-placement="top" title="ตรวจสอบ"><i class="fa fa-edit"></i></a>

                                <!-- <a href="asset_it/print_card.php?key=<?php echo @$showcard->card_key; ?>" target="_blank" class="btn btn-sm btn-outline-warning" data-toggle="toptitle" data-placement="top" title="พิมพ์เอกสาร"><i class="fa fa-print"></i></a>

                                <a href="asset_it/print_qr.php?key=<?php echo @$showcard->card_key; ?>" target="_blank" class="btn btn-sm btn-outline-info" data-toggle="toptitle" data-placement="top" title="พิมพ์ QR Code"><i class="fa fa-qrcode"></i></a> -->
                                <a href="?p=card_all_status&key=<?php echo @$showcard->card_key; ?>" target="_blank" class="btn btn-sm btn-outline-success" data-top="toptitle" data-placement="top" title="ตรวจสอบ"><i class="fa fa-eye"></i></a>
                                <a href="#" onclick="deleteCard('<?php echo @$showcard->card_key; ?>');" class="btn btn-sm btn-outline-danger" data-toggle="toptitle" data-placement="top" title="ลบรายการนี้"><i class="fa fa-times"></i></a>

                            </td>
                        <?php } ?>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>