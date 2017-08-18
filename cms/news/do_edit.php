<?php 
include("../../class/session_check.php");
$page = $_GET["page"];
$wid = $_GET["wid"];

if(isset($_POST["checkEditNews"]) and $_POST["checkEditNews"] == "1")
{
	$id = $_POST["id"];
	$topic = $_POST["topic"];
	$stort_detail = $_POST["short_detail"];
	$detail = $_POST["detail"];
	$news_status = $_POST["news_status"];
	$cate_id = $_POST["cate_id"];

	for($i=0;$i<=count($_FILES["img"]["name"]);$i++)
	{
		if(!empty($_FILES["img"]["name"][$i]))
		{
			$nameimg = $_FILES["img"]["name"][$i];
			$type = strrchr($nameimg,".");
			$new_image_name = 'News_'.date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
			move_uploaded_file($_FILES["img"]["tmp_name"][$i], "../../upload/news/".$new_image_name);

			$sql->table="tbl_news_img";
			$sql->field="news_id,img";
			$sql->value="'$id','$new_image_name'";
			$sql->insert();
		}
	}

	$sql->table="tbl_news";
	$sql->value="cate_id='$cate_id',topic='$topic',short_detail='$short_detail',detail='$detail',update_date=NOW(),news_status='$news_status'";
	$sql->condition="WHERE id='$id'";
	if($sql->update())
	{
		$alert = "แก้ไขข้อมูลเรียบร้อยแล้ว";
		$location = "index.php?page=$page&wid=$wid";
	}
	else
	{
		$alert = "ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง";
		$location = "edit.php?page=$page&wid=$wid&id=$id";
	}
}
else
{
	$location = "index.php?page=$page&wid=$wid&cate_id=$cate_id";
}

require("../../class/JsControl.php");
?>