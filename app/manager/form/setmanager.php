<form method="post" enctype="multipart/form-data" class="was-validated" id="waitsave">
    <div class="form-group row">
        <div class="col-md-6 col-sm-12">
            <label for="manager">ผู้บังคับบัญชา</label>
            <select name="manager" id="manager" class="form-control select2bs4" required style="width: 100%;">
                <option value="">--- เลือกข้อมูล ---</option>
                <?php $getuser = $getdata->my_sql_select($connect, NULL, "user", "user_status = '1'");
                while ($showUser = mysqli_fetch_object($getuser)) {
                    echo '<option value="' . $showUser->user_key . '">' .  getemployee($showUser->user_key) . '</option>';
                }
                ?>
            </select>
            <div class="invalid-feedback">
                เลือก ผู้บังคับบัญชา.
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <label for="under_manager">ใต้ผู้บังคับบัญชา</label>
            <select name="under_manager" id="under_manager" class="form-control select2bs4" required style="width: 100%;">
                <option value="">--- เลือกข้อมูล ---</option>
                <?php $getuser = $getdata->my_sql_select($connect, NULL, "user", "user_status = '1'");
                while ($showUser = mysqli_fetch_object($getuser)) {
                    echo '<option value="' . $showUser->user_key . '">' .  getemployee($showUser->user_key) . '</option>';
                }
                ?>
            </select>
            <div class="invalid-feedback">
                เลือก ใต้ผู้บังคับบัญชา.
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12 text-center">
            <button class="ladda-button btn btn-warning btn-square btn-ladda bg-success" data-style="expand-left" type="submit" name="save_setmanager">
                <span class="fas fa-save"> บันทึก</span>
                <span class="ladda-spinner"></span>
            </button>
        </div>

    </div>

</form>