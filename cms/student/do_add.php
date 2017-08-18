<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if(isset($_POST["checkAddStudent"]) and $_POST["checkAddStudent"] == "1")
{
	$username = mysqli_real_escape_string($sql->connect,$_POST["username"]);
	$password = mysqli_real_escape_string($sql->connect,$_POST["password"]);
	$name = $_POST["name"];
	$year_id = $_POST["year_id"];

	$new_image_name = "";

	if($_FILES["picture"]["name"] != "")
	{
		$nameimg = $_FILES["picture"]["name"];
		$type = strrchr($nameimg,".");
		$new_image_name = 'Profile_'.date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
		move_uploaded_file($_FILES["picture"]["tmp_name"], "../../upload/profile/".$new_image_name);
	}

	$sql->table="tbl_authentication";
	$sql->field="username,password,name,picture,status_id,accept_year_id,create_date";
	$sql->value="'$username','$password','$name','$new_image_name','4','$year_id',NOW()";
	if($sql->insert())
	{
		$user_id = mysqli_insert_id($sql->connect);
		$major = "วิศวกรรมซอฟต์แวร์";
		$faculty = "เทคโนโลยีอุตสาหกรรม";

		$sql->table="tbl_student";
		$sql->field="user_id,major,faculty,year_id";
		$sql->value="'$user_id','$major','$faculty','$year_id'";
		$sql->insert();

		$alert = "เพิมข้อมูลนักศึกษารหัส \"$username\" เรียบร้อยแล้ว";
		$location = "index.php?page=$page";
	}
	else
	{
		$alert = "ไม่สามารถเพิ่มข้อมูลนักศึกษาได้ กรุณาลองใหม่อีกครั้ง";
		$location = "index.php?page=$page";
	}

}
else
{
	$location = "index.php?page=$page";
}

require("../../class/JsControl.php");
?>