<?php 
include("SQLiManager.php"); 
$sql = new SQLiManager();

$email = isset($_POST["email"]) ? trim($_POST["email"]) : "";

$sql->table="tbl_corporation";
$sql->condition="WHERE email='$email'";
$CheckEmail = mysqli_num_rows($sql->select());
if($CheckEmail > 0) 
{
	echo "failEmail";
}
?>