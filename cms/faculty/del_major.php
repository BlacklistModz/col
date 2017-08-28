<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$id = $_GET["id"];

$sql->table="tbl_majors";
$sql->condition="WHERE major_id={$id}";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);

$sql->table="tbl_student";
$sql->condition="WHERE major_id={$result["major_id"]}";
$numRow = mysqli_fetch_assoc($sql->select());

if( empty($numRow) ){
	$sql->table="tbl_majors";
	$sql->condition="WHERE major_id={$id}";
	$sql->delete();

	$alert = "ลบข้อมูลเรียบร้อย";
	$location = "index_major.php?page={$page}&id={$result["major_faculty_id"]}";
}else{
	$alert = "ไม่สามารถลบข้อมูลได้ เนื่องจากมีข้อมูลนักศึกษา";
	$location = "index_major.php?page={$page}&id={$result["major_faculty_id"]}";
}

require("../../class/JsControl.php");
?>