<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$fid = $_GET["fid"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$skill_name = trim($_POST["skill_name"]);
	$sql->table="tbl_skill";
	$sql->field="skill_name";
	$sql->value="'$skill_name'";
	if($sql->insert())
	{
		$alert = "เพิ่มประเภทความสามารถพิเศษเรียบร้อยแล้ว";
		$location = "index.php?page=$page&fid=$fid";
	}
	else
	{
		$alert = "ไม่สามารถเพิ่มประเภทความสามารถพิเศษได้ กรุณาลองใหม่อีกครั้ง";
		$location = "add_skill.php?page=$page&fid=$fid";
	}
}
else
{
	$location = "index.php?page=$page&fid=$fid";
}

require("../../class/JsControl.php");
?>