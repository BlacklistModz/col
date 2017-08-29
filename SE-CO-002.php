<?php
include("header.php");

if(!isset($resultUser["status_id"]) or ($resultUser["status_id"] !="3"))
{
    header("location:index.php?page=home");
}

$month=array("1"=>"มกราคม", "2"=>"กุมภาพันธ์", "3"=>"มีนาคม", "4"=>"เมษายน", "5"=>"พฤษภาคม", "6"=>"มิถุนายน", "7"=>"กรกฎาคม", "8"=>"สิงหาคม", "9"=>"กันยายน", "10"=>"ตุลาคม", "11"=>"พฤศจิกายน", "12"=>"ธันวาคม"); 
$sql->table="tbl_corporation";
$sql->condition="WHERE user_id='$user_id' ORDER By id DESC LIMIT 0,1";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);

$sql->table="tbl_year";
$sql->condition="WHERE id='".$resultCorp["year_id"]."'";
$queryUpdate = $sql->select();
$resultUpdate = mysqli_fetch_assoc($queryUpdate);
?>

<link rel="stylesheet" type="text/css" href="css/select2.min.css">
<link rel="stylesheet" type="text/css" href="css/select2-bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="css/form-group.css">
<style type="text/css">
    .input-group .select2-container--bootstrap {
        width: 100% !important;
    }
    @media screen and (max-width: 991px) {
        .select-mounth-bottom {
            margin-bottom: 15px;
        }
    }
    @media (min-width: 992px) {
        .tabset-center {
            text-align: center;
        }
        .nav-tabs.centered-tab > li,
        .nav-pills.centered-tab > li {
            float:none;
            display:inline-block;
            *display:inline; /* ie7 fix */
            zoom:1; /* hasLayout ie7 trigger */
        }

        .nav-tabs.centered-tab,
        .nav-pills.centered-tab {
            text-align:center;
        }
    }
    .tabset-center {
        color: #fe6711;
        margin-top: 30px;
        margin-bottom: 30px;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none; 
      margin: 0; 
  }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="index.php"><i class="fa fa-home"></i></a>
                </li>
                <li class="active">
                    แบบเสนองานสหกิจศึกษา
                </li>
            </ul>
            <div class="search-section">
                <div class="title">
                    แบบเสนองานสหกิจศึกษา (ปรับปรุงข้อมูลเมื่อ ปีการศึกษา <?php echo $resultUpdate["academic_year"]; ?>)
                </div>
            </div>
            <div class="portlet light" id="form_wizard_1">
                <div class="portlet-body form">
                    <form class="form-horizontal" id="submit_form" method="POST">
                        <div class="form-wizard">
                            <div class="form-body">
                                <ul class="nav nav-pills nav-justified steps">
                                    <li>
                                        <a href="#tab1" data-toggle="tab" class="step">
                                            <span class="number"> 1 </span>
                                            <span class="desc"><i class="fa fa-check success-form-input"></i> ข้อมูลทั่วไป&nbsp; </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab2" data-toggle="tab" class="step">
                                            <span class="number"> 2 </span>
                                            <span class="desc"><i class="fa fa-check success-form-input"></i> ข้อมูลรายละเอียด </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab3" data-toggle="tab" class="step">
                                            <span class="number"> 3 </span>
                                            <span class="desc"><i class="fa fa-check success-form-input"></i> การปฏิบัติงาน </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab4" data-toggle="tab" class="step">
                                            <span class="number"> 4 </span>
                                            <span class="desc"><i class="fa fa-check success-form-input"></i> สาขาวิชาที่ต้องการ </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab5" data-toggle="tab" class="step">
                                            <span class="number"> 5 </span>
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
                                            <h3 class="block headtext-set-center">ข้อมูลทั่วไปของสถานประกอบการ</h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ชื่อสถานประกอบการ
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="name_th" value="<?php echo $resultCorp["name_th"]; ?>" placeholder="กรอกชื่อสถานประกอบการ" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ชื่อสถานประกอบการ (ภาษาอังกฤษ)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="name_en" value="<?php echo $resultCorp["name_en"]; ?>" placeholder="กรอกชื่อสถานประกอบการ" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ที่อยู่
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <textarea class="form-control" rows="3" name="address" placeholder="กรุณากรอกที่อยู่"><?php echo $resultCorp["address"]; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">จังหวัด
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <?php 
                                                    $sql->table="tbl_province";
                                                    $sql->condition="";
                                                    $queryCoun = $sql->select();
                                                    ?>
                                                    <select name="province_id" id="province_list" class="form-control" required>
                                                        <option value=""></option>
                                                        <?php
                                                        while($resultCoun = mysqli_fetch_assoc($queryCoun))
                                                        {
                                                            ?>
                                                            <option <?php if($resultCoun["PROVINCE_ID"] == $resultCorp["province_id"]) { echo "selected"; } ?> value="<?php echo $resultCoun["PROVINCE_ID"]; ?>"><?php echo $resultCoun["PROVINCE_NAME"]; ?></option>
                                                            <?php 
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">รหัสไปรษณีย์
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="zip_code" value="<?php echo $resultCorp["zip_code"]; ?>" placeholder="รหัสไปรษณีย์" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">โทรศัพท์
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="phone" value="<?php echo $resultCorp["phone"]; ?>" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">โทรสาร (Fax.)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="fax" value="<?php echo $resultCorp["fax"]; ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">อีเมล์ (E-mail)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="email" value="<?php echo $resultCorp["email"]; ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ประเภทกิจการ/ธุรกิจ/ผลิตภัณฑ์
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="business_type" value="<?php echo $resultCorp["business_type"]; ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">จํานวนพนักงานรวม (คน)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="emp_count" value="<?php echo $resultCorp["emp_count"]; ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">จํานวนชั่วโมงการทํางาน (ชม./สัปดาห์)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="work_time" value="<?php echo $resultCorp["work_time"]; ?>" class="form-control" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <h3 class="block headtext-set-center">รายละเอียดของสถานประกอบการ</h3>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ชื่อ-สกุล ผู้จัดการ / หัวหน้าหน่วยงาน
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="manager_name" value="<?php echo $resultCorp["manager_name"]; ?>" class="form-control" placeholder="ชื่อผู้จัดการสถานประกอบการ /หัวหน้าหน่วยงาน" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">ตำแหน่ง
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" name="mjob_position" value="<?php echo $resultCorp["mjob_position"]; ?>" class="form-control" placeholder="ตำแหน่งงาน" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">สาขาวิชาที่ต้องการ
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                   <textarea class="form-control" rows="3" name="major_require" placeholder="สาขาวิชาที่ต้องการรับ (เช่น วิศวกรรมซอฟต์แวร์)"><?php echo $resultCorp["major_require"]; ?></textarea>
                                               </div>
                                           </div>
                                           <div class="form-group">
                                                <label class="control-label col-md-4">ความสามารถทางวิชาการ<br/>หรือทักษะที่นักศึกษาควรมี
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <textarea class="form-control" rows="3" name="stu_academic" placeholder=""><?php echo $resultCorp["stu_academic"]; ?></textarea>
                                                </div>
                                           </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-4">ข้อกำหนดอื่นๆ
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <textarea class="form-control" rows="3" name="stu_features" placeholder="เช่น อุปกรณ์หรือเครื่องมือที่ต้องนําติดตัวไประหว่างปฏิบัติงาน"><?php echo $resultCorp["stu_features"]; ?></textarea>
                                            </div>
                                        </div>
                                        <h4 class="block headtext-set-center">ตําแหน่งงานที่เสนอให้นักศึกษาปฏิบัติ</h4>
                                        <div class="col-md-12">
                                            <div class="headtext-set-center">                                           
                                                <input class="btn btn-success" type="button" value="เพิ่มตำแหน่ง" id="addPosition" />
                                            </div>
                                        </div>
                                        <div id="positionBoxesGroup">
                                            <?php 
                                            $sql->table="tbl_position";
                                            $sql->condition="WHERE corp_id='".$resultCorp["id"]."'";
                                            $queryPosition = $sql->select();
                                            $numRow = mysqli_num_rows($queryPosition);
                                            if($numRow == 0)
                                            {
                                                ?>  
                                                <div id="positionBoxDiv"> 
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">ตำแหน่งที่ 1
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <input type="text" name="position[]" value="" class="form-control" required />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">ลักษณะงานที่นักศึกษาต้องปฏิบัติ 1
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <textarea class="form-control" rows="3" name="job_description[]" placeholder="อาจเป็นงานโครงงาน งานวิจัย หรืองานที่สอดคล้องกับสาขาวิชา"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">จํานวนนักศึกษาที่รับ 1
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <input type="text" name="stu_count[]" value="" class="form-control" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="count" data-counter="2"></div>
                                                <?php 
                                            }
                                            else
                                            {
                                                $counter = mysqli_num_rows($queryPosition);
                                                $i=1;
                                                while($resultPosition = mysqli_fetch_assoc($queryPosition))
                                                {
                                                    ?>
                                                    <div id="positionBoxDiv<?php echo $i; ?>">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">ตำแหน่งที่ <?php echo $i; ?>
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <input type="text" name="position[]" value="<?php echo $resultPosition["pos_name"]; ?>" class="form-control" required style="margin-bottom: 5px;"/>
                                                                    <span class="input-group-btn" style="vertical-align: top;">
                                                                        <input class="btn btn-danger removePosition" type="button" value="ลบตำแหน่งนี้" id="divbox<?php echo $i; ?>" data-divbox="<?php echo $i; ?>">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">ลักษณะงานที่นักศึกษาต้องปฏิบัติ <?php echo $i; ?>
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" rows="3" name="job_description[]" placeholder="อาจเป็นงานโครงงาน งานวิจัย หรืองานที่สอดคล้องกับสาขาวิชา"><?php echo $resultPosition["job_description"]; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">จํานวนนักศึกษาที่รับ <?php echo $i; ?>
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="stu_count[]" value="<?php echo $resultPosition["stu_count"]; ?>" class="form-control" required />
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
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <h3 class="block headtext-set-center">รายละเอียดของการปฏิบัติงาน</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">ชื่อ-สกุล พนักงานที่ปรีกษา / พี่เลี้ยง
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="staff_name" value="<?php echo $resultCorp["staff_name"]; ?>" placeholder="ชื่อ-นามสกุล พนักงานที่ปรีกษา หรือพี่เลี้ยง" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">ตำแหน่ง
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="sjob_position" value="<?php echo $resultCorp["sjob_position"]; ?>" placeholder="ตำแหน่งงาน" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">แผนก / ฝ่าย
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="division" value="<?php echo $resultCorp["division"]; ?>" placeholder="แผนก / ฝ่าย" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">โทรศัพท์
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="tel" value="<?php echo $resultCorp["tel"]; ?>" placeholder="เบอร์ที่สามารถติดต่อได้" required />

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">ระยะเวลาที่ต้องการให้นักศึกษาไปปฏิบัติงาน
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-3 select-mounth-bottom">

                                                <div class="input-group select2-bootstrap-prepend">
                                                    <span class="input-group-btn" style="vertical-align: bottom;">
                                                        <button class="btn btn-warning" type="button" style="box-shadow: none;">ตั้งแต่</button>
                                                    </span>
                                                    <select name="practice_start" id="practice_start_list" class="form-control" required >
                                                        <option value=""></option>
                                                        <?php 
                                                        for($i=1;$i<=count($month);$i++)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $i; ?>"  <?php if($resultCorp["practice_start"] == $i) { echo "selected"; } ?>><?php echo $month[$i]; ?></option>
                                                            <?php
                                                        } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group select2-bootstrap-prepend">
                                                    <span class="input-group-btn" style="vertical-align: bottom;">
                                                        <button class="btn btn-warning" type="button" style="box-shadow: none;">จนถึง</button>
                                                    </span>
                                                    <select name="practice_end" id="practice_end_list" class="form-control" required >
                                                        <option value=""></option>
                                                        <?php 
                                                        for($i=1;$i<=count($month);$i++)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $i; ?>" <?php if($resultCorp["practice_end"] == $i) { echo "selected"; } ?>><?php echo $month[$i]; ?></option>
                                                            <?php
                                                        } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">ค่าตอบแทน
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio1" name="compensation_status" value="0" data-title="ไม่มี" class="md-radiobtn" <?=(empty($resultCorp["compensation_status"]) ? "checked" : "")?> required />
                                                        <label for="radio1">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> ไม่มี </label>
                                                        </div>
                                                    </div>
                                                    <div class="md-radio-inline">
                                                        <div class="md-radio form-inline">
                                                            <input type="radio" id="radio2" name="compensation_status" value="1" data-title="มีรายวัน" class="md-radiobtn" <?php if($resultCorp["compensation_status"] == "1") { echo "checked"; } ?> required />
                                                            <label for="radio2">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> มี 
                                                            </label>
                                                            <input type="text" class="form-control" name="compensation" value="<?=($resultCorp["compensation_status"]==1 ? $resultCorp["compensation"] : "")?>" placeholder="" style="width: 80px;" id="compensation2" <?php if($resultCorp["compensation_status"] == "0") { echo "disabled"; } ?>/>
                                                                <span class="box"> บาท/วัน</span>
                                                            </div>
                                                    </div>
                                                    <div class="md-radio-inline">
                                                        <div class="md-radio form-inline">
                                                            <input type="radio" id="radio3" name="compensation_status" value="2" data-title="มีรายเดือน" class="md-radiobtn" <?php if($resultCorp["compensation_status"] == "2") { echo "checked"; } ?> required />
                                                            <label for="radio3">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> มี 
                                                            </label>
                                                            <input type="text" class="form-control" name="compensation" value="<?=($resultCorp["compensation_status"]==2 ? $resultCorp["compensation"] : "")?>" placeholder="" style="width: 80px;" id="compensation3" <?php if($resultCorp["compensation_status"] == "0") { echo "disabled"; } ?>/>
                                                                <span class="box"> บาท/เดือน</span>
                                                            </div>
                                                        </div>
                                                        <div id="form_compensation_status_error"> </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">สวัสดิการ  <span class="required"> * </span> &nbsp;</label>
                                                    <div class="col-md-6">
                                                        <div class="md-checkbox-inline">
                                                            <?php 
                                                            $sql->table="tbl_welfare";
                                                            $sql->condition="WHERE wel_display='enabled' ORDER By id asc";
                                                            $queryWel = $sql->select();
                                                            $num = 1;
                                                            $radio = 3;
                                                            while($resultWel = mysqli_fetch_assoc($queryWel))
                                                            {
                                                                $ck1 = "";
                                                                $ck2 = "";
                                                                $ck3 = "";
                                                                $ck4 = "";

                                                                $sql->table="tbl_corp_welfare";
                                                                $sql->field="*";
                                                                $sql->condition="WHERE corp_id={$resultCorp["id"]} AND wel_id={$resultWel["id"]}";
                                                                $query_cw = $sql->select();
                                                                $result_cw = mysqli_fetch_assoc($query_cw);

                                                                if( $result_cw["wel_type"] == 1 ) $ck1 = ' checked="1"';
                                                                if( $result_cw["wel_type"] == 2 ) $ck2 = ' checked="2"';
                                                                if( $result_cw["wel_type"] == 3 ) $ck3 = ' checked="3"';
                                                                if( $result_cw["wel_type"] == 4 ) $ck4 = ' checked="4"';
                                                                ?>
                                                                <input type="hidden" name="wel_id[<?=$num?>]" value="<?=$resultWel["id"]?>">
                                                                <div class="col-md-12" style="margin-bottom:15px; border: 3px solid #f0ad4e">
                                                                    <div style="margin: 15px 0px 15px 0px">
                                                                    <label><?=$num?>. <?=$resultWel['wel_name']?></label>
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="radio1<?=$radio?>" name="wel_type[<?=$num?>]" value="1" class="md-radiobtn" data-title="ไม่มี" <?=$ck1?>/>
                                                                            <label for="radio1<?=$radio?>">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> ไม่มี
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="radio2<?=$radio?>" name="wel_type[<?=$num?>]" value="2" class="md-radiobtn" data-title="มี" <?=$ck2?>/>
                                                                            <label for="radio2<?=$radio?>">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> มี
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio">
                                                                            <input type="radio" id="radio3<?=$radio?>" name="wel_type[<?=$num?>]" value="3" class="md-radiobtn" data-title="ไม่เสียค่าใช้จ่าย" <?=$ck3?>/>
                                                                            <label for="radio3<?=$radio?>">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> ไม่เสียค่าใช้จ่าย
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="md-radio-inline">
                                                                        <div class="md-radio form-inline">
                                                                            <input type="radio" id="radio4<?=$radio?>" name="wel_type[<?=$num?>]" value="4" class="md-radiobtn" data-title="นักศึกษารับผิดชอบค่าใช้จ่ายเอง" <?=$ck4?>/>
                                                                            <label for="radio4<?=$radio?>">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> นักศึกษารับผิดชอบค่าใช้จ่ายเอง
                                                                                    <input type="text" class="form-control" name="wel_value[<?=$num?>]" value="<?=$result_cw["wel_value"]?>" style="width: 100px;">
                                                                                    <span class="box"></span> บาท/วัน/เดือน
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                $num++;
                                                                $radio++;
                                                            }
                                                            ?>
                                                            <div id="form_payment_error"> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">อื่นๆ (ถ้ามีโปรดระบุ)
                                                            <span class="required"> </span>
                                                        </label>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="welfare" value="<?php echo $resultCorp["welfare"]; ?>" placeholder="(โปรดระบุ เช่น อาหาร ชุดทํางาน)" />
                                                        </div>
                                                    </div>
                                                </div>
                                               <div class="tab-pane" id="tab4">
                                                    <h3 class="block headtext-set-center">สาขาวิชาของมหาวิทยาลัยราชภัฏลำปางที่เข้าร่วมโครงการสหกิจศึกษา มีดังนี้</h3>
                                                    <h4 class="text-center">กรุณาเลือกสาขาวิชา และกรอกจำนวนนักศึกษาที่ต้องการรับ (สาขาเลือกได้มากกว่า 1 สาขาวิชา)</h4>
                                                    <div class="table-responsive">
                                                        <?php 
                                                        $sql->table="tbl_faculty";
                                                        $sql->condition="ORDER BY faculty_id ASC";
                                                        $query = $sql->select();
                                                        while($results = mysqli_fetch_assoc($query)){
                                                            ?>
                                                            <table class="table table-bordered" style="background-color: white;">
                                                                <thead>
                                                                    <tr style="background-color: #fe6711; color:white; border-bottom: 8px solid #BF360C">
                                                                        <th width="85%"><?=$results['faculty_name']?></th>
                                                                        <th width="15%" class="text-center">จำนวน (ตำแหน่ง)</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody role="lists">
                                                                    <?php 
                                                                    $sql->table="tbl_majors";
                                                                    $sql->condition="WHERE major_faculty_id={$results["faculty_id"]}";
                                                                    $q_major = $sql->select();
                                                                    $m = 1;
                                                                    while($major = mysqli_fetch_assoc($q_major)){

                                                                        $sql->table="tbl_corp_majors";
                                                                        $sql->condition="WHERE corp_id={$resultCorp["id"]} AND major_id={$major["major_id"]}";
                                                                        $q_cm = $sql->select();
                                                                        $result_cm = mysqli_fetch_assoc($q_cm);
                                                                        ?>
                                                                        <tr>
                                                                            <td><?=$m?>. <?=$major["major_name"]?></td>
                                                                            <td class="text-center">
                                                                                <div class="form-inline">
                                                                                    <div class="form-group">
                                                                                        <div class="row">
                                                                                            <input type="hidden" name="major_id[]" value="<?=$major['major_id']?>">
                                                                                            <input type="number" class="form-control text-center" name="student_amount[]" value="<?=(!empty($result_cm["student_amount"]) ? $result_cm["student_amount"] : '')?>" style="width: 70px;">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <?php 
                                                                        $m++;
                                                                    } 
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                            <?php 
                                                        } 
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab5">
                                                    <div class="alert alert-warning" style="text-align:center;color: #a94442;background-color: #f2dede;border-color: #ebccd1;">
                                                        *** กรุณาตรวจสอบข้อมูลให้ครบถ้วนก่อนทำการบันทึก !
                                                    </div>
                                                    <ul class="nav nav-tabs centered-tab">
                                                        <li class="active"><a data-toggle="tab" href="#corp_information">ข้อมูลทั่วไป</a></li>
                                                        <li><a data-toggle="tab" href="#corp_detail">รายละเอียด</a></li>
                                                        <li><a data-toggle="tab" href="#corp_working">การปฏิบัติงาน</a></li>
                                                    </ul>

                                                    <div class="tab-content">
                                                        <div id="corp_information" class="tab-pane fade in active">
                                                            <h3 class="tabset-center">ข้อมูลทั่วไปของสถานประกอบการ</h3>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">ชื่อสถานประกอบการ :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="name_th"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">ชื่อสถานประกอบการ (ภาษาอังกฤษ) :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="name_en"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">ที่อยู่ :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="address"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">จังหวัด :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="province_id"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">รหัสไปรษณีย์ :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="zip_code"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">โทรศัพท์ :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="phone"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">โทรสาร (Fax.) :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="fax"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">อีเมล์ (E-mail) :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="email"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">ประเภทกิจการ/ธุรกิจ/ผลิตภัณฑ์ :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="business_type"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">จํานวนพนักงานรวม :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="emp_count"></p>
                                                                    คน
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">จํานวนชั่วโมงการทํางาน :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="work_time"></p>
                                                                    ชม./สัปดาห์
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="corp_detail" class="tab-pane fade">
                                                            <h3 class="tabset-center">ข้อมูลรายละเอียดของสถานประกอบการ</h3>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">ชื่อ-สกุล ผู้จัดการ / หัวหน้าหน่วยงาน :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="manager_name"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">ตำแหน่ง :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="mjob_position"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">สาขาวิชาที่ต้องการ :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="major_require"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">คุณสมบัติของนักศึกษาและข้อกําหนดอื่นๆ :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="stu_features"></p>
                                                                </div>
                                                            </div>
                                                            <div class="show-position"></div>
                                                        </div>

                                                        <div id="corp_working" class="tab-pane fade">
                                                            <h3 class="tabset-center">รายละเอียดของการปฏิบัติงาน</h3>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">ชื่อ-สกุล พนักงานที่ปรีกษา / พี่เลี้ยง :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="staff_name"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">ตำแหน่ง :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="sjob_position"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">แผนก / ฝ่าย :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="division"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">โทรศัพท์ :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="tel"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">ระยะเวลาที่ต้องการให้นักศึกษาไปปฏิบัติงาน :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="practice_start"></p>
                                                                    จนถึง
                                                                    <p class="form-control-static" data-display="practice_end"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">ค่าตอบแทน :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="compensation"></p>
                                                                    <p class="form-control-static" data-display="compensation_status"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">สวัสดิการ :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="wel_id[]"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-6">อื่นๆ (ถ้ามี) :</label>
                                                                <div class="col-md-4">
                                                                    <p class="form-control-static" data-display="welfare"></p>
                                                                </div>
                                                            </div>
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
                                                        <input type="hidden" name="checkCorpEdit" value="1" />
                                                        <input type="hidden" name="id" value="<?php echo $resultCorp["id"]; ?>" />
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
                <?php include("footer.php") ?>
                <script src="js/select2.full.min.js" type="text/javascript"></script>
                <script src="js/select2.th.js" type="text/javascript"></script>
                <script src="js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
                <script src="js/jquery.validate.min.js" type="text/javascript"></script>
                <script src="js/additional-methods.min.js" type="text/javascript"></script>
                <script src="js/app.min.js" type="text/javascript"></script>
                <script src="js/form-wizard.min.js" type="text/javascript"></script>
                <script src="js/messages_th.min.js" type="text/javascript"></script>
                <script src="js/SE-CO-002.js" type="text/javascript"></script>
                <script type="text/javascript">
                    $("#radio1").click(function(){
                        $("#compensation2").attr("disabled", true);
                        $("#compensation3").attr("disabled", true);

                        $("#compensation2").val("");
                        $("#compensation3").val("");
                    });

                    $("#radio2").click(function(){
                        $("#compensation2").attr("disabled", false);

                        $("#compensation3").attr("disabled", true);
                        $("#compensation3").val("");
                    })

                    $("#radio3").click(function(){
                        $("#compensation3").attr("disabled", false);

                        $("#compensation2").attr("disabled", true);
                        $("#compensation2").val("");
                    })
                </script>