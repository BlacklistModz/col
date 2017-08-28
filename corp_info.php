<?php
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");

$sql = new SQLiManager();

if(isset($_POST["checkCorpEdit"]) and $_POST["checkCorpEdit"] == "1")
{
	$id = $_POST["id"];

	$sql->table="tbl_year";
	$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
	$resultYear = mysqli_fetch_assoc($sql->select());

	$sql->table="tbl_corporation";
	$sql->condition="WHERE year_id='".$resultYear["id"]."'";
	$numRow = mysqli_num_rows($sql->select());
	if($numRow <= 0)
	{
		#SET DATA
		$field = "";
		$value = "";
		$_POST["update_date"] = date("c");
		$_POST["year_id"] = $resultYear['id'];

		foreach ($_POST as $key => $val) {

			if( $key == "checkCorpEdit" || $key == "id" || $key == "wel_id" || $key == "wel_type" || $key == "position" || $key == "job_description" || $key == "wel_value" || $key == "stu_count" || $key == "major_id"  || $key == "student_amount" ) continue;

			$field .= !empty($field) ? "," : "";
			$field .= "{$key}";

			$value .= !empty($value) ? "," : "";
			$value .= "'{$val}'";
		}

		$sql->table="tbl_corporation";
		$sql->field=$field;
		$sql->value=$value;
		$query = $sql->insert();
		$id = mysqli_insert_id($sql->connect);
	}
	else
	{
		#SET DATA
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
		$query = $sql->update();
	}

	if($query)
	{
		$sql->table="tbl_position";
		$sql->condition="WHERE corp_id='{$id}'";
		while($resultPosition = mysqli_fetch_assoc( $sql->select() ) ){
			$sql->table="tbl_stu_job";
			$sql->condition="WHERE pos_id='{$resultPosition["id"]}'";
			$sql->delete();
		}
		$sql->delete();
		///////////////////////////////////////
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
		// $alert = "บันทึกข้อมูลสถานประกอบการของท่าน ในปีการศึกษา {$resultYear["academic_year"]} เรียบร้อยแล้ว";
		// $location = "SE-CO-002.php?page=company&sub=coop_02";
		echo "1";
	}
	else
	{
		// $alert = "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง \\n -> หรือติดต่อสาขาวิชาวิศวกรรมซอฟต์แวร์ \\n -> โทร 054-237399 ต่อ (6000)";
		// $location = "SE-CO-002.php?page=company&sub=coop_02";
		echo "2";
	}
}

require("class/JsControl.php");
?>