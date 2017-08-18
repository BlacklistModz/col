<?php 
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");

$sql = new SQLiManager();

$id = $_GET["id"];
$job_status = $_GET["job_status"];

$sql->table="tbl_stu_job";
$sql->condition="WHERE id='$id'";
$queryJob = $sql->select();
$resultJob = mysqli_fetch_assoc($queryJob);

$sql->table="tbl_position";
$sql->condition="WHERE id='{$resultJob["pos_id"]}'";
$queryPos = $sql->select();
$resultPos = mysqli_fetch_assoc($queryPos);

$sql->table="tbl_corporation";
$sql->condition="WHERE id='{$resultPos["corp_id"]}'";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);

$sql->table="tbl_stu_job";
$sql->value="job_status='$job_status'";
$sql->condition="WHERE id='$id'";
if($sql->update())
{
	if($job_status == 3)
	{
		$sql->table="tbl_stu_job";
		$sql->value="job_status='4'";
		$sql->condition="WHERE stu_id='{$resultJob["stu_id"]}' and job_status='1'";
		$sql->update();

		$alert = "ตอบรับการฝึกงานเรียบร้อยแล้ว \\n -> สถานประกอบการ : {$resultCorp["name_th"]} \\n -> ตำแหน่ง : {$resultPos["pos_name"]}";
		$location = "student_job.php";
	}
	else
	{
		$alert = "สละสิทธิ์เรียบร้อยแล้ว \\n -> สถานประกอบการ : {$resultCorp["name_th"]} \\n -> ตำแหน่ง : {$resultPos["pos_name"]}";
		$location = "student_job.php";
	}
}
else
{
	$alert = "ไม่สามารถดำเนินการตามที่ร้องขอได้ กรุณาลองใหม่อีกครั้ง";
	$location = "student_job.php";
}

require("class/JsControl.php");
?>