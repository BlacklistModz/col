<?php
header("Content-type: text/html; charset=utf-8");
session_start();
include("class/SQLiManager.php");

$sql = new SQLiManager();

if(isset($_POST["checkProfile"]) and $_POST["checkProfile"] == "1")
{
	$pro_id = $_POST["id"];
	$name = $_POST["name"];

	$password_old = mysqli_real_escape_string($sql->connect,(trim($_POST["password_old"])));
	$password = mysqli_real_escape_string($sql->connect,(trim($_POST["password"])));

	$sql->table="tbl_authentication";
	$sql->condition="WHERE id='$pro_id' and password='$password_old'";
	$CheckPass = mysqli_num_rows($sql->select());
	if($CheckPass <= 0)
	{
		echo "2";
		exit();
	}

	$sql->table="tbl_authentication";
	$sql->condition="WHERE id='$pro_id'";
	$result = mysqli_fetch_assoc($sql->select());

	$new_image_name = $result["picture"];

	if(!empty($_FILES["picture"]["name"]))
	{	
		$nameimg = $_FILES["picture"]["name"];
		$type = strrchr($nameimg,".");
		$new_image_name = 'Profile_'.date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
		move_uploaded_file($_FILES["picture"]["tmp_name"], "upload/profile/".$new_image_name);

		@unlink("upload/profile/".$result["picture"]);
	}

	$sql->table="tbl_authentication";
	$sql->value="name='$name',picture='$new_image_name'";
	$sql->condition="WHERE id={$pro_id}";
	if( $sql->update() ){

		#Change Password
		if( !empty($password) ){
			$sql->table="tbl_authentication";
			$sql->value="password='$password'";
			$sql->condition="WHERE id='$pro_id'";
			if ($sql->update())
			{
				echo "1";
			}
			else
			{
				echo "3";
			}
		}
		else{
			echo "1";
		}
	}
	else{
		echo "3";
	}
}
?>