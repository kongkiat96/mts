<?php
if (isset($_POST['save_prefix'])) {
	if (htmlspecialchars($_POST['prefix_title']) != null) {
		$mbkey = md5(rand() . time('now'));
		$getdata->my_sql_insert(
			$connect,
			'members_prefix',
			"prefix_key='" . $mbkey . "',
			prefix_title='" . htmlspecialchars($_POST['prefix_title']) . "',
			prefix_status='1'"
		);

		$alert = $success;
	} else {
		$alert = $warning;
	}
}
if (isset($_POST['save_company'])) {
	if (htmlspecialchars($_POST['new_company']) != null) {
		$getdata->my_sql_insert(
			$connect,
			'company',
			"company_name='" . htmlspecialchars($_POST['new_company']) . "'"
		);
		$alert = $success;
	} else {
		$alert = $warning;
	}
}

if (isset($_POST['save_department'])) {
	if (htmlspecialchars($_POST['department_name']) != null) {
		$getdata->my_sql_insert(
			$connect,
			'department_name',
			"department_name='" . htmlspecialchars($_POST['department_name']) . "'"
		);

		$alert = $success;
	} else {
		$alert = $warning;
	}
}
if (isset($_POST['save_device'])) {
	if (htmlspecialchars($_POST['device_name']) != null) {
		$getdata->my_sql_insert(
			$connect,
			'device_type',
			"device_type='" . htmlspecialchars($_POST['device_name']) . "'"
		);

		$alert = $success;
	} else {
		$alert = $warning;
	}
}
if (isset($_POST['save_edit_prefix'])) {
	if (htmlspecialchars($_POST['edit_prefix_title']) != null) {
		$getdata->my_sql_update(
			$connect,
			'members_prefix',
			"prefix_title='" . htmlspecialchars($_POST['edit_prefix_title']) . "'",
			"prefix_key='" . htmlspecialchars($_POST['prefix_key']) . "'"
		);

		$alert = $saveedit;
	} else {
		$alert = $warning;
	}
}
if (isset($_POST['save_edit_company'])) {
	if (htmlspecialchars($_POST['edit_company']) != null) {
		$getdata->my_sql_update(
			$connect,
			"company",
			"company_name = '" . htmlspecialchars($_POST['edit_company']) . "'",
			"id='" . htmlspecialchars($_POST['dep_id']) . "'"
		);

		$alert = $saveedit;
	} else {
		$alert = $warning;
	}
}


if (isset($_POST['save_edit_department'])) {
	if (htmlspecialchars($_POST['edit_department']) != null) {
		$getdata->my_sql_update(
			$connect,
			'department_name',
			"department_name='" . htmlspecialchars($_POST['edit_department']) . "'",
			"id='" . htmlspecialchars($_POST['dep_id']) . "'"
		);

		$alert = $saveedit;
	} else {
		$alert = $warning;
	}
}
if (isset($_POST['save_edit_device'])) {
	if (htmlspecialchars($_POST['edit_device']) != null) {
		$getdata->my_sql_update(
			$connect,
			'device_type',
			"device_type='" . htmlspecialchars($_POST['edit_device']) . "'",
			"id='" . htmlspecialchars($_POST['dev_id']) . "'"
		);

		$alert = $saveedit;
	} else {
		$alert = $warning;
	}
}


if (isset($_POST['save_edit_user'])) {
	if (htmlspecialchars($_POST['edit_password']) != NULL && htmlspecialchars($_POST['edit_repassword']) != NULL) {
		if (htmlspecialchars($_POST['edit_password']) == htmlspecialchars($_POST['edit_repassword'])) {
			$getdata->my_sql_update(
				$connect,
				"user",
				"username ='" . htmlspecialchars($_POST['edit_username']) . "',
      			password ='" . md5(htmlspecialchars($_POST['edit_password'])) . "',
      			user_class='" . htmlspecialchars($_POST['edit_class']) . "'",
				"id='" . htmlspecialchars($_POST['id_user']) . "'"
			);

			$alert = $saveedit;
		} else {
			$alert = $ck_pass;
		}
	} else {
		$getdata->my_sql_update(
			$connect,
			"user",
			"username ='" . htmlspecialchars($_POST['edit_username']) . "',
			user_class='" . htmlspecialchars($_POST['edit_class']) . "'",
			"id='" . htmlspecialchars($_POST['id_user']) . "'"
		);


		$alert = $saveedit;
	}
}

