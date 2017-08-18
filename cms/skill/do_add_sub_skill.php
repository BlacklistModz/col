<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$fid = $_GET["fid"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$skill_id = $_POST["skill_id"];
	$sub_name = trim($_POST["sub_name"]);

	$sql->table="tbl_sub_skill";
	$sql->field="skill_id,sub_name";
	$sql->value="'$skill_id','$sub_name'";
	if($sql->insert())
	{
		$alert = "เพิ่มความสามารถพิเศษเรียบร้อยแล้ว";
		$location = "index_subskill.php?page=$page&fid=$fid&id=$skill_id";
	}
	else
	{
		$alert = "ไม่สามารถเพิ่มความสามารถพิเศษได้ กรุณาลองใหม่อีกครั้ง";
		$location = "add_sub_skill.php?page=$page&fid=$fid&id=$skill_id";
	}
}
else
{
	$location = "index.php?page=$page&fid=$fid";
}

require("../../class/JsControl.php");
?>