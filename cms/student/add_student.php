<?php
include("../header.php");
include("../sidebar.php");
?>
<link rel="stylesheet" type="text/css" href="../../css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="../../css/cms-forminput.css">
<style type="text/css">
	.fileUpload {
		position: relative;
		overflow: hidden;
		/*margin: 10px;*/
	}
	.fileUpload input.upload {
		position: absolute;
		top: 0;
		right: 0;
		margin: 0;
		padding: 0;
		font-size: 20px;
		cursor: pointer;
		opacity: 0;
		filter: alpha(opacity=0);
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			เพิ่มข้อมูลนักศึกษา
			<small>เพิ่ม-ลบ/แก้ไข ข้อมูลนักศึกษา</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="#"><i class="fa fa-dashboard"></i> จัดการข้อมูลนักศึกษา</a></li>
			<li class="active">เพิ่มข้อมูลนักศึกษา</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">เพิ่มข้อมูลนักศึกษา</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="ซ่อน" style="box-shadow: none">
								<i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="portlet light" id="form_wizard_1">
								<div class="portlet-body form">
									<form class="form-horizontal" action="do_add.php?page=<?php echo $_GET["page"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
										<div class="form-wizard">
											<div class="form-body">
												<div class="tab-content">
													<div class="tab-pane active" id="tab1">
														<h3 class="block headtext-set-center">ข้อมูลนักศึกษาสหกิจ</h3>
														<div class="form-group">
															<label class="control-label col-md-4">รหัสนักศึกษา
																<span class="required"> * </span>
															</label>
															<div class="col-md-6">
																<input type="text" name="username" id="username" class="form-control" maxlength="16" minlength="5" pattern="^[a-zA-Z0-9]{5,16}$" title="ภาษาอังกฤษ/ตัวเลข เท่านั้น" placeholder="กรอกรหัสนักศึกษา" required />
																<!-- <span class="message"></span> -->
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">รหัสผ่าน
																<span class="required"> * </span>
															</label>
															<div class="col-md-6">
																<input type="password" class="form-control" name="password" placeholder="รหัสผ่าน (วันเดือนปีเกิด)" required id="password" />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">ยืนยันรหัสผ่าน
																<span class="required"> * </span>
															</label>
															<div class="col-md-6">
																<input type="password" name="confirm_pass" class="form-control" placeholder="ยืนยันรหัสผ่าน (วันเดือนปีเกิด)" required id="confirm_pass" />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">ชื่อ-สกุล
																<span class="required"> * </span>
															</label>
															<div class="col-md-6">
																<input type="text" name="name" class="form-control" placeholder="กรอกชื่อ-นามสกุล" required />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">ปีการศึกษา
																<span class="required"> * </span>
															</label>
															<div class="col-md-6">
																<select name="year_id" class="form-control">
																	<?php 
																	$sql->table="tbl_year";
																	$sql->condition="ORDER By academic_year DESC";
																	$queryYear = $sql->select();
																	while($resultYear = mysqli_fetch_assoc($queryYear))
																	{
																		?>
																		<option value="<?php echo $resultYear["id"]; ?>">ปีการศึกษา <?php echo $resultYear["academic_year"]; ?></option>
																		<?php
																	}
																	?>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">รูปประจำตัว
																<span class="required"></span>
															</label>
															<div class="col-md-6">
																<div class="fileUpload btn btn-warning">
																	<span>อัพโหลดรูปโปรไฟล์</span>
																	<input type="file" name="picture" id="img" onchange="setImage(this,1);" class="upload" accept="image/gif,image/jpeg,image/jpg,image/png" />
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">
																<span class="required"></span>
															</label>
															<div class="col-md-6">
																<img id="img1" style="max-width:100%;max-height:230px">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-12">
														<button type="submit" id="btnSubmit" class="btn green button-submit"> เพิ่มนักศึกษา <i class="fa fa-check"></i></button>
														<input type="hidden" name="checkAddStudent" value="1" />
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
				<div class="col-md-6">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">เพิ่มข้อมูลนักศึกษาในรูปแบบไฟล์</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="ซ่อน" style="box-shadow: none">
									<i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="portlet light" id="form_wizard_1">
									<div class="portlet-body form">
										<form class="form-horizontal" action="do_add_file.php?page=<?php echo $_GET["page"]; ?>" name="form_file" method="POST" onSubmit="return check();" enctype="multipart/form-data">
											<div class="form-wizard">
												<div class="form-body">
													<div class="tab-content">
														<div class="tab-pane active" id="tab1">
															<h3 class="block headtext-set-center">กรุณาเลือกไฟล์ที่ต้องการอัพโหลด</h3>
															<div class="form-group">
																<label class="control-label col-md-4">ไฟล์ตัวอย่าง (Excel)
																	<span class="required"> * </span>
																</label>
																<div class="col-md-6">
																	<a href="../../plugin/phpexcel/example.xlsx" class="form-control">Click ! เพื่อดาวน์โหลดไฟล์ตัวอย่าง</a>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-md-4">ไฟล์ (Excel)
																	<span class="required"> * </span>
																</label>
																<div class="col-md-6">
																	<div class="">
																		<input type="file" name="studentfile" class="form-control" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
																	</div>
																</div>
															</div>
															<div class="form-actions">
																<div class="row">
																	<div class="col-md-12">
																		<button type="submit" id="btnSubmitFile" class="btn green button-submit"> บันทึกข้อมูล <i class="fa fa-check"></i></button>
																		<input type="hidden" name="checkAddStudent" value="1" />
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<a href="index.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-primary pull-right">กลับหน้าหลัก</a>
						</div>
					</div>
				</section>
			</div>
			<?php include("../footer.php"); ?>
			<script type="text/javascript">
				$(document).ready(function(){
					$('#btnSubmit').click(function(){
						var check = check_username();
						check.success(function(data){
							if (data != 1){
								$('#form_student').submit();
								return false;
							}
						});
					});
					$('#username').focusout(function(){
						var check = check_username();
						check.success(function(data){
							if (data == 1){
								$('.message')
								swal("แจ้งเตือน!!!","Username นี้ไม่สามารถใช้ได้ กรุณาลองใหม่อีกครั้ง!","warning");
								document.getElementById("btnSubmit").disabled = true;
							} else {
								$('.message').html('');
								document.getElementById("btnSubmit").disabled = false;
							}
						});
					});
				});
				function check_username(){
					return $.ajax({
						type: 'POST',
						data: {username: $('#username').val()},
						url: '../../class/username_check.php'
					});
				}
				$('#btnSubmit').click(function()
				{
					if($("#password").val() != $("#confirm_pass").val())
					{
						swal("ผิดพลาด","กรุณากรอกรหัสผ่านให้ตรงกัน","error")
						return false
					}
				});
			</script>