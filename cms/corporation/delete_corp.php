<?php 
include("../../class/session_check.php");

$sql = new SQLiManager();

$id = mysqli_real_escape_string($sql->connect,$_GET["corp_id"]);

$page = $_GET["page"];

$sql->table="tbl_corporation INNER JOIN tbl_authentication ON tbl_corporation.user_id = tbl_authentication.id";
$sql->condition="WHERE tbl_corporation.user_id='$id'";
$sql->field="tbl_corporation.id AS corp_id,tbl_authentication.picture AS picture,tbl_corporation.name_th AS name_th";
$query = $sql->select();
$numRow = mysqli_num_rows($query);
if($numRow == 1)
{
	$result = mysqli_fetch_assoc($query);
	$corp_name = $result["name_th"];
	@unlink("../../upload/profile/".$result["picture"]);

	$sql->table="tbl_authentication";
	$sql->condition="WHERE id='$id'";
	$sql->delete();

	$sql->table="tbl_corporation";
	$sql->field="*";
	$sql->condition="WHERE user_id='$id'";
	while($resultCorp = mysqli_fetch_assoc($sql->select()))
	{
		$sql->table="tbl_corp_welfare";
		$sql->condition="WHERE corp_id='".$resultCorp["id"]."'";
		$sql->delete();

		$sql->table="tbl_position";
		$sql->condition="WHERE corp_id='".$resultCorp["id"]."'";
		$resultPos = mysqli_fetch_assoc($sql->select());
		$sql->delete();

		$sql->table="tbl_stu_job";
		$sql->condition="WHERE pos_id='".$resultPos["id"]."'";
		$sql->delete();

		$sql->table="tbl_corporation";
		$sql->condition="WHERE id='".$resultCorp["id"]."'";
		$sql->delete();
	}

	$alert = "ลบสถานประกอบการ $corp_name เรียบร้อยแล้ว";
	$location = "index.php?page=$page";
}
else
{
	$alert = "ไม่สามารถลบรายการที่เลือกได้ กรุณาลองใหม่อีกครั้ง";
	$location = "index.php?page=$page";
}

require("../../class/JsControl.php");
?>