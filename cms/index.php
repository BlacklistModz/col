<?php
ob_start();
session_start();
include("../class/SQLiManager.php");
include("../class/IP_login.php");

$sql = new SQLiManager();

if(!empty($_SESSION["user_id"]))
{
	$sql->table="tbl_authentication";
	$sql->condition="WHERE id='".$_SESSION["user_id"]."' and status_id='1'";
	$queryCheck = $sql->select();
	$numCheck = mysqli_num_rows($queryCheck);
	if($numCheck)
	{
		header("location:corporation/index.php?page=corporation");
	}
	else
	{
		echo "<script type='text/javascript'>window.history.back();</script>";
	}
}

if(isset($_POST["checkLogin"]) and $_POST["checkLogin"] == "1")
{
	$username = mysqli_real_escape_string($sql->connect,$_POST["username"]);
	$password = mysqli_real_escape_string($sql->connect,$_POST["password"]);

	$ip = get_client_ip();

	$sql->table="tbl_authentication";
	$sql->condition="WHERE username='$username' and password='$password' and status_id='1'";
	$queryLogin = $sql->select();
	$numLoing = mysqli_num_rows($queryLogin);

	if($numLoing == 1)
	{
		$result = mysqli_fetch_assoc($queryLogin);
		$_SESSION["login_date"] = $result["last_login"];

		$sql->value="last_login=NOW(),ip_login='$ip'";
		$sql->update();

		$_SESSION["user_id"] = $result["id"];
		$name = $result["name"];
		$msgSuccessLoginCMS = "$name";
		$localSetTimeout = "corporation/index.php?page=corporation";
	}
	else
	{
		$msgErrorLoginCMS = "กรุณาตรวจสอบ! ชื่อผู้ใช้ และ รหัสผ่าน ของคุณ";
		$localSetTimeout = "index.php";
	}
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
	<meta charset="utf-8">
	<meta name="theme-color" content="#fe6711" />
	<meta name="msapplication-navbutton-color" content="#fe6711">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<title>ระบบจัดการ สหกิจศึกษา</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" href="../img/favicon.png">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	<style type="text/css">
		* {
			-ms-box-sizing: border-box;
			-moz-box-sizing: border-box;
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
			margin: 0;
			padding: 0;
			border: 0;
		}

		html,
		body {
			width: 100%;
			height: 100%;
			font-family: 'Open Sans', sans-serif;
			font-weight: 200;
			background-color: #ecf0f5;
		}

		.login {
			position: relative;
			top: 50%;
			width: 280px;
			display: table;
			margin: -150px auto 0 auto;
			background: #fff;
			border-radius: 4px;
		}

		.legend {
			position: relative;
			width: 100%;
			display: block;
			background: #fe6711;
			padding: 15px;
			color: #fff;
			font-size: 20px;
		}

		.legend:after {
			content: "";
			background-image: url(../img/multy-user.png);
			background-size: 80px 80px;
			background-repeat: no-repeat;
			background-position: 200px 0px;
			opacity: 0.06;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			position: absolute;
		}

		.input {
			position: relative;
			width: 90%;
			margin: 15px auto;
		}

		.input span {
			position: absolute;
			display: block;
			color: #d4d4d4;
			left: 10px;
			top: 4px;
			font-size: 20px;
		}

		.input input {
			width: 100%;
			padding: 10px 5px 10px 40px;
			display: block;
			border: 1px solid #EDEDED;
			transition: 0.2s ease-out;
			/*color: #a1a1a1;*/
			color: #fe6711;
		}

		.input input:focus {
			padding: 10px 5px 10px 10px;
			outline: 0;
			border-color: #fe6711;
		}

		.submit {
			width: 45px;
			height: 45px;
			display: block;
			margin: 0 auto -15px auto;
			background: #fff;
			border-radius: 100%;
			border: 1px solid #fe6711;
			color: #fe6711;
			font-size: 24px;
			cursor: pointer;
			box-shadow: 0px 0px 0px 7px #fff;
			transition: 0.2s ease-out;
		}

		.submit:hover,
		.submit:focus {
			background: #fe6711;
			color: #fff;
			outline: 0;
		}
		.set-center {
			width: 100%;
		}
		.contain {
			padding-right: 15px;
			padding-left: 15px;
			margin-right: auto;
			margin-left: auto;
		}
	</style>
</head>

<body>
	<form class="login" method="POST">
		<div class="legend">CMS Login</div>
		<div class="input">
			<input name="username" type="text" placeholder="Username" required />
			<span><i class="fa fa-user"></i></span>
		</div>
		<div class="input">
			<input name="password" type="password" placeholder="Password" required />
			<span><i class="fa fa-lock"></i></span>
		</div>
		<button type="submit" class="submit"><i class="fa fa-sign-in"></i></button>
		<input type="hidden" name="checkLogin" value="1">
	</form>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/sweetalert.min.js"></script>
	<script >
		$(".input").focusin(function() {
			$(this).find("span").animate({
				"opacity": "0"
			}, 200);
		});
		$(".input").focusout(function() {
			$(this).find("span").animate({
				"opacity": "1"
			}, 300);
		});
	</script>
	<?php require("../class/JsControl.php"); ?>
</body>

</html>
