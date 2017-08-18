<?php 
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");

$sql = new SQLiManager();

if($_POST["checkSubmit"] == "1")
{
	$id = $_POST["id"];
	$crop_id = $_POST["crop_id"];
	$pos_name = trim($_POST["pos_name"]);
	$job_description = trim($_POST["job_description"]);
	$stu_count = trim($_POST["stu_count"]);

	//$sql = "UPDATE tbl_position SET pos_name='$pos_name',job_description='$job_description',stu_count='$stu_count'";
	//$sql.= "WHERE id='$id' and corp_id='$crop_id'";
	//$query = mysqli_query($sql->connect,$sql);

	$sql->table="tbl_position";
	$sql->value="pos_name='$pos_name',job_description='$job_description',stu_count='$stu_count'";
	$sql->condition="WHERE id='$id' and corp_id='$crop_id'";
	if($sql->update())
	{
		echo "1";
	}
	else
	{
		echo "fail";
	}
}
?>