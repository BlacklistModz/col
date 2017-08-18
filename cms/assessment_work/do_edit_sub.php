<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$aid = $_GET["aid"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$id = $_POST["id"];
	$ass_id = $_POST["ass_id"];
	$sub_topic = trim($_POST["sub_topic"]);
	$sub_detail = $_POST["sub_detail"];

	$sql->table="tbl_assess_sub";
	$sql->value="ass_id='$ass_id',sub_topic='$sub_topic',sub_detail='$sub_detail'";
	$sql->condition="WHERE id='$id'";
	if($sql->update())
	{
		$alert = "แก้ไขหัวข้อการประเมินเรียบร้อยแล้ว";
		$location = "index_sub.php?page=$page&aid=$aid&ass_id=$ass_id";
	}
	else
	{
		$alert = "ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง";
		$location = "edit_sub.php?page=$page&aid=&aid&ass_id=$ass_id&id=$id";
	}
}
else
{
	$location = "index.php?page=$page&aid=$aid";
}

require("../../class/JsControl.php");
?>