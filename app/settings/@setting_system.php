<?php require_once 'procress/dataSetting.php'; ?>
<?php echo @$alert; ?>
<!-- Modal new name Prefix -->
<div class="modal fade" id="modal_new_prefix" role="dialog" aria-labelledby="modal_new_prefix" aria-hidden="true">
	<form method="post" enctype="multipart/form-data" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">เพิ่มคำนำหน้า</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="prefix_title">ชื่อคำนำหน้านาม</label>
						<input type="text" name="prefix_title" id="prefix_title" class="form-control" required>
						<div class="invalid-feedback">
							ระบุ คำนำหน้านาม
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col text-center">
						<button class="ladda-button btn btn-primary btn-square btn-ladda bg-success" type="submit" name="save_prefix" data-style="expand-left">
							<span class="fas fa-save"> บันทึก</span>
							<span class="ladda-spinner"></span>
						</button>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div>
	</form>
</div><!-- /.modal -->

<!-- Modal new company -->
<div class="modal fade" id="modal_new_company" role="dialog" aria-labelledby="modal_new_company" aria-hidden="true">
	<form method="post" enctype="multipart/form-data" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">เพิ่มบริษัท</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="new_company">ชื่อบริษัท</label>
						<input type="text" name="new_company" id="new_company" class="form-control" required>
						<div class="invalid-feedback">
							ระบุ ชื่อบริษัท
						</div>
					</div>
					<hr class="sidebar-divider d-none d-block">
				</div>
				<div class="modal-footer">
					<div class="col text-center">
						<button class="ladda-button btn btn-primary btn-square btn-ladda bg-success" type="submit" name="save_company" data-style="expand-left">
							<span class="fas fa-save"> บันทึก</span>
							<span class="ladda-spinner"></span>
						</button>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div>
	</form>
</div><!-- /.modal -->

<!-- Modal new Department -->
<div class="modal fade" id="modal_new_department" role="dialog" aria-labelledby="modal_new_department" aria-hidden="true">
	<form method="post" enctype="multipart/form-data" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">เพิ่มแผนก</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="department_name">ชื่อแผนก</label>
						<input type="text" name="department_name" id="department_name" class="form-control" required>
						<div class="invalid-feedback">
							ระบุ ชื่อแผนก
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col text-center">

						<button class="ladda-button btn btn-primary btn-square btn-ladda bg-success" type="submit" name="save_department" data-style="expand-left">
							<span class="fas fa-save"> บันทึก</span>
							<span class="ladda-spinner"></span>
						</button>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div>
	</form>
</div><!-- /.modal -->

<!-- Modal new Device -->
<div class="modal fade" id="modal_new_device" role="dialog" aria-labelledby="modal_new_device" aria-hidden="true">
	<form method="post" enctype="multipart/form-data" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">เพิ่มอุปกรณ์</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="device_name">ชื่ออุปกรณ์</label>
						<input type="text" name="device_name" id="device_name" class="form-control" required>
						<div class="invalid-feedback">
							ระบุ ชื่ออุปกรณ์
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col text-center">
						<button class="ladda-button btn btn-primary btn-square btn-ladda bg-success" type="submit" name="save_device" data-style="expand-left">
							<span class="fas fa-save"> บันทึก</span>
							<span class="ladda-spinner"></span>
						</button>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div>
	</form>
</div><!-- /.modal -->

<!-- Edit name Prefix -->
<div class="modal fade" id="edit_prefix" role="dialog" aria-labelledby="modal_edit_prefix" aria-hidden="true">
	<form method="post" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">แก้ไขข้อมูล</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="edit_prefix">

				</div>
				<div class="modal-footer">
					<button class="ladda-button btn btn-primary btn-square btn-ladda bg-warning" type="submit" name="save_edit_prefix" data-style="expand-left">
						<span class="fas fa-save"> บันทึก</span>
						<span class="ladda-spinner"></span>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- End Modal -->


<!-- Edit Company -->
<div class="modal fade" id="edit_company" role="dialog" aria-labelledby="modal_edit_company" aria-hidden="true">
	<form method="post" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">แก้ไขข้อมูล</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="edit_company">

				</div>
				<div class="modal-footer">
					<button class="ladda-button btn btn-primary btn-square btn-ladda bg-warning" type="submit" name="save_edit_company" data-style="expand-left">
						<span class="fas fa-save"> บันทึก</span>
						<span class="ladda-spinner"></span>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- End Modal -->

