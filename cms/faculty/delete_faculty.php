<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$id = $_GET["id"];

$sql->table="tbl_majors";
$sql->condition="WHERE major_faculty_id={$id}";
$query = $sql->select();
$numRow = mysqli_num_rows($query);

if( empty($numRow) ){
	$sql->table="tbl_faculty";
	$sql->condition="WHERE faculty_id={$id}";
	$sql->delete();

	$alert = "ลบข้อมูลเรียบร้อย";
	$location = "index.php?page={$page}";
}
else{
	$alert = "ไม่สามารถลบข้อมูลได้ เนื่องจากมีข้อมูลสาขาวิชา";
	$location = "index.php?page={$page}";
}

require("../../class/JsControl.php");
?>