<?php 
header("Content-type:application/json; charset=UTF-8");               
header("Cache-Control: no-store, no-cache, must-revalidate");                 
header("Cache-Control: post-check=0, pre-check=0", false); 

include("../../class/SQLiManager.php");
$sql = new SQLiManager();

$id = $_GET["id"];

$sql->table="tbl_stu_asswork";
$sql->condition="WHERE stu_id='$id'";
$queryWork = $sql->select();
$resultWork = mysqli_fetch_assoc($queryWork);

$sql->table="tbl_assess_work";
$sql->condition="ORDER By id ASC";
$query = $sql->select();
$rows = array();
while($result = mysqli_fetch_assoc($query)) 
{
	$point = 0;
	$sql->table="tbl_assess_sub";
	$sql->condition="WHERE ass_id='{$result["id"]}'";
	$querySub = $sql->select();
	$numAssess = mysqli_num_rows($querySub);
	while($resultSub = mysqli_fetch_assoc($querySub))
	{
		$sql->table="tbl_stu_asswork_detail";
		$sql->condition="WHERE asswork_id='{$resultWork["id"]}' and ass_sub_id='{$resultSub["id"]}'";
		$queryAssess = $sql->select();
		$resultAssess = mysqli_fetch_assoc($queryAssess);
		$point = $point + $resultAssess["ass_point"];
	}
	$FullPoint = $numAssess*5;
	$persent = $point/$FullPoint * 100;

	$row[0] = $result["topic"];
	$row[1] = number_format($persent, 2, '.', '');
	array_push($rows,$row);
} 

echo json_encode($rows, JSON_NUMERIC_CHECK);
?>