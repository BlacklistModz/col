<?php 
include("../../class/session_check.php");
$page = $_GET["page"];
$wid = $_GET["wid"];
$id = $_GET["id"];
$cate_id = $_GET["cate_id"];

$sql->table="tbl_news";
$sql->condition="WHERE id='$id'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);

if($result["news_status"] == 1)
{
	$status = "0";
	$status_name = "แสดงผล";
}
else
{
	$status = "1";
	$status_name = "ไม่แสดงผล";
}

$sql->table="tbl_news";
$sql->value="news_status='$status'";
$sql->condition="WHERE id='$id'";
$sql->update();

$alert = "ปรับสถานะเป็น \"$status_name\" เรียบร้อยแล้ว";
$location = "index.php?page=$page&wid=$wid&cate_id=$cate_id";

require("../../class/JsControl.php");
?>