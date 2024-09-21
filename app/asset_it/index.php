<?php $getmenus = $getdata->my_sql_query($connect, null, 'menus', "menu_status ='1' AND menu_case = '" . $_GET['p'] . "' AND menu_key != 'c6c8729b45d1fec563f8453c16ff03b8'"); ?>

<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><?php echo '<i class="fas ' . $getmenus->menu_icon . ' fa-2x"></i> <span>' . $getmenus->menu_name . '</span>'; ?></h3>
  </div>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
  <ol class="breadcrumb breadcrumb-inverse">
    <li class="breadcrumb-item">
      <a href="index.php">หน้าแรก</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo '<span>' . $getmenus->menu_name . '</span>'; ?></li>
  </ol>
</nav>

<div class="card card-default">
  <div class="card-header card-header-border-bottom">
    <h2><?php echo '<span>' . $getmenus->menu_name . '</span>'; ?></h2>
  </div>

  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="ipills-summary" role="tabpanel" aria-labelledby="ipills-summary-tab">
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked flex-column">
              <li class="nav-item">
                <a class="nav-link <?php if (isset($_POST['search'])) {
                                      echo '';
                                    } elseif (isset($_POST['filter_device'])) {
                                      echo '';
                                    } elseif (isset($_POST['export'])) {
                                      echo '';
                                    } else {
                                      echo 'active';
                                    }; ?>" id="reserve-tab" data-toggle="tab" href="#reserve" role="tab" aria-controls="reserve" aria-selected="true"><i class="fas fa-list-ol"></i> รายการอุปกรณ์สำรอง</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if (isset($_POST['search'])) {
                                      echo 'active';
                                    }; ?>" id="use-tab" data-toggle="tab" href="#use" role="tab" aria-controls="use" aria-selected="false"><i class="fas fa-network-wired"></i> รายการอุปกรณ์ที่ใช้งานอยู่</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if (isset($_POST['filter_device'])) {
                                      echo 'active';
                                    }; ?>" id=" filter_device" data-toggle="tab" href="#filter_device" role="tab" aria-controls="filter_device" aria-selected="false"><i class="fas fa-search"></i> ค้นหาแยกตามอุปกรณ์</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if (isset($_POST['export'])) {
                                      echo 'active';
                                    }; ?>" id=" export" data-toggle="tab" href="#export" role="tab" aria-controls="export" aria-selected="false"><i class="fas fa-file-download"></i> ออกรายงานอุปกรณ์</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="newasset_it-tab" data-toggle="tab" href="#newasset_it" role="tab" aria-controls="newasset_it" aria-selected="false"><i class="fas fa-address-card"></i> เพิ่มรายการสินทรัพย์</a>
              </li>

            </ul>
          </div>

          <div class="tab-content col-md-10" id="myTabContent3">
            <div class="row mt-3 mb-0">
              <div class="col-md-3 col-sm-6">
                <div class="media widget-media p-4 bg-white border">
                  <i class="mdi mdi-desktop-tower-monitor text-blue mr-4"></i>
                  <div class="media-body align-self-center">
                    <h4 class="text-primary mb-2"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_key <> 'hidden' AND card_status != ''");
                                                  echo @number_format($getall); ?></h4>
                    <p>จำนวนรายการทั้งหมด</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="media widget-media p-4 rounded bg-white border">
                  <i class="mdi mdi-account-clock text-success mr-4"></i>
                  <div class="media-body align-self-center">
                    <h4 class="text-success mb-2"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_status = '2e34609794290a770cb0349119d78d21' <> 'hidden' AND card_delete ='1'");
                                                  echo @number_format($getall); ?></h4>
                    <p>จำนวนรายการที่ใช้งาน</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="media widget-media p-4 rounded bg-white border">
                  <i class="mdi mdi-account-convert text-warning mr-4"></i>
                  <div class="media-body align-self-center">
                    <h4 class="text-warning mb-2"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_status = '9ba0f256a5f620136568c6b47dcb24bd' AND card_delete ='1'");
                                                  echo @number_format($getall); ?></h4>
                    <p>จำนวนรายการที่สำรอง</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="media widget-media p-4 rounded bg-white border">
                  <i class="mdi mdi-loading mdi-spin text-danger mr-4"></i>
                  <div class="media-body align-self-center">
                    <h4 class="text-danger mb-2"><?php @$getall = $getdata->my_sql_show_rows($connect, "card_info", "card_status = NULL OR card_status = ''");
                                                  echo @number_format($getall); ?></h4>
                    <p><a href="index.php?p=add_detail" target="_blank">ข้อมูลไม่สมบูรณ์</a></p>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="tab-pane pt-3 fade <?php if (isset($_POST['search'])) {
                                              echo '';
                                            } elseif (isset($_POST['filter_device'])) {
                                              echo '';
                                            } elseif (isset($_POST['export'])) {
                                              echo '';
                                            } else {
                                              echo 'show active';
                                            }; ?>" id="reserve" role="tabpanel" aria-labelledby="reserve-tab">

              <div class="row">
                <div class="col-12">
                  <?php require_once 'table/reserve.php'; ?>
                </div>
              </div>
            </div>
            <div class="tab-pane pt-3 fade <?php if (isset($_POST['search'])) {
                                              echo 'show active';
                                            }; ?>" id="use" role="tabpanel" aria-labelledby="use-tab">

              <div class="row">
                <div class="col-12">
                  <?php require_once 'table/use.php'; ?>
                </div>
              </div>
            </div>

            <div class="tab-pane pt-3 fade <?php if (isset($_POST['filter_device'])) {
                                              echo 'show active';
                                            }; ?>" id="filter_device" role="tabpanel" aria-labelledby="filter_device-tab">

              <div class="row">
                <div class="col-12">
                  <?php require_once 'table/filter.php'; ?>
                </div>
              </div>
            </div>
            <div class="tab-pane pt-3 fade <?php if (isset($_POST['export'])) {
                                              echo 'show active';
                                            }; ?>" id="export" role="tabpanel" aria-labelledby="export-tab">

              <div class="row">
                <div class="col-12">
                  <?php require_once 'table/report.php'; ?>
                </div>
              </div>
            </div>

            <div class="tab-pane pt-3 fade" id="newasset_it" role="tabpanel" aria-labelledby="newasset_it-tab">
              <div class="col-12">
                <?php require_once 'form/form_new_asset.php'; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>