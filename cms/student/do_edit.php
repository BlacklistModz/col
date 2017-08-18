<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if (isset($_POST["checkEditStudent"]) and $_POST["checkEditStudent"] == "1") {

	$stu_id = $_POST["id"];
	$password = mysqli_real_escape_string($sql->connect,$_POST["password"]);
	$name = $_POST["name"];
	$year_id = $_POST["year_id"];

	$sql->table="tbl_authentication";
	$sql->condition="WHERE id='$stu_id'";
	$result = mysqli_fetch_assoc($sql->select());

	$new_image_name = $result["picture"];

	if($_FILES["picture"]["name"] != "")
	{
		$nameimg = $_FILES["picture"]["name"];
		$type = strrchr($nameimg,".");
		$new_image_name = 'Profile_'.date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
		move_uploaded_file($_FILES["picture"]["tmp_name"], "../../upload/profile/".$new_image_name);

		@unlink("../../upload/profile/".$result["picture"]);
	}

	$sql->table="tbl_authentication";
	$sql->value="password='$password',name='$name',picture='$new_image_name',accept_year_id='$year_id'";
	$sql->condition="WHERE id='$stu_id'";
	if ($sql->update())
	{
		$sql->table="tbl_student";
		$sql->value="year_id='$year_id'";
		$sql->condition="WHERE user_id='$stu_id'";
		$sql->update();
		
		$alert = "แก้ไขข้อมูลนักศึกษา \"$name\" เรียบร้อยแล้ว";
		$location = "index.php?page=$page";
	}
	else
	{
		$alert = "ไม่สามารถแก้ไขข้อมูลนักศึกษา \"$name\" ได้ \\n กรุณาลองใหม่อีกครั้ง";
		$location = "edit_student.php?page=$page&id=$stu_id";
	}

}
require("../../class/JsControl.php");
?>