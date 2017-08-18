<?php
include("class/IP_login.php");
if(isset($_POST["checkLogin"]) and $_POST["checkLogin"] == "1")
{
	$username = mysqli_real_escape_string($sql->connect,$_POST["username"]);
	$password = mysqli_real_escape_string($sql->connect,$_POST["password"]);

	$ip = get_client_ip();

	$sql->table="tbl_authentication";
	$sql->condition="WHERE username='$username' and password='$password'";
	$queryLogin = $sql->select();
	$numLoing = mysqli_num_rows($queryLogin);

	if($numLoing == 1)
	{
		$result = mysqli_fetch_assoc($queryLogin);
		if($result["status_id"] == "0") 
		{
			$msgErrorStatus = "สถานประกอบการของท่าน ยังไม่ได้รับการยืนยัน \\n กรุณาติดต่อสาขาวิชาวิศวกรรมซอต์แวร์ \\n หรือโทร 054-237399 ต่อ (6000)";
		}
		else
		{
			$_SESSION["login_date"] = $result["last_login"];
			$sql->value="last_login=NOW(),ip_login='$ip'";
			$sql->update();

			$name = $result["name"];

			$sql->table="tbl_year";
			$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
			$resultYear = mysqli_fetch_assoc($sql->select());

			if($result["status_id"] == "3" and $result["accept_year_id"] != $resultYear["id"])
			{
				$msgErrorStatus = "สถานประกอบการของท่าน ยังไม่ได้รับการยืนยันในปีการศึกษา {$resultYear["academic_year"]} \\n กรุณาติดต่อสาขาวิชาวิศวกรรมซอต์แวร์ \\n หรือโทร 054-237399 ต่อ (6000)";
			}
			else 
			{
				$_SESSION["user_id"] = $result["id"];
				$_SESSION["user_status"] = $result["status_id"];
				$msgSuccessLogin = "$name";
				$localSetTimeout = "$redirect";
			}
		}
	}
	else
	{
		$msgErrorLogin = "กรุณาตรวจสอบ! ชื่อผู้ใช้ และ รหัสผ่าน ของคุณ";
	}
}
?>
<div class="modal modal-log fade-scale" id="loginModal" role="dialog">
	<div class="modal-dialog modal-dialog-log">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #eea236;color: white !important;text-align: center;font-size: 1.1em;padding: 35px 50px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<i class="fa fa-lock" aria-hidden="true"></i> ตรวจสอบสิทธิ์ผู้ใช้
			</div>
			<div class="modal-body" style="padding: 40px 50px;">
				<form role="form" method="POST">
					<div class="form-group">
						<label><i class="fa fa-user" aria-hidden="true"></i> ชื่อผู้ใช้</label>
						<input type="text" class="form-control" name="username" placeholder="กรุณากรอกชื่อผู้ใช้" required>
					</div>
					<div class="form-group">
						<label><i class="fa fa-unlock" aria-hidden="true"></i> รหัสผ่าน</label>
						<input type="password" class="form-control" name="password" placeholder="กรุณากรอกรหัสผ่าน" required>
					</div>
					<input type="hidden" name="checkLogin" value="1">
					<button type="submit" class="btn btn-warning btn-block"><i class="fa fa-power-off" aria-hidden="true"></i> ล็อคอิน</button>
				</form>
			</div>
			<div class="modal-footer" style="background-color: #f9f9f9;padding: 0px 40px;margin: 10px 0 10px;">
				<p class="gg">สำหรับสถานประกอบการ <a class="wp" href="register.php?page=company">สมัครสมาชิก</a></p>
			</div>
		</div>
	</div>
</div>