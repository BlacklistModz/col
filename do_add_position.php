<?php 
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");

$sql = new SQLiManager();

if($_POST["checkSubmit"] == "1")
{
	$crop_id = $_POST["crop_id"];
	$pos_name = trim($_POST["pos_name"]);
	$job_description = trim($_POST["job_description"]);
	$stu_count = trim($_POST["stu_count"]);

	$sql->table="tbl_position";
	$sql->field="corp_id,pos_name,job_description,stu_count";
	$sql->value="'$crop_id','$pos_name','$job_description','$stu_count'";
	if($sql->insert())
	{
		echo "1";
	}
	else
	{
		echo "fail";
	}
}
?>