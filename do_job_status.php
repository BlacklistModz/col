<?php 
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");

$sql = new SQLiManager();

$id = $_GET["id"];
$status = $_GET["status"];

if($id != "" and $status != "")
{
	$sql->table="tbl_stu_job";
	$sql->condition="WHERE id='$id'";
	$queryJob = $sql->select();
	$resultJob = mysqli_fetch_assoc($queryJob);

	$sql->table="tbl_authentication";
	$sql->condition="WHERE id='{$resultJob["stu_id"]}'";
	$queryStu = $sql->select();
	$resultStu = mysqli_fetch_assoc($queryStu);

	$sql->table="tbl_position";
	$sql->condition="WHERE id='{$resultJob["pos_id"]}'";
	$queryPos = $sql->select();
	$resultPos = mysqli_fetch_assoc($queryPos);

	$sql->table="tbl_stu_job";
	$sql->value="job_status='$status'";
	$sql->condition="WHERE id='$id'";
	if($sql->update())
	{
		if($status == "1")
		{
			$alert = "ดำเนินการตอบรับนักศึกษา \\n -> ชื่อ {$resultStu["name"]} \\n -> ตำแหน่ง {$resultPos["pos_name"]} เรียบร้อยแล้ว";
		}
		else
		{
			$alert = "ไม่ตอบรับนักศึกษา \\n -> ชื่อ {$resultStu["name"]} \\n -> ตำแหน่ง {$resultPos["pos_name"]} เรียบร้อยแล้ว";
		}
		$location = "corp_job_detail.php?pos_id={$resultJob["pos_id"]}";
	}
	else
	{
		$alert = "เกิดความผิดพลาดระหว่างการดำเนินการ กรุณาลองใหม่อีกครั้ง";
		$location = "corp_job_detail.php?pos_id={$resultJob["pos_id"]}";
	}
}
else
{
	$location = "index.php?page=home";
}

require("class/JsControl.php");
?>