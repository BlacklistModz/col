<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$id = $_GET["id"];

$sql->table="tbl_slide";
$sql->condition="WHERE id='$id'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);

if($result["slide_status"] == 1)
{
	$status = "0";
	$status_name = "แสดงผล";
}
else
{
	$status = "1";
	$status_name = "ไม่แสดงผล";
}

$sql->table="tbl_slide";
$sql->value="slide_status='$status'";
$sql->condition="WHERE id='$id'";
$sql->update();

$alert = "ปรับสถานะเป็น \"$status_name\" เรียบร้อยแล้ว";
$location = "index.php?page=$page";

require("../../class/JsControl.php");
?>