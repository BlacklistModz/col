<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$aid = $_GET["aid"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$topic = trim($_POST["topic"]);
	$ass_status = $_POST["ass_status"];

	$sql->table="tbl_assess_report";
	$sql->condition="WHERE topic='$topic'";
	$numRow = mysqli_num_rows($sql->select());

	if($numRow <= 0)
	{
		$sql->table="tbl_assess_report";
		$sql->field="topic,ass_status";
		$sql->value="'$topic','$ass_status'";
		if($sql->insert())
		{
			$alert = "เพิ่มหัวข้อ $topic เรียบร้อยแล้ว";
			$location = "index.php?page=$page&aid=$aid";
		}
		else
		{
			$alert = "ไม่สามารถเพิ่มหัวข้อได้ กุรณาลองใหม่อีกครั้ง";
			$location = "add.php?page=$page&aid=$aid";
		}
	}
	else
	{
		$alert = "ตรวจสอบหัวข้อ $topic ซ้ำในฐานข้อมูล กรุณาตรวจสอบ";
		$location = "index.php?page=$page&aid=$aid";
	}
}
else
{
	$location = "index.php?page=$page&aid=$aid";
}

require("../../class/JsControl.php");
?>