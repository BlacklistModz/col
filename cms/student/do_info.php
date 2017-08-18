<?php 
include("../../class/session_check.php");

$page = $_GET["page"];

if(isset($_POST["checkStuEdit"]) and $_POST["checkStuEdit"] == "1")
{
	//------------- Tab 1 --------------
	$id = $_POST["id"];
	$name = $_POST["name_th"];
	$name_en = $_POST["name_en"];
	$major = $_POST["major"];
	$faculty = $_POST["faculty"];
	$gpa = $_POST["gpa"];
	$gender = $_POST["gender"];
	$birthplace = $_POST["birthplace"];
	$birthdate = DateInSQL($_POST["birthdate"]);
	$height = $_POST["height"];
	$weight = $_POST["weight"];
	$id_card = $_POST["id_card"];
	$date_issued = DateInSQL($_POST["date_issued"]);
	$expiry_date = DateInSQL($_POST["expiry_date"]);
	$issued_at = $_POST["issued_at"];
	$religion = $_POST["religion"];
	$nationality = $_POST["nationality"];
	$driving_license = $_POST["driving_license"];
	$expiry_driving = DateInSQL($_POST["expiry_driving"]);
	$conscription = $_POST["conscription"];

	//------------- Tab 2 --------------
	$father_name = $_POST["father_name"];
	$father_career = $_POST["father_career"];
	$father_workplace = $_POST["father_workplace"];
	$father_phone = $_POST["father_phone"];
	$mother_name = $_POST["mother_name"];
	$mother_career = $_POST["mother_career"];
	$mother_workplace = $_POST["mother_workplace"];
	$mother_phone = $_POST["mother_phone"];
	$parent_address = $_POST["parent_address"];
	$parent_phone = $_POST["parent_phone"];
	$permanent_address = $_POST["permanent_address"];
	$permanent_phone = $_POST["permanent_phone"];
	
	if(isset($_POST["cloneDataAds"]) and $_POST["cloneDataAds"] == "1")
	{
		$contact_address = "";
		$contact_phone = "";
	}
	else
	{
		$contact_address = $_POST["contact_address"];
		$contact_phone = $_POST["contact_phone"];
	}

	$mobile_phone = $_POST["mobile_phone"];
	$email = $_POST["email"];
	$emer_name = $_POST["emer_name"];
	$emer_address = $_POST["emer_address"];
	$emer_phone = $_POST["emer_phone"];

	//--------------- Value Hidden --------------
	$update_user = $_POST["update_user"];

	$sql->table="tbl_authentication";
	$sql->value="name='$name'";
	$sql->condition="WHERE id='$update_user'";
	$sql->update();

	$sql->table="tbl_student";
	$sql->value="name_en='$name_en',major='$major',faculty='$faculty',gpa='$gpa',gender='$gender',birthplace='$birthplace',birthdate='$birthdate',height='$height',weight='$weight',id_card='$id_card',date_issued='$date_issued',expiry_date='$expiry_date',issued_at='$issued_at',religion='$religion',nationality='$nationality',driving_license='$driving_license',expiry_driving='$expiry_driving',conscription='$conscription',father_name='$father_name',father_career='$father_career',father_workplace='$father_workplace',father_phone='$father_phone',mother_name='$mother_name',mother_career='$mother_career',mother_workplace='$mother_workplace',mother_phone='$mother_phone',parent_address='$parent_address',parent_phone='$parent_phone',permanent_address='$permanent_address',permanent_phone='$permanent_phone',contact_address='$contact_address',contact_phone='$contact_phone',mobile_phone='$mobile_phone',email='$email',emer_name='$emer_name',emer_address='$emer_address',emer_phone='$emer_phone',update_date=NOW(),user_update='$update_user'";
	$sql->condition="WHERE id='$id'";
	if($sql->update())
	{
		//------------------------- Education Manage ---------------------------//
		$sql->table="tbl_stu_edu";
		$sql->condition="WHERE stu_id='$id'";
		$sql->delete();
		for($j=0;$j<count($_POST["edu_academy"]);$j++)
		{
			$sql->table="tbl_stu_edu";
			$sql->field="stu_id,edu_id,edu_academy,edu_major,edu_level,edu_start,edu_end,edu_grade";
			$sql->value="'$id','".$_POST["edu_id"][$j]."','".$_POST["edu_academy"][$j]."','".$_POST["edu_major"][$j]."','".$_POST["edu_level"][$j]."','".$_POST["edu_start"][$j]."','".$_POST["edu_end"][$j]."','".$_POST["edu_grade"][$j]."'";
			$sql->insert();
		}

		//------------------------- Training Manage ---------------------------//
		$sql->table="tbl_training";
		$sql->condition="WHERE stu_id='$id'";
		$sql->delete();
		for($i=0;$i<=count($_POST["training_topics"]);$i++)
		{ 
			if(!empty($_POST["training_topics"][$i]))
			{
				$sql->table="tbl_training";
				$sql->field="stu_id,training_topics,training_agency,training_duration";
				$sql->value="'$id','".$_POST["training_topics"][$i]."','".$_POST["training_agency"][$i]."','".$_POST["training_duration"][$i]."'";
				$sql->insert();
			}
		}
		//----------------------------------------------------------------------//
		
		//--------------------------- Skill Manage ----------------------------//
		$sql->table="tbl_stu_skill";
		$sql->condition="WHERE stu_id='$id'";
		$sql->delete();
		for($x=0;$x<count($_POST["sub_id"]);$x++)
		{
			$sql->table="tbl_stu_skill";
			$sql->field="stu_id,sub_id,skill_point";
			$sql->value="'$id','".$_POST["sub_id"][$x]."','".$_POST["sub_point"][$x]."'";
			$sql->insert();
		}
		//----------------------------------------------------------------------//
		
		//---------------------------- EXP Manage -------------------------------//
		$sql->table="tbl_stu_exp";
		$sql->condition="WHERE stu_id='$id'";
		$sql->delete();
		for($z=0;$z<=count($_POST["exp_topics"]);$z++)
		{
			if(!empty($_POST["exp_topics"][$z]))
			{
				$exp_year = DateInSQL($_POST["exp_year"][$z]);
				$sql->table="tbl_stu_exp";
				$sql->field="stu_id,exp_topics,exp_duration,exp_responsibility,exp_award,exp_agency,exp_year,exp_note";
				$sql->value="'$id','".$_POST["exp_topics"][$z]."','".$_POST["exp_duration"][$z]."','".$_POST["exp_responsibility"][$z]."','".$_POST["exp_award"][$z]."','".$_POST["exp_agency"][$z]."','".$exp_year."','".$_POST["exp_note"][$z]."'";
				$sql->insert();
			}
		}
		//-----------------------------------------------------------------------//

		$alert = "ปรับปรุงข้อมูลใบสมัครของนักศึกษา $name เรียบร้อยแล้ว";
		$location = "index.php?page=$page";
	}
	else
	{
		$alert = "ไม่สามารถบันทึกใบสมัครของนักศึกษาได้ กรุณาลองใหม่อีกครั้ง";
		$location = "student_info.php?page=$page&id=$update_user";
	}
}
else
{
	$location = "index.php?page=$page";
}

require("class/JsControl.php");
?>