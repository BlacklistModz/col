<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if(isset($_POST["checkCorpEdit"]) and $_POST["checkCorpEdit"] == "1")
{
	$id = $_POST["id"];

	$data = "";
	$_POST["update_date"] = date("c");
	foreach ($_POST as $key => $val) {

		if( $key == "checkCorpEdit" || $key == "id" || $key == "wel_id" || $key == "wel_type" || $key == "position" || $key == "job_description" || $key == "wel_value" || $key == "stu_count" || $key == "major_id"  || $key == "student_amount" ) continue;

		$data .= !empty($data) ? "," : "";
		$data .= "{$key}='{$val}'"; 
	}

	$sql->table="tbl_corporation";
	$sql->value=$data;
	$sql->condition="WHERE id='{$id}'";
	if($sql->update())
	{
		$sql->table="tbl_position";
		$sql->condition="WHERE corp_id='{$id}'";
		while($resultPosition = mysqli_fetch_assoc( $sql->select() ) ){
			$sql->table="tbl_stu_job";
			$sql->condition="WHERE pos_id='{$resultPosition["id"]}'";
			$sql->delete();
		}
		$sql->delete();
		foreach ($_POST["position"] as $key => $value) {
			if( empty($value) || empty($_POST["stu_count"][$key]) ) continue;

			$sql->table="tbl_position";
			$sql->field="corp_id,pos_name,job_description,stu_count";
			$sql->value="'{$id}','{$_POST["job_description"][$key]}','{$_POST["stu_count"][$key]}'";
		}
		////////////////////////////////////////
		
		if(isset($_POST["wel_id"])) 
		{
			$sql->table="tbl_corp_welfare";
			$sql->condition="WHERE corp_id={$id}";
			$sql->delete();

			foreach ($_POST["wel_id"] as $key => $value) {

				if( empty($_POST["wel_type"][$key]) ) continue;

				$sql->table="tbl_corp_welfare";
				$sql->field="corp_id,wel_id,wel_type,wel_value";
				$sql->value="'{$id}','{$value}','{$_POST["wel_type"][$key]}','{$_POST["wel_value"][$key]}'";
				$sql->insert();
			}
		}
		///////////////////////////////////////
		
		if( !empty($_POST["major_id"]) ){

			$sql->table="tbl_corp_majors";
			$sql->condition="WHERE corp_id={$id}";
			$sql->delete();

			foreach ($_POST["major_id"] as $key => $value) {

				if( empty($_POST["student_amount"][$key]) ) continue;

				$sql->table="tbl_corp_majors";
				$sql->field="corp_id,major_id,student_amount";
				$sql->value="'{$id}', '{$value}', {$_POST["student_amount"][$key]}";
				$sql->insert();
			}
		}

		$alert = "ปรับปรุงข้อมูลสถานประกอบการ \"$name_th\" เรียบร้อยแล้ว";
		$location = "index.php?page=$page";
	}
	else
	{
		echo mysqli_error($sql->connect);
	}
}
require("../../class/JsControl.php");
?>