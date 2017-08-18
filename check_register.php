<?php
header("Content-type: text/html; charset=utf-8");
session_start();
include("class/SQLiManager.php");
require("plugin/PHPMailer/PHPMailerAutoload.php");

$sql = new SQLiManager();

$mail = new PHPMailer();
$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->Debugoutput = "html";
$mail->SMTPSecure = "tls";
$mail->Host = "smtp.live.com";
$mail->Port = 587;
$mail->Username = "softengthai_lpru@hotmail.com";
$mail->Password = "softeng1234";

if(isset($_POST["checkRegister"]) and $_POST["checkRegister"] == "1")
{
	$corp_name = $_POST["corp_name"];
	$name = $_POST["name"];
	$username = mysqli_real_escape_string($sql->connect,strtolower(trim($_POST["username"])));
	$password = mysqli_real_escape_string($sql->connect,$_POST["password"]);
	$phone = $_POST["phone"];
	$fax = $_POST["fax"];
	$email = mysqli_real_escape_string($sql->connect,strtolower(trim($_POST["email"])));

	$sql->table="tbl_authentication";
	$sql->condition="WHERE username='$username'";
	$CheckUser = mysqli_num_rows($sql->select());
	if($CheckUser > 0)
	{
		echo "3";
		exit();
	}

	$sql->table="tbl_corporation";
	$sql->condition="WHERE email='$email'";
	$CheckEmail = mysqli_num_rows($sql->select());
	if($CheckEmail > 0)
	{
		echo "4";
		exit();
	}

	$new_image_name = "";

	if(isset($_FILES["picture"]["name"]))
	{	
		$nameimg = $_FILES["picture"]["name"];
		$type = strrchr($nameimg,".");
		$new_image_name = 'Profile_'.date('Y-m-d-H-i-s').'_'.uniqid('', true).$type;
		move_uploaded_file($_FILES["picture"]["tmp_name"], "upload/profile/".$new_image_name);
	}

	$sql->table="tbl_authentication";
	$sql->field="username,password,name,picture,create_date";
	$sql->value="'$username','$password','$name','$new_image_name',NOW()";
	if($sql->insert())
	{
		$user_id = mysqli_insert_id($sql->connect);
		$sql->table="tbl_corporation";
		$sql->field="name_th,phone,fax,user_id,email,session_id";
		$sql->value="'$corp_name','$phone','$fax','$user_id','$email','".session_id()."'";
		$sql->insert();

		$mail->SetFrom("softengthai_lpru@hotmail.com", "วิศวกรรมซอฟต์แวร์ มหาวิทยาลัยราชภัฏลำปาง");
		$mail->Subject = "ยินดีต้อนรับสู่สหกิจศึกษา สาขาวิชาวิศวกรรมซอฟต์แวร์ มหาวิทยาลัยราชภัฏลำปาง";
		$body = "สวัสดีสถานประกอบการ $corp_name <br/>";
		$body.= "----------------------------------<br/>";
		$body.= "คลิกลิงค์ด้านล่างเพื่อยืนยันการลงทะเบียน<br/>";
		$body.= "http://www.softengpro.96.lt/activate.php?sid=".session_id()."&uid=".$user_id."<br/>";
		$body.= "----------------------------------<br/>";
		$body.= "ด้วยความเคารพ, สาขาวิชาวิศวกรรมซอฟต์แวร์ คณะเทคโนโลยีอุตสาหกรรม มหาวิทยาลัยราชภัฏลำปาง<br/>";
		$body.= "โทร 054-237399 ต่อ (6000)";
		$mail->MsgHTML($body);
		$mail->AddAddress($email,$corp_name);

		if(!$mail->Send()) 
		{
			echo "2";
		}
		else
		{
			echo "1";
		}
	}
	else
	{
		echo "5";
	}
}
?>