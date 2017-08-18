<?php 
include("../../class/session_check.php");
$page = $_GET["page"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$id = $_POST["id"];
	$name = $_POST["name"];
	$detail = $_POST["detail"];
	$info_status = $_POST["info_status"];

	$sql->table="tbl_infomation";
	$sql->value="name='$name',detail='$detail',info_status='$info_status'";
	$sql->condition="WHERE id='$id'";
	if($sql->update())
	{
		$alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
		$location = "index.php?page=$page&wid=$id";
	}
	else
	{
		$alert = "ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง";
		$location = "edit.php?page=$page&wid=$id";
	}
}
else
{
	$location = "index.php?page=$page&wid=$id";
}

require("../../class/JsControl.php");
?>