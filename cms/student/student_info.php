<?php
include("../header.php");
include("../sidebar.php");
include("../../class/DateSwitch.Bootstrap.php");

$month=array("1"=>"มกราคม", "2"=>"กุมภาพันธ์", "3"=>"มีนาคม", "4"=>"เมษายน", "5"=>"พฤษภาคม", "6"=>"มิถุนายน", "7"=>"กรกฎาคม", "8"=>"สิงหาคม", "9"=>"กันยายน", "10"=>"ตุลาคม", "11"=>"พฤศจิกายน", "12"=>"ธันวาคม");

$id = $_GET["id"];

$sql->table="tbl_authentication";
$sql->condition="WHERE id={$id}";
$queryUser = $sql->select();
$resultUser = mysqli_fetch_assoc($queryUser);

$sql->table="tbl_student";
$sql->condition="WHERE user_id={$resultUser["id"]}";
$queryStudent = $sql->select();
$resultStudent = mysqli_fetch_assoc($queryStudent);
?>
<link rel="stylesheet" type="text/css" href="../../css/select2.min.css">
<link rel="stylesheet" type="text/css" href="../../css/select2-bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="../../css/form-group.css">
<link rel="stylesheet" type="text/css" href="../../css/cms-forminput.css">
<!-- <link rel="stylesheet" type="text/css" href="../../css/datepicker3.css"> -->
<link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="../../css/jquery-ui-timepicker-addon.css">
<style type="text/css">
	.input-group .select2-container--bootstrap {
		width: 100% !important;
	}
	@media screen and (max-width: 991px) {
		.select-mounth-bottom {
			margin-bottom: 15px;
		}
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo $resultUser["username"]; ?> - <?php echo $resultUser["name"]; ?>
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="index.php?page=<?php echo $_GET["page"]; ?>"><i class="fa fa-edit"></i>ข้อมูลใบสมัครนักศึกษา</a></li>
			<li class="active">แก้ไขข้อมูล </li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">แก้ไขข้อมูลใบสมัครนักศึกษา</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="ซ่อน" style="box-shadow: none">
								<i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="portlet light" id="form_wizard_1">
								<div class="portlet-body form">
									<form class="form-horizontal" action="do_info.php?page=<?php echo $_GET["page"]; ?>" id="submit_form" method="POST">
										<div class="form-wizard">
											<div class="form-wizard">
                            <div class="form-body">
                                <ul class="nav nav-pills nav-justified steps">
                                    <li>
                                        <a href="#tab1" data-toggle="tab" class="step">
                                            <span class="number"> 1 </span>
                                            <span class="desc"><i class="fa fa-check success-form-input"></i> ข้อมูลส่วนตัว </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab2" data-toggle="tab" class="step">
                                            <span class="number"> 2 </span>
                                            <span class="desc"><i class="fa fa-check success-form-input"></i> ข้อมูลครอบครัว </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab3" data-toggle="tab" class="step">
                                            <span class="number"> 3 </span>
                                            <span class="desc"><i class="fa fa-check success-form-input"></i> ประวัติการศึกษา </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab4" data-toggle="tab" class="step">
                                            <span class="number"> 4 </span>
                                            <span class="desc"><i class="fa fa-check success-form-input"></i> ตรวจสอบข้อมูล </span>
                                        </a>
                                    </li>
                                </ul>
                                <div id="bar" class="progress progress-striped" role="progressbar">
                                    <div class="progress-bar progress-bar-success"> </div>
                                </div>
                                <div class="tab-content">
                                    <div class="alert alert-danger display-none">
                                        <button class="close" data-dismiss="alert"></button> เกิดข้อผิดพลาดบางอย่าง กรุณาตรวจสอบด้านล่าง ! </div>
                                        <div class="tab-pane active" id="tab1">
                                            <h3 class="block headtext-set-center">ข้อมูลทั่วไปของนักศึกษา</h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">รหัสประจำตัว
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="form-read">
                                                        <input type="text" class="form-control" name="stu_id" value="<?php echo $resultUser["username"]; ?>" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ชื่อ-สกุล
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                <input type="text" class="form-control" name="name_th" value="<?php echo $resultUser["name"]; ?>" pattern="[ก-๙\s]+" title="กรุณากรอกชื่อภาษาไทย" placeholder="กรอกชื่อ-นามสกุล" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Name (Please Write in UPPERCASE LETTER)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="name_en" value="<?php echo $resultStudent["name_en"]; ?>" placeholder="กรอกชื่อ-นามสกุล เป็นภาษาอังกฤษ (ตัวพิมพ์ใหญ่เท่านั้น)" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ชั้นปี
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <select class="form-control" name="class_year">
                                                    <?php 
                                                    for($i=1; $i<=5; $i++){
                                                        $sel = "";
                                                        if( $i == $resultStudent["class_year"] ) $sel = ' selected="1"';
                                                        echo '<option'.$sel.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">คณะ
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $sql->table="tbl_faculty";
                                                    $sql->condition="";
                                                    $q_faculty = $sql->select();
                                                    ?>
                                                    <select name="faculty_id" class="form-control js-select-faculty" required>
                                                        <?php 
                                                        while($rs_faculty = mysqli_fetch_assoc($q_faculty)){
                                                            $sel = "";
                                                            if( $rs_faculty["faculty_id"] == $resultStudent["faculty_id"] ){
                                                                $sel = ' selected="1"';
                                                            }
                                                            echo '<option'.$sel.' value="'.$rs_faculty["faculty_id"].'">'.$rs_faculty["faculty_name"].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">สาขาวิชา
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                   <select name="major_id" class="form-control js-select-majors" required></select>
                                                   <input type="hidden" class="js-input-majors" value="<?=$resultStudent["major_id"]?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">เกรดเฉลี่ยสะสม
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="gpa" value="<?php echo $resultStudent["gpa"]; ?>" placeholder="เกรดเฉลี่ยปัจุจบัน" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">เพศ
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="md-radio-inline">
                                                        <div class="md-radio">
                                                            <input type="radio" id="radio1" name="gender" value="M" data-title="ชาย" class="md-radiobtn" <?php if($resultStudent["gender"] == "M") { echo "checked"; } ?> />
                                                            <label for="radio1">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> ชาย
                                                            </label>
                                                        </div>
                                                        <div class="md-radio">
                                                            <input type="radio" id="radio2" name="gender" value="F" data-title="หญิง" class="md-radiobtn" <?php if($resultStudent["gender"] == "F") { echo "checked"; } ?> />
                                                            <label for="radio2">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> หญิง
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="form_gender_error"> </div>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-4">สถานที่เกิด
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="birthplace" value="<?php echo $resultStudent["birthplace"]; ?>" placeholder="สถานที่เกิด" required />
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <label class="control-label col-md-4">วันเกิด
                                                    <span class="required"> * </span>
                                                </label>
                                                <?php 
                                                $birthdate = "";
                                                if( !empty($resultStudent["birthdate"]) && $resultStudent["birthdate"] != "0000-00-00" ){
                                                    $birthdate = DateOutSQL($resultStudent["birthdate"]);
                                                }
                                                ?>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control dateTimePicker" name="birthdate" value="<?=$birthdate?>" data-date="dtp" placeholder="กรุณาเลือก วัน/เดือนน/ปี เกิด" required readonly />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">จังหวัดที่เกิด
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <?php 
                                                    $sql->table="tbl_province";
                                                    $sql->condition="";
                                                    $q_province = $sql->select();
                                                    ?>
                                                    <select class="form-control" name="birth_province">
                                                        <?php 
                                                        while($province = mysqli_fetch_assoc($q_province)){
                                                            $sel = "";
                                                            if( $resultStudent["birth_province"] == $province["PROVINCE_ID"] ) $sel = ' selected="1"';
                                                            echo '<option'.$sel.' value="'.$province["PROVINCE_ID"].'">'.$province["PROVINCE_NAME"].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-4">ส่วนสูง (cm)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="height" value="<?php echo $resultStudent["height"]; ?>" placeholder="ส่วนสูง (เซนติเมตร)" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">น้ำหนัก (kg)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="weight" value="<?php echo $resultStudent["weight"]; ?>" placeholder="น้ำหนัก (กิโลกรัม)" required />
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <label class="control-label col-md-4">เลขที่บัตรประชาชน
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="id_card" value="<?php echo $resultStudent["id_card"]; ?>" minlength="13" maxlength="13" placeholder="รหัสบัตรประจำตัวประชาชน" required />
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-4">วันที่ออกบัตร
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control dateTimePicker" name="date_issued" value="<?php if($resultStudent["date_issued"] != "0000-00-00") { echo DateOutSQL($resultStudent["date_issued"]); } ?>" data-date="dtp" placeholder="วันที่ออกบัตร" readonly required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">วันหมดอายุ
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control dateTimePicker" name="expiry_date" value="<?php if($resultStudent["expiry_date"] != "0000-00-00") { echo DateOutSQL($resultStudent["expiry_date"]); } ?>" data-date="dtp" placeholder="วันที่บัตรหมดอายุ" readonly required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">สถานที่ออกบัตร
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="issued_at" value="<?php echo $resultStudent["issued_at"]; ?>" placeholder="สถานที่ออกบัตร" required />
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ศาสนา
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="religion" value="<?php echo $resultStudent["religion"]; ?>" placeholder="ศาสนา" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">สัญชาติ
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="nationality" value="<?php echo $resultStudent["nationality"]; ?>" placeholder="ระบุสัญชาติ" required />
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label class="control-label col-md-4">ใบอนุญาตขับขี่รถยนต์
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="driving_license" value="<?php echo $resultStudent["driving_license"]; ?>" pattern="[0-9]{10}" title="กรุณากรอกเลขที่ใบขับขี่ให้ถูกต้อง" placeholder="กรอกรหัสใบอนุญาติขับขี่รถยนต์" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">วันหมดอายุ
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control dateTimePicker" name="expiry_driving" value="<?php if($resultStudent["expiry_driving"] != "0000-00-00") { echo DateOutSQL($resultStudent["expiry_driving"]); } ?>" data-date="dtp" placeholder="วันหมดอายุของใบอนุญาติขับขี่ฯ" readonly required />
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <label class="control-label col-md-4">เลือดกรุ๊ป
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6 md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio_A" name="blood_group" value="A" data-title="A" class="md-radiobtn" <?php if($resultStudent["blood_group"] == "A") { echo "checked"; } ?> />
                                                        <label for="radio_A">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> กรุ๊ป A
                                                        </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio_B" name="blood_group" value="B" data-title="B" class="md-radiobtn" <?php if($resultStudent["blood_group"] == "B") { echo "checked"; } ?> />
                                                        <label for="radio_B">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> กรุ๊ป B
                                                        </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio_AB" name="blood_group" value="AB" data-title="AB" class="md-radiobtn" <?php if($resultStudent["blood_group"] == "AB") { echo "checked"; } ?> />
                                                        <label for="radio_AB">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> กรุ๊ป AB
                                                        </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio_O" name="blood_group" value="O" data-title="O" class="md-radiobtn" <?php if($resultStudent["blood_group"] == "O") { echo "checked"; } ?> />
                                                        <label for="radio_O">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> กรุ๊ป O
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">การเกณฑ์ทหาร
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio3" name="conscription" value="1" data-title="ผ่านการเกณฑ์แล้ว" class="md-radiobtn" <?php if($resultStudent["conscription"] == "1") { echo "checked"; } ?> />
                                                        <label for="radio3">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> ผ่านการเกณฑ์แล้ว
                                                        </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio4" name="conscription" value="2" data-title="ยังไม่ได้เกณฑ์ / อยู่ในระหว่างการขอผ่อนผัน" class="md-radiobtn" <?php if($resultStudent["conscription"] == "2") { echo "checked"; } ?> />
                                                        <label for="radio4">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> ยังไม่ได้เกณฑ์ / อยู่ในระหว่างการขอผ่อนผัน
                                                        </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio5" name="conscription" value="3" data-title="ได้รับการยกเว้น" class="md-radiobtn" <?php if($resultStudent["conscription"] == "3") { echo "checked"; } ?> />
                                                        <label for="radio5">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> ได้รับการยกเว้น
                                                        </label>
                                                    </div>
                                                    <div id="form_conscription_error"> </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab2">
                                            <h3 class="block headtext-set-center">ข้อมูลเกี่ยวกับครอบครัว</h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ชื่อบิดา
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="father_name" value="<?php echo $resultStudent["father_name"]; ?>" placeholder="ชื่อ-สกุล ของบิดา" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">อาชีพบิดา
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="father_career" value="<?php echo $resultStudent["father_career"]; ?>" placeholder="อาชีพของบิดา" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ที่ทำงานบิดา
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="father_workplace" value="<?php echo $resultStudent["father_workplace"]; ?>" placeholder="ที่ทำงานของบิดา" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">โทรศัพท์บิดา
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="father_phone" value="<?php echo $resultStudent["father_phone"]; ?>" placeholder="เบอร์โทรศัพท์ของบิดา" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ชื่อมารดา
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="mother_name" value="<?php echo $resultStudent["mother_name"]; ?>" placeholder="ชื่อ-สกุล ของมารดา" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">อาชีพมารดา
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="mother_career" value="<?php echo $resultStudent["mother_career"]; ?>" placeholder="อาชีพของมารดา" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ที่ทำงานมารดา
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="mother_workplace" value="<?php echo $resultStudent["mother_workplace"]; ?>" placeholder="ที่ทำงานของมารดา" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">โทรศัพท์มารดา
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="mother_phone" value="<?php echo $resultStudent["mother_phone"]; ?>" placeholder="เบอร์โทรศัพท์ของมารดา" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ที่อยู่ บิดา / มารดา
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <textarea class="form-control" rows="3" name="parent_address" placeholder="ให้กรอกที่อยู่ บิดา หรือมารดา"><?php echo $resultStudent["parent_address"]; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">โทรศัพท์
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="parent_phone" value="<?php echo $resultStudent["parent_phone"]; ?>" placeholder="เบอร์โทรศัพท์" required />
                                                </div>
                                            </div>
                                            <h3 class="block headtext-set-center">ที่อยู่อาศัย</h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ที่อยู่ตามทะเบียนบ้าน
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="md-checkbox-inline">
                                                        <div class="md-checkbox">
                                                            <input type="checkbox" id="cloneDataParent" class="md-check" name="cloneDataParent" value="1" <?php if($resultStudent["permanent_address"] == "" and $resultStudent["update_date"] != "0000-00-00") { echo "checked"; } ?>/>
                                                            <label for="cloneDataParent">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>โปรดเลือกหากมีที่อยู่ตรงกับที่อยู่ของบิดา / มารดา
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ที่อยู่
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="textarea-read">
                                                        <textarea class="form-control sync-parent" rows="3" name="permanent_address" placeholder="ให้กรอกที่อยู่ ตามทะเบียนบ้าน"><?php echo $resultStudent["permanent_address"]; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">โทรศัพท์
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="form-read">
                                                        <input type="text" class="form-control sync-parent" name="permanent_phone" value="<?php echo $resultStudent["permanent_phone"]; ?>" placeholder="เบอร์โทรศัพท์บ้าน หรือ เบอร์ที่สามารถติดต่อได้" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ที่อยู่ที่สามารถติดต่อได้
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="md-checkbox-inline">
                                                        <div class="md-checkbox">
                                                            <input type="checkbox" id="cloneDataAds" class="md-check" name="cloneDataAds" value="1" <?php if($resultStudent["contact_address"] == "" and $resultStudent["update_date"] != "0000-00-00") { echo "checked"; } ?>/>
                                                            <label for="cloneDataAds">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>โปรดเลือกหากมีที่อยู่ตรงกับที่อยู่ตามทะเบียนบ้าน
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ที่อยู่
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="textarea-read">
                                                        <textarea class="form-control sync-address" rows="3" name="contact_address" placeholder="ให้กรอกที่อยู่ ที่สามารถติดต่อได้"><?php echo $resultStudent["contact_address"]; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">โทรศัพท์
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="form-read">
                                                        <input type="text" class="form-control sync-address" name="contact_phone" value="<?php echo $resultStudent["contact_phone"]; ?>" placeholder="เบอร์โทรศัพท์บ้าน หรือ เบอร์ที่สามารถติดต่อได้" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">เบอร์มือถือ
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="mobile_phone" value="<?php echo $resultStudent["mobile_phone"]; ?>" placeholder="เบอร์มือถือที่สามารถติดต่อได้" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">อีเมล์
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="email" value="<?php echo $resultStudent["email"]; ?>" placeholder="กรุณากรอกอีเมล์แอดเดรส" required />
                                                </div>
                                            </div>
                                            <h3 class="block headtext-set-center">เพื่อนสนิท/บุคคลที่ติดต่อได้เวลาฉุกเฉิน</h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">เพื่อนสนิท/บุคคลที่สามารถติดต่อได้
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="md-checkbox-inline">
                                                        <div class="md-checkbox">
                                                            <input type="checkbox" id="cloneDataFather" class="md-check" name="check_address" value="FA" <?php if($resultStudent["check_address"] == "FA") { echo "checked"; } ?>/>
                                                            <label for="cloneDataFather">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>โปรดเลือกหากผู้ติดต่อเป็นบิดา
                                                            </label>
                                                        </div>
                                                        <div class="md-checkbox">
                                                            <input type="checkbox" id="cloneDataMother" class="md-check" name="check_address" value="MO" <?php if($resultStudent["check_address"] == "MO") { echo "checked"; } ?>/>
                                                            <label for="cloneDataMother">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>โปรดเลือกหากผู้ติดต่อเป็นมารดา
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ชื่อ-สกุล
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="form-read">
                                                        <input type="text" class="form-control sync-emer" name="emer_name" value="<?php echo $resultStudent["emer_name"]; ?>" placeholder="โปรดระบุชื่อ บุคคลที่สามารถติดต่อได้ในเวลาฉุกเฉิน" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ที่ทํางาน/ที่อยู่
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="textarea-read">
                                                        <textarea class="form-control sync-emer" rows="3" name="emer_address" placeholder="โปรดระบุที่อยู่ ของบุคคลที่สามารถติดต่อได้ในเวลาฉุกเฉิน"><?php echo $resultStudent["emer_address"]; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">เบอร์โทร
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="form-read">
                                                        <input type="text" class="form-control sync-emer" name="emer_phone" value="<?php echo $resultStudent["emer_phone"]; ?>" placeholder="เบอร์ฉุกเฉินที่สามารถติดต่อได้" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <h3 class="block headtext-set-center">ประวัติการศึกษาและการฝึกอบรม</h3>

                                            <?php
                                            $sql->table="tbl_education";
                                            $sql->condition="ORDER By id";
                                            $queryEdu = $sql->select();
                                            $edu=0;

                                            while($resultEdu = mysqli_fetch_assoc($queryEdu))
                                            {
                                                $sql->table="tbl_stu_edu";
                                                $sql->condition="WHERE edu_id='".$resultEdu["id"]."' and stu_id='".$resultStudent["id"]."'";
                                                $queryEduStu = $sql->select();
                                                $resultEduStu = mysqli_fetch_assoc($queryEduStu);
                                                ?>
                                                <h4 class="block headtext-set-center">ระดับ<?php echo $resultEdu["edu_name"]; ?></h4>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">ชื่อสถานศึกษา
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <input type="hidden" class="form-control" name="edu_id[]" value="<?php echo $resultEdu["id"]; ?>" />
                                                        <input type="text" class="form-control" name="edu_academy[<?php echo $edu; ?>]" value="<?php echo $resultEduStu["edu_academy"]; ?>" placeholder="ชื่อสถานศึกษา" required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">สาขาวิชา
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="edu_major[<?php echo $edu; ?>]" placeholder="สาขาวิชา (ถ้าไม่มีให้ใส่ - )" required value="<?php echo $resultEduStu["edu_major"]; ?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">วุฒิที่ได้รับ
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="edu_level[<?php echo $edu; ?>]" value="<?php echo $resultEduStu["edu_level"]; ?>" placeholder="วุฒิที่ได้รับ" required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">ช่วงเวลาที่ศึกษา
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-3 select-mounth-bottom">
                                                        <div class="input-group">
                                                            <span class="input-group-btn" style="vertical-align: top;">
                                                                <input class="btn btn-warning" type="button" value="ตั้งแต่" style="box-shadow: none;">
                                                            </span>
                                                            <input type="text" name="edu_start[<?php echo $edu; ?>]" class="form-control dateYear" data-date="dtp" style="margin-bottom: 5px;" readonly required value="<?php echo $resultEduStu["edu_start"]; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 select-mounth-bottom">
                                                        <div class="input-group">
                                                            <span class="input-group-btn" style="vertical-align: top;">
                                                                <input class="btn btn-warning" type="button" value="จนถึง" style="box-shadow: none;">
                                                            </span>
                                                            <input type="text" name="edu_end[<?php echo $edu; ?>]" class="form-control dateYear" data-date="dtp" style="margin-bottom: 5px;" readonly required value="<?php echo $resultEduStu["edu_end"]; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">เกรดเฉลี่ย
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="edu_grade[<?php echo $edu; ?>]" value="<?php echo $resultEduStu["edu_grade"]; ?>" placeholder="เกรดเฉลี่ย" required />
                                                    </div>
                                                </div>
                                                <?php 
                                                $edu++;
                                            }
                                            ?>
                                            <!-- <div class="col-md-12">
                                                <div class="headtext-set-center">              
                                                    <input class="btn btn-success" type="button" value="เพิ่มหัวข้ออบรม" id="addTraining" />
                                                </div>
                                            </div> -->
                                            <!-- <div id="trainingBoxesGroup">
                                                <?php 
                                                $sql->table="tbl_training";
                                                $sql->condition="WHERE stu_id='".$resultStudent["id"]."'";
                                                $queryTraining = $sql->select();
                                                $numTraining = mysqli_num_rows($queryTraining);
                                                if($numTraining == 0)
                                                {
                                                    ?>  
                                                    <div id="trainingBoxDiv"> 

                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">หัวข้อการฝึกอบรม
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="training_topics[]" value="" placeholder="หัวข้อของการฝึกอบรม" required />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">หน่วยงานที่ให้การฝึกอบรม
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="training_agency[]" value="" placeholder="หน่วยงานที่ให้การฝึกอบรม" required />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">ช่วงเวลาที่ฝึกอบรม (เดือน / ปี)
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control dateMonths" name="training_duration[]" value="" data-date="dtp" placeholder="ช่วงเวลาที่ฝึกอบรม" readonly required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="count" data-counter="2"></div>
                                                    <?php 
                                                }
                                                else
                                                {
                                                    $counter = $numTraining;
                                                    $i=1;
                                                    while($resultTraining = mysqli_fetch_assoc($queryTraining))
                                                    {
                                                        ?>
                                                        <div id="trainingBoxDiv<?php echo $i; ?>">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">หัวข้อการฝึกอบรม (<?php echo $i; ?>)
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                       <input type="text" class="form-control" name="training_topics[]" value="<?php echo $resultTraining["training_topics"]; ?>" placeholder="หัวข้อของการฝึกอบรม" required style="margin-bottom: 5px;" />
                                                                       <span class="input-group-btn" style="vertical-align: top;">
                                                                           <input class="btn btn-danger removeTraining" type="button" value="ลบหัวข้อนี้" id="divbox<?php echo $i; ?>" data-divbox="<?php echo $i; ?>" />
                                                                       </span>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           <div class="form-group">
                                                            <label class="control-label col-md-4">หน่วยงานที่ให้การฝึกอบรม
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="training_agency[]" value="<?php echo $resultTraining["training_agency"]; ?>" placeholder="หน่วยงานที่ให้การฝึกอบรม" required />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">ช่วงเวลาที่ฝึกอบรม (เดือน / ปี)
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control dateMonths" name="training_duration[]" value="<?php echo $resultTraining["training_duration"]; ?>" data-date="dtp" placeholder="ช่วงเวลาที่ฝึกอบรม" readonly required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                                <div id="count" data-counter="<?php echo $counter+1; ?>"></div>
                                                <?php
                                            }
                                            ?>
                                        </div> -->
                                        <h3 class="block headtext-set-center">ความสามารถพิเศษ</h3>

                                        <?php 
                                        $sql->table="tbl_skill";
                                        $sql->condition="";
                                        $querySkill = $sql->select();
                                        $sub = 0;

                                        while($resultSkill = mysqli_fetch_assoc($querySkill))
                                        {
                                            ?>
                                            <h4 class="block headtext-set-center"><?php echo $resultSkill["skill_name"]; ?></h4>
                                            <?php 
                                            $sql->table="tbl_sub_skill";
                                            $sql->condition="WHERE skill_id='{$resultSkill["id"]}'";
                                            $querySub = $sql->select();
                                            while($resultSub = mysqli_fetch_assoc($querySub))
                                            {
                                                $sql->table="tbl_stu_skill";
                                                $sql->condition="WHERE stu_id='".$resultStudent["id"]."' and sub_id='".$resultSub["id"]."'";
                                                $queryPoint = $sql->select();
                                                $resultPoint = mysqli_fetch_assoc($queryPoint);
                                                ?>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4"><?php echo $resultSub["sub_name"]; ?>
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-6">
                                                        <div class="md-radio-inline">
                                                            <div class="md-radio">
                                                                <input type="radio" id="radio6<?php echo $sub; ?>" name="sub_point[<?php echo $sub; ?>]" value="4" data-title="ดีเยี่ยม" class="md-radiobtn" <?php if($resultPoint["skill_point"] == "4") { echo "checked"; } ?> />
                                                                <label for="radio6<?php echo $sub; ?>">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> ดีเยี่ยม
                                                                </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="radio7<?php echo $sub; ?>" name="sub_point[<?php echo $sub; ?>]" value="3" data-title="ดี" class="md-radiobtn" <?php if($resultPoint["skill_point"] == "3") { echo "checked"; } ?> />
                                                                <label for="radio7<?php echo $sub; ?>">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> ดี
                                                                </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="radio8<?php echo $sub; ?>" name="sub_point[<?php echo $sub; ?>]" value="2" data-title="พอใช้" class="md-radiobtn" <?php if($resultPoint["skill_point"] == "2") { echo "checked"; } ?> />
                                                                <label for="radio8<?php echo $sub; ?>">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> พอใช้
                                                                </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="radio9<?php echo $sub; ?>" name="sub_point[<?php echo $sub; ?>]" value="1" data-title="แย่" class="md-radiobtn" <?php if($resultPoint["skill_point"] == "1") { echo "checked"; } ?> />
                                                                <label for="radio9<?php echo $sub; ?>">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> แย่
                                                                </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input type="radio" id="radio10<?php echo $sub; ?>" name="sub_point[<?php echo $sub; ?>]" value="0" data-title="ไม่มี" class="md-radiobtn" <?php if($resultPoint["skill_point"] == "0") { echo "checked"; } ?> />
                                                                <label for="radio10<?php echo $sub; ?>">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> ไม่มี
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="form_skill_error"> </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="sub_id[<?php echo $sub; ?>]" value="<?php echo $resultSub["id"]; ?>" />
                                                <?php 
                                                $sub++;
                                            }
                                        }
                                        ?>

                                        <!-- <h3 class="block headtext-set-center">ประสบการณ์การปฏิบัติงานและกิจกรรมนักศึกษา</h3>
                                        <div class="col-md-12">
                                            <div class="headtext-set-center">              
                                                <input class="btn btn-success" type="button" value="เพิ่มหัวข้อกิจกรรม" id="addExp" />
                                            </div>
                                        </div>
                                        <div id="expBoxesGroup">
                                            <?php 
                                            $sql->table="tbl_stu_exp";
                                            $sql->condition="WHERE stu_id='".$resultStudent["id"]."'";
                                            $queryExp = $sql->select();
                                            $numExp = mysqli_num_rows($queryExp);
                                            if($numExp == 0)
                                            {
                                                ?>  
                                                <div id="expBoxDiv"> 
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">หัวข้อกิจกรรม</label>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="exp_topics[]" value="" placeholder="หัวข้อประสบการณ์หรือกิจกรรม" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">ช่วงเวลา - ปี</label>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control dateMonths" name="exp_duration[]" value="" data-date="dtp" placeholder="ปีหรือช่วงเวลาการทำกิจกรรม" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">ความรับผิดชอบ</label>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="exp_responsibility[]" value="" placeholder="ความรับผิดชอบหรือหน้าที่ในการทำกิจกรรม" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">ชื่อรางวัล</label>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="exp_award[]" value="" placeholder="ชื่อรางวัลที่ได้รับ" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">หน่วยงานที่มอบให้</label>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="exp_agency[]" value="" placeholder="หน่วยงานที่มอบให้" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">วัน/เดือน/ปี ที่ได้รับ</label>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control dateTimePicker" name="exp_year[]" value="" data-date="dtp" placeholder="วัน/เดือน/ปี ที่ได้รับรางวัล" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">หมายเหตุ</label>
                                                        <div class="col-md-6">
                                                            <textarea class="form-control" rows="3" name="exp_note[]" placeholder="หมายเหตุ"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="expcount" data-expcounter="2"></div>
                                                <?php 
                                            }
                                            else
                                            {
                                                $expcounter = $numExp;
                                                $x=1;
                                                while($resultExp = mysqli_fetch_assoc($queryExp))
                                                {
                                                    ?>
                                                    <div id="expBoxDiv<?php echo $x; ?>">
                                                        <div class="form-group">
                                                           <label class="control-label col-md-4">หัวข้อกิจกรรม (<?php echo $x; ?>)</label>
                                                           <div class="col-md-6">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="exp_topics[]" value="<?php echo $resultExp["exp_topics"]; ?>" placeholder="หัวข้อประสบการณ์หรือกิจกรรม" />
                                                                <span class="input-group-btn" style="vertical-align: top;">
                                                                   <input class="btn btn-danger removeExp" type="button" value="ลบกิจกรรมนี้" id="expbox<?php echo $x; ?>" data-expbox="<?php echo $x; ?>" />
                                                               </span>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                    <label class="control-label col-md-4">ช่วงเวลา - ปี</label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control dateMonths" name="exp_duration[]" value="<?php echo $resultExp["exp_duration"]; ?>" data-date="dtp" placeholder="ปีหรือช่วงเวลาการทำกิจกรรม" readonly />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">ความรับผิดชอบ</label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="exp_responsibility[]" value="<?php echo $resultExp["exp_responsibility"]; ?>" placeholder="ความรับผิดชอบหรือหน้าที่ในการทำกิจกรรม" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">ชื่อรางวัล</label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="exp_award[]" value="<?php echo $resultExp["exp_award"]; ?>" placeholder="ชื่อรางวัลที่ได้รับ" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">หน่วยงานที่มอบให้</label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="exp_agency[]" value="<?php echo $resultExp["exp_agency"]; ?>" placeholder="หน่วยงานที่มอบให้" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">วัน/เดือน/ปี ที่ได้รับ</label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control dateTimePicker" name="exp_year[]" data-date="dtp" placeholder="วัน/เดือน/ปี ที่ได้รับรางวัล" readonly value="<?php echo DateOutSQL($resultExp["exp_year"]); ?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">หมายเหตุ</label>
                                                    <div class="col-md-6">
                                                        <textarea class="form-control" rows="3" name="exp_note[]" placeholder="หมายเหตุ"><?php echo $resultExp["exp_note"]; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $x++;
                                        }
                                        ?>
                                        <div id="expcount" data-expcounter="<?php echo $expcounter+1; ?>"></div>
                                        <?php
                                    }
                                    ?>
                                </div> -->
                                <h3 class="block headtext-set-center">กิจกรรมพิเศษ และ งานอดิเรก</h3>
                                <div class="form-group">
                                    <label class="control-label col-md-4">กิจกรรมพิเศษ
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <textarea name="activities" class="form-control" rows="3" placeholder="กิจกรรมพิเศษเช่น เป็นสมาชิกของสโมสร ชมรม หรือร่วมงานกับชมรม"><?=$resultStudent["activities"]?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">งานอดิเรก
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                    <textarea name="hobbies" class="form-control" rows="3" placeholder="งานอดิเรก"><?=$resultStudent["hobbies"]?></textarea>
                                    </div>
                                </div>

                                <h3 class="block headtext-set-center">เหตุผลที่เข้าร่วมสหกิจ</h3>
                                <div class="form-group">
                                    <label class="control-label col-md-4">เหตุผล
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                    <textarea name="reason" class="form-control" rows="3" placeholder="เหตุผล"><?=$resultStudent["reason"]?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab4">
                                <div class="alert alert-warning" style="text-align:center;color: #a94442;background-color: #f2dede;border-color: #ebccd1;">
                                    *** ให้นักศึกษาตรวจสอบข้อมูลให้ครบถ้วนก่อนทำการบันทึก !
                                </div>
                                <ul class="nav nav-tabs centered-tab">
                                    <li class="active"><a data-toggle="tab" href="#std_info">ข้อมูลทั่วไป</a></li>
                                    <li><a data-toggle="tab" href="#std_family">ข้อมูลครอบครัว</a></li>
                                    <li><a data-toggle="tab" href="#std_address">ข้อมูลที่อยู่</a></li>
                                    <li><a data-toggle="tab" href="#std_education">ข้อมูลการศึกษา</a></li>
                                    <li><a data-toggle="tab" href="#std_experience">ข้อมูลประสบการณ์</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="std_info" class="tab-pane fade in active">
                                        <h3 class="tabset-center">ข้อมูลทั่วไปของนักศึกษา</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ชื่อ-สกุล :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="name_th"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ชื่อ-สกุล (อังกฤษ) :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="name_en"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ชั้นปี :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="class_year"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">สาขาวิชา :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="major"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">คณะ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="faculty"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">เกรดเฉลี่ยสะสม :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="gpa"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">เพศ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="gender"></p>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label class="control-label col-md-6">สถานที่เกิด :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="birthdate"></p>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label class="control-label col-md-6">วันเกิด :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="birthdate"></p>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label class="control-label col-md-6">ส่วนสูง (cm) :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="height"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">น้ำหนัก (kg) :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="weight"></p>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label class="control-label col-md-6">เลขที่บัตรประชาชน :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="id_card"></p>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label class="control-label col-md-6">วันที่ออกบัตร :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="date_issued"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">วันหมดอายุ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="expiry_date"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">สถานที่ออกบัตร :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="issued_at"></p>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ศาสนา :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="religion"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">สัญชาติ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="nationality"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ใบอนุญาตขับขี่รถยนต์เลขที่ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="driving_license"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">วันหมดอายุ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="expiry_driving"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">การเกณฑ์ทหาร :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="conscription"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="std_family" class="tab-pane fade">
                                        <!-- <h4 class="form-section tabset-center">ข้อมูลเกี่ยวกับครอบครัว</h4> -->
                                        <h3 class="tabset-center">ข้อมูลเกี่ยวกับครอบครัว</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ชื่อบิดา :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="father_name"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">อาชีพของบิดา :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="father_career"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ที่ทำงานของบิดา :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="father_workplace"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">โทรศัพท์บิดา :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="father_phone"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ชื่อมารดา :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="mother_name"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">อาชีพของมารดา :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="mother_career"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ที่ทำงานของมารดา :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="mother_workplace"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">โทรศัพท์มารดา :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="mother_phone"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ที่อยู่ บิดา / มารดา :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="parent_address"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">โทรศัพท์ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="parent_phone"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="std_address" class="tab-pane fade">
                                        <h3 class="tabset-center">ข้อมูลเกี่ยวกับที่อยู่</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ที่อยู่ตามทะเบียนบ้าน :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="permanent_address"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">โทรศัพท์ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="permanent_phone"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ที่อยู่ที่สามารถติดต่อได้ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="contact_address"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">โทรศัพท์ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="contact_phone"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">เบอร์มือถือ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="mobile_phone"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">อีเมล์ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="email"></p>
                                            </div>
                                        </div>

                                        <h3 class="tabset-center">บุคคลที่สามารถติดต่อได้ในเวลาฉุกเฉิน</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ชื่อ-สกุล :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="emer_name"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">ที่ทํางาน / ที่อยู่ :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="emer_address"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">เบอร์โทร :</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="emer_phone"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="std_education" class="tab-pane fade">
                                        <h3 class="tabset-center">ข้อมูลประวัติการศึกษา</h3>
                                        <?php
                                        
                                        $sql->table="tbl_education";
                                        $sql->condition="ORDER By id";
                                        $queryEdu = $sql->select();
                                        $edu=0;

                                        while($resultEdu = mysqli_fetch_assoc($queryEdu))
                                        {
                                            $sql->table="tbl_stu_edu";
                                            $sql->condition="WHERE edu_id='".$resultEdu["id"]."' and stu_id='".$resultStudent["id"]."'";
                                            $queryEduStu = $sql->select();
                                            $resultEduStu = mysqli_fetch_assoc($queryEduStu);
                                            ?>
                                            <h4 class="tabset-center">ระดับ<?php echo $resultEdu["edu_name"]; ?></h4>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">ชื่อสถานศึกษา :</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="edu_academy[<?php echo $edu; ?>]"></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">สาขาวิชา :</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="edu_major[<?php echo $edu; ?>]"></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">วุฒิที่ได้รับ :</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="edu_level[<?php echo $edu; ?>]"></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">ช่วงเวลาที่ศึกษา :</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="edu_start[<?php echo $edu; ?>]"></p>
                                                    จนถึง
                                                    <p class="form-control-static" data-display="edu_end[<?php echo $edu; ?>]"></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-6">เกรดเฉลี่ย :</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="edu_grade[<?php echo $edu; ?>]"></p>
                                                </div>
                                            </div>
                                            <?php
                                            $edu++;
                                        }
                                        ?>
                                    </div>

                                    <div id="std_experience" class="tab-pane fade">
                                        <h3 class="tabset-center">ข้อมูลการฝึกอบรม</h3>
                                        <div class="showtraining"></div>

                                        <h3 class="tabset-center">ความสามารถพิเศษ</h3>
                                        <?php 
                                        $sql->table="tbl_skill";
                                        $sql->condition="";
                                        $querySkill = $sql->select();
                                        $sub = 0;

                                        while($resultSkill = mysqli_fetch_assoc($querySkill))
                                        {
                                            ?>
                                            <h4 class="tabset-center"><?php echo $resultSkill["skill_name"]; ?></h4>
                                            <?php 
                                            $sql->table="tbl_sub_skill";
                                            $sql->condition="WHERE skill_id='".$resultSkill["id"]."'";
                                            $querySub = $sql->select();
                                            while($resultSub = mysqli_fetch_assoc($querySub))
                                            {
                                                $sql->table="tbl_stu_skill";
                                                $sql->condition="WHERE stu_id='".$resultStudent["id"]."' and sub_id='".$resultSub["id"]."'";
                                                $queryPoint = $sql->select();
                                                $resultPoint = mysqli_fetch_assoc($queryPoint);
                                                ?>
                                                <div class="form-group">
                                                    <label class="control-label col-md-6"><?php echo $resultSub["sub_name"]; ?> :</label>
                                                    <div class="col-md-4">
                                                        <p class="form-control-static" data-display="sub_point[<?php echo $sub; ?>]"> </p>
                                                    </div>
                                                </div>
                                                <?php 
                                                $sub++;
                                            }
                                        }
                                        ?>
                                        <div class="showExp"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
												<div class="form-actions">
													<div class="row">
														<div class="col-md-12" style="text-align: center">
															<a href="javascript:;" class="btn default button-previous"><i class="fa fa-angle-left"></i> กลับ </a>
															<a href="javascript:;" class="btn btn-outline green button-next"> ถัดไป <i class="fa fa-angle-right"></i></a>
															<button type="submit" class="btn green button-submit"> บันทึก <i class="fa fa-check"></i></button>
															<input type="hidden" name="checkStuEdit" value="1" />
															<input type="hidden" name="id" value="<?php echo $resultStudent["id"]; ?>" />
															<input type="hidden" name="update_user" value="<?php echo $resultUser["id"]; ?>" />
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php include("../footer.php"); ?>
		<script type="text/javascript" src="../../js/select2.full.min.js"></script>
		<script type="text/javascript" src="../../js/select2.th.js"></script>
		<script type="text/javascript" src="../../js/jquery.bootstrap.wizard.min.js"></script>
		<script type="text/javascript" src="../../js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="../../js/additional-methods.min.js"></script>
		<script type="text/javascript" src="../../js/app.min.js"></script>
		<script type="text/javascript" src="../../js/form-wizard.min.js"></script>
		<script type="text/javascript" src="../../js/messages_th.min.js"></script>
		<script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../../js/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="../../js/jquery-ui-sliderAccess.js"></script>
        <script type="text/javascript" src="../../js/SE-CO-003.js"></script>