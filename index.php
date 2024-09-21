<?php
session_start();
error_reporting(0);
require("core/config.core.php");
$connect = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno()) {
  echo '<script>window.location="../"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
require("core/connect.core.php");
require("core/functions.core.php");
require("core/alert.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$userdata = $getdata->my_sql_query($connect, NULL, "user", "user_key='" . $_SESSION['ukey'] . "'");
mysqli_set_charset($connect, "utf8");
$system_info = $getdata->my_sql_query($connect, NULL, "system_info", NULL);
date_default_timezone_set('Asia/Bangkok');

?>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="<?php echo @$system_info->site_name; ?>">


  <title><?php echo @$system_info->site_name; ?></title>



  <!-- PLUGINS CSS STYLE -->
  <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />

  <link href="assets/plugins/fontawesome-5.12.1/css/all.css" rel="stylesheet" type="text/css">

  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />

  <!-- FAVICON -->
  <link rel="shortcut icon" href="resource/system/favicon/<?php echo @$system_info->site_favicon; ?>" />

  <script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="assets/plugins/sweetalert2/sweetalert2.min.css">



  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="assets/plugins/nprogress/nprogress.js"></script>
  <style>
    .app-brand {
      position: relative;
      display: block;
      background-color: #fec400;
    }

    .logo-fill-blue {
      fill: #7dffb6;
    }

    .btn-custome {
      color: black;
      border-color: <?php echo @$system_info->site_color_form; ?>;
    }

    .btn-custome:hover {
      color: white;
      background-color: <?php echo @$system_info->site_color_form; ?>;
      border-color: <?php echo @$system_info->site_color_form; ?>;
      transition: 0.8s;
    }
  </style>
</head>

<body class="" id="body">
  <div class="container d-flex flex-column justify-content-between vh-100">
    <div class="row justify-content-center mt-5">
      <div class="col-xl-5 col-lg-6 col-md-10">
        <div class="card mt-5">
          <div class="card-header text-center" style="background: <?php echo @$system_info->site_color_form; ?>;">

            <img src="resource/system/logo/<?php echo @$system_info->site_logo; ?>" width="150" alt="" class="mb-2" />
            <h3 style="color: <?php echo @$system_info->site_color_name; ?>;"><strong><?php echo @$system_info->site_name; ?></strong> </h3>
          </div>
          <div class="card-body p-3">
            <?php
            if (@htmlspecialchars($_GET['c']) == 'nouser') {
              echo @$chk_user;
            }
            ?>
            <h4 class="text-dark mb-3">Sign In</h4>
            <form action="core/takelogin.core.php" method="post" class="was-validated">

              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" autofocus required>
                <div class="invalid-feedback">
                  ระบุ ผู้ใช้งานหรืออีเมลล์ .
                </div>
              </div>
              <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" name="password" id="pass" placeholder="Password" required>
                <div class="invalid-feedback">
                  ระบุ รหัสผ่าน .
                </div>
              </div>
              <button type="submit" name="login" class="btn btn-lg btn-block btn-custome">เข้าสู่ระบบ <i class="fa fa-sign-in-alt fa-1x"></i></button>

            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright pl-0">
      <p class="text-center">
        <small>&copy;&nbsp;2018 - <?php echo date('Y'); ?>&nbsp;Service Service IT By Kongkiat.</small>
      </p>
      <input type="text" hidden value="">
    </div>
  </div>

</body>

</html>