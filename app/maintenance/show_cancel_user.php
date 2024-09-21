<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header"><i class="fa fa-trash fa-fw"></i> ตรวจสอบการยกเลิกแจ้งใช้บริการ</h1>
   </div>
</div>

<nav aria-label="breadcrumb">
   <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="index.php">หน้าแรก</a></li>
      <li class="breadcrumb-item active" aria-current="page">Case Cencel</li>
   </ol>
</nav>

<div class="card border-danger">
   <div class="card-header bg-danger text-white text-center font-weight-bold">
      รายละเอียด การแจ้งยกเลิกดำเนินการ
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered text-center table-hover" width="100%" id="datatale-desc" cellspacing="0">
            <thead class="font-weight-bold bg-danger" style="color:#FFF;">
               <tr>
                  <td>Ticket Code</td>
                  <td>ผู้แจ้ง</td>
                  <td>วันที่แจ้ง</td>
                  <td>เวลา</td>
                  <td>สถานะ</td>
                  <td>วันที่ยกเลิก</td>
                  <td>เวลา</td>
                  <td>ผู้ดำเนินการ</td>
                  <td>ดำเนินการ</td>
               </tr>
            </thead>
            <tbody>
               <?php
               $get_total = $getdata->my_sql_select($connect, NULL, "building_list", "user_key = '" . $_SESSION['ukey'] . "' AND card_status = '57995055c28df9e82476a54f852bd214'");
               while ($show_total = mysqli_fetch_object($get_total)) {
               ?>
                  <tr>
                     <td>
                        <?php
                        echo  @$show_total->ticket;
                        ?>

                     </td>
                     <td>
                        <?php echo @getemployee($show_total->user_key); ?>
                     </td>

                     <td><?php echo @dateConvertor($show_total->date); ?></td>
                     <td>
                        <?php
                        if (@$show_total->time_start != NULL & @$show_total->time_start != "00:00:00") {
                           echo @$show_total->time_start;
                        } else {
                           echo "-";
                        }
                        ?>
                     </td>

                     <td>
                        <?php

                        echo @cardStatus($show_total->card_status);

                        ?>
                     </td>
                     <td>
                        <?php
                        echo @dateConvertor($show_total->date_update);
                        ?>
                     </td>
                     <td>
                        <?php
                        if (@$show_total->time_update != NULL & @$show_total->time_update != "00:00:00") {
                           echo @$show_total->time_update;
                        } else {
                           echo "-";
                        }
                        ?>
                     </td>
                     <td>
                        <?php echo @getemployee($show_total->admin_update); ?>
                     </td>
                     <td>
                        <?php
                        echo '<a href="?p=maintenance_case_all_service&key=' . @$show_total->ticket . '" class="btn btn-sm btn-outline-success" data-top="toptitle" data-placement="top" title="ตรวจสอบ"><i class="fa fa-history"></i></a>';
                        ?>
                     </td>
                  </tr>
               <?php
               }
               ?>
            </tbody>
         </table>
      </div>
   </div>
   <div class="card-footer text-center">
      <a href="index.php" class="btn btn-xs btn-outline-danger"><i class="fa fa-reply"></i> กลับ</a>
   </div>
</div>

<!-- <div class="footer" align="center">
    
</div> -->