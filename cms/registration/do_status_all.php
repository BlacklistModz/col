<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	if(!empty($_POST["id"]))
	{
		for($i=0;$i<count($_POST["id"]);$i++)
		{
			$id = $_POST["id"][$i];
			$sql->table="tbl_authentication";
			$sql->condition="WHERE id='$id'";
			$queryCheck = $sql->select();
			$resultCheck = mysqli_fetch_assoc($queryCheck);

			if($resultCheck["status_id"] == "4")
			{
				$sql->table="tbl_authentication";
				$sql->value="status_id='5'";
				$sql->condition="WHERE id='$id'";
				$sql->update();
			}
			elseif($resultCheck["status_id"] == "5")
			{
				$sql->table="tbl_authentication";
				$sql->value="status_id='4'";
				$sql->condition="WHERE id='$id'";
				$sql->update();
			}
		}
		$alert = "ปรับสถานะนักศึกษาที่เลือกเรียบร้อยแล้ว";
		$location = "index.php?page=$page";
	}
	else
	{
		$alert = "กรุณาเลือกนักศึกษา ก่อนดำเนินการปรับสถานะ";
		$location = "index.php?page=$page";
	}
}
else
{
	$location = "index.php?page=$page";
}

require("../../class/JsControl.php");
?>