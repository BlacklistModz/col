<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$slide_status = $_POST["slide_status"];

	$sql->table="tbl_slide";
	$sql->condition="ORDER By rank DESC LIMIT 0,1";
	$queryRank = $sql->select();
	$resultRank = mysqli_fetch_assoc($queryRank);

	$rank = $resultRank["rank"] + 1;

	$nameimg = $_FILES["img"]["name"];
	$type = strrchr($nameimg,".");
	$new_image_name = 'Slide_'.date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
	move_uploaded_file($_FILES["img"]["tmp_name"], "../../upload/slide/".$new_image_name);

	$sql->table="tbl_slide";
	$sql->field="img,rank,slide_status";
	$sql->value="'$new_image_name','$rank','$slide_status'";
	if($sql->insert())
	{
		$alert = "เพิ่มรูปภาพสไลด์หน้าเว็บไซต์ เรียบร้อยแล้ว";
		$location = "index.php?page=$page";
	}
	else
	{
		$alert = "ไม่สามารถเพิ่มรูปภาพสไลด์หน้าเว็บไซต์ได้ กรุณาลองใหม่อีกครั้ง";
		$location = "add.php?page=$page";
	}
}
else
{
	$location = "index.php?page=$page";
}

require("../../class/JsControl.php");
?>