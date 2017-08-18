<?php 
include("SQLiManager.php"); 
$sql = new SQLiManager();

$username = isset($_POST["username"]) ? trim($_POST["username"]) : "";

$sql->table="tbl_authentication";
$sql->condition="WHERE username='$username'";
$CheckUser = mysqli_num_rows($sql->select());
if($CheckUser > 0)
{
	echo "failUser";
}
?>