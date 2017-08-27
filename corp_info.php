<?php
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");

$sql = new SQLiManager();

if(isset($_POST["checkCorpEdit"]) and $_POST["checkCorpEdit"] == "1")
{
	$id = $_POST["id"];
/* 
// tab1
	$name_th = $_POST["name_th"];
	$name_en = $_POST["name_en"];
	$address = $_POST["address"];
	$province_id = $_POST["province_id"];
	$zip_code = $_POST["zip_code"];
	$phone = $_POST["phone"];
	$fax = $_POST["fax"];
	$business_type = $_POST["business_type"];
	$emp_count = $_POST["emp_count"];
	$work_time = $_POST["work_time"];

//tab 2
	$manager_name = $_POST["manager_name"];
	$mjob_position = $_POST["mjob_position"];
	$major_require = $_POST["major_require"];
	$stu_features = $_POST["stu_features"];

//tab 3
	$staff_name = $_POST["staff_name"];
	$sjob_position = $_POST["sjob_position"];
	$division = $_POST["division"];
	$tel = $_POST["tel"];
	$practice_start = $_POST["practice_start"];
	$practice_end = $_POST["practice_end"];
	$compensation = $_POST["compensation"];
	$compensation_status = $_POST["compensation_status"];
	$welfare = $_POST["welfare"]; //สวัสดิการอื่นๆ
	$update_user = $_POST["update_user"];
	$user_id = $_POST["update_user"]; */

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
		$_POST["update_date"] = "NOW()";
		$_POST["year_id"] = $resultYear['id'];

		foreach ($_POST as $key => $val) {

			if( $key == "checkCorpEdit" || $key == "id" || $key == "wel" || $key == "position" || $key == "job_description" || $key == "wel_value" || $key == "stu_count" ) continue;

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
		$_POST["update_date"] = "NOW()";
		foreach ($_POST as $key => $val) {
			
			if( $key == "checkCorpEdit" || $key == "id" || $key == "wel" || $key == "position" || $key == "job_description" || $key == "wel_value" || $key == "stu_count" ) continue;

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
		/* $count = count($_POST["position"]);
		for($i=0;$i<=$count;$i++)
		{
			if(!empty($_POST["position"][$i]) and !empty($_POST["stu_count"][$i]))
			{
				$name = $_POST["position"][$i];
				$job_description = $_POST["job_description"][$i];
				$stu_count = $_POST["stu_count"][$i];
				$sql->table="tbl_position";
				$sql->field="corp_id,pos_name,job_description,stu_count";
				$sql->value="'$id','$name','$job_description','$stu_count'";
				$sql->insert();
			}
		} */
		////////////////////////////////////////
		if(isset($_POST["wel"])) 
		{
			$sql->table="tbl_corp_welfare";
			$sql->condition="WHERE corp_id={$id}";
			$sql->delete();

			foreach ($_POST["wel"] as $key => $value) {

				$sql->table="tbl_corp_welfare";
				$sql->field="corp_id,wel_id,wel_value";
				$sql->value="'{$id}','{$value}','{$_POST["wel_value"][$key]}'";
				$sql->insert();
			}
			/* $countWel = count($_POST["wel"]);
			for($x=0;$x<=$countWel;$x++)
			{
				if(!empty($_POST["wel_id"][$x]))
				{
					$wel_id = $_POST["wel_id"][$x];
					$sql->table="tbl_corp_welfare";
					$sql->field="corp_id,wel_id";
					$sql->value="'$id','$wel_id'";
					$sql->insert();
				}
			} */
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