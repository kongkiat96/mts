<?php $card_detail = $getdata->my_sql_query($connect, NULL, "card_info", "card_key='" . htmlspecialchars($_GET['key']) . "'"); ?>
<div class="row">
    <div class="col-lg-6 col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-edit fa-fw"></i> รายการอุปกรณ์ [<?php echo @$card_detail->card_code; ?>]
        </h3>
    </div>
    <div class="col-lg-6 col-sm-12">
        <h3 class="page-header"><i class="fa fa-history fa-fw"></i> ระยะเวลาเสื่อมอุปกรณ์
            <?php
            $nowdate = date('Y-m-d');
            $startday = strtotime("$card_detail->card_date_buy");
            $today = time();
            if (@$card_detail->card_date_buy != 0000 - 00 - 00 && @$card_detail->card_date_buy != $nowdate) {
                # code...
                echo  '<font color="#E81600">' . timespan($startday, $today) . '</font>';
            } else {
                echo '<a href="#" class="badge badge-danger">ไม่มีข้อมูล</a>';
            }
            ?>
        </h3>
    </div>
</div>
<nav aria-label="breadcrumb" class="mt-3 mb-3">
    <ol class="breadcrumb breadcrumb-inverse">
        <li class="breadcrumb-item">
            <a href="index.php">หน้าแรก</a>
        </li>

        <li class="breadcrumb-item active" aria-current="page">รหัสสินทรัพย์ [ <?php echo @$card_detail->asset_code; ?> ]</li>
    </ol>
