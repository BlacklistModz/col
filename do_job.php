<?php 
header('Content-type: text/html; charset=utf-8');
session_start();
include("class/SQLiManager.php");

$sql = new SQLiManager();

$id = $_GET["id"];
$user_id = $_SESSION["user_id"];

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$resultYear = mysqli_fetch_assoc($sql->select());

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$user_id'";
$queryUser = $sql->select();
$resultUser = mysqli_fetch_assoc($queryUser);
$year_id = $resultYear["id"];

if($resultUser["status_id"] == "4")
{
	$sql->table="tbl_rulejob";
	$sql->condition="WHERE id='1'";
	$resultRule = mysqli_fetch_assoc($sql->select());

	$sql->table="tbl_stu_job";
	$sql->condition="WHERE stu_id='$user_id'";
	$numRow = mysqli_num_rows($sql->select());

	if($numRow < $resultRule["num_job"])
	{
		$sql->table="tbl_stu_job";
		$sql->field="pos_id,stu_id,job_status,year_id";
		$sql->value="'$id','$user_id','0','$year_id'";
		if($sql->insert())
		{
			$sql->table="tbl_corporation INNER JOIN tbl_position ON tbl_corporation.id = tbl_position.corp_id";
			$sql->field="tbl_corporation.name_th , tbl_position.pos_name";
			$sql->condition="WHERE tbl_position.id='$id'";
			$resultPos = mysqli_fetch_assoc($sql->select());
			$alert = "สมัครงานบริษัท {$resultPos["name_th"]} ในตำแหน่ง {$resultPos["pos_name"]} เรียบร้อยแล้ว";
			$location = "student_job.php";
		}
		else
		{
			$alert = "ไม่สามารถสมัครงานได้ กรุณาลองใหม่อีกครั้ง";
			$location = "job.php";
		}
	}
	else
	{
		$alert = "โควต้าการสมัครงานเต็ม นักศึกษาสามารถสมัครงานได้ 3 ตำแหน่งเท่านั้น";
		$location = "student_job.php";
	}
}
else
{
	$location = "index.php?page=home";
}

require("class/JsControl.php");
?>