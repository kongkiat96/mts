<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<?php
if ($_SESSION['uname'] == null || $_SESSION['uclass'] >= 4) {
  echo '<script>window.location="../"</script>';
}
require '../core/config.core.php';
require '../core/connect.core.php';
require '../core/functions.core.php';
require '../core/logs.core.php';
require '../core/alert.php';
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, 'utf8');
$userdata = $getdata->my_sql_query($connect, null, 'user', "user_key='" . $_SESSION['ukey'] . "'");
$system_info = $getdata->my_sql_query($connect, null, 'system_info', null);
date_default_timezone_set('Asia/Bangkok');

//require("../core/online.core.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="description" content="<?php echo @$system_info->site_name; ?>">


  <title><?php echo @$system_info->site_name; ?></title>

  <!-- FAVICON -->
  <link rel="shortcut icon" href="../resource/system/favicon/<?php echo @$system_info->site_favicon; ?>" />
  <script src="https://code.jquery.com/jquery-latest.js"></script>

  <?php require '../core/header.php' ?>

  <script>
    NProgress.configure({
      showSpinner: true
    });
    NProgress.start();
  </script>
  <script>
    setInterval(function() {
      $('#sidebar-menus').load('auto/menu.php');

    }, 1000) /* time in milliseconds (ie 2 seconds)*/
  </script>

  <style>
    body {
      font-family: 'Prompt';
      /* font-size: 22px; */
    }

    .app-brand {
      position: relative;
      display: block;
      background-color: <?php echo @$system_info->site_color_form; ?>;
    }

    .logo-fill-blue {
      fill: #7dffb6;
    }

    .field-icon {
      float: right;
      margin-left: -25px;
      margin-top: -25px;
      position: relative;
      z-index: 2;
      margin-right: 10px;
    }
  </style>

</head>


<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">

  <!-- <div id="toaster"></div> -->

  <div class="wrapper">


    <aside class="left-sidebar bg-sidebar">
      <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
          <a href="#" title="<?php echo @$system_info->site_name; ?>">
            <img src="../resource/system/logo/<?php echo @$system_info->site_logo; ?>" width="30px" alt="><?php echo @$system_info->site_name; ?>" />
            <span class="brand-name text-truncate font-weight-bold" style="font-size: 14px; color: <?php echo $system_info->site_color_name; ?>"><?php echo @$system_info->site_name; ?></span>
          </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">

          <ul class="nav sidebar-inner" id="sidebar-menu">

            <?php
            $getmenus = $getdata->my_sql_select($connect, null, 'menus', "menu_status ='1' AND menu_key != 'c6c8729b45d1fec563f8453c16ff03b8' ORDER BY menu_sorting");
            while ($showmenus = mysqli_fetch_object($getmenus)) {

              if ($_GET['p'] == $showmenus->menu_case) {
                $show = '
<li class="has-sub active"> <a class="sidenav-item-link" href="' . $showmenus->menu_link . '">

<i class="fas ' . $showmenus->menu_icon . '"></i><span>' . $showmenus->menu_name . '</span></a>
</li>';
                echo @accessMenus($showmenus->menu_key, $_SESSION['ukey'], $show);
              } else {
                $show = '
                <li class="has-sub"> <a class="sidenav-item-link" href="' . $showmenus->menu_link . '">
                
                <i class="fas ' . $showmenus->menu_icon . '"></i><span>' . $showmenus->menu_name . '</span></a>
                </li>';
                echo @accessMenus($showmenus->menu_key, $_SESSION['ukey'], $show);
              }
            }
            ?>
            <li class="has-sub"> <a class="sidenav-item-link" target="_blank" href="https://its.nbrest.com/app/index.php"><i class="fas fa-link"></i><span>แจ้งปัญหาฝ่าย IT</span></a></li>

          </ul>


        </div>

        <div class="sidebar-footer">
          <hr class="separator mb-0" />
          <div class="sidebar-footer-content">
            <small style="font-size: 8px;">&copy;&nbsp;2018 - <?php echo date('Y'); ?>&nbsp;SSIT By Kongkiat. <br>Version 2.5</small>
          </div>
        </div>
      </div>
    </aside>

    <div class="page-wrapper">
      <header class="main-header " id="header">
        <nav class="navbar navbar-static-top navbar-expand-lg">
          <!-- Sidebar toggle button -->
          <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
          </button>
          <!-- search form -->
          <div class="search-form d-none d-lg-inline-block">
            <div class="input-group">
              <div id="DigitalCLOCK" onload="showTime()"></div>

            </div>
            <div id="search-results-container">
              <ul id="search-results"></ul>
            </div>
          </div>

          <div class="navbar-right ">
            <ul class="nav navbar-nav">
              <!-- User Account -->
              <li class="dropdown user-menu">
                <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <img src="../assets/img/user/noimg.jpg" class="user-image" alt="User Image" />
                  <span class="d-none d-lg-inline-block"><?php echo @getemployee($userdata->user_key); ?></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                  <!-- User image -->
                  <li class="dropdown-header">
                    <img src="../assets/img/user/noimg.jpg" class="img-circle" alt="User Image" />
                    <div class="d-inline-block">
                      <?php echo @$userdata->name . '&nbsp;' . $userdata->lastname; ?><small class="pt-1"><?php echo @$userdata->email; ?></small>
                    </div>
                  </li>
                  <li>
                    <a href="?p=view_info"> <i class="mdi mdi-account-edit"></i> เปลี่ยนแปลงข้อมูล </a>
                  </li>
                  <li>
                    <a href="../core/logout.core.php"> <i class="mdi mdi-logout"></i> Log Out </a>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>


      </header>




      <div class="content-wrapper">
        <div class="content">

          <?php
          $page = htmlspecialchars(@$_GET['p']);
          $listdata = $getdata->my_sql_query($connect, null, 'list', "cases='" . $page . "' AND case_status='1'");
          if ($listdata != null) {
            require $listdata->pages;
          } else {
            if ($_SESSION['uclass'] == 1 || $_SESSION['uclass'] == 2 || $_SESSION['uclass'] == 3) {
              // echo '<div id="toaster"></div>';
              require 'home.php';
            }
          }
          ?>
        </div>


      </div>
      <footer class="footer mt-auto">
        <div class="copyright bg-white">
          <p>
            &copy; <span id="copy-year">2020</span> Copyright <?php echo @$system_info->site_name; ?>.
          </p>
        </div>
      </footer>
    </div>

  </div>




  <?php require '../core/footer.php' ?>

  <script>
    jQuery(document).ready(function() {
      jQuery('input[name="dateRange"]').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        locale: {
          cancelLabel: 'Clear'
        }
      });
      jQuery('input[name="dateRange"]').on('apply.daterangepicker', function(ev, picker) {
        jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
      });
      jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function(ev, picker) {
        jQuery(this).val('');
      });
    });
  </script>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>





  <script>
    // Code By Webdevtrick ( https://webdevtrick.com )
    function showTime() {
      var date = new Date();
      var h = date.getHours();
      var m = date.getMinutes();
      var s = date.getSeconds();
      var session = "AM";

      if (h == 0) {
        h = 12;
      }

      if (h > 12) {
        h = h - 12;
        session = "PM";
      }

      h = (h < 10) ? "0" + h : h;
      m = (m < 10) ? "0" + m : m;
      s = (s < 10) ? "0" + s : s;

      var time = h + ":" + m + ":" + s + " " + session;
      document.getElementById("DigitalCLOCK").innerText = time;
      document.getElementById("DigitalCLOCK").textContent = time;

      setTimeout(showTime, 1000);

    }

    showTime();
  </script>
</body>

</html>