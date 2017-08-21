<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if( isset($_POST["checkSubmit"]) && $_POST["checkSubmit"] == 1 ){

	$field = '';
	$value = '';

	$faculty_name = trim($_POST["faculty_name"]);
	$sql->table="tbl_faculty";
	$sql->condition="WHERE faculty_name='{$faculty_name}'";
	$numRow = mysqli_num_rows($sql->select());

	if( empty($numRow) ){
		foreach ($_POST as $key => $val) {

			if( $key == 'checkSubmit' ) continue;

			$field .= !empty($field) ? "," : "";
			$field .= $key;

			$value .= !empty($value) ? "," : "";
			$value .= "'{$val}'";
		}

		$sql->table="tbl_faculty";
		$sql->field=$field;
		$sql->value=$value;
		if( $sql->insert() ){
			$alert = "เพิ่มคณะ {$_POST["faculty_name"]} เรียบร้อยแล้ว";
			$location = "index.php?page={$page}";
		}
		else{
			$alert = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
			$location = "add_faculty.php?page={$page}";
		}
	}
	else{
		$alert = "ตรวจพบชื่อคณะ {$faculty_name} ในระบบ กรุณาใช้ชื่ออื่น";
		$location = "add_faculty.php?page={$page}";
	}
}
else{
	$location = "index.php?page=$page";
}

require("../../class/JsControl.php");
?>