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

	$result = mysqli_fetch_assoc($query);

	$faculty_name = trim($_POST["faculty_name"]);

	$has_name = true;
	if( $result['faculty_name'] == $faculty_name ){
		$has_name = false;
	}

	$sql->table="tbl_faculty";
	$sql->condition="WHERE faculty_name='{$faculty_name}'";
	$is_name = mysqli_num_rows($sql->select());

	if( !empty($is_name) && $has_name == true ){
		$alert = "ตรวจพบชื่อคณะ {$faculty_name} ในระบบ กรุณาใช้ชื่ออื่น";
		$location = "edit_faculty.php?page={$page}&id={$id}";
	}
	else{
		$value = "";
		foreach ($_POST as $key => $val) {
			if( $key == "checkSubmit" || $key == "id" ) continue;

			$val = trim($val);
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
	}

}else{
	$location = "index.php?page={$page}";
}

require("../../class/JsControl.php");