<?php $getmenus = $getdata->my_sql_query($connect, null, 'menus', "menu_status ='1' AND menu_case = 'report' AND menu_key != 'c6c8729b45d1fec563f8453c16ff03b8'"); ?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-chart-bar fa-2x"></i> กราฟสรุปงาน</h3>
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

<div class="row">
    <div class="col-lg-6">
        <div class="card card-default">
            <div id="accordion1" class="accordion accordion-shadow">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            งานประจำปี <u><?php echo date('Y') + 543; ?></u> เดือน <u><?php echo @month(); ?></u>
                        </button>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion1">
                        <div class="card-body">
                            <canvas id="workmonth"></canvas>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>


    <div class="col-lg-6">
        <div class="card card-default">
            <div id="accordion2" class="accordion accordion-shadow">

                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            งานแต่ละประเภท
                        </button>
                    </div>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion2">
                        <div class="card-body">

                            <canvas id="work"></canvas>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-6">
        <div class="card card-default">
            <div id="accordion3" class="accordion accordion-shadow">
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            สถานะงานแยก 4 ประเภทประจำปี <u><?php echo date('Y') + 543; ?></u>
                        </button>
                    </div>

                    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion3">
                        <div class="card-body">
                            <canvas id="asset"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>





<?php

$m1 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-01%'");
$m2 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-02%'");
$m3 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-03%'");
$m4 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-04%'");
$m5 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-05%'");
$m6 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-06%'");
$m7 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-07%'");
$m8 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-08%'");
$m9 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-09%'");
$m10 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-10%'");
$m11 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-11%'");
$m12 = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '" . date("Y") . "-12%'");


$getcolor_success = $getdata->my_sql_query($connect, NULL, "card_type", "ctype_key = '2e34609794290a770cb0349119d78d21'");
$getcolor_cancel = $getdata->my_sql_query($connect, NULL, "card_type", "ctype_key = '57995055c28df9e82476a54f852bd214'");
$getcolor_addwork = $getdata->my_sql_query($connect, NULL, "card_type", "ctype_key = 'befb5e146e599a9876757fb18ce5fa2e'");

$sumsuccess = $getdata->my_sql_show_rows($connect, "building_list", "card_status = '2e34609794290a770cb0349119d78d21' AND date_update != '0000-00-00' AND date_update LIKE '" . date("Y") . "%'");
$sumcancel = $getdata->my_sql_show_rows($connect, "building_list", "card_status = '57995055c28df9e82476a54f852bd214' AND  date LIKE '" . date("Y") . "%'");
$sumstartwork = $getdata->my_sql_show_rows($connect, "building_list", "card_status = 'befb5e146e599a9876757fb18ce5fa2e' AND date_update != '0000-00-00' AND date_update LIKE '" . date("Y") . "%'");
$sumnull = $getdata->my_sql_show_rows($connect, "building_list", "card_status IS NULL AND date_update = '0000-00-00'");

?>





<!-- echo $showquery . " " . $show->ctype_name . "<br>"; -->

<script type="text/javascript">
    var ctx = document.getElementById('work').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['งานประจำปี <?php echo date('Y') + 543; ?>'],
            datasets: [

                <?php
                $getstatus = $getdata->my_sql_select($connect, NULL, "card_type", "ctype_status != 0 ORDER BY ctype_name DESC");

                while ($show = mysqli_fetch_object($getstatus)) {
                    $showquery = $getdata->my_sql_show_rows($connect, "building_list", "card_status = '$show->ctype_key'");
                    if ($showquery > 0) { ?>

                        {
                            label: '<?php echo $show->ctype_name; ?>',
                            data: [
                                '<?php echo $showquery; ?>'
                            ],
                            backgroundColor: [
                                '<?php echo $show->ctype_color; ?>',
                            ],

                        },

                <?php
                    }
                }
                $showquery2 = $getdata->my_sql_show_rows($connect, "building_list", "card_status IS NULL");
                // echo $showquery2;
                ?>

            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>



<script type="text/javascript">
    var ctx = document.getElementById('asset').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                'ยกเลิกการแจ้ง',
                'รับดำเนินการ',
                'ดำเนินการเสร็จสิ้น',
                'รอดำเนินการ'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [<?php echo $sumcancel; ?>, <?php echo $sumstartwork; ?>, <?php echo $sumsuccess; ?>, <?php echo $sumnull; ?>],
                backgroundColor: [
                    'rgb(255, 0, 0)',
                    'rgb(0, 255, 255)',
                    'rgb(0, 255, 0)',
                    'rgb(255, 128, 0)'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>


<script>
    var ctx = document.getElementById('workmonth').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['จำนวนการแจ้งปัญหา'],
            datasets: [{
                label: 'เดือน มกราคม',
                data: [
                    <?php echo $m1 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', // 12
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // 12
                ],
                borderWidth: 1
            }, {
                label: 'เดือน กุมภาพันธ์',
                data: [
                    <?php echo $m2 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน มีนาคม',
                data: [
                    <?php echo $m3 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน เมษายน',
                data: [
                    <?php echo $m4 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน พฤษภาคม',
                data: [
                    <?php echo $m5 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 15, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 15, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน มิถุนายน',
                data: [
                    <?php echo $m6 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(163, 15, 52, 0.2)',
                ],
                borderColor: [
                    'rgba(163, 15, 52, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน กรกฎาคม',
                data: [
                    <?php echo $m7 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(15, 163, 144, 0.2)',
                ],
                borderColor: [
                    'rgba(15, 163, 144, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน สิงหาคม',
                data: [
                    <?php echo $m8 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(126, 163, 15, 0.2)',
                ],
                borderColor: [
                    'rgba(126, 163, 15, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน กันยายน',
                data: [
                    <?php echo $m9 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(15, 163, 109, 0.2)',
                ],
                borderColor: [
                    'rgba(15, 163, 109, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน ตุลาคม',
                data: [
                    <?php echo $m10 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(15, 30, 163,  0.2)',
                ],
                borderColor: [
                    'rgba(15, 30, 163,  1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน พฤศจิกายน',
                data: [
                    <?php echo $m11 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(163, 141, 15, 0.2)',
                ],
                borderColor: [
                    'rgba(163, 141, 15, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'เดือน ธันวาคม',
                data: [
                    <?php echo $m12 . ',' ?>
                ],
                backgroundColor: [
                    'rgba(163, 15, 124, 0.2)',
                ],
                borderColor: [
                    'rgba(163, 15, 124, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>