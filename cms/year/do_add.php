<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if(isset($_POST["checkAddStudent"]) and $_POST["checkAddStudent"] == "1")
{
	$field = "";
	$value = "";
	
	foreach ($_POST as $key => $val) {
		if( $key == 'checkSubmit' ) continue;

		$field .= !empty($field) ? "," : "";
		$field .= $key;

		$value .= !empty($value) ? "," : "";
		$value .= "'{$val}'";
	}

	$sql->table="tbl_year";
	$sql->field=$field;
	$sql->value=$value;
	if( $sql->insert() ){
		$alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
		$location = "index.php?page={$page}";
	}
	else{
		$alert = "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง";
		$location = "add.php?page={$page}";
	}
}
else{
	$location = "index.php?page={$page}";
}
require("../../class/JsControl.php");
?>