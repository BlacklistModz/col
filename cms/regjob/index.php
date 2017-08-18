<?php
include("../header.php");
include("../sidebar.php");

$sql->table="tbl_rulejob";
$sql->condition="WHERE id='1'";
$result = mysqli_fetch_assoc($sql->select());
?>
<link rel="stylesheet" type="text/css" href="../../css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="../../css/cms-forminput.css">
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการสิทธิ์การสมัครงานของนักศึกษา
			<!-- <small>เพิ่ม-ลบ/แก้ไข ข้อมูลนักศึกษา</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active"><i class="fa fa-dashboard"></i> จัดการสิทธิ์การสมัครงานของนักศึกษา</li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_edit.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">จัดการสิทธิ์การสมัครงานของนักศึกษา</h3>
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
														<h3 class="block headtext-set-center">จัดการสิทธิ์ในการสมัครงานของนักศึกษา</h3>

														<div class="form-group">
															<label class="control-label col-md-6">จำนวนตำแหน่งที่นักศึกษาสามารถสมัครได้
																<span class="required"> * </span>
															</label>
															<div class="col-md-3">
																<div class="form-inline">
																	<input type="number" name="num_job" class="form-control" required value="<?php echo $result["num_job"]; ?>" /> ตำแหน่ง / ต่อคน
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
							<div class="box-footer text-center">
								<button type="submit" id="btnSubmit" class="btn green button-submit"><i class="fa fa-check"></i> บันทึก </button>
								<input type="hidden" name="checkSubmit" value="1" />
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
		<?php include("../footer.php"); ?>