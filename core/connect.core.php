<?php
class clear_db
{
	function my_sql_connect($host, $username, $password, $dbname)
	{
		$conn = mysqli_connect($host, $username, $password, $dbname);
		if (mysqli_connect_errno()) {
			die('Connect Error 1: ' . mysqli_connect_error());
		}
		$db = mysqli_select_db($conn, $dbname) or die(mysqli_error($conn));
		return $conn;
	}

	function my_sql_query($conn, $field, $table, $event)
	{
		if ($field == NULL && $event == NULL) {
			$objQuery = mysqli_query($conn, "SELECT * FROM " . $table);
		} else if ($field == NULL) {
			$objQuery = mysqli_query($conn, "SELECT * FROM " . $table . " WHERE " . $event);
		} else if ($event == NULL) {
			$objQuery = mysqli_query($conn, "SELECT " . $field . " FROM " . $table);
		} else {
			$objQuery = mysqli_query($conn, "SELECT " . $field . " FROM " . $table . " WHERE " . $event);
		}
		$objShow = mysqli_fetch_object($objQuery);
		return $objShow;
	}
	function my_sql_select($conn, $field, $table, $event)
	{
		if ($field == NULL && $event == NULL) {
			$objQuery = mysqli_query($conn, "SELECT * FROM " . $table);
		} else if ($field == NULL) {
			$objQuery = mysqli_query($conn, "SELECT * FROM " . $table . " WHERE " . $event);
		} else if ($event == NULL) {
			$objQuery = mysqli_query($conn, "SELECT " . $field . " FROM " . $table);
		} else {
			$objQuery = mysqli_query($conn, "SELECT " . $field . " FROM " . $table . " WHERE " . $event);
		}
		return $objQuery;
	}
	function my_sql_show_rows($conn, $table, $event)
	{
		if ($event != NULL) {
			$objQuery = mysqli_query($conn, "SELECT * FROM " . $table . " WHERE " . $event);
		} else {
			$objQuery = mysqli_query($conn, "SELECT * FROM " . $table);
		}
		$objShow = mysqli_num_rows($objQuery);
		return $objShow;
	}
	function my_sql_show_field($conn, $table, $event)
	{
		if ($event != NULL) {
			$objQuery = mysqli_query($conn, "SELECT * FROM " . $table . " WHERE " . $event);
		} else {
			$objQuery = mysqli_query($conn, "SELECT * FROM " . $table);
		}
		$objShow = mysqli_num_fields($objQuery);
		return $objShow;
	}
	function my_sql_update($conn, $table, $set, $event)
	{
		if ($event != NULL) {
			return mysqli_query($conn, "UPDATE " . $table . " SET " . $set . " WHERE " . $event);
		} else {
			return mysqli_query($conn, "UPDATE " . $table . " SET " . $set);
		}
	}
	function my_sql_insert($conn, $table, $set)
	{
		return mysqli_query($conn, "INSERT INTO " . $table . " SET " . $set);
	}
	function my_sql_delete($conn, $table, $event)
	{
		if ($event != NULL) {
			return mysqli_query($conn, "DELETE FROM " . $table . " WHERE " . $event);
		} else {
			return mysqli_query($conn, "DELETE FROM " . $table);
		}
	}
	function my_sql_string($conn, $string)
	{
		return mysqli_query($conn, $string);
	}
	function my_sql_set_utf8($conn)
	{
		$cs1 = "SET character_set_results=utf8";
		mysqli_query($conn, $cs1) or die('Error query: ' . mysqli_error($conn));
		$cs2 = "SET character_set_client = utf8";
		mysqli_query($conn, $cs2) or die('Error query: ' . mysqli_error($conn));
		$cs3 = "SET character_set_connection = utf8";
		mysqli_query($conn, $cs3) or die('Error query: ' . mysqli_error($conn));

		mysqli_query($conn, "SET NAMES utf8");
		mysqli_query($conn, "SET CHARACTER SET utf8");
		mysqli_query($conn, "SET collation_connection='utf8_unicode_ci'");
		mysqli_query($conn, "SET character_set_results=utf8");
		mysqli_query($conn, "SET character_set_client='utf8'");
		mysqli_query($conn, "SET character_set_connection='utf8'");
		mysqli_query($conn, "collation_connection = utf8_unicode_ci");
		mysqli_query($conn, "collation_database = utf8_unicode_ci");
		mysqli_query($conn, "collation_server = utf8_unicode_ci");
	}
	function my_sql_set_tis620($conn)
	{
		$cs1 = "SET character_set_results=tis620";
		mysqli_query($conn, $cs1) or die('Error query: ' . mysqli_error($conn));
		$cs2 = "SET character_set_client = tis620";
		mysqli_query($conn, $cs2) or die('Error query: ' . mysqli_error($conn));
		$cs3 = "SET character_set_connection = tis620";
		mysqli_query($conn, $cs3) or die('Error query: ' . mysqli_error($conn));

		mysqli_query($conn, "SET NAMES tis620");
		mysqli_query($conn, "SET CHARACTER SET tis620");
		mysqli_query($conn, "SET collation_connection='tis620_thai_ci'");
		mysqli_query($conn, "SET character_set_results=tis620");
		mysqli_query($conn, "SET character_set_client='tis620'");
		mysqli_query($conn, "SET character_set_connection='tis620'");
		mysqli_query($conn, "collation_connection = tis620_thai_ci");
		mysqli_query($conn, "collation_database = tis620_thai_ci");
		mysqli_query($conn, "collation_server = tis620_thai_ci");
	}
	function my_sql_close($conn)
	{
		mysqli_close($conn);
	}
}
