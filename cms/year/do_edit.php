<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$id = $_GET["id"];

if(isset($_POST["checkAddStudent"]) and $_POST["checkAddStudent"] == "1")
{
	$sql->table="tbl_year";
	$sql->condition="WHERE id={$id}";
	$query = $sql->select();
	$numRow = mysqli_num_rows($query);

	if( $numRow == 1 ){

		$value = "";

		foreach ($_POST as $key => $val) {
			if( $key == 'checkSubmit' || $key == "id" ) continue;

			$val = trim($val);
			$value .= !empty($value) ? "," : "";
			$value .= "{$key}='{$val}'";
		}

		$sql->table="tbl_year";
		$sql->value=$value;
		$sql->condition="WHERE id={$id}";
		if( $sql->update() ){
			$alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
			$location = "index.php?page={$page}";
		}
		else{
			$alert = "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง";
			$location = "edit.php?page={$page}&id={$id}";
		}
	}
	else{
		$alert = "เกิดข้อผิดพลาด...";
		$location = "index.php?page={$page}";
	}
}
else{
	$location = "index.php?page={$page}";
}
require("../../class/JsControl.php");
?>