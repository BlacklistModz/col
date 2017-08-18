<?php 
include("../../class/session_check.php");
$page = $_GET["page"];
$fid = $_GET["fid"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{

	$num_job = $_POST["num_job"];

	$sql->table="tbl_rulejob";
	$sql->value="num_job='$num_job'";
	$sql->condition="WHERE id='1'";
	if($sql->update())
	{
		$alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
		$location = "index.php?page=$page&fid=$fid";
	}
	else
	{
		$alert = "ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง";
		$location = "edit.php?page=$page&fid=$fid";
	}
}
else
{
	$location = "index.php?page=$page&fid=$fid";
}

require("../../class/JsControl.php");
?>