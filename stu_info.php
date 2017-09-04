<?php 
header('Content-type: text/html; charset=utf-8');
include("class/SQLiManager.php");
include("class/DateSwitch.Bootstrap.php");

$sql = new SQLiManager();

if(isset($_POST["checkStuEdit"]) and $_POST["checkStuEdit"] == "1")
{
	$value = "";

	foreach ($_POST as $key => $item) {
		if( $key == "stu_id" || $key == "id" || $key == "checkStuEdit" || $key == "cloneDataParent" || $key == "cloneDataAds" || $key == "check_address" || $key == "emer_name" || $key == "emer_address" || $key == "emer_phone" || $key == "name_th" || $key == "edu_id" || $key == "edu_academy" || $key == "edu_major" || $key == "edu_level" || $key == "edu_start" || $key == "edu_end" || $key == "edu_grade" || $key == "sub_point" || $key == "sub_id" ) continue;

		if( $key == "birthdate" ) $item = DateInSQL($item);

		$value .= !empty($value) ? "," : "";
		$value .= "{$key}='{$item}'";
	}

	//------------- Tab 1 --------------
	/* $id = $_POST["id"];
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
	// $permanent_address = $_POST["permanent_address"];
	// $permanent_phone = $_POST["permanent_phone"]; */
	
	if( empty($_POST["cloneDataParent"]) ){
		$value .= ",permanent_address='{$_POST["permanent_address"]}'";
		$value .= ",permanent_phone='{$_POST["permanent_phone"]}'";
	}

	if( empty($_POST["cloneDataAds"]) ){
		$value .= ",contact_address='{$_POST["contact_address"]}'";
		$value .= ",contact_phone='{$_POST["contact_phone"]}'";
	}

	if( !empty($_POST["check_address"]) ){
		$value .= ",check_address='{$_POST["check_address"]}'";
	}
	else{
		$value .= ",emer_name='{$_POST["emer_name"]}'";
		$value .= ",emer_address='{$_POST["emer_address"]}'";
		$value .= ",emer_phone='{$_POST["emer_phone"]}'";
	}

	$value .= ",update_date=NOW()";
	

	/* $mobile_phone = $_POST["mobile_phone"];
	$email = $_POST["email"]; */

	// $emer_name = $_POST["emer_name"];
	// $emer_address = $_POST["emer_address"];
	// $emer_phone = $_POST["emer_phone"];

	//--------------- Value Hidden --------------
	/* $update_user = $_POST["update_user"]; */

	$sql->table="tbl_authentication";
	$sql->value="name='{$_POST["name_th"]}'";
	$sql->condition="WHERE id='{$_POST["mobile_phone"]}'";
	$sql->update();

	$sql->table="tbl_student";
	$sql->value=$value;
	$sql->condition="WHERE id='{$_POST["id"]}'";
	if($sql->update())
	{
		//------------------------- Education Manage ---------------------------//
		$sql->table="tbl_stu_edu";
		$sql->condition="WHERE stu_id='{$_POST["id"]}'";
		$sql->delete();
		for($j=0;$j<count($_POST["edu_academy"]);$j++)
		{
			$sql->table="tbl_stu_edu";
			$sql->field="stu_id,edu_id,edu_academy,edu_major,edu_level,edu_start,edu_end,edu_grade";
			$sql->value="'{$_POST["id"]}','".$_POST["edu_id"][$j]."','".$_POST["edu_academy"][$j]."','".$_POST["edu_major"][$j]."','".$_POST["edu_level"][$j]."','".$_POST["edu_start"][$j]."','".$_POST["edu_end"][$j]."','".$_POST["edu_grade"][$j]."'";
			$sql->insert();
		}

		//------------------------- Training Manage ---------------------------//
		/* $sql->table="tbl_training";
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
		} */
		//----------------------------------------------------------------------//
		
		//--------------------------- Skill Manage ----------------------------//
		$sql->table="tbl_stu_skill";
		$sql->condition="WHERE stu_id='{$_POST["id"]}'";
		$sql->delete();
		for($x=0;$x<count($_POST["sub_id"]);$x++)
		{
			$sql->table="tbl_stu_skill";
			$sql->field="stu_id,sub_id,skill_point";
			$sql->value="'{$_POST["id"]}','".$_POST["sub_id"][$x]."','".$_POST["sub_point"][$x]."'";
			$sql->insert();
		}
		//----------------------------------------------------------------------//
		
		//---------------------------- EXP Manage -------------------------------//
		/* $sql->table="tbl_stu_exp";
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
		} */
		//-----------------------------------------------------------------------//

		// $alert = "บันทึกข้อมูลใบสมัครของนักศึกษาเรียบร้อยแล้ว";
		// $location = "SE-CO-003.php?page=student&sub=coop_03";
		echo "1";
	}
	else
	{
		// $alert = "ไม่สามารถบันทึกใบสมัครของนักศึกษาได้ กรุณาลองใหม่อีกครั้ง";
		// $location = "SE-CO-003.php?page=student&sub=coop_03";
		echo "2";
	}
}
else
{
	$location = "index.php?page=home";
}

require("class/JsControl.php");
?>