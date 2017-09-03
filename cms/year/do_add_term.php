<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1"){

	$field = "";
	$value = "";

	foreach ($_POST as $key => $val) {
		if( $key == 'checkSubmit' ) continue;

		$field .= !empty($field) ? "," : "";
		$field .= $key;

		$value .= !empty($value) ? "," : "";
		if( $key == "term_start" || $key == "term_end" ) $val = date("Y-m-d", strtotime($val));
		$value .= "'{$val}'";
	}

	$field .= ",term_created,term_updated";
	$value .= ",NOW(),NOW()";

	$sql->table="tbl_term";
	$sql->field=$field;
	$sql->value=$value;
	if( $sql->insert() ){
		$alert = "บันทึกข้อมูลเรียบร้อยแล้ว";
		$location = "index_term.php?page={$page}&id={$_POST["term_year_id"]}";
	}
	else{
		$alert = "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง";
		$location = "add_term.php?page={$page}&id={$_POST["term_year_id"]}";
	}
}
else{
	$location = "index.php?page={$page}";
}
require("../../class/JsControl.php");
?>