<?php
$count = $getdata->my_sql_show_rows($connect, "list", "cases='" . htmlspecialchars($_POST['page_name']) . "'");
if (isset($_POST['save_new_link'])) {
	if (htmlspecialchars($_POST['page_name']) != NULL && htmlspecialchars($_POST['link_name']) != NULL) {
		if ($count < 1) {
			$getdata->my_sql_insert(
				$connect,
				"list",
				"cases = '" . htmlspecialchars($_POST['page_name']) . "',
			menu = '" . htmlspecialchars($_POST['folder_name']) . "',
			pages = '" . htmlspecialchars($_POST['link_name']) . "'"
			);
			$alert = $success;
		} else {
			$alert = $counterror;
		}
	} else {
		$alert = $warning;
	}
}

if (isset($_POST['save_edit_page'])) {
	if (htmlspecialchars($_POST['edit_page_name']) != NULL && htmlspecialchars($_POST['edit_link']) != NULL) {
		$getdata->my_sql_update(
			$connect,
			"list",
			"cases ='" . htmlspecialchars($_POST['edit_page_name']) . "',
			menu ='" . htmlspecialchars($_POST['edit_folder']) . "',
			pages='" . htmlspecialchars($_POST['edit_link']) . "'",
			"id='" . htmlspecialchars($_POST['id_link']) . "'"
		);
		$alert = $saveedit;
	} else {
		$alert = $warning;
	}
}
?>
<?php echo @$alert; ?>
<div class="row">
	<div class="col-12">
		<h1 class="page-header"><i class="fa fa-bezier-curve"></i> [ผู้ดูแลระบบ] ตั้งลิงค์หน้า</h1>
	</div>
</div>


<nav aria-label="breadcrumb" class="mt-3 mb-3">
	<ol class="breadcrumb breadcrumb-inverse">
		<li class="breadcrumb-item">
			<a href="index.php">หน้าแรก</a>
		</li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?p=setting">ตั้งค่า</a></li>
		<li class="breadcrumb-item active" aria-current="page">ตั้งลิงค์หน้า</li>
	</ol>
</nav>
<!-- New link -->
<div class="modal fade" id="modal_new_link" tabindex="-1" role="dialog" aria-labelledby="modal_new_link" aria-hidden="true">
	<form method="post" enctype="multipart/form-data" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">เพิ่มรายการลิงค์หน้า</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-md-4 col-sm-12">
							<label for="page_name">ชื่อไฟล์</label>
							<input type="text" name="page_name" id="page_name" class="form-control input-sm" required autocomplete="off">
							<div class="invalid-feedback">
								*** ใส่เฉพาะชื่อไฟล์ไม่ต้องมี .php ***
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<label for="folder_name">หมวดหมู่</label>
							<input type="text" name="folder_name" id="folder_name" class="form-control input-sm" required autocomplete="off">
						</div>
						<div class="col-md-4 col-sm-12">
							<label for="link_name">Part File</label>
							<input type="text" name="link_name" id="link_name" class="form-control input-sm" required autocomplete="off">
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<div class="col text-center">

						<button class="ladda-button btn btn-primary btn-square btn-ladda bg-warning" type="submit" name="save_new_link" data-style="expand-left">
							<span class="fas fa-save"> บันทึก</span>
							<span class="ladda-spinner"></span>
						</button>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div>
	</form><!-- /.modal-dialog -->
</div>
<!-- End New link -->

<!-- Edit Page list -->
<div class="modal fade" id="edit_page" tabindex="-1" role="dialog" aria-labelledby="modal_edit_page" aria-hidden="true">
	<form method="post" action="<?php echo $SERVER_NAME; ?>" class="was-validated">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">แก้ไขข้อมูล</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="edit_page">

				</div>
				<div class="modal-footer">
					<div class="col text-center">

						<button class="ladda-button btn btn-primary btn-square btn-ladda bg-warning" type="submit" name="save_edit_page" data-style="expand-left">
							<span class="fas fa-save"> บันทึก</span>
							<span class="ladda-spinner"></span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</form><!-- /.modal-dialog -->
</div>
<!-- End edit Page list -->
<div class="card mb-2">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs">
			<li class="nav-item font-weight-bold">
				<a class="nav-link text-danger active" id="pagelink-tab" data-toggle="tab" href="#pagelink" role="tab" aria-controls="pagelink" aria-selected="true">รายการลิงค์หน้า</a>
			</li>
		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content" id="myTabContent">
			<div class="tab-panel fade show active" id="service" role="tabpanel" aria-labelledby="service-tab">
				<div class="card shadow">
					<div class="card-body m-2">
						<div class="row">
							<button class="btn btn-danger btn-xs float-right mb-2 btn-outline" data-toggle="modal" data-target="#modal_new_link"><i class="fa fa-plus fa-fw"></i> เพิ่มรายการลิงค์หน้า</button>
						</div>

						<div class="responsive-data-table-1">
							<table id="responsive-data-table-1" class="table dt-responsive nowrap hover text-center" width="100%">
								<thead class="bg-danger text-white font-weight-bold">
									<tr>
										<td width="5%">ลำดับ</td>
										<td>ชื่อไฟล์ระบบ</td>
										<td>หมวดหมู่</td>
										<td>ที่อยู่ไฟล์</td>
										<td>จัดการ</td>
									</tr>
								</thead>
								<tbody>
									<?php
									$l = 0;
									$getlink = $getdata->my_sql_select($connect, NULL, "list", "case_status !='2' ORDER BY menu ASC");
									while ($showlink = mysqli_fetch_object($getlink)) {
										$l++;
									?>
										<tr>
											<td><?php echo @$l; ?></td>
											<td><?php echo @$showlink->cases; ?></td>
											<td><?php echo @$showlink->menu; ?></td>
											<td>

												<?php echo @$showlink->pages; ?>
											</td>
											<td>

												<?php
												if ($showlink->case_status == '1') {
													echo '<button type="button" class="btn btn-success btn-sm" id="btn-' . @$showlink->id . '" onclick="javascript:DisabledLink(\'' . @$showlink->id . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-unlock-alt fa-fw" id="icon-' . @$showlink->id . '"></i> <span id="text-' . @$showlink->id . '"></span></button>';
												} else {
													echo '<button type="button" class="btn btn-danger btn-sm" id="btn-' . @$showlink->id . '" onclick="javascript:DisabledLink(\'' . @$showlink->id . '\');" data-top="toptitle" data-placement="top" title="เปิด/ปิดการใช้งาน"><i class="fa fa-lock fa-fw" id="icon-' . @$showlink->id . '"></i> <span id="text-' . @$showlink->id . '"></span></button>';
												}
												?>
												<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_page" data-whatever="<?php echo @$showlink->id; ?>" data-top="toptitle" data-placement="top" title="แก้ไข"><i class="fa fa-edit fa-fw"></i></button>
												<button type="button" class="btn btn-danger btn-sm" onclick="javascript:delect_link('<?php echo @$showlink->id; ?>');" data-top="toptitle" data-placement="top" title="ลบรายการ"><i class="fa fa-trash-alt fa-fw"></i></button>

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