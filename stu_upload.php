<?php 
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");

$sql = new SQLiManager();

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$page = $_POST["page"];
	$sub = $_POST["sub"];
	$doc_id = $_POST["doc_id"];
	$stu_id = $_POST["stu_id"];
	$year_id = $_POST["year_id"];

	$sql->table="tbl_authentication";
	$sql->condition="WHERE id='$stu_id'";
	$queryStu = $sql->select();
	$resultStu = mysqli_fetch_assoc($queryStu);

	$sql->table="tbl_document";
	$sql->condition="WHERE id='$doc_id'";
	$queryDoc = $sql->select();
	$resultDoc = mysqli_fetch_assoc($queryDoc);

	$stu_number = $resultStu["username"]; 

	if($resultDoc["doc_status"] == "0" or $resultDoc["doc_status"] == "3")
	{
		$namedoc = $_FILES["doc_file"]["name"];
		$type = strrchr($namedoc,".");
		$new_doc_name = $stu_number."_".$doc_id."_".date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;

		$sql->table="tbl_stu_send";
		$sql->condition="WHERE stu_id='$stu_id' and doc_id='$doc_id'";
		$numDoc = mysqli_num_rows($sql->select());
		if($numDoc <= 0)
		{
			$sql->table="tbl_stu_send";
			$sql->field="stu_id,doc_id,year_id,send_date";
			$sql->value="'$stu_id','$doc_id','$year_id',NOW()";
			$query = $sql->insert();
			if($query)
			{
				$send_id = mysqli_insert_id($sql->connect);

				$sql->table="tbl_stu_send_detail";
				$sql->field="send_id,doc_file,upload_date";
				$sql->value="'$send_id','$new_doc_name',NOW()";
				if($sql->insert())
				{
					move_uploaded_file($_FILES["doc_file"]["tmp_name"], "upload/student_doc/".$new_doc_name);

					// $alert = "บันทึกไฟล์เอกสาร {$resultDoc["doc_name"]} เรียบร้อยแล้ว";
					echo "บันทึกไฟล์เอกสาร {$resultDoc["doc_name"]} เรียบร้อยแล้ว";
					// $location = "document.php?page=$page&sub=$sub";
				}
			}
			else
			{
				$alert = "ไม่สามารถบันทึกไฟล์ได้ กรุณาลองใหม่อีกครั้ง";
				// $location = "document.php?page=$page&sub=$sub";
			}
		}
		else
		{
			$resultSend = mysqli_fetch_assoc($sql->select());

			$send_id = $resultSend["id"];

			$sql->table="tbl_stu_send_detail";
			$sql->condition="WHERE send_id='$send_id'";
			$resultFile = mysqli_fetch_assoc($sql->select());
			@unlink("upload/student_doc/".$resultFile["doc_file"]);

			$sql->table="tbl_stu_send_detail";
			$sql->value="doc_file='$new_doc_name',upload_date=NOW()";
			$sql->condition="WHERE send_id='$send_id'";
			if($sql->update())
			{
				move_uploaded_file($_FILES["doc_file"]["tmp_name"], "upload/student_doc/".$new_doc_name);

				// $alert = "แก้ไขไฟล์เอกสาร {$resultDoc["doc_name"]} เรียบร้อยแล้ว";
				echo "แก้ไขไฟล์เอกสาร {$resultDoc["doc_name"]} เรียบร้อยแล้ว";
				// $location = "document.php?page=$page&sub=$sub";
			}
			else
			{
				$alert = "ไม่สามารถบันทึกไฟล์ได้ กรุณาลองใหม่อีกครั้ง";
				// $location = "document.php?page=$page&sub=$sub";
			}
		}
	}
	elseif($resultDoc["doc_status"] == "1")
	{
		$sql->table="tbl_stu_send";
		$sql->condition="WHERE stu_id='$stu_id' and doc_id='$doc_id'";
		$numDoc = mysqli_num_rows($sql->select());
		if($numDoc <= 0)
		{
			$sql->table="tbl_stu_send";
			$sql->field="stu_id,doc_id,year_id,send_date";
			$sql->value="'$stu_id','$doc_id','$year_id',NOW()";
			$query = $sql->insert();
			if($query)
			{
				$send_id = mysqli_insert_id($sql->connect);
				$countFile = count($_FILES["doc_file"]["name"]);

				for($i=0;$i<$countFile;$i++)
				{
					if($_FILES["doc_file"]["name"][$i] != "")
					{
						$namedoc = $_FILES["doc_file"]["name"][$i];
						$type = strrchr($namedoc,".");
						$new_doc_name = $stu_number."_".$doc_id."_".date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
						move_uploaded_file($_FILES["doc_file"]["tmp_name"][$i], "upload/student_doc/".$new_doc_name);

						$sql->table="tbl_stu_send_detail";
						$sql->field="send_id,doc_file,upload_date";
						$sql->value="'$send_id','$new_doc_name',NOW()";
						$sql->insert();
					}
				}
				echo "บันทึกไฟล์เอกสาร {$resultDoc["doc_name"]} เรียบร้อยแล้ว";
				// $location = "document.php";
			}
			else
			{
				$alert = "ไม่สามารถบันทึกไฟล์ได้ กรุณาลองใหม่อีกครั้ง";
				// $location = "document.php";
			}
		}
		else
		{
			$resultDoc = mysqli_fetch_assoc($sql->select());
			$send_id = $resultDoc["id"];
			$countFile = count($_FILES["doc_file"]["name"]);
			for($i=0;$i<$countFile;$i++)
			{
				if(isset($_FILES["doc_file"]["name"][$i]))
				{
					$namedoc = $_FILES["doc_file"]["name"][$i];
					$type = strrchr($namedoc,".");
					$new_doc_name = $stu_number."_".$doc_id."_".date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
					move_uploaded_file($_FILES["doc_file"]["tmp_name"][$i], "upload/student_doc/".$new_doc_name);

					$sql->table="tbl_stu_send_detail";
					$sql->field="send_id,doc_file,upload_date";
					$sql->value="'$send_id','$new_doc_name',NOW()";
					$sql->insert();
				}
			}
			// $alert = "บันทึกไฟล์เพิ่มเติม เอกสาร เรียบร้อยแล้ว";
			echo "แก้ไขไฟล์เอกสารเรียบร้อยแล้ว";
			// $location = "document.php";
		}
	}
	elseif($resultDoc["doc_status"] == "2")
	{
		$project_th = $_POST["project_th"];
		$project_en = $_POST["project_en"];
		$project_detail = $_POST["project_detail"];
		$emp_name = $_POST["emp_name"];
		$emp_position = $_POST["emp_position"];
		$emp_department = $_POST["emp_department"];

		$sql->table="tbl_stu_send";
		$sql->condition="WHERE stu_id='$stu_id' and doc_id='$doc_id'";
		$numDoc = mysqli_num_rows($sql->select());
		if($numDoc <= 0)
		{
			$sql->table="tbl_stu_project";
			$sql->field="stu_id,year_id,project_th,project_en,project_detail,emp_name,emp_position,emp_department,create_date,update_date";
			$sql->value="'$stu_id','$year_id','$project_th','$project_en','$project_detail','$emp_name','$emp_position','$emp_department',NOW(),NOW()";
			$sql->insert();

			$sql->table="tbl_stu_send";
			$sql->field="stu_id,doc_id,year_id,send_date";
			$sql->value="'$stu_id','$doc_id','$year_id',NOW()";
			$query = $sql->insert();
			if($query)
			{
				$send_id = mysqli_insert_id($sql->connect);
				if($_FILES["doc_file"]["name"] != "")
				{
					$namedoc = $_FILES["doc_file"]["name"];
					$type = strrchr($namedoc,".");
					$new_doc_name = $stu_number."_".$doc_id."_".date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
					move_uploaded_file($_FILES["doc_file"]["tmp_name"], "upload/student_doc/".$new_doc_name);

					$sql->table="tbl_stu_send_detail";
					$sql->field="send_id,doc_file,upload_date";
					$sql->value="'$send_id','$new_doc_name',NOW()";
					$sql->insert();
				}

				$alert = "บันทึกไฟล์เอกสาร {$resultDoc["doc_name"]} เรียบร้อยแล้ว";
				// $location = "document.php?page=$page&sub=$sub";
			}
			else
			{
				$alert = "ไม่สามารถบันทึกไฟล์ได้ กรุณาลองใหม่อีกครั้ง";
				// $location = "document.php?page=$page&sub=$sub";
			}
		}
		else
		{
			$resultSend = mysqli_fetch_assoc($sql->select());

			$send_id = $resultSend["id"];

			$sql->table="tbl_stu_project";
			$sql->value="project_th='$project_th',project_en='$project_en',project_detail='$project_detail',emp_name='$emp_name',emp_position='$emp_position',emp_department='$emp_department',update_date=NOW()";
			$sql->condition="WHERE stu_id='$stu_id' and year_id='$year_id'";
			if($sql->update())
			{
				$sql->table="tbl_stu_send_detail";
				$sql->condition="WHERE send_id='$send_id'";
				$resultFile = mysqli_fetch_assoc($sql->select());
				$new_doc_name = $resultFile["doc_file"];

				if(!empty($_FILES["doc_file"]["name"]))
				{
					$namedoc = $_FILES["doc_file"]["name"];
					$type = strrchr($namedoc,".");
					$new_doc_name = $stu_number."_".$doc_id."_".date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
					move_uploaded_file($_FILES["doc_file"]["tmp_name"], "upload/student_doc/".$new_doc_name);
					@unlink("upload/student_doc/".$resultFile["doc_file"]);
				}

				$sql->table="tbl_stu_send_detail";
				$sql->value="doc_file='$new_doc_name',upload_date=NOW()";
				$sql->condition="WHERE send_id='$send_id'";
				$sql->update();

				// $alert = "แก้ไขข้อมูลไฟล์เอกสาร {$resultDoc["doc_name"]} เรียบร้อยแล้ว";
				// $location = "document.php?page=$page&sub=$sub";
				// echo "แก้ไขข้อมูลไฟล์เอกสาร{$resultDoc["doc_name"]}เรียบร้อยแล้ว";
				//$msgSuccessSending = "อัพโหลดไฟล์เสร็จสิ้น!"
				echo "แก้ไขไฟล์เอกสาร {$resultDoc["doc_name"]} เรียบร้อยแล้ว";
				//$localSetTimeout = "document.php?page=$page&sub=$sub";
			}
			else
			{
				$alert = "ไม่สามารถบันทึกข้อมูล {$resultDoc["doc_name"]} ได้ กรุณาลองใหม่อีกครั้ง";
				// $location = "document.php?page=$page&sub=$sub";
			}
		}
	}
	else
	{
		// $location = "document.php?page=$page&sub=$sub";
	}
}
else
{
	$location = "document.php?page=$page&sub=$sub";
}

require("class/JsControl.php");
?>