<?php
ini_set('max_execution_time', 999999);
ini_set('memory_limit', '-1');
ob_start();
session_start();
include("class/SQLiManager.php");
require_once("plugin/mpdf/mpdf.php");
include("class/DateThai.php");

$sql = new SQLiManager();
if(isset($_SESSION["user_id"]) and $_SESSION["user_id"] != "")
{
  $user_id = $_SESSION["user_id"];
  $sql->table="tbl_authentication";
  $sql->condition="WHERE id='$user_id'";
  $querySession = $sql->select();
  $numSession = mysqli_num_rows($querySession);
  if($numSession != "1")
  {
    $location = "class/session_clear.php";
  }
  $resultUser = mysqli_fetch_assoc($querySession);
}

$month=array("1"=>"มกราคม", "2"=>"กุมภาพันธ์", "3"=>"มีนาคม", "4"=>"เมษายน", "5"=>"พฤษภาคม", "6"=>"มิถุนายน", "7"=>"กรกฎาคม", "8"=>"สิงหาคม", "9"=>"กันยายน", "10"=>"ตุลาคม", "11"=>"พฤศจิกายน", "12"=>"ธันวาคม");

$id = $_GET["id"];
$pos_id = $_GET["pos_id"];

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$id'";
$queryReg = $sql->select();
$resultReg = mysqli_fetch_assoc($queryReg);

$sql->table="tbl_student";
$sql->condition="WHERE user_id='$id'";
$queryStudent = $sql->select();
$resultStudent = mysqli_fetch_assoc($queryStudent);

$sql->table="tbl_position";
$sql->condition="WHERE id='$pos_id'";
$queryPosition = $sql->select();
$resultPosition = mysqli_fetch_assoc($queryPosition);

$sql->table="tbl_corporation";
$sql->condition="WHERE id='".$resultPosition["corp_id"]."'";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>

<!-- <div style="font-size: 18px; text-align: center;"><b>ใบสมัครงานสหกิจศึกษา</b></div>
<div style="font-size: 18px; margin-top: 5px; text-align: center;"><b>มหาวิทยาลัยราชภัฏลําปาง</b></div>

<img src="img/lpru.png" style="height: 100px;"> -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><font size="6"><b>ใบสมัครงานสหกิจศึกษา</b></font></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td rowspan="3"><img src="img/lpru.png" style="height: 120px;">
      </td>
      <td align="center"><font size="6"><b>มหาวิทยาลัยราชภัฏลําปาง</b></font></td>
      <td rowspan="3"><img src="upload/profile/<?php echo $resultReg["picture"]; ?>" style="height: 110px; width: 100px">
      </td>
    </tr>
    <tr>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="5"><b>ชื่อสถานประกอบการ</b>&nbsp;&nbsp;&nbsp;&nbsp;<i><?php echo $resultCorp["name_th"]; ?></i>&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
    </tr>
    <tr>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="5"><b>ระยะเวลาปฏิบัติงานตั้งแต่เดือน</b>&nbsp;&nbsp;&nbsp;&nbsp;<i><?php for($i=1;$i<=count($month);$i++){if($resultCorp["practice_start"] == $i) {echo $month[$i];}} ?>&nbsp;&nbsp;&nbsp;&nbsp;</i><b>ถึงเดือน</b>&nbsp;&nbsp;&nbsp;&nbsp;<i><?php for($i=1;$i<=count($month);$i++){if($resultCorp["practice_end"] == $i) {echo $month[$i];}} ?></i>&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
    </tr>
  </tbody>
</table>

