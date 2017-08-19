<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if( isset($_POST["checkSubmit"]) && $_POST["checkSubmit"] == 1 ){
	$id = trim($_POST["id"]);

	$sql->table="tbl_faculty";
	$sql->condition="WHERE faculty_id={$id}";
	$query = $sql->select();

	$numRow = mysqli_num_rows($query);

	if( empty($numRow) ){
		$alert = "ไม่พบข้อมูลที่ต้องการแก้ไข";
		$location = "edit_faculty.php?page={$page}&id={$id}";
	}

	$value = "";
	foreach ($_POST as $key => $val) {
		if( $key == "checkSubmit" || $key == "id" ) continue;

		$value .= !empty($value) ? "," : "";
		$value .= "{$key}='{$val}'";
	}

	$sql->table="tbl_faculty";
	$sql->value=$value;
	$sql->condition="WHERE faculty_id={$id}";

	if( $sql->update() ){
		$alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
		$location = "index.php?page={$page}";
	}
	else{
		$alert = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
		$location = "edit_faculty.php?page={$page}&id={$id}";
	}

}else{
	$location = "index.php?page={$page}";
}

require("../../class/JsControl.php");