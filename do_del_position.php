<?php 
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");

$sql = new SQLiManager();

$corp_id = $_GET["corp_id"];
$pos_id = $_GET["pos_id"];

$sql->table="tbl_position";
$sql->condition="WHERE id='$pos_id' and corp_id='$corp_id'";
if($sql->delete())
{
	echo "1";
}
else
{
	echo "fail";
}

?>