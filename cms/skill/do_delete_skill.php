<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$fid = $_GET["fid"];
$id = $_GET["id"];

$sql->table="tbl_skill";
$sql->condition="WHERE id='$id'";
$sql->delete();

$sql->table="tbl_sub_skill";
$sql->condition="WHERE skill_id='$id'";
$result = mysqli_fetch_assoc($sql->select());
$sql->delete();

$subskill_id = $result["id"];

$sql->table="tbl_student_skill";
$sql->condition="WHERE subskill_id='$subskill_id'";
$sql->delete();

$alert = "ลบข้อมูลความสามารถพิเศษเรียบร้อยแล้ว";
$location = "index.php?page=$page&fid=$fid";

require("../../class/JsControl.php");
?>