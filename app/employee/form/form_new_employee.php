<form method="post" enctype="multipart/form-data" class="was-validated" id="waitsave">

    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="code_em">ผู้ใช้งาน</label>
            <input type="text" name="code_em" id="code_em" class="form-control input-sm" required>
            <div class="invalid-feedback">
                ระบุ ผู้ใช้งาน.
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="pass_em">รหัสผ่าน</label>
            <input type="password" name="pass_em" id="pass_em" class="form-control input-sm" required>
            <div class="invalid-feedback">
                ระบุ รหัสผ่าน.
            </div>
        </div>

    </div>
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="company">บริษัท / สังกัด</label>
            <select name="company" id="company" class="form-control select2bs4" required style="width: 100%;">
                <option value="">--- เลือกข้อมูล ---</option>
                <?php $getprefix = $getdata->my_sql_select($connect, NULL, "company", "cp_status = '1'");
                while ($showprefix = mysqli_fetch_object($getprefix)) {
                    echo '<option value="' . $showprefix->id . '">' . $showprefix->company_name . '</option>';
                }
                ?>
            </select>
            <div class="invalid-feedback">
                เลือก บริษัท / สังกัด.
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <label for="email">อีเมล</label>
            <input type="email" name="email" id="email" class="form-control input-sm" required>
            <div class="invalid-feedback">
                ระบุ อีเมล.
            </div>
        </div>
    </div>
    <div class="form-group row">

        <div class="col-md-4 col-sm-12">
            <label for="prefixname">คำนำหน้าชื่อ</label>
            <select name="prefixname" id="prefixname" class="form-control select2bs4" required style="width: 100%;">
                <option value="">--- เลือกข้อมูล ---</option>
                <?php $getprefix = $getdata->my_sql_select($connect, NULL, "members_prefix", "prefix_status ='1'");
                while ($showprefix = mysqli_fetch_object($getprefix)) {
                    echo '<option value="' . $showprefix->prefix_code . '">' . $showprefix->prefix_title . '</option>';
                }
                ?>
            </select>
            <div class="invalid-feedback">
                เลือก คำนำหน้า.
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <label for="name">ชื่อ</label>
            <input type="text" name="name" id="name" class="form-control input-sm" required>
            <div class="invalid-feedback">
                ระบุ ชื่อพนักงาน.
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <label for="lastname">นามสกุล</label>
            <input type="text" name="lastname" id="lastname" class="form-control input-sm" required>
            <div class="invalid-feedback">
                ระบุ นามสกุล.
            </div>
        </div>

    </div>
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="position">ตำแหน่ง</label>
            <input type="text" name="position" id="position" class="form-control input-sm" required>
            <div class="invalid-feedback">
                ระบุ ตำแหน่ง.
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <label for="department">แผนก</label>
            <select name="department" id="department" class="form-control select2bs4" required style="width: 100%;">
                <option value="">--- เลือกข้อมูล ---</option>
                <?php $getprefix = $getdata->my_sql_select($connect, NULL, "department_name", "id <> 'hidden' AND department_status = '1'");
                while ($showprefix = mysqli_fetch_object($getprefix)) {
                    echo '<option value="' . $showprefix->id . '">' . $showprefix->department_name . '</option>';
                }
                ?>
            </select>
            <div class="invalid-feedback">
                เลือก แผนก.
            </div>
        </div>

    </div>

    <!-- <div id="showload" style="display: none;"><span class="spinner-border text-primary spinner-sm" role="status" aria-hidden="true"></span></div>
    <div id="hidden">
        <button class="btn btn-outline-primary btn-sm" type="submit" name="save_employee"><i class="fa fa-save fa-fw"></i>บันทึก</button>
    </div> -->

    <div class="form-group row">
        <div class="col-12 text-center">

            <button class="ladda-button btn btn-warning btn-square btn-ladda bg-success" data-style="expand-left" type="submit" name="save_employee">
                <span class="fas fa-save"> บันทึก</span>
                <span class="ladda-spinner"></span>
            </button>
        </div>

    </div>

</form>