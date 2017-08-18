<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$aid = $_GET["aid"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$ass_id = $_POST["ass_id"];
	$sub_topic = trim($_POST["sub_topic"]);
	$sub_detail = $_POST["sub_detail"];

	$sql->table="tbl_assess_sub";
	$sql->field="ass_id,sub_topic,sub_detail";
	$sql->value="'$ass_id','$sub_topic','$sub_detail'";
	if($sql->insert())
	{
		$alert = "เพิ่มหัวข้อการประเมินเรียบร้อยแล้ว";
		$location = "index_sub.php?page=$page&aid=$aid&ass_id=$ass_id";
	}
	else
	{
		$alert = "ไม่สามารถเพิ่มหัวข้อการประเมินได้ กรุณาลองใหม่อีกครั้ง";
		$location = "add_sub.php?page=$page&aid=$aid&ass_id=$ass_id";
	}
}
else
{
	$location = "index.php?page=$page&aid=$aid";
}

require("../../class/JsControl.php");
?>