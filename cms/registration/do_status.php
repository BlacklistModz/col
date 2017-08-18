<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$id = $_GET["id"];

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$id'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);
if($result["status_id"] == "4")
{
	$sql->table="tbl_authentication";
	$sql->value="status_id='5'";
	$sql->condition="WHERE id='$id'";
	$sql->update();
}
elseif($result["status_id"]  == "5")
{
	$sql->table="tbl_authentication";
	$sql->value="status_id='4'";
	$sql->condition="WHERE id='$id'";
	$sql->update();
}

$alert = "ปรับสถานะของนักศึกษารหัส {$result["username"]} เรียบร้อยแล้ว";
$location = "index.php?page=$page";

require("../../class/JsControl.php");
?>