<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$fid = $_GET["fid"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$id = $_POST["id"];
	$skill_name = $_POST["skill_name"];
	$sql->table="tbl_skill";
	$sql->value="skill_name='$skill_name'";
	$sql->condition="WHERE id='$id'";
	if($sql->update())
	{
		$alert = "แก้ไขข้อมูลประเภทความสามารถพิเศษเรียบร้อยแล้ว";
		$location = "index.php?page=$page&fid=$fid";
	}
	else
	{
		$alert = "ไม่สามารถแก้ไขข้อมูลประเภทความสามารถพิเศษได้ กรุณาลองใหม่อีกครั้ง";
		$location = "edit_skill.php?page=$page&fid=$fid&id=$id";
	}
}
else
{
	$location = "index.php?page=$page&fid=$fid";
}

require("../../class/JsControl.php");
?>