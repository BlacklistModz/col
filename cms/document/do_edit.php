<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if(isset($_POST["checkSubmit"]) and $_POST["checkSubmit"] == "1")
{
	$id = $_POST["id"];
	$doc_name = trim($_POST["doc_name"]);
	$doc_date = $_POST["doc_date"];
	$doc_status = $_POST["doc_status"];

	$sql->table="tbl_document";
	$sql->condition="WHERE id='$id'";
	$query = $sql->select();
	$result = mysqli_fetch_assoc($query);

	if($_FILES["doc_file"]["name"] != "")
	{
		$namedoc = $_FILES["doc_file"]["name"];
		$type = strrchr($namedoc,".");
		$new_doc_name = 'Doc_'.date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
		move_uploaded_file($_FILES["doc_file"]["tmp_name"], "../../upload/doc/".$new_doc_name);
		@unlink("../../upload/doc/".$result["doc_file"]);
	}
	else
	{
		$new_doc_name = $result["doc_file"];
	}

	$sql->table="tbl_document";
	$sql->value="doc_name='$doc_name',doc_date='$doc_date',doc_file='$new_doc_name',upload_date=NOW(),doc_status='$doc_status'";
	$sql->condition="WHERE id='$id'";
	if($sql->update())
	{
		$alert = "แก้ไขเอกสาร $doc_name ศึกษาเรียบร้อยแล้ว";
		$location = "index.php?page=$page";
	}
	else
	{
		$alert = "ไม่สามารถเแก้ไขเอกสาร $doc_name ได้ กรุณาลองใหม่อีกครั้ง";
		$location = "edit.php?page=$page&id=$id";
	}
}
else
{
	$location = "index.php?page=$page";
}

require("../../class/JsControl.php");
?>