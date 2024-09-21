<?php
if (isset($_POST['search'])) {
    if ($_POST['asset_company'] != NULL) {
        $asset_company = $_POST['asset_company'];

        $getsearch = $getdata->my_sql_select($connect, NULL, "card_info", "card_company = '" . $asset_company . "' AND card_status = '2e34609794290a770cb0349119d78d21' AND card_delete = '1' ORDER BY card_customer_name", "card_key");
    } else {
        $getsearch = $getdata->my_sql_select($connect, NULL, "card_info");
    }

    $log_key = substr(md5(time("now")), 8, 16);
    $getdata->my_sql_insert($connect, "logs_keep", "
    ls_key = '" . $log_key . "',
    ls_text = 'ค้นหารายการที่ใช้งานอยู่',
    ls_user = '" . $_SESSION['ukey'] . "'
    ");
}
?>

<div class=" card-default text-center">



    <form method="post" action="<?php echo $SERVER_NAME; ?>" class="needs-validation" novalidate id="waitsave" require>

        <div class="form-group row">

            <div class="col-12">
                <label for="asset_company">สินทรัพย์ของบริษัท</label>
                <select name="asset_company" id="asset_company" class="form-control select2bs4" style="width: 100%;">
                    <option value="" selected>--- เลือกข้อมูล ---</option>
                    <?php
                    $getcompany = $getdata->my_sql_select($connect, NULL, "company", "cp_status = '1' AND show_it = '1' ORDER BY id");
                    while ($show = mysqli_fetch_object($getcompany)) {
                        echo '<option value="' . $show->id . '">' . $show->company_name . '</option>';
                    }
                    ?>
                </select>
            </div>

        </div>


        <?php if (isset($_POST['search'])) { ?>

            <button class="ladda-button btn btn-primary btn-square btn-ladda bg-danger" onclick="reloadPage()" data-style="expand-left">
                <span class="fas fa-trash-alt"> ล้างค่า</span>
                <span class="ladda-spinner"></span>
            </button>

            <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" data-style="expand-left" type="submit" name="search">
                <span class="fas fa-filter"> ค้นหา</span>
                <span class="ladda-spinner"></span>
            </button>
        <?php } else { ?>



            <button class="ladda-button btn btn-primary btn-square btn-ladda bg-info" data-style="expand-left" type="submit" name="search">
                <span class="fas fa-filter"> ค้นหา</span>
                <span class="ladda-spinner"></span>
            </button>
        <?php } ?>

    </form>
</div>
<?php if (isset($_POST['search'])) { ?>
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