if (isset($_POST['save_access'])) {
	$getdata->my_sql_delete($connect, "access_user", "user_key='" . htmlspecialchars($_POST['key']) . "'");
	for ($ac = 0; $ac < count($_POST['access_list']); $ac++) {
		$getdata->my_sql_insert($connect, "access_user", "access_key='" . htmlspecialchars($_POST['access_list'][$ac]) . "',user_key='" . htmlspecialchars($_POST['key']) . "'");
	}
	$alert = $success;
}


if (isset($_POST['save_status'])) {
	if (htmlspecialchars($_POST['status_name']) != NULL) {
		$ctype_key = md5(htmlspecialchars($_POST['status_name']));
		$getdata->my_sql_insert(
			$connect,
			"card_type",
			"ctype_key='" . $ctype_key . "',
		ctype_name='" . htmlspecialchars($_POST['status_name']) . "',
		ctype_color='" . htmlspecialchars($_POST['color_tag']) . "',
		ctype_use ='" . htmlspecialchars($_POST['status_use']) . "'"
		);
		$alert = $success;
	} else {
		$alert = $warning;
	}
}

if (isset($_POST['save_edit_status'])) {
	if (htmlspecialchars($_POST['edit_name_status']) != NULL) {
		$getdata->my_sql_update(
			$connect,
			"card_type",
			"ctype_name ='" . htmlspecialchars($_POST['edit_name_status']) . "',
			ctype_color ='" . htmlspecialchars($_POST['edit_color_status']) . "',
			ctype_use = '" . htmlspecialchars($_POST['edit_status_use']) . "'",
			"ctype_key ='" . htmlspecialchars($_POST['ctype_key']) . "'"
		);
		$alert = $saveedit;
	} else {
		$alert = $warning;
	}
}


if (isset($_POST['save_service'])) {
	if (htmlspecialchars($_POST['service_name']) != NULL && $_POST['service_group']) {
		$getdata->my_sql_insert(
			$connect,
			"service",
			"se_name ='" . htmlspecialchars($_POST['service_name']) . "',
			se_sort = '" . htmlspecialchars($_POST['service_sort']) . "',
            se_group = '" . htmlspecialchars($_POST['service_group']) . "'"
		);

		$alert = $success;
	} else {
		$alert = $warning;
	}
}

if (isset($_POST['save_service_list'])) {
	if (htmlspecialchars($_POST['service_id']) != NULL && htmlspecialchars($_POST['service_list_name']) != NULL) {
		$getdata->my_sql_insert(
			$connect,
			"service_list",
			"se_id = '" . htmlspecialchars($_POST['service_id']) . "',
            se_li_name ='" . htmlspecialchars($_POST['service_list_name']) . "'"
		);

		$alert = $success;
	} else {
		$alert = $warning;
	}
}

if (isset($_POST['save_edit_service'])) {
	if (htmlspecialchars($_POST['edit_se_name']) != NULL) {
		$getdata->my_sql_update(
			$connect,
			"service",
			"se_name ='" . htmlspecialchars($_POST['edit_se_name']) . "',
			se_sort = '" . htmlspecialchars($_POST['edit_se_sort']) . "'",
			"se_id = '" . htmlspecialchars($_POST['se_id']) . "'"
		);
		$alert = $saveedit;
	} else {
		$alert = $warning;
	}
}

if (isset($_POST['save_edit_service_list'])) {
	if (htmlspecialchars($_POST['edit_se_li_name']) != NULL) {
		$getdata->my_sql_update(
			$connect,
			"service_list",
			"se_id ='" . htmlspecialchars($_POST['se_id']) . "',
            se_li_name ='" . htmlspecialchars($_POST['edit_se_li_name']) . "'",
			"se_li_id = '" . htmlspecialchars($_POST['se_li_id']) . "'"
		);

		$alert = $saveedit;;
	} else {
		$alert = $warning;;
	}
}

