<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$corp_id = $_GET["corp_id"];
$user_id = $_GET["user_id"];

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$queryYear = $sql->select();
$resultYear = mysqli_fetch_assoc($queryYear);

$sql->table="tbl_authentication";
$sql->condition="WHERE id ='$user_id'";
$queryUser = $sql->select();
$resultUser = mysqli_fetch_assoc($queryUser);

$status = $resultUser["status_id"];

$sql->table="tbl_corporation";
$sql->condition="WHERE id='$corp_id' and user_id='$user_id'";
$query = $sql->select();
$numRow = mysqli_num_rows($query);
if($numRow == 1)
{
	$result = mysqli_fetch_assoc($query);
	$corp_name = $result["name_th"];
	if($status == 0 or ($status == 3 and $resultUser["accept_year_id"] != $resultYear["id"]))
	{
		$sql->table="tbl_authentication";
		$sql->value="status_id='3',accept_year_id='{$resultYear["id"]}'";
		$sql->condition="WHERE id='$user_id'";
		$sql->update();

		$alert = "ยืนยันสถานประกอบการ $corp_name ในปีการศึกษา {$resultYear["academic_year"]} เรียบร้อยแล้ว";
		$location = "index.php?page=$page";
	}
	elseif($status == 3 and $resultUser["accept_year_id"] == $resultYear["id"])
	{
		$sql->table="tbl_authentication";
		$sql->value="status_id='3',accept_year_id='0'";
		$sql->condition="WHERE id='$user_id'";
		$sql->update();

		$alert = "ยกเลิกการยืนยันสถานประกอบการ $corp_name ใบปีการศึกษา {$resultYear["academic_year"]} เรียบร้อยแล้ว";
		$location = "index.php?page=$page";
	}
	else
	{
		$alert = "เกิดข้อผิดพลาดบางอย่าง กรุณาลองใหม่อีกครั้ง";
		$location = "index.php?page=$page";
	}
}
else
{
	$location = "index.php?page=$page";
}
require("../../class/JsControl.php");
?>