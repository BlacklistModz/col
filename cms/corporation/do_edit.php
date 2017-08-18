<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if(isset($_POST["checkCorpEdit"]) and $_POST["checkCorpEdit"] == "1")
{
	$id = $_POST["id"];
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

	$sql->table="tbl_corporation";
	$sql->value="name_th='$name_th',name_en='$name_en',address='$address',province_id='$province_id',zip_code='$zip_code',phone='$phone',fax='$fax',business_type='$business_type',emp_count='$emp_count',work_time='$work_time',manager_name='$manager_name',mjob_position='$mjob_position',major_require='$major_require',stu_features='$stu_features',staff_name='$staff_name',sjob_position='$sjob_position',division='$division',tel='$tel',practice_start='$practice_start',practice_end='$practice_end',compensation='$compensation',compensation_status='$compensation_status',welfare='$welfare',update_date=NOW(),update_user='$update_user'";
	$sql->condition="WHERE id='$id'";
	if($sql->update())
	{
		$sql->table="tbl_position";
		$sql->condition="WHERE corp_id='$id'";
		$sql->delete();
		///////////////////////////////////////
		$count = count($_POST["position"]);
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
		}
		////////////////////////////////////////
		$sql->table="tbl_corp_welfare";
		$sql->condition="WHERE corp_id='$id'";
		$sql->delete();
		$countWel = count($_POST["wel_id"]);
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