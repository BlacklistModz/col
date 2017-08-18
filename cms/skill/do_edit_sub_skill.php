<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$fid = $_GET["fid"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$id = $_POST["id"];
	$skill_id = $_POST["skill_id"];
	$sub_name = trim($_POST["sub_name"]);

	$sql->table="tbl_sub_skill";
	$sql->value="skill_id='$skill_id',sub_name='$sub_name'";
	$sql->condition="WHERE id='$id'";
	if($sql->update())
	{
		$alert = "แก้ไขข้อมูล ความสามารถพิเศษ เรียบร้อยแล้ว";
		$location = "index_subskill.php?page=$page&fid=$fid&id=$skill_id";
	}
	else
	{
		$alert = "ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง";
		$location = "edit_sub_skill.php?page=$page&fid=$fid&id=$id&skill_id=$skill_id";
	}
}
else
{
	$location = "index_subskill.php?page=$page&fid=$fid&id=$skill_id";
}

require("../../class/JsControl.php");
?>