<!-- Edit Department -->
<div class="modal fade" id="edit_department" role="dialog" aria-labelledby="modal_edit_department" aria-hidden="true">
	<form method="post" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">แก้ไขข้อมูล</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="edit_department">

				</div>
				<div class="modal-footer">
					<button class="ladda-button btn btn-primary btn-square btn-ladda bg-warning" type="submit" name="save_edit_department" data-style="expand-left">
						<span class="fas fa-save"> บันทึก</span>
						<span class="ladda-spinner"></span>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- End Modal -->


<!-- Edit Device -->
<div class="modal fade" id="edit_device" role="dialog" aria-labelledby="modal_edit_device" aria-hidden="true">
	<form method="post" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">แก้ไขข้อมูล</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="edit_device">

				</div>
				<div class="modal-footer">
					<button class="ladda-button btn btn-primary btn-square btn-ladda bg-warning" type="submit" name="save_edit_device" data-style="expand-left">
						<span class="fas fa-save"> บันทึก</span>
						<span class="ladda-spinner"></span>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- End Modal -->


<div class="row">
	<div class="col-12">
		<h1 class="page-header"><i class="fa fa-sliders-h fa-fw"></i> ตั้งค่าภายในระบบ</h1>
	</div>
</div>
<nav aria-label="breadcrumb" class="mt-3 mb-3">
	<ol class="breadcrumb breadcrumb-inverse">
		<li class="breadcrumb-item">
			<a href="index.php">หน้าแรก</a>
		</li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?p=setting">ตั้งค่า</a></li>
		<li class="breadcrumb-item active" aria-current="page">ตั้งค่าภายในระบบ</li>
	</ol>
</nav>