if (isset($_POST['save_info'])) {
	if (!defined('UPLOADDIR')) define('UPLOADDIR', '../resource/system/logo/');
	if (is_uploaded_file($_FILES["site_logo"]["tmp_name"])) {
		$File_name = $_FILES["site_logo"]["name"];
		$File_tmpname = $_FILES["site_logo"]["tmp_name"];
		if (move_uploaded_file($File_tmpname, (UPLOADDIR . $File_name)));
	}
	if (!defined('UPLOADDIR2')) define('UPLOADDIR2', '../resource/system/favicon/');
	if (is_uploaded_file($_FILES["site_favicon"]["tmp_name"])) {
		$File_name2 = $_FILES["site_favicon"]["name"];
		$File_tmpname2 = $_FILES["site_favicon"]["tmp_name"];
		if (move_uploaded_file($File_tmpname2, (UPLOADDIR2 . $File_name2)));
	}

	$site_name = htmlspecialchars($_POST['site_name']);
	$site_color_name = $_POST['site_color_name'];
	$site_color_form = $_POST['site_color_form'];

	if ($File_name != NULL && $File_name2 != NULL) {
		$getdata->my_sql_update($connect, "system_info", "site_logo='" . $File_name . "',site_favicon='" . $File_name2 . "'", NULL);
	} else if ($File_name != NULL && $File_name2 == NULL) {
		$getdata->my_sql_update($connect, "system_info", "site_logo='" . $File_name . "'", NULL);
	} else if ($File_name == NULL && $File_name2 != NULL) {
		$getdata->my_sql_update($connect, "system_info", "site_favicon='" . $File_name2 . "'", NULL);
	} else if ($File_name == NULL && $File_name2 == NULL && $site_name != NULL && $site_color_name != NULL && $site_color_form != NULL) {
		$getdata->my_sql_update($connect, "system_info", "site_name = '" . $site_name . "',site_color_name = '" . $site_color_name . "',site_color_form = '" . $site_color_form . "'", NULL);
	} else if ($File_name == NULL && $File_name2 == NULL && $site_name != NULL && $site_color_name != NULL && $site_color_form == NULL) {
		$getdata->my_sql_update($connect, "system_info", "site_name = '" . $site_name . "',site_color_name = '" . $site_color_name . "'", NULL);
	} else if ($File_name == NULL && $File_name2 == NULL && $site_name != NULL && $site_color_name == NULL && $site_color_form != NULL) {
		$getdata->my_sql_update($connect, "system_info", "site_name = '" . $site_name . "',site_color_form = '" . $site_color_form . "'", NULL);
	} else {
		$getdata->my_sql_update($connect, "system_info", "site_title='" . htmlspecialchars($_POST['site_title']) . "',site_footer='" . htmlspecialchars($_POST['site_footer']) . "'", NULL);
	}
	$alert = $success;
}

if (isset($_POST['save_alert'])) {
	$lineToken = $_POST['line_notify'];
	$mail_host = htmlspecialchars($_POST['host']);
	$mail_get = htmlspecialchars($_POST['getmail']);
	$username = htmlspecialchars($_POST['username']);
	$password = $_POST['password'];

	$getdata->my_sql_update(
		$connect,
		'system_alert',
		"alert_line_token = '" . $lineToken . "',
			alert_mail_server = '" . $mail_host . "',
			alert_mail_user = '" . $username . "',
			alert_mail_pass = '" . $password . "',
			alert_mail_get = '" . $mail_get . "'",
		'alert_key = "cd5fe35c5af97026fd4efdfe4afd4376"'
	);
	$alert = $success;
}

if (isset($_POST['save_list_admin_approve'])) {
	if (!empty(htmlspecialchars($_POST['list_admin'])) && !empty(htmlspecialchars($_POST['approve_menu']))) {
		$getdata->my_sql_insert(
			$connect,
			"list_admin_approve",
			"user_key = '" . htmlspecialchars($_POST['list_admin']) . "',
			approve_menu = '" . htmlspecialchars($_POST['approve_menu']) . "',
			create_at = '" . date('Y-m-d H:i:s') . "',
            create_user ='" . Userlogin($_SESSION['ukey']) . "'"
		);

		$alert = $success;
	} else {
		$alert = $warning;
	}
}

if (isset($_POST['edit_list_admin_approve'])) {
	if (!empty(htmlspecialchars($_POST['edit_approve_menu']))) {
		$getdata->my_sql_update(
			$connect,
			"list_admin_approve",
			"approve_menu = '" . htmlspecialchars($_POST['edit_approve_menu']) . "'",
			"id = '" . htmlspecialchars($_POST['list_approve_id']) . "'"
		);

		$alert = $saveedit;
	} else {
		$alert = $warning;
	}
}
