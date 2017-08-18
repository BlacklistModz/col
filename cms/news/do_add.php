<?php 
include("../../class/session_check.php");

$page = $_GET["page"];
$wid = $_GET["wid"];

if(isset($_POST["checkAddNews"]) and $_POST["checkAddNews"] == "1")
{
	$topic = $_POST["topic"];
	$stort_detail = $_POST["short_detail"];
	$detail = $_POST["detail"];
	$news_status = $_POST["news_status"];
	$cate_id = $_POST["cate_id"];
	$new_image_name = "";

	$sql->table="tbl_news";
	$sql->field="cate_id,topic,short_detail,detail,create_date,news_status";
	$sql->value="'$cate_id','$topic','$stort_detail','$detail',NOW(),'$news_status'";
	if($sql->insert())
	{
		$news_id = mysqli_insert_id($sql->connect);

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
				$sql->value="'$news_id','$new_image_name'";
				$sql->insert();
			}
		}

		$alert = "เพิ่มข้อมูล ข่าวสารประชาสัมพันธ์ เรียบร้อยแล้ว";
		$location = "index.php?page=$page&wid=$wid";
	}
	else
	{
		$alert = "ไม่สามารถเพิ่มข้อมูลข่าวสารประชาสัมพันธ์ได้ กรุณาลองใหม่อีกครั้ง";
		$location = "add.php?page=$page&wid=$wid";
	}
}
else
{
	$location = "index.php?page=$page&wid=$wid";
}
require("../../class/JsControl.php");
?>