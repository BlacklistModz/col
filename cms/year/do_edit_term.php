<?php 
include("../../class/session_check.php");

$id = $_POST["id"];
$page = $_GET["page"];

if( !empty($_POST["checkSubmit"]}) && $_POST["checkSubmit"] == 1 ){

	$sql->table="tbl_term";
	$sql->condition="WHERE term_id={$id}";
	$query = $sql->select();
	$num = mysqli_num_rows($query);

	if( !empty($num) && $num == 1 ){

		$value = "";
		foreach ($_POST as $key => $val) {
			if( $key == "id" || $key == "checkSubmit" ) continue;

			$value .= !empty($value) ? "," : "";
			$value .= "{$key}='$val'";
		}

		$sql->table="tbl_term";
		$sql->value=$value;
		$sql->condition="WHERE term_id={$id}";
		if( $sql->update() ){
			$alert = "บันทึกข้อมูลเรียบร้อย";
			$location = "index_term.php?page={$page}&id={$_POST["term_year_id"]}";
		}
		else{
			$alert = "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง";
			$location = "edit_term.php?page={$page}&id={$id}";
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
