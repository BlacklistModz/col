<?php 
include("../../class/session_check.php");
$page = $_GET["page"];
$wid = $_GET["wid"];
$id = $_GET["id"];
$cate_id = $_GET["cate_id"];

$sql->table="tbl_news_img";
$sql->condition="WHERE id='$id'";
$result = mysqli_fetch_assoc($sql->select());

@unlink("../../upload/news/".$result["img"]);

$news_id = $result["news_id"];

$sql->delete();

$alert = "ลบรูปภาพที่เลือกเรียบร้อยแล้ว";
$location = "edit.php?page=$page&wid=$wid&id=$news_id&cate_id=$cate_id";

require("../../class/JsControl.php");
?>