<?php 
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");

$sql = new SQLiManager();

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$countAss = count($_POST["ass_sub_id"]);
	$total_point = 0;

	$corp_id = $_POST["corp_id"];
	$stu_id = $_POST["stu_id"];
	$year_id = $_POST["year_id"];
	$pos_name = $_POST["pos_name"];

	$stu_strength = trim($_POST["stu_strength"]);
	$stu_improvement = trim($_POST["stu_improvement"]);
	$stu_offer = $_POST["offer"];

	$sql->table="tbl_authentication";
	$sql->condition="WHERE id='$stu_id'";
	$resultStudent = mysqli_fetch_assoc($sql->select());

	$sql->table="tbl_stu_asswork";
	$sql->field="corp_id,stu_id,stu_strength,stu_improvement,stu_offer,assess_date,year_id,total_point";
	$sql->value="'$corp_id','$stu_id','$stu_strength','$stu_improvement','$stu_offer',NOW(),'$year_id','0'";
	if($sql->insert())
	{
		$asswork_id = mysqli_insert_id($sql->connect);

		for($i=0;$i<$countAss;$i++)
		{
			$ass_sub_id = $_POST["ass_sub_id"][$i];
			if(!empty($_POST["ass_point"][$i]))
			{
				$point = $_POST["ass_point"][$i];
			}
			else
			{
				$point = 0;
			}

			$sql->table="tbl_stu_asswork_detail";
			$sql->field="asswork_id,ass_sub_id,ass_point";
			$sql->value="'$asswork_id','$ass_sub_id','$point'";
			$sql->insert();
			$total_point = $total_point + $point;
		}
		$sql->table="tbl_stu_asswork";
		$sql->value="total_point='$total_point'";
		$sql->condition="WHERE id='$asswork_id'";
		$sql->update();

		$alert = "ประเมินผลการปฏิบัติงานสหกิจศึกษา \\n - นักศึกษา {$resultStudent["name"]} \\n ตำแหน่ง $pos_name เรียบร้อยแล้ว";
		$location = "corp_assess.php";
	}
	else
	{
		$alert = "ไม่สามารถประเมินได้ กรุณาลองใหม่อีกครั้ง";
		$location = "corp_assess.php";
	}
}
else
{
	$location "index.php?page=home";
}

require("class/JsControl.php");
?>