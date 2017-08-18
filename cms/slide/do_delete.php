<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$id = $_GET["id"];

$sql->table="tbl_slide";
$sql->condition="WHERE id='$id'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);

$sql->table="tbl_slide";
$sql->condition="ORDER By rank DESC LIMIT 0,1";
$queryLast = $sql->select();
$resultLast = mysqli_fetch_assoc($queryLast);

$sql->table="tbl_slide";
$sql->condition="WHERE id='$id'";
$sql->delete();
@unlink("../../upload/slide/".$result["img"]);

$rank = $result["rank"]+1;
$rankLast = $resultLast["rank"];

$sql->table="tbl_slide";
$sql->value="rank=rank-'1'";
$sql->condition="WHERE rank between '$rank' and '$rankLast'";
$sql->update();

$alert = "ลบข้อมูลรูปภาพสไลด์เรียบร้อยแล้ว";
$location = "index.php?page=$page";

require("../../class/JsControl.php");
?>