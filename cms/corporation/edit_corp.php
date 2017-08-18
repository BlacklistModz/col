<?php
include("../header.php");
include("../sidebar.php");
$month=array("1"=>"มกราคม", "2"=>"กุมภาพันธ์", "3"=>"มีนาคม", "4"=>"เมษายน", "5"=>"พฤษภาคม", "6"=>"มิถุนายน", "7"=>"กรกฎาคม", "8"=>"สิงหาคม", "9"=>"กันยายน", "10"=>"ตุลาคม", "11"=>"พฤศจิกายน", "12"=>"ธันวาคม"); 
$user_id = $_GET["corp_id"];
$sql->table="tbl_corporation";
$sql->condition="WHERE user_id='$user_id' ORDER By id DESC LIMIT 0,1";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);
?>
<link rel="stylesheet" type="text/css" href="../../css/select2.min.css">
<link rel="stylesheet" type="text/css" href="../../css/select2-bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="../../css/form-group.css">
<link rel="stylesheet" type="text/css" href="../../css/cms-forminput.css">
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			แก้ไขข้อมูล
			<small>สถานประกอบการ <?php echo $resultCorp["name_th"]; ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="index.php?page=<?php echo $_GET["page"]; ?>"><i class="fa fa-edit"></i>ตรวจสอบสถานประกอบการ</a></li>
			<li class="active">แก้ไขข้อมูล </li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">แก้ไขข้อมูลสถานประกอบการ</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="ซ่อน" style="box-shadow: none">
								<i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="portlet light" id="form_wizard_1">
								<div class="portlet-body form">
									<form class="form-horizontal" action="do_edit.php?page=<?php echo $_GET["page"]; ?>" id="submit_form" method="POST">
										<div class="form-wizard">
											<div class="form-body">
												<ul class="nav nav-pills nav-justified steps">
													<li>
														<a href="#tab1" data-toggle="tab" class="step">
															<span class="number"> 1 </span>
															<span class="desc"><i class="fa fa-check success-form-input"></i> ข้อมูลทั่วไป </span>
														</a>
													</li>
													<li>
														<a href="#tab2" data-toggle="tab" class="step">
															<span class="number"> 2 </span>
															<span class="desc"><i class="fa fa-check success-form-input"></i> รายละเอียด </span>
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
																	<input type="text" class="form-control" name="name_th" value="<?php echo $resultCorp["name_th"]; ?>" placeholder="กรอกชื่อสถานประกอบการ" required  />
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-4">ชื่อสถานประกอบการ (ภาษาอังกฤษ)
																	<span class="required"> * </span>
																</label>
																<div class="col-md-6">
																	<input type="text" class="form-control" name="name_en" value="<?php echo $resultCorp["name_en"]; ?>" placeholder="กรอกชื่อสถานประกอบการ" required  />
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
																	<input type="text" class="form-control" name="zip_code" value="<?php echo $resultCorp["zip_code"]; ?>" placeholder="รหัสไปรษณีย์" required  />
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-4">โทรศัพท์
																	<span class="required"> * </span>
																</label>
																<div class="col-md-6">
																	<input type="text" class="form-control" name="phone" value="<?php echo $resultCorp["phone"]; ?>" />
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-4">โทรสาร (Fax.)
																	<span class="required"> * </span>
																</label>
																<div class="col-md-6">
																	<input type="text" class="form-control" name="fax" value="<?php echo $resultCorp["fax"]; ?>" required />
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-4">ประเภทกิจการ/ธุรกิจ/ผลิตภัณฑ์
																	<span class="required"> * </span>
																</label>
																<div class="col-md-6">
																	<input type="text" class="form-control" name="business_type" value="<?php echo $resultCorp["business_type"]; ?>" required />
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-4">จํานวนพนักงานรวม (คน)
																	<span class="required"> * </span>
																</label>
																<div class="col-md-6">
																	<input type="number" class="form-control" name="emp_count" value="<?php echo $resultCorp["emp_count"]; ?>" required />
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-4">จํานวนชั่วโมงการทํางาน (ชม./สัปดาห์)
																	<span class="required"> * </span>
																</label>
																<div class="col-md-6">
																	<input type="number" class="form-control" name="work_time" value="<?php echo $resultCorp["work_time"]; ?>" required />
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
																	<input type="text" name="major_require" value="<?php echo $resultCorp["major_require"]; ?>" class="form-control" required />
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-4">คุณสมบัติของนักศึกษาและข้อกําหนดอื่นๆ
																	<span class="required"> * </span>
																</label>
																<div class="col-md-6">
																	<textarea class="form-control" rows="3" name="stu_features" placeholder="คุณสมบัติของนักศึกษาและข้อกําหนดอื่นๆ (เช่น อุปกรณ์หรือเครื่องมือที่ต้องนําติดตัวไประหว่างปฏิบัติงาน)"><?php echo $resultCorp["stu_features"]; ?></textarea>
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
																				<input type="number" name="stu_count[]" value="" class="form-control" required />
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
																						<input type="text" name="position[]" value="<?php echo $resultPosition["pos_name"]; ?>" class="form-control" required style="margin-bottom: 5px;" />
																						<span class="input-group-btn" style="vertical-align: top;">
																							<input class="btn btn-danger removePosition" type="button" value="ลบตำแหน่งนี้" id="divbox<?php echo $i; ?>" data-divbox="<?php echo $i; ?>" style="border-radius:0px;" />
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
																					<input type="number" name="stu_count[]" value="<?php echo $resultPosition["stu_count"]; ?>" class="form-control" required />
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
																			<button class="btn btn-warning" type="button" style="box-shadow: none;border-radius: 0px;">ตั้งแต่</button>
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
																			<button class="btn btn-warning" type="button" style="box-shadow: none;border-radius: 0px;">จนถึง</button>
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

																<div class="col-md-3">
																	<input type="text" class="form-control" name="compensation" value="<?php echo $resultCorp["compensation"]; ?>" placeholder="ค่าตอบแทนของนักศึกษา" required />
																</div>
																<div class="col-md-3">
																	<div class="md-radio-inline">
																		<div class="md-radio">
																			<input type="radio" id="radio1" name="compensation_status" value="0" data-title="บาท/วัน" class="md-radiobtn" <?php if($resultCorp["compensation_status"] == "0") { echo "checked"; } ?> required />
																			<label for="radio1">
																				<span></span>
																				<span class="check"></span>
																				<span class="box"></span> บาท/วัน </label>
																			</div>
																			<div class="md-radio">
																				<input type="radio" id="radio2" name="compensation_status" value="1" data-title="บาท/เดือน" class="md-radiobtn" <?php if($resultCorp["compensation_status"] == "1") { echo "checked"; } ?> required />
																				<label for="radio2">
																					<span></span>
																					<span class="check"></span>
																					<span class="box"></span> บาท/เดือน </label>
																				</div>
																			</div>
																			<div id="form_compensation_status_error"> </div>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-md-4">สวัสดิการอื่นๆ ถ้ามี
																			<span class="required"> * </span>
																		</label>
																		<div class="col-md-6">
																			<div class="md-checkbox-inline">
																				<?php 
																				$sql->table="tbl_welfare";
																				$sql->condition="ORDER By id asc";
																				$queryWel = $sql->select();
																				$num = 1;
																				while($resultWel = mysqli_fetch_assoc($queryWel))
																				{
																					$sql->table="tbl_corp_welfare";
																					$sql->condition="WHERE corp_id='".$resultCorp["id"]."' and wel_id='".$resultWel["id"]."'";
																					$queryCorpWel = $sql->select();
																					$numCorpWel = mysqli_num_rows($queryCorpWel);
																					if($numCorpWel == 1)
																					{
																						$checked = "checked";
																					}
																					else
																					{
																						$checked = "";
																					}
																					?>
																					<div class="md-checkbox">
																						<input type="checkbox" id="checkbox<?php echo $num; ?>" class="md-check" name="wel_id[]" value="<?php echo $resultWel["id"]; ?>" <?php echo $checked; ?> />
																						<label for="checkbox<?php echo $num; ?>">
																							<span></span>
																							<span class="check"></span>
																							<span class="box"></span><?php echo $resultWel["wel_name"]; ?></label>
																						</div>
																						<?php
																						$num++; 
																					}
																					?>
																					<div id="form_payment_error"> </div>
																				</div>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-md-4">สวัสดิการอื่นๆ (ถ้ามีโปรดระบุ)
																				<span class="required"> </span>
																			</label>
																			<div class="col-md-6">
																				<input type="text" class="form-control" name="welfare" value="<?php echo $resultCorp["welfare"]; ?>" placeholder="(โปรดระบุ เช่น อาหาร ชุดทํางาน)" />
																			</div>
																		</div>
																	</div>
																	<div class="tab-pane" id="tab4">
																		<h3 class="block">ตรวจสอบ / ยืนยันข้อมูล</h3>
																		<h4 class="form-section">Account</h4>
																		<div class="form-group">
																			<label class="control-label col-md-3">ชื่อสถานประกอบการ:</label>
																			<div class="col-md-4">
																				<p class="form-control-static" data-display="name_th"> </p>
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
																		<input type="hidden" name="update_user" value="<?php echo $resultAdmin["id"]; ?>" />
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
					<script type="text/javascript">
						$(document).ready(function() {
							var counter = $("#count").data("counter");
							$("#addPosition").click(function() {
            // if (counter > 4) {
            //     swal("แจ้งเตือน!!!", "ไม่สามารถเพิ่มมากกว่า 4 ช่องได้", "warning");
            //     return false;
            // }
            var newTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'positionBoxDiv' + counter);

            newTextBoxDiv.after().html('<div class="form-group"><label class="control-label col-md-4">ตำแหน่งที่ ' + counter + ' <span class="required"> * </span></label><div class="col-md-6"><div class="input-group"><input type="text" name="position[]" value="" class="form-control" /><span class="input-group-btn"><input class="btn btn-danger removePosition" type="button" value="ลบตำแหน่งนี้" id="divbox'+counter+'" data-divbox="'+counter+'" style="border-radius:0px;" /></span></div></div></div><div class="form-group"><label class="control-label col-md-4">ลักษณะงานที่นักศึกษาต้องปฏิบัติ '+counter+'<span class="required"> * </span></label><div class="col-md-6"><textarea class="form-control" rows="3" name="job_description[]" placeholder="อาจเป็นงานโครงงาน งานวิจัย หรืองานที่สอดคล้องกับสาขาวิชา"></textarea></div></div><div class="form-group"><label class="control-label col-md-4">จํานวนนักศึกษาที่รับ '+counter+'<span class="required"> * </span></label><div class="col-md-6"><input type="number" name="stu_count[]" value="" class="form-control" required /></div></div>');

            newTextBoxDiv.appendTo("#positionBoxesGroup");
            counter++;
        });
        $(document).on("click", "input.removePosition" , function() { //ฟังชั่นลบ Element
        	if(counter == 2) 
        	{
        		swal("ผิดพลาด!!!", "ไม่สามารถลบได้", "error");
        		return false;
        	}
        	counter--;
        	var divBox = $(this).data("divbox");
        	$("#positionBoxDiv" + divBox).remove();
        });
    });
</script>
<script>
	var el = document.getElementById('submit_form');
	if (el) {
		el.addEventListener('submit', function(e) {
			var form = this;
			e.preventDefault();
			swal({
				title: "คุณแน่ใจหรือไม่?",
				text: "ต้องการบันทึกข้อมูล!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'ใช่, ตกลง!',
				cancelButtonText: "ไม่, ยกเลิก!",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm) {
				if (isConfirm) 
				{ 
					form.submit();
				} 
			});
		});
	}
</script>