<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$fid = $_GET["fid"];
$id = $_GET["id"];
$skill_id = $_GET["skill_id"];

$sql->table="tbl_sub_skill";
$sql->condition="WHERE id='$id'";
$sql->delete();

$alert = "ลบข้อมูลความสามารถพิเศษเรียบร้อยแล้ว";
$location = "index_subskill.php?page=$page&fid=$fid&id=$skill_id";

require("../../class/JsControl.php");
?>