<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$id = $_POST["id"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$sql->table="tbl_slide";
	$sql->condition="WHERE id='$id'";
	$query = $sql->select();
	$result = mysqli_fetch_assoc($query);

	$slide_status = $_POST["slide_status"];
	$new_image_name = $result["img"];

	if($_FILES["img"]["name"] != "")
	{
		$nameimg = $_FILES["img"]["name"];
		$type = strrchr($nameimg,".");
		$new_image_name = 'Slide_'.date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
		move_uploaded_file($_FILES["img"]["tmp_name"], "../../upload/slide/".$new_image_name);
		@unlink("../../slide/".$result["img"]);
	}

	$sql->table="tbl_slide";
	$sql->value="img='$new_image_name',slide_status='$slide_status'";
	$sql->condition="WHERE id='$id'";
	if($sql->update())
	{
		$alert = "แก้ไขรูปภาพสไลด์เรียบร้อยแล้ว";
		$location = "index.php?page=$page";
	}
	else
	{
		$alert = "ไม่สามารถแก้ไขรูปภาพสไลด์ได้ กรุณาลองใหม่อีกครั้ง";
		$location = "edit.php?page=$page&id=$id";
	}
}
else
{
	$location = "index.php?page=$page";
}

require("../../class/JsControl.php");
?>