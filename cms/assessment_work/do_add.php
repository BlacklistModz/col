<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$aid = $_GET["aid"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$topic = trim($_POST["topic"]);
	$ass_status = $_POST["ass_status"];

	$sql->table="tbl_assess_work";
	$sql->condition="WHERE topic='$topic'";
	$query = $sql->select();
	$numRow = mysqli_num_rows($query);
	if($numRow <= 0)
	{
		$sql->table="tbl_assess_work";
		$sql->field="topic,ass_status";
		$sql->value="'$topic','$ass_status'";
		if($sql->insert())
		{
			$alert = "เพิ่มการประเมินด้าน $topic เรียบร้อยแล้ว";
			$location = "index.php?page=$page&aid=$aid";
		}
		else
		{
			$alert = "ไม่สามารถเพิ่มด้านการประเมินได้ กรุณาลองใหม่อีกครั้ง";
			$location = "add.php?page=$page&aid=$aid";
		}
	}
	else
	{
		$alert = "ตรวจสอบพบด้านการประเมิน $topic ในฐานข้อมูลแล้ว";
		$location = "index.php?page=$page&aid=$aid";
	}
}
else
{
	$location = "index.php?page=$page&aid=$aid";
}

require("../../class/JsControl.php");
?>