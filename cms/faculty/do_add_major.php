<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if( isset($_POST["checkSubmit"]) && $_POST["checkSubmit"] == 1 ){

	$field = "";
	$value = "";

	$major_name = trim($_POST["major_name"]);

	$sql->table="tbl_majors";
	$sql->condition="WHERE major_name='{$major_name}'";
	$numRow = mysqli_num_rows($sql->select());

	if( empty($numRow) ){

		foreach ($_POST as $key => $val) {
			if( $key == "checkSubmit" ) continue;

			$field .= !empty($field) ? "," : "";
			$field .= $key;

			$value .= !empty($value) ? "," : "";
			$value .= "'".trim($val)."'";
		}

		$sql->table="tbl_majors";
		$sql->field=$field;
		$sql->value=$value;
		if( $sql->insert() ){
			$alert = "บันทึกข้อมูลเรียบร้อย";
			$location = "index_major.php?page={$page}&id={$_POST["major_faculty_id"]}";
		}
		else{
			$alert = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
			$location = "add_major.php?page={$page}&id={$_POST["major_faculty_id"]}";
		}
	}
	else{
		$alert = "ตรวจพบชื่อสาขาวิชา {$major_name} ในระบบ กรุณาใช้ชื่ออื่น";
		$location = "add_major.php?page={$page}&id={$_POST["major_faculty_id"]}";
	}
}
else{
	$location = "index.php?page={$page}";
}

require("../../class/JsControl.php");
?>