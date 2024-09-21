<?php
session_start();
error_reporting(0);
//Remove
function EmptyDir($dir)
{
	$handle = opendir($dir);

	while (($file = readdir($handle)) !== false) {
		@unlink($dir . '/' . $file);
	}

	closedir($handle);
}
//set_time_default
date_default_timezone_set('Asia/Bangkok');
require("../core/connect.core.php");
require("../core/config.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, "utf8");
switch (htmlspecialchars($_GET['type'])) {

	case "chg_ordering":
		$getdata->my_sql_update($connect, "slideshow", "slide_sorting='" . htmlspecialchars($_GET['sort']) . "'", "slide_key='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.location="index.php?p=slideshow";</script>';
		break;
	case "change_cat_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "categories", "cat_status='0'", "cat_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "categories", "cat_status='1'", "cat_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;
	case "change_grp_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "member_group", "grp_status='0'", "grp_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "member_group", "grp_status='1'", "grp_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;
	case "change_level_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "level", "level_status='0'", "level_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "level", "level_status='1'", "level_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;

	case "change_user_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "user", "user_status='0'", "user_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "employee", "em_status = '1'", "card_key='" . htmlspecialchars($_GET['key']) . "'");
			$getdata->my_sql_update($connect, "user", "user_status='1'", "user_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;
	case "change_member_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "member", "member_status='0'", "member_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "member", "member_status='1'", "member_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;
	case "change_menu_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "menus", "menu_status='0'", "menu_key='" . htmlspecialchars($_GET['key']) . "'");
			$getdata->my_sql_update($connect, "access_list", "access_status='0'", "access_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "menus", "menu_status='1'", "menu_key='" . htmlspecialchars($_GET['key']) . "'");
			$getdata->my_sql_update($connect, "access_list", "access_status='1'", "access_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;
	case "change_unit_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "product_unit", "unit_status='0'", "unit_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "product_unit", "unit_status='1'", "unit_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;
	case "change_products_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "products", "pro_status='0'", "pro_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "products", "pro_status='1'", "pro_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;
	case "change_barcode_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "products_barcode", "barcode_status='0'", "barcode_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "products_barcode", "barcode_status='1'", "barcode_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;
	case "change_cardtype_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "card_type", "ctype_status='0'", "ctype_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "card_type", "ctype_status='1'", "ctype_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;

	case "change_discount_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "member_discount", "disc_status='0'", "disc_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "member_discount", "disc_status='1'", "disc_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;

	case "change_access_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "access_list", "access_status='0'", "access_key='" . htmlspecialchars($_GET['key']) . "'");
			$getdata->my_sql_update($connect, "menus", "menu_status='0'", "menu_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "access_list", "access_status='1'", "access_key='" . htmlspecialchars($_GET['key']) . "'");
			$getdata->my_sql_update($connect, "menus", "menu_status='1'", "menu_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;
	case "change_export_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "products_export", "export_status='0'", "export_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "products_export", "export_status='1'", "export_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;
	case "change_slide_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "link_slideshow", "slide_status='0'", "slide_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "link_slideshow", "slide_status='1'", "slide_key='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;
	case "change_case_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "list", "case_status='0'", "id='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "list", "case_status='1'", "id='" . htmlspecialchars($_GET['key']) . "'");
		}

		break;

	case "hide_card":
		$getdata->my_sql_update($connect, "card_info", "card_status='hidden'", "card_key='" . htmlspecialchars($_GET['key']) . "'");
		break;


	case "delete_cat":
		$getdata->my_sql_delete($connect, "categories", "cat_key='" . htmlspecialchars($_GET['key']) . "'");
		break;
	case "delete_period":
		$getdata->my_sql_delete($connect, "commission_period", "period_key='" . htmlspecialchars($_GET['key']) . "'");
		break;

	case "delete_grp":
		$getdata->my_sql_delete($connect, "member_group", "grp_key='" . htmlspecialchars($_GET['key']) . "'");
		break;

	case "delete_user":
		$getdata->my_sql_delete($connect, "user", "user_key='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.location="index.php?p=setting_users";</script>';
		break;

	case "print":

		$getdata->my_sql_update(
			$connect,
			"asset_print",
			"p_status = '2',
				p_status_add = '0'",
			"p_user = '" . $_SESSION['ukey'] . "'"
		);
		echo '<script>window.location="index.php?p=asset";</script>';
		break;

	case "delete_asset":
		$getdata->my_sql_update($connect, "asset", "status='0'", "as_keyID='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.location="index.php?p=asset";</script>';
		break;

	case "delete_level":
		$getdata->my_sql_delete($connect, "level", "level_key='" . htmlspecialchars($_GET['key']) . "'");
		break;

	case "delete_case": // 2 เท่ากับลบ
		$getdata->my_sql_update($connect, "list", "case_status = '2'", "id='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.location="index.php?p=administrator_cases";</script>';
		break;
	case "delete_employee":
		$getdata->my_sql_update($connect, "employee", "em_status = '0'", "card_key='" . htmlspecialchars($_GET['key']) . "'");
		$getdata->my_sql_update($connect, "user", "user_status = '0'", "user_key='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.history.back();</script>';
		break;
	case "delete_cardtype":
		$getdata->my_sql_update($connect, "card_type", "ctype_status='2'", "ctype_key='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.history.back();</script>';
		break;
	case "delete_card":
		$getdata->my_sql_update($connect, "card_info", "card_delete ='0'", "card_key='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.history.back();</script>';
		break;
	case "delete_card_pic":
		$getdata->my_sql_update($connect, "card_pic", "pic_status ='0'", "pic_key='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.history.back();</script>';
		break;
	case "delete_print":
		$getdata->my_sql_update($connect, "asset_print", "p_status ='0'", "ID ='" . htmlspecialchars($_GET['key']) . "'");
		//echo '<script>window.history.back();</script>';
		echo '<script>window.location="index.php?p=asset";</script>';
		break;

	case "lock":
		$getdata->my_sql_update($connect, "user", "user_status = '0'", "user_key='" . htmlspecialchars($_GET['ukey']) . "'");
		echo '<script>window.location="../"</script>';
		break;
	case "delete_menu": // status 2 = ลบ
		$getdata->my_sql_update($connect, "menus", "menu_status = '2'", "menu_key='" . htmlspecialchars($_GET['key']) . "'");
		$getdata->my_sql_update($connect, "access_list", "access_status = '2'", "access_key='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.location="index.php?p=administrator_menus";</script>';
		break;
	case "delete_barcode":
		$getdata->my_sql_delete($connect, "products_barcode", "barcode_key='" . htmlspecialchars($_GET['key']) . "'");
		break;
	case "delete_discount":
		$getdata->my_sql_delete($connect, "member_discount", "disc_key='" . htmlspecialchars($_GET['key']) . "'");
		break;
	case "delete_item":
		$getdata->my_sql_delete($connect, "card_item", "item_key='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.history.back();</script>';
		break;

	case "delete_prefix":
		$getdata->my_sql_update($connect, "members_prefix", "prefix_status = '2'", "prefix_key='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.history.back();</script>';
		break;
	case "delete_manager":
		$getdata->my_sql_delete($connect, "manager", "id='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.history.back();</script>';
		break;
	case "change_prefix":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "members_prefix", "prefix_status = '0'", "prefix_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "members_prefix", "prefix_status = '1'", "prefix_key='" . htmlspecialchars($_GET['key']) . "'");
		}
		break;


	case "change_using_company":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "company", "cp_status = '0'", "id='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "company", "cp_status = '1'", "id='" . htmlspecialchars($_GET['key']) . "'");
		}
		break;

	case "change_using_dep":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "department_name", "department_status = '0'", "id='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "department_name", "department_status = '1'", "id='" . htmlspecialchars($_GET['key']) . "'");
		}
		break;

	case "change_using_device":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "device_type", "device_status = '0'", "id='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "device_type", "device_status = '1'", "id='" . htmlspecialchars($_GET['key']) . "'");
		}
		break;

	case "using_service":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "service", "se_status = '0'", "se_id='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "service", "se_status = '1'", "se_id='" . htmlspecialchars($_GET['key']) . "'");
		}
		break;

	case "using_service_list":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "service_list", "se_li_status = '0'", "se_li_id='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "service_list", "se_li_status = '1'", "se_li_id='" . htmlspecialchars($_GET['key']) . "'");
		}
		break;

	case "delete_company":
		$getdata->my_sql_update($connect, "company", "cp_status = '2'", "id='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.history.back();</script>';
		break;

	case "delete_department":
		$getdata->my_sql_update($connect, "department_name", "department_status = '2'", "id='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.history.back();</script>';
		break;

	case "delete_device":
		$getdata->my_sql_update($connect, "device_type", "device_status = '2'", "id='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.history.back();</script>';
		break;
	case "delete_admin_approve":
		$getdata->my_sql_update($connect, "list_admin_approve", "deleted = '1'", "id='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.location="index.php?p=setting_approve";</script>';
		break;

	case "delete_service_li":
		$getdata->my_sql_update($connect, "service_list", "se_li_status = '0'", "se_li_id='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.location="index.php?p=setting_services";</script>';
		break;

	case "delete_service":
		$getdata->my_sql_update($connect, "service", "se_status = '0'", "se_id='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.location="index.php?p=setting_services";</script>';
		break;

	case "change_prefix_status":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "members_prefix", "prefix_status='0'", "prefix_key='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "members_prefix", "prefix_status='1'", "prefix_key='" . htmlspecialchars($_GET['key']) . "'");
		}
		break;

	case "delete_backup":

		$getremove = $getdata->my_sql_query($connect, NULL, "backup_logs", "backup_key='" . htmlspecialchars($_GET['key']) . "'");
		unlink("../backup/" . $getremove->backup_file);
		$getdata->my_sql_delete($connect, "backup_logs", "backup_key='" . htmlspecialchars($_GET['key']) . "'");
		break;
	case "download_backup":
		$getlink = $getdata->my_sql_query($connect, "backup_file", "backup_logs", "backup_key='" . htmlspecialchars($_GET['key']) . "'");
		$file = "../backup/" . $getlink->backup_file;
		$filename = $getlink->backup_file;
		header("Content-Description: Clear Download");
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		readfile($file);
		break;

	case "show_card_count":
		$card_count = $getdata->my_sql_show_rows($connect, "card_info", "card_status = ''");
		if ($card_count != 0) {
			echo @number_format($card_count);
		}
		break;

	case "delete_branch":
		$getdata->my_sql_update($connect, "branch", "status = '2'", "id='" . htmlspecialchars($_GET['key']) . "'");
		echo '<script>window.history.back();</script>';
		break;

	case "change_using_branch":
		if (htmlspecialchars($_GET['sts']) == "1") {
			$getdata->my_sql_update($connect, "branch", "status = '0'", "id='" . htmlspecialchars($_GET['key']) . "'");
		} else {
			$getdata->my_sql_update($connect, "branch", "status = '1'", "id='" . htmlspecialchars($_GET['key']) . "'");
		}
		break;
}
