<?php 
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");

$sql = new SQLiManager();

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$corp_id = $_POST["corp_id"];
	$stu_id = $_POST["stu_id"];
	$year_id = $_POST["year_id"];
	$assess_comment = $_POST["assess_comment"];
	$countTopic = count($_POST["ass_topic_id"]);
	$total_point = 0;

	$sql->table="tbl_authentication";
	$sql->condition="WHERE id='$stu_id'";
	$queryStudent = $sql->select();
	$resultStudent = mysqli_fetch_assoc($queryStudent);

	$sql->table="tbl_stu_assreport";
	$sql->field="corp_id,stu_id,assess_date,assess_comment,year_id,total_point";
	$sql->value="'$corp_id','$stu_id',NOW(),'$assess_comment','$year_id','0'";
	if($sql->insert())
	{
		$assreport_id = mysqli_insert_id($sql->connect);
		for($i=0;$i<$countTopic;$i++)
		{
			$ass_topic_id = $_POST["ass_topic_id"][$i];
			if(!empty($_POST["ass_point"][$i]))
			{
				$point = $_POST["ass_point"][$i];
			}
			else
			{
				$point = 0;
			}

			$sql->table="tbl_stu_assreport_detail";
			$sql->field="assreport_id,ass_topic_id,assess_point";
			$sql->value="'$assreport_id','$ass_topic_id','$point'";
			$sql->insert();
			$total_point = $total_point + $point;
		}

		$sql->table="tbl_stu_assreport";
		$sql->value="total_point='$total_point'";
		$sql->condition="WHERE id='$assreport_id'";
		$sql->update();

		$alert = "ประเมินผลรายงานสหกิจศึกษา \\n - นักศึกษา {$resultStudent["name"]} เรียบร้อยแล้ว";
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
	$location = "index.php?page=home";
}

require("class/JsControl.php");
?>