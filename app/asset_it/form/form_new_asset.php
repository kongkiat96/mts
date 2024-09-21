<?php

$getcontrol = $getdata->my_sql_show_rows($connect, "card_info", "card_key <> 'hidden'"); // นับข้อมูลใน database

if (isset($_POST['save_card'])) {
    if ($getcontrol < 9999) {
        if (htmlspecialchars($_POST['card_customer_name']) != NULL && htmlspecialchars($_POST['asset_code']) != NULL) {
            $card_key = md5(htmlspecialchars($_POST['card_customer_name']) . htmlspecialchars($_POST['card_code']) . time("now"));
            $card_code =  htmlspecialchars($_POST['card_code']);
            if (!defined('pic')) {
                define('pic', '../resource/asset/delevymo/');
            }
            if (is_uploaded_file($_FILES['pic']['tmp_name'])) {
                $remove_charname = array(' ', '`', '"', '\'', '\\', '/', '_');
                $pic = str_replace($remove_charname, '', $_FILES['pic']['name']);
                $fixname_pic = $card_code . '-' . $pic;
                $File_tmpname = $_FILES['pic']['tmp_name'];

                if (move_uploaded_file($File_tmpname, (pic . $fixname_pic)));
            }


            resizepicasset($pic, $fixname_pic);


            $getdata->my_sql_insert($connect, "card_info", "card_key='" . $card_key . "',
          card_code='" . htmlspecialchars($_POST['card_code']) . "',
          asset_code='" . htmlspecialchars($_POST['asset_code']) . "',
          card_customer_name='" . htmlspecialchars($_POST['card_customer_name']) . "',
        
          card_company='" . htmlspecialchars($_POST['company']) . "',
          card_possess = '" . htmlspecialchars($_POST['card_possess']) . "',
          card_customer_phone='" . htmlspecialchars($_POST['card_customer_phone']) . "',
          card_customer_email='" . htmlspecialchars($_POST['card_customer_email']) . "',
          card_note='" . htmlspecialchars($_POST['card_note']) . "',
          card_equipment='" . htmlspecialchars($_POST['card_device_id']) . "',
          card_brand='" . htmlspecialchars($_POST['card_brand']) . "',
          card_model='" . htmlspecialchars($_POST['card_model']) . "',
          card_serial='" . htmlspecialchars($_POST['card_serial']) . "',
          card_sum='" . htmlspecialchars($_POST['card_sum']) . "',
          card_date_buy='" . htmlspecialchars($_POST['card_date_buy']) . "',
          card_ex='" . htmlspecialchars($_POST['card_ex']) . "',
          card_pic = '" . $fixname_pic . "',
          card_price = '" . htmlspecialchars($_POST['card_price']) . "',
          card_done_aprox='" . date("Y-m-d") . "',user_key='" . $_SESSION['ukey'] . "',
          card_status='',card_insert='" . date("Y-m-d H:i:s") . "'");

            echo '<script>window.location="?p=asset_it_create_detail&key=' . $card_key . '";</script>';
        } else {
            $alert = $warning;
        }
    } else {
        $alert = $warning;
    }
}
?>
<?php echo @$alert; ?>
<form method="post" enctype="multipart/form-data" class="was-validated" id="waitsave">
    <div class="form-group row">
        <div class="col-md-3 col-sm-6">
            <label for="card_code">Code Index</label>
            <input type="text" name="card_code" id="card_code" value="<?php echo @RandomString(4, 'C', 7); ?>" class="form-control" readonly>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="asset_code">รหัสสินทรัพย์</label>
            <input type="text" name="asset_code" id="asset_code" class="form-control" placeholder="Code Asset IT" autofocus required>
            <div class="invalid-feedback">
                ระบุ รหัสสินทรัพย์.
            </div>
        </div>

        <div class="col-md-3 col-sm-12">
            <label for="company">สินทรัพย์ของบริษัท</label>
            <select name="company" id="company" class="form-control select2bs4" style="width: 100%;" required>
                <option value="" selected>--- เลือกข้อมูล ---</option>
                <?php
                $getprefix = $getdata->my_sql_select($connect, NULL, "company", "cp_status = '1' ORDER BY id");
                while ($showprefix = mysqli_fetch_object($getprefix)) {
                    echo '<option value="' . $showprefix->id . '">' . $showprefix->company_name . '</option>';
                }
                ?>
            </select>
            <div class="invalid-feedback">
                เลือก สินทรัพย์ของบริษัท.
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <label for="card_possess">ผู้ครอบครองสินทรัพย์</label>
            <input type="text" name="card_possess" id="card_possess" class="form-control" placeholder="Asset Possess" required>
            <div class="invalid-feedback">
                ระบุ ผู้ครอบครองสินทรัพย์.
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="card_customer_name">ผู้ใช้งาน</label>
            <select name="card_customer_name" id="card_customer_name" class="form-control select2bs4" style="width: 100%;" required>
                <option value="" selected>--- เลือกข้อมูล ---</option>
                <?php
                $getgroup = $getdata->my_sql_select($connect, NULL, "employee", "em_status = '1' ORDER BY title_name");
                while ($showgroup = mysqli_fetch_object($getgroup)) {

                    echo '<option value="' . $showgroup->card_key . '">' . @prefixConvertor($showgroup->title_name) . '&nbsp;' . $showgroup->name . '&nbsp;' . $showgroup->lastname . '</option>';
                }
                ?>
            </select>
            <div class="invalid-feedback">
                เลือก ผู้ใช้งาน.
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <label for="card_date_buy">วันที่ซื้อ / วันที่ขอใช้สินทรัพย์</label>
            <input type="date" name="card_date_buy" id="card_date_buy" class="form-control input-sm" required>
            <div class="invalid-feedback">
                ระบุ วันที่.
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="card_device_id">อุปกรณ์</label>
            <select name="card_device_id" id="card_device_id" class="form-control select2bs4" style="width: 100%;" required>
                <option value="">--- เลือกข้อมูล ---</option>
                <?php $getprefix = $getdata->my_sql_select($connect, NULL, "device_type", "device_status = '1' ORDER BY id");
                while ($showprefix = mysqli_fetch_object($getprefix)) {
                    echo '<option value="' . $showprefix->id . '">' . $showprefix->device_type . '</option>';
                }
                ?>
            </select>
            <div class="invalid-feedback">
                เลือก อุปกรณ์.
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="card_ex">ระยะเวลาการรับประกัน</label>
            <input type="text" name="card_ex" id="card_ex" class="form-control input-sm" placeholder="1 ปี / 1 เดือน" autocomplete="off" required>
            <div class="invalid-feedback">
                ระบุ ระยะเวลาการรับประกัน.
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="card_sum">จำนวน</label>
            <input type="number" name="card_sum" id="card_sum" class="form-control input-sm" autocomplete="off" placeholder="ชิ้น / ชุด" required="" min="1" max="99">
            <div class="invalid-feedback">
                ระบุ จำนวน.
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 col-sm-12">
            <label for="card_brand">ยี่ห้อ</label>
            <input type="text" name="card_brand" id="card_brand" class="form-control input-sm" autofocus="off" placeholder="Brand name" required>
            <div class="invalid-feedback">
                ระบุ ยี่ห้อ.
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="card_model">รุ่น</label>
            <input type="text" name="card_model" id="card_model" class="form-control input-sm" autofocus="off" placeholder="Model name" required>
            <div class="invalid-feedback">
                ระบุ รุ่น.
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="card_serial">Service tag / Serial number</label>
            <input type="text" name="card_serial" id="card_serial" class="form-control input-sm" autocomplete="off" placeholder="S/T | S/N" required>
            <div class="invalid-feedback">
                ระบุ Service tag / Serial number.
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 col-sm-12">
            <label for="card_customer_phone">เบอร์โทรติดต่อ Supplier</label>
            <input type="tel" name="card_customer_phone" id="card_customer_phone" class="form-control input-sm" required>
            <div class="invalid-feedback">
                ระบุ เบอร์โทรติดต่อ Supplier.
            </div>
        </div>
        <div class="col-md-4 col-sm-12"> <label for="card_customer_email">E-mail Supplier</label>
            <input type="email" name="card_customer_email" id="card_customer_email" class="form-control input-sm" required>
            <div class="invalid-feedback">
                ระบุ E-mail Supplier.
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <label for="card_note">ชื่อเครื่อง / ชื่ออุปกรณ์</label>
            <input type="text" name="card_note" id="card_note" class="form-control input-sm" required>
            <div class="invalid-feedback">
                ระบุ ชื่อเครื่อง / อุปกรณ์.
            </div>
        </div>
    </div>
    <!-- <div class="form-group row">
        <div class="col-md-7">
            <label for="os">รายละเอียดระบบปฏิบัติการ</label>&nbsp
            <input type="radio" name="ck_license" value="1" required>
            <label for="ck_license">
                <font color="green">License</font>
            </label>&nbsp
            <input type="radio" name="ck_license" value="0" required>
            <label for="ck_license">
                <font color="red">No license</font>
            </label>
            <input type="text" name="name_license" id="os" class="form-control input-sm" disabled="disabled" placeholder="Windows" required>
            <div class="invalid-feedback">
                Input Windows Or Other.
            </div>
        </div>
        <div class="col-md-5">
            <label for="key">License key </label>
            <input type="text" name="key_license" id="key" class="form-control input-sm" disabled="disabled" placeholder="xxxxx-xxxxx-xxxxx-xxxxx-xxxxx" required>
            <div class="invalid-feedback">
                Key license.
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-7">
            <label for="p_ck_license">รายละเอียดโปรแกรม</label>&nbsp
            <input type="radio" name="p_ck_license" value="1" required>
            <label for="pck_license">
                <font color="green">License</font>
            </label>&nbsp
            <input type="radio" name="p_ck_license" value="0" required>
            <label for="pck_license">
                <font color="red">No license</font>
            </label>
            <input type="text" name="p_license_name" id="program" class="form-control input-sm" disabled="disabled" placeholder="Program" required>
            <div class="invalid-feedback">
                Input Programs Or Other.
            </div>
        </div>
        <div class="col-md-5">
            <label for="programkey">License key </label>
            <input type="text" name="p_license_key" id="programkey" class="form-control input-sm" disabled="disabled" placeholder="xxxxx-xxxxx-xxxxx-xxxxx-xxxxx" required>
            <div class="invalid-feedback">
                Key license.
            </div>
        </div>
    </div> -->
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="pic">รูปภาพอุปกรณ์</label>
            <input type="file" name="pic" id="pic" class="form-control input-sm" required>
            <div class="invalid-feedback">
                ระบุ รูปภาพอุปกรณ์.
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="currency-field">ราคาอุปกรณ์</label>
            <input type="text" name="card_price" id="currency-field" class="form-control input-sm" required data-type="currency" placeholder="0.00">
            <div class="invalid-feedback">
                ระบุ ราคาอุปกรณ์.
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 text-center">


            <button class="ladda-button btn btn-warning btn-square btn-ladda bg-success" data-style="expand-left" type="submit" name="save_card">
                <span class="fas fa-save"> บันทึก</span>
                <span class="ladda-spinner"></span>
            </button>
        </div>

    </div>
</form>
<script src="asset_it/currency.js"></script>