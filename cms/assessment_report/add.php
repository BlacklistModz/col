<?php
include("../header.php");
include("../sidebar.php");
?>
<link rel="stylesheet" type="text/css" href="../../css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="../../css/cms-forminput.css">
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			เพิ่มหัวข้อการประเมิน | แบบประเมิน รายงานการฝึกสหกิจ
			<small>เพิ่ม-ลบ/แก้ไข ด้านการประเมิน</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="index.php?page=<?php echo $_GET["page"] ?>aid=<?php echo $_GET["aid"]; ?>"><i class="fa fa-dashboard"></i> จัดการแบบประเมินรายงานการฝึกสหกิจ</a></li>
			<li class="active">เพิ่มหัวข้อการประเมิน</li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_add.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">เพิ่มด้านการประเมิน | แบบประเมินรายงานการฝึกสหกิจ</h3>
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
														<h3 class="block headtext-set-center">เพิ่มหัวข้อการประเมิน</h3>
														<div class="form-group">
															<label class="control-label col-md-3">หัวข้อ
																<span class="required"> * </span>
															</label>
															<div class="col-md-7">
																<input type="text" name="topic" class="form-control" placeholder="หัวข้อการประเมินรายงานการฝึกสหกิจ" required />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3">สถานะ
																<span class="required"> * </span>
															</label>
															<div class="col-md-7">
																<div class="radio">
																	<label><input type="radio" name="ass_status" value="0" checked> แสดงผล</label>
																</div>
																<div class="radio">
																	<label><input type="radio" name="ass_status" value="1"> ไม่แสดงผล</label>
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
								<a href="index.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>" class="btn btn-danger pull-left">ยกเลิก</a>
								<button type="submit" id="btnSubmit" class="btn green button-submit pull-right"><i class="fa fa-check"></i> เพิ่มหัวข้อการประเมิน</button>
								<input type="hidden" name="checkSubmit" value="1" />
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
		<?php include("../footer.php"); ?>