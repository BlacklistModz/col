<?php 
include("../../class/session_check.php");

$id = $_GET["id"]; //Authentication id
$page = $_GET["page"];

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$id'";
$result = mysqli_fetch_assoc($sql->select());
@unlink("../../upload/profile/".$result["picture"]);
$sql->delete();

$sql->table="tbl_student";
$sql->condition="WHERE user_id='$id'";
$resultStu = mysqli_fetch_assoc($sql->select());
$stu_id = $resultStu["id"]; //Student From id
$sql->delete();

$sql->table="tbl_stu_exp";
$sql->condition="WHERE stu_id='$stu_id'";
$sql->delete();

$sql->table="tbl_stu_job";
$sql->condition="WHERE stu_id='$stu_id'";
$sql->delete();

$sql->table="tbl_stu_edu";
$sql->condition="WHERE stu_id='$stu_id'";
$sql->delete();

$sql->table="tbl_training";
$sql->condition="WHERE stu_id='$stu_id'";
$sql->delete();

$sql->table="tbl_stu_skill";
$sql->condition="WHERE stu_id='$stu_id'";
$sql->delete();

$alert = "ลบข้อมูลนักศึกษารหัส \"{$result["username"]}\" เรียบร้อยแล้ว";
$location = "index.php?page=$page";

require("../../class/JsControl.php");
?>