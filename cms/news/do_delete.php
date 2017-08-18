<?php 
include("../../class/session_check.php");
$page = $_GET["page"];
$wid = $_GET["wid"];
$id = $_GET["id"];
$cate_id = $_GET["cate_id"];

$sql->table="tbl_news_img";
$sql->condition="WHERE news_id='$id'";
$query = $sql->select();
while($result = mysqli_fetch_assoc($query))
{
	@unlink("../../upload/news/".$result["img"]);
}
$sql->delete();

$sql->table="tbl_news";
$sql->condition = "WHERE id='$id'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);
$sql->delete();

$news_name = $result["topic"];

$alert = "ลบข้อมูล \"$news_name\" เรียบร้อยแล้ว";
$location = "index.php?page=$page&wid=$wid&cate_id=$cate_id";

require("../../class/JsControl.php");
?>