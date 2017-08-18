<?php 
session_start();
include("SQLiManager.php");
$sql = new SQLiManager();

$sql->table="tbl_authentication";
$sql->condition="WHERE status_id='1' ORDER By id ASC LIMIT 0,1";
$resultUser = mysqli_fetch_assoc($sql->select());

$_SESSION["user_id"] = $resultUser["id"];
$_SESSION["login_date"] = $resultUser["last_login"];
header("location:../cms/index.php");

?>