<?php
require_once 'procress/dataSetting.php';
$getsystem_info = $getdata->my_sql_query($connect, NULL, "system_info", NULL);
$getalert = $getdata->my_sql_query($connect, NULL, "system_alert", NULL);
?>
<?php echo @$alert; ?>
<div class="row">
    <div class="col-12">
        <h3 class="page-header"><i class="fa fa-sliders-h fa-fw"></i> ตั้งค่า</h3>
    </div>
</div>
<nav aria-label="breadcrumb" class="mt-3 mb-3">
    <ol class="breadcrumb breadcrumb-inverse">
        <li class="breadcrumb-item">
            <a href="index.php">หน้าแรก</a>
        </li>
        <li class="breadcrumb-item">
            <a href="?p=setting">ตั้งค่า</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">ตั้งค่าระบบ</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>ข้อมูลระบบ </h2>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills nav-justified nav-style-fill" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="site-tab" data-toggle="tab" href="#site" role="tab" aria-controls="site" aria-selected="true">เกี่ยวกับระบบ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="alert-tab" data-toggle="tab" href="#alert" role="tab" aria-controls="alert" aria-selected="false">การแจ้งเตือน</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent4">
            <div class="tab-pane pt-3 fade show active" id="site" role="tabpanel" aria-labelledby="site-tab">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-md-6 col-sm-12">
                                <label for="site_logo">โลโกบริษัท</label>
                                <img src="../resource/system/logo/<?php echo @$getsystem_info->site_logo; ?>" width="256" alt="" />
                                <div class="form-group">
                                    <input type="file" name="site_logo" id="site_logo" class="form-control input-sm mt-2">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="site_favicon">ไอคอนบริษัท</label>
                                <img src="../resource/system/favicon/<?php echo @$getsystem_info->site_favicon; ?>" width="256" alt="" />
                                <div class="form-group">
                                    <input type="file" name="site_favicon" id="site_favicon" class="form-control input-sm mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="site_name">ชื่อบริษัท</label>
                                <input type="text" class="form-control" name="site_name" id="site_name" value="<?php echo @$getsystem_info->site_name; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-sm-12">
                                <label for="site_color_name">สีของชื่อบริษัท</label>
                                <input type="color" class="form-control" name="site_color_name" id="site_color_name" value="<?php echo @$getsystem_info->site_color_name; ?>">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="site_color_form">สีของหน้าฟอร์ม</label>
                                <input type="color" class="form-control" name="site_color_form" id="site_color_form" value="<?php echo @$getsystem_info->site_color_form; ?>">
                            </div>

                        </div>
                    </div>

                    <div class="text-center">
                        <button class="ladda-button btn btn-primary btn-square btn-ladda bg-success " type="submit" name="save_info" data-style="expand-left">
                            <span class="fas fa-save"> บันทึก</span>
                            <span class="ladda-spinner"></span>
                        </button>
                    </div>

                </form>
            </div>
            <div class="tab-pane pt-3 fade" id="alert" role="tabpanel" aria-labelledby="profile3-tab">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="line_notify">Line Notify <a href="settings/Set_line_notify.pdf" target="_blank" rel="noopener noreferrer">คู่มือการตั้งค่า</a></label>
                                <input type="text" class="form-control" name="line_notify" id="line_notify" placeholder="Ex. : ILgVattVGcQm5preH3uqlApJ4jqDCacByMGJ27YEvAx" value="<?php echo $getalert->alert_line_token; ?>" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-6 col-sm-12">
                                <label for="host">Mail Server</label>
                                <input type="text" class="form-control" name="host" id="host" placeholder="Ex. : mail.domain.com" autocomplete="off" value="<?php echo @$getalert->alert_mail_server; ?>">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="getmail">ผู้รับอีเมล</label>
                                <input type="text" class="form-control" name="getmail" id="getmail" placeholder="Ex. email@domain.com" autocomplete="off" value="<?php echo $getalert->alert_mail_get; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-sm-12">
                                <label for="username">ผู้ใช้งานอีเมล</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Ex. username@domain.com" autocomplete="off" value="<?php echo $getalert->alert_mail_user; ?>">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="password">รหัสผ่าน</label>
                                <input type="password" class="form-control" name="password" id="password" value="">
                            </div>

                        </div>

                        <div class="text-center">
                            <button class="ladda-button btn btn-primary btn-square btn-ladda bg-success " type="submit" name="save_alert" data-style="expand-left">
                                <span class="fas fa-save"> บันทึก</span>
                                <span class="ladda-spinner"></span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        <a class="btn btn-md btn-outline-info" href="index.php?p=setting"><i class="fas fa-arrow-circle-left"></i> กลับ</a>
    </div>
</div>