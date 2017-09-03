<?php 

$data = array();

include("../class/SQLiManager.php");
$sql = new SQLiManager();

$sql->table="tbl_majors";
$sql->condition="WHERE major_faculty_id={$_GET["id"]}";
$query = $sql->select();
while($results = mysqli_fetch_assoc($query)){
	$data[] = $results;
}

echo json_encode($data);
?>