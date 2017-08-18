<?php 
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");

$sql = new SQLiManager();

$session_id = $_GET["sid"];
$user_id = $_GET["uid"];

$sql->table="tbl_corporation";
$sql->condition="WHERE user_id='$user_id' and session_id='$session_id'";
$query = $sql->select();
$numRow = mysqli_num_rows($query);
if($numRow == 1)
{
	$sql->table="tbl_year";
	$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
	$resultYear = mysqli_fetch_assoc($sql->select());
	$sql->table="tbl_authentication";
	$sql->value="status_id='3',accept_year_id='".$resultYear["id"]."'";
	$sql->condition="WHERE id='$user_id'";
	if($sql->update())
	{
		$alert = "ยืนยันตัวตนเรียบร้อย คุณสามารถเข้าใช้งานได้ทันที";
		$location = "index.php?page=home";
	}
	else
	{
		$alert = "เกิดข้อผิดพลาดเกี่ยวกับลิงค์ยืนยัน กรุณาลองใหม่อีกครั้ง";
		$location = "index.php?page=home";
	}
}
else
{
	$alert = "กรุณาตรวจสอบลิงค์ที่ใช้ยืนยันในการเข้าสู่ระบบ";
	$location = "index.php?page=home";
}

require("class/JsControl.php");
?>