<div class="card card-default">
	<div class="card-header card-header-border-bottom">
		<h2>ตั้งค่าทั่วไปภายในระบบ</h2>
	</div>
	<div class="card-body">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link <?php if (isset($_POST['save_company']) || isset($_POST['save_edit_company']) || isset($_POST['save_department']) || isset($_POST['save_edit_department']) || isset($_POST['save_device']) || isset($_POST['save_edit_device'])) {
										echo '';
									} else {
										echo 'active';
									};
									?>" id=" prefixname-tab" data-toggle="tab" href="#prefixname" role="tab" aria-controls="prefixname" aria-selected="true">
					<i class="mdi mdi-star mr-1"></i> คำนำหน้าชื่อ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if (isset($_POST['save_company']) || isset($_POST['save_edit_company'])) {
										echo 'active';
									};
									?>" id="company-tab" data-toggle="tab" href="#company" role="tab" aria-controls="company" aria-selected="false">
					<i class="mdi mdi-office-building mr-1"></i> บริษัท</a>
			</li>

			<li class="nav-item">
				<a class="nav-link <?php if (isset($_POST['save_department']) || isset($_POST['save_edit_department'])) {
										echo 'active';
									};
									?>" id="department-tab" data-toggle="tab" href="#department" role="tab" aria-controls="department" aria-selected="false"><i class="mdi mdi-buffer mr-1"></i> แผนก</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if (isset($_POST['save_device']) || isset($_POST['save_edit_device'])) {
										echo 'active';
									};
									?>" id="device-tab" data-toggle="tab" href="#device" role="tab" aria-controls="device" aria-selected="false">
					<i class="mdi mdi-box-shadow mr-1"></i> อุปกรณ์</a>
			</li>
		</ul>

		<div class="tab-content" id="myTabContent2">

			<div class="tab-pane pt-3 fade <?php if (isset($_POST['save_company']) || isset($_POST['save_edit_company']) || isset($_POST['save_department']) || isset($_POST['save_edit_department']) || isset($_POST['save_device']) || isset($_POST['save_edit_device'])) {
												echo '';
											} else {
												echo 'show active';
											};
											?>" id="prefixname" role="tabpanel" aria-labelledby="prefixname-tab">

				<div class="card shadow">
					<div class="card-body">
						<div class="row">
							<button class="btn btn-success btn-xs float-right mb-2" data-toggle="modal" data-target="#modal_new_prefix"><i class="fa fa-plus fa-fw"></i> เพิ่มคำนำหน้า</button>
						</div>
						<div class="responsive-data-table-1">
							<table id="responsive-data-table-1" class="table dt-responsive nowrap hover text-center" width="100%">
								<thead class="bg-info text-white font-weight-bold">
									<tr>
										<td>ลำดับ</td>
										<td>รายการ</td>
										<td>การแสดงผล</td>
										<td>จัดการ</td>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									$getprefix = $getdata->my_sql_select($connect, null, "members_prefix", "prefix_code <> 'hidden' AND prefix_status = '1' OR prefix_status = '0' AND prefix_status != '2' ORDER BY prefix_status DESC");
									while ($showprefix = mysqli_fetch_object($getprefix)) {
										$i++
									?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo @$showprefix->prefix_title; ?></td>
											<td>
												<?php
												if ($showprefix->prefix_status == 1) {
													echo '<span class="mb-2 mr-2 badge badge-success">กำลังใช้งาน</span>';
												} elseif ($showprefix->prefix_status == 0) {
													echo '<span class="mb-2 mr-2 badge badge-danger">ปิดการใช้งาน</span>';
												} ?>
											</td>
											<td>
												<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_prefix" data-whatever="<?php echo @$showprefix->prefix_key; ?>"><i class="fa fa-edit"></i></button>
												<?php if ($_SESSION['uclass'] == 3) { ?>
													<a href="#" onclick="deletePrefix('<?php echo @$showprefix->prefix_key; ?>');" class="btn btn-sm btn-outline-danger" data-toggle="toptitle" data-placement="top" title="ลบรายการนี้"><i class="fa fa-trash-alt"></i></a>
												<?php } ?>
											</td>
										</tr>
									<?php
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>

			<div class="tab-pane pt-3 fade <?php if (isset($_POST['save_company']) || isset($_POST['save_edit_company'])) {
												echo 'show active';
											};
											?>" id="company" role="tabpanel" aria-labelledby="company-tab">

				<div class="card shadow">
					<div class="card-body">
						<div class="row">
							<button class="btn btn-success btn-xs float-right mb-2" data-toggle="modal" data-target="#modal_new_company"><i class="fa fa-plus fa-fw"></i> เพิ่มบริษัท</button>
						</div>
						<div class="responsive-data-table-2">
							<table id="responsive-data-table-2" class="table dt-responsive nowrap hover text-center" width="100%">
								<thead class="bg-info text-white font-weight-bold">
									<tr>
										<td>ลำดับ</td>
										<td>รายชื่อบริษัท</td>
										<td>การแสดงผล</td>
										<td>จัดการ</td>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									$getcompany = $getdata->my_sql_select($connect, null, "company", "id <> 'hidden' AND cp_status = '1' OR cp_status = '0' AND cp_status != '2' ORDER BY cp_status DESC");
									while ($showcompany = mysqli_fetch_object($getcompany)) {
										$i++; ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo @$showcompany->company_name; ?></td>
											<td>
												<?php
												if ($showcompany->cp_status == 1) {
													echo '<span class="mb-2 mr-2 badge badge-success">กำลังใช้งาน</span>';
												} elseif ($showcompany->cp_status == 0) {
													echo '<span class="mb-2 mr-2 badge badge-danger">ปิดการใช้งาน</span>';
												} ?>
											</td>
											<td>
												<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_company" data-whatever="<?php echo @$showcompany->id; ?>"><i class="fa fa-edit"></i></button>
												<?php if ($_SESSION['uclass'] == 3) { ?>
													<a href="#" onclick="deleteCompany('<?php echo @$showcompany->id; ?>');" class="btn btn-sm btn-outline-danger" data-toggle="toptitle" data-placement="top" title="ลบรายการนี้"><i class="fa fa-trash-alt"></i></a>
												<?php } ?>
											</td>

										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>



			<div class="tab-pane pt-3 fade <?php if (isset($_POST['save_department']) || isset($_POST['save_edit_department'])) {
												echo 'show active';
											};
											?>" id="department" role="tabpanel" aria-labelledby="department-tab">

				<div class="card shadow">
					<div class="card-body">
						<div class="row">
							<button class="btn btn-success btn-xs float-right mb-2" data-toggle="modal" data-target="#modal_new_department"><i class="fa fa-plus fa-fw"></i> เพิ่มแผนก</button>
						</div>
						<div class="responsive-data-table-3">
							<table id="responsive-data-table-3" class="table dt-responsive nowrap hover text-center" width="100%">
								<thead class="bg-info text-white font-weight-bold">
									<tr>
										<td>ลำดับ</td>
										<td>รายชื่อแผนก</td>
										<td>การแสดงผล</td>
										<td>จัดการ</td>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									$getdep = $getdata->my_sql_select($connect, null, "department_name", "id <> 'hidden' AND department_status = '1' OR department_status = '0' AND department_status != '2' ORDER BY department_status DESC");
									while ($showdep = mysqli_fetch_object($getdep)) {
										$i++; ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo @$showdep->department_name; ?></td>
											<td>
												<?php
												if ($showdep->department_status == 1) {
													echo '<span class="mb-2 mr-2 badge badge-success">กำลังใช้งาน</span>';
												} elseif ($showdep->department_status == 0) {
													echo '<span class="mb-2 mr-2 badge badge-danger">ปิดการใช้งาน</span>';
												} ?>
											</td>
											<td>
												<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_department" data-whatever="<?php echo @$showdep->id; ?>"><i class="fa fa-edit"></i></button>
												<?php if ($_SESSION['uclass'] == 3) { ?>
													<a href="#" onclick="deleteDepartment('<?php echo @$showdep->id; ?>');" class="btn btn-sm btn-outline-danger" data-toggle="toptitle" data-placement="top" title="ลบรายการนี้"><i class="fa fa-trash-alt"></i></a>
												<?php } ?>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>

			<div class="tab-pane pt-3 fade <?php if (isset($_POST['save_device']) || isset($_POST['save_edit_device'])) {
												echo 'show active';
											};
											?>" id="device" role="tabpanel" aria-labelledby="device-tab">

				<div class="card shadow">

					<div class="card-body">
						<div class="row">
							<button type="button" class="btn btn-success btn-xs float-right mb-2" data-toggle="modal" data-target="#modal_new_device"><i class="fa fa-plus fa-fw"></i> เพิ่มอุปกรณ์</button>
						</div>
						<div class="responsive-data-table-4">
							<table id="responsive-data-table-4" class="table dt-responsive nowrap hover text-center" width="100%">
								<thead class="bg-info text-white font-weight-bold">
									<tr>
										<td>ลำดับ</td>
										<td>รายการอุปกรณ์</td>
										<td>การแสดงผล</td>
										<td>จัดการ</td>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									$getdevice = $getdata->my_sql_select($connect, null, "device_type", "id <> 'hidden' AND device_status = '1' OR device_status = '0' AND device_status !='2' ORDER BY device_status DESC");
									while ($showdevice = mysqli_fetch_object($getdevice)) {
										$i++; ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo @$showdevice->device_type; ?></td>
											<td>
												<?php
												if ($showdevice->device_status == 1) {
													echo '<span class="mb-2 mr-2 badge badge-success">กำลังใช้งาน</span>';
												} elseif ($showdevice->device_status == 0) {
													echo '<span class="mb-2 mr-2 badge badge-danger">ปิดการใช้งาน</span>';
												} ?>
											</td>
											<td>
												<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_device" data-whatever="<?php echo @$showdevice->id; ?>"><i class="fa fa-edit"></i></button>
												<?php if ($_SESSION['uclass'] == 3) { ?>
													<a href="#" onclick="deleteDevice('<?php echo @$showdevice->id; ?>');" class="btn btn-sm btn-outline-danger" data-toggle="toptitle" data-placement="top" title="ลบรายการนี้"><i class="fa fa-trash-alt"></i></a>
												<?php } ?>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	<div class="card-footer text-center">
		<a class="btn btn-md btn-outline-info" href="index.php?p=setting"><i class="fas fa-arrow-circle-left"></i> กลับ</a>
	</div>


</div>