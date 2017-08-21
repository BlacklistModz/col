<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if( isset($_POST["checkSubmit"]) && $_POST["checkSubmit"] == 1 ){
	
	$id = $_POST["id"];

	$sql->table="tbl_majors";
	$sql->condition="WHERE major_id={$id}";
	$query = $sql->select();
	$numRow = mysqli_num_rows($query);
	if( !empty($numRow) ){

		$result = mysqli_fetch_assoc($query);

		$major_name = trim($_POST["majo"]);
		$has_name = true;
		if( $result["major_name"] == $major_name ){
			$has_name = false;
		}

		$sql->table="tbl_majors";
		$sql->condition="WHERE major_name='{$major_name}'";
		$is_name = mysqli_num_rows($sql->select());

		if( !empty($is_name) && $has_name == true ){
			$alert = "ตรวจพบชื่อสาขาวิชา {$major_name} ในระบบ กรุณาใช้ชื่ออื่น";
			$location = "edit_major.php?page={$page}&id={$id}&faculty={$result['major_faculty_id']}";
		}
		else{

			$value = "";
			foreach ($_POST as $key => $val) {
				if( $key == "checkSubmit" || $key == "id" ) continue;

				$value .= !empty($value) ? "," : "";
				$value .= "{$key}='".trim($val)."'";
			}

			$sql->table="tbl_majors";
			$sql->value=$value;
			$sql->condition="WHERE major_id={$id}";
			if( $sql->update() ){
				$alert = "บันทึกข้อมูลเรียบร้อย";
				$location = "index_major.php?page={$page}&id={$_POST["major_faculty_id"]}";
			}
			else{
				$alert = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
				$location = "edit_major.php?page={$page}&id={$id}&faculty={$_POST["major_faculty_id"]]";
			}
		}
	}
	else{
		$alert = "ไม่พบข้อมูลที่ต้องการแก้ไข";
		$location = "index.php?page={$page}";
	}

}else{
	$location = "index.php?page={$page}";
}

require("../../class/JsControl.php");