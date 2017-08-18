<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$doc_name = trim($_POST["doc_name"]);
	$doc_date = $_POST["doc_date"];
	$doc_status = $_POST["doc_status"];

	$namedoc = $_FILES["doc_file"]["name"];
	$type = strrchr($namedoc,".");
	$new_doc_name = 'Doc_'.date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
	move_uploaded_file($_FILES["doc_file"]["tmp_name"], "../../upload/doc/".$new_doc_name);

	$sql->table="tbl_document";
	$sql->field="doc_name,doc_date,doc_file,upload_date,doc_status";
	$sql->value="'$doc_name','$doc_date','$new_doc_name',NOW(),'$doc_status'";
	if($sql->insert())
	{
		$alert = "เพิ่มเอกสาร $doc_name ศึกษาเรียบร้อยแล้ว";
		$location = "index.php?page=$page";
	}
	else
	{
		$alert = "ไม่สามารถเพิ่มเอกสาร $doc_name ได้ กรุณาลองใหม่อีกครั้ง";
		$location = "add.php?page=$page";
	}
}
else
{
	$location = "index.php?page=$page";
}

require("../../class/JsControl.php");
?>