<?php 
include("../../class/session_check.php");

$id = $_GET["id"];
$page = $_GET["page"];

if($_GET["action"] == "up")
{
	$sql->table="tbl_slide";
	$sql->condition="WHERE id='$id'";
	$query = $sql->select();
	$result = mysqli_fetch_assoc($query);

	$rank_up = $result["rank"]-1;

	$sql->table="tbl_slide";
	$sql->condition="WHERE rank='$rank_up'";
	$query_up = $sql->select();
	$result_up = mysqli_fetch_assoc($query_up);

	$rank_down = $result_up["rank"]+1;

	$sql->table="tbl_slide";
	$sql->value="rank='$rank_down'";
	$sql->condition="WHERE id='{$result_up["id"]}'";
	$sql->update();

	$sql->table="tbl_slide";
	$sql->value="rank='$rank_up'";
	$sql->condition="WHERE id='$id'";
	$sql->update();
}
else
{
	$sql->table="tbl_slide";
	$sql->condition="WHERE id='$id'";
	$query = $sql->select();
	$result = mysqli_fetch_assoc($query);

	$rank_down = $result["rank"]+1;

	$sql->table="tbl_slide";
	$sql->condition="WHERE rank='$rank_down'";
	$query_up = $sql->select();
	$result_up = mysqli_fetch_assoc($query_up);

	$rank_up = $result_up["rank"]-1;

	$sql->table="tbl_slide";
	$sql->value="rank='$rank_up'";
	$sql->condition="WHERE id='{$result_up["id"]}'";
	$sql->update();

	$sql->table="tbl_slide";
	$sql->value="rank='$rank_down'";
	$sql->condition="WHERE id='$id'";
	$sql->update();
}

$location = "index.php?page=$page";

require("../../class/JsControl.php");
?>