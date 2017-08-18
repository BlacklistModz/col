<?php
ob_start();
session_start();
header('Content-type: text/html; charset=utf-8');
include("SQLiManager.php");
$sql = new SQLiManager();

if($_SESSION["user_id"] != "")
{
	$user_id = $_SESSION["user_id"];

	$sql->table="tbl_authentication";
	$sql->condition="WHERE id='$user_id' and status_id='1'";
	$query = $sql->select();
	$numRow = mysqli_num_rows($query);
	if($numRow != 1)
	{
		header("location:../index.php");
	}

	$resultAdmin = mysqli_fetch_assoc($query);

	$sql->table="tbl_status";
	$sql->condition="WHERE id='1'";
	$queryStatus = $sql->select();
	$resultStatus = mysqli_fetch_assoc($queryStatus);
}
else
{
	header("location:../index.php");
}
?>