<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$aid = $_GET["aid"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$id = $_POST["id"];
	$topic = $_POST["topic"];
	$ass_status = $_POST["ass_status"];

	$sql->table="tbl_assess_work";
	$sql->value="topic='$topic',ass_status='$ass_status'";
	$sql->condition="WHERE id='$id'";
	if($sql->update())
	{
		$alert = "แก้ไขข้อมูลด้านการประเมินเรียบร้อยแล้ว";
		$location = "index.php?page=$page&aid=$aid";
	}
	else
	{
		$alert = "ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง";
		$location = "edit.php?page=$page&aid=$aid&id=$id";
	}
}
else
{
	$location = "index.php?page=$page&aid=$aid";
}

require("../../class/JsControl.php");
?>