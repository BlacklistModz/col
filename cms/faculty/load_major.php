<?php 
include("../../class/session_check.php");

if( !empty($_GET["id"]) ){

	$id = mysqli_real_escape_string($sql->connect, $_GET["id"]);

	$sql->table="tbl_majors";
	$sql->condition="WHERE major_faculty_id={$id}";
	$query = $sql->select();
	$results = mysqli_fetch_assoc($query);
	
	return $results;
}
else{
	return false;
}
?>