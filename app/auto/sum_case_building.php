<?php
require 'inc_file.php';
?>
<div class="col-xl-3">
    <div class="media widget-media p-4 bg-primary border text-white ">
        <div class="icon rounded-circle mr-4">
            <i class="fas fa-user-plus"></i>
        </div>
        <div class="media-body align-self-center">
            <h4 class="mb-2"><?php @$getall = $getdata->my_sql_show_rows($connect, "building_list", "date LIKE '%" . date("Y-m") . "%' AND (user_key = '" . $_SESSION['ukey'] . "' OR se_namecall = '" . $_SESSION['ukey'] . "')");
                                            echo @number_format($getall); ?></h4>
            <p>Your Case</p>
        </div>
    </div>
</div>
<div class="col-xl-3">
    <div class="media widget-media p-4 bg-success border text-white">
        <div class="icon rounded-circle mr-4">
            <i class="fas fa-user-check"></i>
        </div>
        <div class="media-body align-self-center">
            <h4 class="mb-2"><?php @$getall = $getdata->my_sql_show_rows($connect, "building_list", "card_status = '33831963cbe86c4e544c5a999984aa7b' AND (user_key = '" . $_SESSION['ukey'] . "' OR se_namecall = '" . $_SESSION['ukey'] . "') AND (date LIKE '%" . date("Y-m") . "%' )");
                                            echo @number_format($getall); ?></h4>
            <p>Success</p>
        </div>
    </div>
</div>
<div class="col-xl-3">
    <div class="media widget-media p-4 bg-warning border text-white">
        <div class="icon rounded-circle mr-4">
            <i class="fas fa-user-clock"></i>
        </div>
        <div class="media-body align-self-center">
            <h4 class="mb-2"><?php $a = NULL;
                                            @$getwait = $getdata->my_sql_show_rows($connect, "building_list", "1=1 AND (date_update = '0000-00-00' OR card_status = '5cafc78523f4f5e4812f9545b2ba5ae7') AND (date LIKE '%" . date("Y-m") . "%' ) AND (user_key = '" . $_SESSION['ukey'] . "' OR se_namecall = '" . $_SESSION['ukey'] . "')");
                                            echo @number_format($getwait); ?></h4>
            <p>Wait</p>
        </div>
    </div>
</div>

<div class="col-xl-3">
    <div class="media widget-media p-4 bg-danger border text-white">
        <div class="icon rounded-circle mr-4">
            <i class="fas fa-user-times"></i>
        </div>
        <div class="media-body align-self-center">
            <h4 class="mb-2"><?php $a = NULL;
                                            @$getwait = $getdata->my_sql_show_rows($connect, "building_list", "card_status = '57995055c28df9e82476a54f852bd214' AND (user_key = '" . $_SESSION['ukey'] . "' OR se_namecall = '" . $_SESSION['ukey'] . "') AND (date LIKE '%" . date("Y-m") . "%' )");
                                            echo @number_format($getwait); ?></h4>
            <p>Cancel</p>
        </div>
    </div>
</div>