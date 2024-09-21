<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fas fa-chalkboard-teacher fa-fw"></i> ข้อมูลไม่สมบูรณ์</h1>
  </div>
</div>



<nav aria-label="breadcrumb" class="mt-3 mb-3">
  <ol class="breadcrumb breadcrumb-inverse">
    <li class="breadcrumb-item">
      <a href="index.php">หน้าแรก</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">ข้อมูลไม่สมบูรณ์</li>
  </ol>
</nav>


<div class="card border-danger">
  <div class="card-header bg-danger card-default">
    <h6 class="m-0 font-weight-bold text-md text-white text-center">รายการที่ไม่สมบูรณ์</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered text-center table-hover" width="100%" id="dataTable" cellspacing="0">
        <thead class="font-weight-bold bg-warning" style="color:#FFF;">
          <tr>
            <td>ลำดับ</td>
            <td>Tickets Code</td>
            <td>วันที่เริ่มใช้งาน</td>
            <td>ชื่อ - นามสกุล</td>
            <td>บริษัท / สังกัดผู้ใช้งาน</td>
            <td>แผนก</td>
            <td>อุปกรณ์</td>
            <td>จำนวน</td>
            <td>สถานะ</td>
            <td>ผู้บันทึก</td>
            <td>จัดการ</td>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $getcard = $getdata->my_sql_select($connect, NULL, "card_info", " card_status = '' AND card_delete ='1'  ORDER BY card_insert DESC");
          while ($showcard = mysqli_fetch_object($getcard)) {
            $i++;
          ?>
            <tr>
              <td><?php echo @$i; ?></td>
              <td><?php echo @$showcard->card_code; ?></td>
              <td><?php echo @dateConvertor($showcard->card_insert); ?></td>

              <td><?php echo @getemployee($showcard->card_customer_name) ?></td>

              <td><?php echo @getemployee_company($showcard->card_customer_name) ?></td>
              <td><?php echo @prefixConvertorDepartment($showcard->card_customer_name); ?></td>
              <td><?php echo @prefixConvertorequipment($showcard->card_equipment); ?></td>
              <td><?php echo @$showcard->card_sum; ?></td>

              <td><?php echo @cardStatus($showcard->card_status); ?></td>
              <td>
                <?php
                echo @getemployee($showcard->user_key);
                ?></td>
              <td>
                <a href="?p=asset_it_create_detail&key=<?php echo @$showcard->card_key; ?>" class="btn btn-sm btn-outline-info" data-toggle="toptitle" data-placement="top" title="แก้ไข"><i class="fa fa-edit"></i></a>
                <a href="#" onclick="deleteCard('<?php echo @$showcard->card_key; ?>');" class="btn btn-sm btn-outline-danger" data-toggle="toptitle" data-placement="top" title="ลบรายการ"><i class="fa fa-times"></i></a></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer text-center">
    <a class="btn btn-xs btn-outline-danger" href="#" onclick="window.close();"><i class="fas fa-times-circle"></i> ปิด</a>
  </div>
</div>