<div style="font-size: 18px; background-color: silver;padding: 10px 5px 5px 5px;margin: 10px 0 8px 0px;width: 335px;"><b>ข้อมูลส่วนตัวของนักศึกษา Personal Data </b></div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4"><b>ชื่อ-สกุล</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultReg["name"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4"><b>รหัสประจำตัว</b>&nbsp;&nbsp;<?php echo $resultReg["username"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4"><b>ชั้นปีที่</b>&nbsp;&nbsp;<?php echo $resultReg["status_id"]; ?></font></td>
    </tr>
    <tr>
      <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4"><b>ชื่อภาษาอังกฤษ</b>&nbsp;&nbsp;<?php echo $resultStudent["name_en"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4"><b>สาขาวิชา</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultStudent["major"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4"><b>คณะ</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultStudent["faculty"]; ?></font></td>
    </tr>
    <tr>
      <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4"><b>เกรดเฉลี่ยสะสม</b>&nbsp;&nbsp;<?php echo $resultStudent["gpa"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4"><b>เพศ</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php if ($resultStudent["gender"] == "M") {echo "ชาย";} else {echo "หญิง";}?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4"><b>สถานที่เกิด</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultStudent["birthplace"]; ?></font></td>
    </tr>
    <tr>
      <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">วันที่เกิด&nbsp;&nbsp;&nbsp;&nbsp;<?php echo DateThai($resultStudent["birthdate"]); ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">ส่วนสูง&nbsp;&nbsp;<?php echo $resultStudent["height"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">น้ำหนัก&nbsp;&nbsp;<?php echo $resultStudent["weight"]; ?></font></td>
    </tr>
    <tr>
      <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">เลขที่บัตรประชาชน&nbsp;&nbsp;<?php echo $resultStudent["id_card"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">วันที่ออกบัตร&nbsp;&nbsp;&nbsp;&nbsp;<?php echo DateThai($resultStudent["date_issued"]); ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">วันหมดอายุ&nbsp;&nbsp;&nbsp;&nbsp;<?php echo DateThai($resultStudent["expiry_date"]); ?></font></td>
    </tr>
    <tr>
      <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">สถานที่ออกบัตร&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultStudent["issued_at"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">ศาสนา&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultStudent["religion"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">สัญชาติ&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultStudent["nationality"]; ?></font></td>
    </tr>
    <tr>
      <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">ใบอนุญาตรถยนต์เลขที่&nbsp;&nbsp;<?php echo $resultStudent["driving_license"]; ?></font></td>
      <td colspan="2" style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">วันหมดอายุ&nbsp;&nbsp;&nbsp;&nbsp;<?php echo DateThai($resultStudent["expiry_driving"]); ?></font></td>
    </tr>
    <tr>
      <td colspan="3" height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">การเกณฑ์ทหาร&nbsp;&nbsp;&nbsp;&nbsp;<?php if ($resultStudent["conscription"] == 1) {echo "ผ่านการเกณฑ์แล้ว";} if ($resultStudent["conscription"] == 2) {echo "ยังไม่ได้เกณฑ์ / อยู่ในระหว่างการขอผ่อนผัน";} if ($resultStudent["conscription"] == 3) {echo "ได้รับการยกเว้น";}?></font></td>
    </tr>
  </tbody>
</table>

<div style="font-size: 18px; background-color: silver;padding: 10px 5px 5px 5px;margin: 10px 0 8px 0px;width: 300px;"><b>ข้อมูลเกี่ยวกับครอบครัว Family Data </b></div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">ชื่อบิดา&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultStudent["father_name"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">อาชีพ&nbsp;&nbsp;<?php echo $resultStudent["father_career"]; ?></font></td>
    </tr>
    <tr>
      <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">ที่ทำงาน&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultStudent["father_workplace"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">โทรศัพท์&nbsp;&nbsp;<?php echo $resultStudent["father_phone"]; ?></font></td>
    </tr>
    <tr>
      <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">ชื่อมารดา&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultStudent["mother_name"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">อาชีพ&nbsp;&nbsp;<?php echo $resultStudent["mother_career"]; ?></font></td>
    </tr>
    <tr>
      <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">ที่ทำงาน&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultStudent["mother_workplace"]; ?></font></td>
      <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">โทรศัพท์&nbsp;&nbsp;<?php echo $resultStudent["mother_phone"]; ?></font></td>
    </tr>
    <tr>
      <td colspan="2" height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">ที่อยู่บิดา / มารดา&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $resultStudent["parent_address"]; ?></font></td>
    </tr>
    <tr>
      <td colspan="2" height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">โทรศัพท์&nbsp;&nbsp;<?php echo $resultStudent["parent_phone"]; ?></font></td>
    </tr>
  </tbody>
</table>

<div style="font-size: 18px; background-color: silver;padding: 10px 5px 5px 5px;margin: 10px 0 8px 0px;width: 155px;"><b>ที่อยู่อาศัย Address </b></div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td colspan="3" height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">ที่อยู่ตามทะเบียนบ้าน&nbsp;&nbsp;&nbsp;&nbsp;<?php if (!empty($resultStudent["permanent_address"])) {echo $resultStudent["permanent_address"];} else {echo $resultStudent["parent_address"];} ?></font></td>
    </tr>
    <tr>
      <td colspan="3" height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">โทรศัพท์&nbsp;&nbsp;<?php if (!empty($resultStudent["permanent_phone"])) {echo $resultStudent["permanent_phone"];} else {echo $resultStudent["parent_phone"];} ?></font></td>
    </tr>
    <tr>
      <td colspan="3" height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">ที่อยู่ที่ติดต่อได้&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
        if (!empty($resultStudent["contact_address"]))
        {
          echo $resultStudent["contact_address"];
        }
        else
        {
          echo $resultStudent["permanent_address"];
        }
        ?></font></td>
      </tr>
      <tr>
        <td height="25" style="text-overflow: ellipsis; white-space: nowrap;padding-left: 5px;"><font size="4">โทรศัพท์&nbsp;&nbsp;<?php if(!empty($resultStudent["contact_phone"])) {echo $resultStudent["contact_phone"];} else {echo $resultStudent["permanent_phone"];} ?></font></td>
        <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">มือถือ&nbsp;&nbsp;<?php echo $resultStudent["mobile_phone"]; ?></font></td>
        <td style="text-overflow: ellipsis; white-space: nowrap;"><font size="4">อีเมล์&nbsp;&nbsp;<?php echo $resultStudent["email"]; ?></font></td>
      </tr>
    </tbody>
  </table>

  <div style="font-size: 18px; background-color: silver;padding: 10px 5px 5px 5px;margin: 10px 0 8px 0px;width: 545px;"><b>บุคคลที่ติดต่อได้เวลาฉุกเฉิน In Case of Emergency Please Contact</b></div>

  <?php
  $html = ob_get_contents(); 
  ob_end_clean();
  $pdf = new mPDF("th", "A4", "0", "THSarabanNew");
  // $pdf->SetAutoFont();
  $pdf->SetDisplayMode("fullpage");
  $pdf->WriteHTML($html, 2);
  $pdf->Output();
  ?>
</body>
</html>