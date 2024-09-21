<?php
require_once 'procress/dataSetting.php';
?>
<?php echo @$alert; ?>

<div class="row">
	<div class="col-12">
		<h1 class="page-header"><i class="fa fa-tag fa-fw"></i> สถานะรายการต่าง ๆ</h1>
	</div>
</div>

<nav aria-label="breadcrumb" class="mt-3 mb-3">
	<ol class="breadcrumb breadcrumb-inverse">
		<li class="breadcrumb-item">
			<a href="index.php">หน้าแรก</a>
		</li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?p=setting">ตั้งค่า</a></li>
		<li class="breadcrumb-item active" aria-current="page">ตั้งค่าสถานะรายการ</li>
	</ol>
</nav>

<!-- New status -->
<div class="modal fade" id="modal_new_status" tabindex="-1" role="dialog" aria-labelledby="modal_new_status" aria-hidden="true">
	<form method="post" enctype="multipart/form-data" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">เพิ่มสถานะรายการ</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-12">
							<label for="status_name">ชื่อสถานะ</label>
							<input type="text" name="status_name" id="status_name" class="form-control" required>
							<div class="invalid-feedback">
								ระบุ ชื่อสถานะ
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-12">
							<label for="color_tag">Color Tag</label>
							<input type="color" name="color_tag" id="color_tag" class="form-control" value="" required>
							<div class="invalid-feedback">
								เลือก สีสถานะ
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-12">
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="3" name="status_use" class="custom-control-input" value="3" required checked>
								<label class="custom-control-label text-success" for="3">ใช้งานทุกระบบ</label>
							</div>
							<!-- <div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="2" name="status_use" class="custom-control-input" value="2" required>
								<label class="custom-control-label text-info" for="2">ใช้งานแจ้งซ่อม</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="1" name="status_use" class="custom-control-input" value="1" required>
								<label class="custom-control-label text-warning" for="1">ใช้งานรายการสินทรัพย์</label>
							</div> -->
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col text-center">

						<button class="ladda-button btn btn-primary btn-square btn-ladda bg-success" type="submit" name="save_status" data-style="expand-left">
							<span class="fas fa-save"> บันทึก</span>
							<span class="ladda-spinner"></span>
						</button>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div>
	</form><!-- /.modal-dialog -->
</div>
<!-- End New status -->
<!-- Edit Status -->
<div class="modal fade" id="edit_status" tabindex="-1" role="dialog" aria-labelledby="modal_edit_status" aria-hidden="true">
	<form method="post" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">แก้ไขข้อมูล</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="edit_status">

				</div>
				<div class="modal-footer">
					<div class="col text-center">
						<button class="ladda-button btn btn-primary btn-square btn-ladda bg-warning" type="submit" name="save_edit_status" data-style="expand-left">
							<span class="fas fa-save"> บันทึก</span>
							<span class="ladda-spinner"></span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</form><!-- /.modal-dialog -->
</div>
<!-- End Edit status -->

<div class="card card-default">
	<div class="card-header card-header-border-bottom">
		<h2>สถานะรายการต่าง ๆ </h2>
	</div>
	<div class="card-body">
		<div class="row">
			<button class="btn btn-success btn-xs float-right mb-2 btn-outline" data-toggle="modal" data-target="#modal_new_status"><i class="fa fa-plus fa-fw"></i> เพิ่มสถานะรายการ</button>
		</div>

		<div class="responsive-data-table-1">
			<table id="responsive-data-table-1" class="table dt-responsive nowrap hover text-center" width="100%">
				<thead class="bg-info text-white font-weight-bold">
					<tr>
						<td>#</td>
						<td>Color Tag</td>
						<td>ชื่อสถานะ</td>
						<td>สำคัญ</td>
						<td>การใช้งาน</td>
						<td>จัดการ</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$t = 0;
					$getcat = $getdata->my_sql_select($connect, NULL, "card_type", "ctype_name <> '' AND ctype_status != '2' ORDER BY ctype_use DESC");
					while ($showcat = mysqli_fetch_object($getcat)) {
						$t++;
					?>
						<tr>
							<td><?php echo $t; ?></td>
							<td><i class="fa fa-circle" style="color:<?php echo @$showcat->ctype_color; ?>"></i></td>
							<td><?php echo @$showcat->ctype_name; ?></td>
							<td>
								<?php if ($showcat->ctype_key == '57995055c28df9e82476a54f852bd214' || $showcat->ctype_key == '2e34609794290a770cb0349119d78d21' || $showcat->ctype_key == '9ba0f256a5f620136568c6b47dcb24bd') {
									echo '<span class="badge badge-danger">ห้ามลบ</span>';
								} else {
									echo '<span class="badge badge-success">แก้ไขได้</span>';
								} ?>
							</td>
							<td>
								<?php if ($showcat->ctype_status != 0) { ?>
									<div class="custom-control custom-checkbox custom-control-inline font-weight-bold">
										<?php if (@$showcat->ctype_use == '1') { ?>
											<input type="checkbox" class="custom-control-input" checked>
											<label class="custom-control-label text-warning">ใช้งานรายการสินทรัพย์</label>
										<?php } elseif (@$showcat->ctype_use == '2') { ?>
											<input type="checkbox" class="custom-control-input" checked>
											<label class="custom-control-label text-info">ใช้งานแจ้งซ่อม</label>
										<?php } elseif (@$showcat->ctype_use == '3') { ?>
											<input type="checkbox" class="custom-control-input" checked>
											<label class="custom-control-label text-success">ใช้งานทุกระบบ</label>
										<?php } ?>
									</div>
								<?php } else { ?>
									<label class="text-danger font-weight-bold">ปิดการใช้งาน</label>
								<?php } ?>
							</td>
							<td>
								<?php
								if ($showcat->ctype_status == '1') {
									echo '<button type="button" class="btn btn-success btn-sm" id="btn-' . @$showcat->ctype_key . '" onclick="javascript:changeTypeStatus(\'' . @$showcat->ctype_key . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-eye fa-fw" id="icon-' . @$showcat->ctype_key . '"></i> <span id="text-' . @$showcat->ctype_key . '"></span></button>';
								} else {
									echo '<button type="button" class="btn btn-danger btn-sm" id="btn-' . @$showcat->ctype_key . '" onclick="javascript:changeTypeStatus(\'' . @$showcat->ctype_key . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-eye-slash fa-fw" id="icon-' . @$showcat->ctype_key . '"></i> <span id="text-' . @$showcat->ctype_key . '"></span></button>';
								}
								?>
								<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_status" data-whatever="<?php echo @$showcat->ctype_key; ?>" data-top="toptitle" data-placement="top" title="แก้ไข"><i class="fa fa-edit fa-fw"></i></button>
								<?php if ($_SESSION['uclass'] == 3) { ?>
									<a href="#" onclick="deleteStatus('<?php echo @$showcat->ctype_key; ?>');" class="btn btn-sm btn-outline-danger" data-toggle="toptitle" data-placement="top" title="ลบรายการนี้"><i class="fa fa-times"></i></a>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="card-footer text-center">
		<a class="btn btn-md btn-outline-info" href="index.php?p=setting"><i class="fas fa-arrow-circle-left"></i> กลับ</a>
	</div>
</div>