</nav>
<div class="card mb-3">
    <div class="card-header bg-success text-white font-weight-bold">
        <div class="row">
            <span class="ml-3">รายละเอียด</span>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <div class="col-md-3 col-sm-3"><strong>รหัสสินทรัพย์ :</strong></div>
            <div class="col-md-3 col-sm-3">
                <?php
                if (@$card_detail->asset_code != NULL) {
                    echo @$card_detail->asset_code;
                } else {
                    echo '<strong><font color="#E81600">ยังไม่ระบุ</font></strong>';
                }
                ?>
            </div>
            <div class="col-md-3 col-sm-3"><strong>วันที่เริ่มใช้งาน :</strong></div>
            <div class="col-md-3 col-sm-3">
                <?php
                if (@$card_detail->card_insert != 0000 - 00 - 00) {
                    echo @dateConvertor($card_detail->card_insert);
                } else {
                    echo '<strong><font color="#E81600">ยังไม่ระบุ</font></strong>';
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3 col-sm-3"><strong>ผู้ใช้งาน :</strong></div>
            <div class="col-md-3 col-sm-3">
                <?php echo @getemployee($card_detail->card_customer_name); ?>
            </div>
            <div class="col-md-3 col-sm-3"><strong>บริษัท / สังกัด :</strong></div>
            <div class="col-md-3 col-sm-3"><?php echo @getemployee_company($card_detail->card_customer_name); ?></div>
        </div>
        <div class="form-group row">
            <div class="col-md-3 col-sm-3"><strong>สินทรัพย์ของบริษัท :</strong></div>
            <div class="col-md-3 col-sm-3"><?php echo @prefixConvertorCompany($card_detail->card_company); ?></div>
            <div class="col-md-3 col-sm-3"><strong>อุปกรณ์ :</strong></div>
            <div class="col-md-3 col-sm-3"><?php echo @prefixConvertorequipment($card_detail->card_equipment); ?></div>
        </div>
        <div class="form-group row">
            <div class="col-md-3 col-sm-3"><strong>จำนวน :</strong></div>
            <div class="col-md-3 col-sm-3"><?php echo @$card_detail->card_sum; ?> ชุด / ชิ้น</div>
            <div class="col-md-3 col-sm-3"><strong>วันที่ซื้อ :</strong></div>
            <div class="col-md-3 col-sm-3"><?php echo @($card_detail->card_date_buy != '0000-00-00') ? dateConvertor($card_detail->card_date_buy) : '<strong><div style="color: #F00D0D">ไม่ระบุ</div></strong>'; ?></div>
        </div>
        <!-- <div class="form-group row">
            <div class="col-md-3 col-sm-3"><strong>ระบบปฏิบัติการ :</strong></div>
            <div class="col-md-3 col-sm-3">
                <?php
                if (@$card_detail->license_name == NULL) {
                    # code...
                    echo '<strong><font color="red">ไม่มีข้อมูล</font></strong>';
                } else {

                    echo '<strong><font color="green">' . @$card_detail->license_name . '</font></strong>';
                }
                ?></div>
            <div class="col-md-3 col-sm-3"><strong>ลิขสิทธิ์ :</strong></div>
            <div class="col-md-3 col-sm-3">
                <?php
                if (@$card_detail->ck_license == 1) {
                    # code...
                    echo '<strong><font color="green">License</font></strong>';
                } else {
                    echo '<strong><font color="red">No License</font></strong>';
                }
                ?>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-md-3 col-sm-3"><strong>โปรแกรม :</strong></div>
            <div class="col-md-3 col-sm-3">
                <?php
                if (@$card_detail->p_license_name == NULL) {
                    # code...
                    echo '<strong><font color="red">ไม่มีข้อมูล</font></strong>';
                } else {

                    echo '<strong><font color="green">' . @$card_detail->p_license_name . '</font></strong>';
                }
                ?></div>
            <div class="col-md-3 col-sm-3"><strong>ลิขสิทธิ์ :</strong></div>
            <div class="col-md-3 col-sm-3">
                <?php
                if (@$card_detail->p_ck_license == 1) {
                    # code...
                    echo '<strong><font color="green">License</font></strong>';
                } else {
                    echo '<strong><font color="red">No License</font></strong>';
                }
                ?>
            </div>

        </div> -->
        <div class="row form-group">
            <div class="col-md-3 col-sm-3"><strong>ระยะเวลาการรับประกัน :</strong></div>
            <div class="col-md-3 col-sm-3"><?php echo @($card_detail->card_ex != '') ? $card_detail->card_ex : '<strong><div style="color: #F00D0D">ไม่ระบุ</div></strong>'; ?></div>
            <div class="col-md-3 col-sm-3"><strong>เจ้าหน้าที่บันทึกรายการ :</strong></div>
            <div class="col-md-3 col-sm-3">
                <?php
                echo @getemployee($card_detail->user_key);
                ?>
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-3 col-sm-3"><strong>ระยะเวลาอุปกรณ์ :</strong></div>
            <div class="col-md-3 col-sm-3"><?php
                                            $nowdate = date('Y-m-d');
                                            $startday = strtotime("$card_detail->card_date_buy");
                                            $today = time();
                                            if (@$card_detail->card_date_buy != 0000 - 00 - 00 && @$card_detail->card_date_buy != $nowdate) {
                                                # code...
                                                echo  '<font color="#E81600">' . timespan($startday, $today) . '</font>';
                                            } else {
                                                echo '<a href="#" class="badge badge-danger">ไม่มีข้อมูล</a>';
                                            }
                                            ?></div>
            <div class="col-md-3 col-sm-3"><strong>ผู้ครอบครองสินทรัพย์ :</strong></div>
            <div class="col-md-3 col-sm-3"><?php echo @$card_detail->card_possess; ?></div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header bg-success text-white font-weight-bold">
        <div class="row">
            <span class="ml-3">รายละเอียด ประวัติการใช้งาน</span>
        </div>
    </div>
    <div class="card-body">
        <table id="responsive-data-table-it-use" class="table dt-responsive nowrap hover m-2" style="width:100%">
            <thead class="font-weight-bold text-center">

                <tr style="font-weight:bold; color:#FFF; background:#006EBD; text-align:center;">
                    <td width="17%">วันที่</td>
                    <td width="17%">สถานะ</td>
                    <td width="46%">หมายเหตุ</td>
                    <td width="20%">ผู้บันทึกรายการ</td>
                </tr>
            </thead>
            <tbody>
                <?php $getcard_status = $getdata->my_sql_select(
                    $connect,
                    NULL,
                    "card_status,card_type",
                    "card_status.card_key='" . $card_detail->card_key . "' 
   AND card_status.card_status=card_type.ctype_key ORDER BY card_status.cstatus_insert DESC"
                );
                while ($showcard_status = mysqli_fetch_object($getcard_status)) {
                ?>
                    <tr style="font-weight:bold;">
                        <td align="center"><?php echo @dateTimeConvertor($showcard_status->cstatus_insert); ?></td>
                        <td align="center"><?php echo @cardStatus($showcard_status->card_status); ?></td>
                        <td style="text-align: center;">
                            <?php
                            if (@$showcard_status->card_status_note != NULL) {
                                # code...
                                echo @$showcard_status->card_status_note;
                            } else {
                                echo '<strong><font color="#E81600">ไม่มีข้อมูล</font></strong>';
                            }
                            ?>
                        </td>
                        <td align="center"><?php
                                            echo @getemployee($card_detail->user_key);
                                            ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card text-center mt-3">
    <div class="card-header bg-success text-white font-weight-bold">
        <div class="row">
            <span class="ml-3">รูปภาพ</span>


        </div>
    </div>
    <div class="card-body text-center" id="repic">
        <?php
        if ($card_detail->card_pic == null) {
            echo '<img class="img-thumbnail" src="../resource/asset/file_pic_now/no-img.png" width="80%">';
        } else {
            echo '<img class="img-thumbnail" src="../resource/asset/delevymo/' . $card_detail->card_pic . '" width="80%">';
        }
        ?>
    </div>




</div>

<div class="card text-center mt-3">
    <div class="card-header bg-success text-white font-weight-bold">
        <div class="row">
            <span class="ml-3">รูปภาพเพิ่มเติม</span>
        </div>
    </div>
    <div class="card-body ">
        <div class="row">

            <?php
            $i = 0;
            $getpic = $getdata->my_sql_select($connect, NULL, "card_pic", "card_key='" . $card_detail->card_key . "' AND pic_status = '1' ORDER BY date_time");
            while ($showpic = mysqli_fetch_object($getpic)) {
                $i++;
            ?>
                <div class="card-deck col-3">
                    <div class="card">
                        <img class="card-img-top" src="../resource/asset/delevymo/<?php echo $showpic->pic_name; ?>">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?php echo $i; ?></h5>
                            <p class="card-text pb-3">Code: <?php echo $card_detail->card_code; ?></p>
                            <p class="card-text pb-3">Ref Key: <?php echo $showpic->pic_key; ?></p>


                        </div>
                    </div>

                </div>
            <?php } ?>

        </div>
    </div>
    <div class="card-footer text-center">
        <a href="#" class="btn btn-xs btn-outline-danger" onclick="window.close();"><i class="fa fa-reply"></i> กลับ</a>
    </div>
</div>