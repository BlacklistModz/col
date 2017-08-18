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
			จัดการรูปภาพสไลด์
			<small>เพิ่ม-ลบ/แก้ไข รูปภาพสไลด์</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="#"><i class="fa fa-dashboard"></i> จัดการรูปสไลด์หน้าเว็บไซต์</a></li>
			<li class="active">เพิ่มข้อมูลรูปภาพสไลด์</li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_add.php?page=<?php echo $_GET["page"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">เพิ่มข้อมูลรูปภาพสไลด์</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="ซ่อน" style="box-shadow: none">
									<i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="portlet light" id="form_wizard_1">
									<div class="portlet-body form">
										<div class="form-wizard">
											<div class="form-body">
												<div class="tab-content">
													<div class="tab-pane active" id="tab1">
														<h3 class="block headtext-set-center">ข้อมูลรูปภาพสไลด์</h3>
														<div class="form-group">
															<label class="control-label col-md-2">รูปภาพ
																<span class="required"></span>
															</label>
															<div class="col-md-10">
																<div class="fileUpload btn btn-warning">
																	<span>อัพโหลดรูปสไลด์</span>
																	<input type="file" name="img" id="img" onchange="setImage(this,1);" class="upload" accept="image/gif,image/jpeg,image/jpg,image/png" required />
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-2">
																<span class="required"></span>
															</label>
															<div class="col-md-10">
																<img id="img1" style="max-width:100%;max-height:500px">
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-2">สถานะ
																<span class="required"> * </span>
															</label>
															<div class="col-md-10">
																<div class="radio">
																	<label><input type="radio" name="slide_status" value="0" checked> แสดงผล</label>
																</div>
																<div class="radio">
																	<label><input type="radio" name="slide_status" value="1"> ไม่แสดงผล</label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="box-footer">
								<a href="index.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-danger pull-left">ยกเลิก</a>
								<button type="submit" id="btnSubmit" class="btn green button-submit pull-right"><i class="fa fa-check"></i> บันทึก</button>
								<input type="hidden" name="checkSubmit" value="1" />
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
		<?php include("../footer.php"); ?>