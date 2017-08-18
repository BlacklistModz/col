<?php 
header('Content-type: text/html; charset=utf-8');
session_start();
include("class/SQLiManager.php");

$user_id = $_SESSION["user_id"];
$sql = new SQLiManager();

$send_id = $_GET["send_id"];
$id = $_GET["id"];

$sql->table="tbl_stu_send";
$sql->condition="WHERE id='$send_id'";
$numRow = mysqli_num_rows($sql->select());
if($numRow <= 0)
{
	$location = "document.php";
}

$resultSend = mysqli_fetch_assoc($sql->select());

$doc_id = $resultSend["doc_id"];

$sql->table="tbl_stu_send_detail";
$sql->condition="WHERE id='$id' and send_id='$send_id'";
if($sql->delete())
{
	$alert = "ลบไฟล์เอกสารที่เลือกเรียบร้อยแล้ว";
	$location = "stu_document.php?page=student&sub=document&doc_id=$doc_id";
}
else
{
	$alert = "ผิดพลาด ไม่สามารถลบไฟล์ได้ กรุณาลองใหม่อีกครั้ง";
	$location = "stu_document.php?page=student&sub=document&doc_id=$doc_id";
}

require("class/JsControl.php");
?>