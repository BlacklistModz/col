<?php
include("../header.php");
include("../sidebar.php");

$id = $_GET["id"];

$sql->table="tbl_year";
$sql->condition="WHERE id={$id}";
$qy = $sql->select();
$numQY = mysqli_num_rows($qy);
$rs = mysqli_fetch_assoc($qy);

if( empty($numQY) || $numQY > 1 ) header("location : index.php?page={$_GET["page"]}");

$sql->table="tbl_year";
$sql->condition="ORDER BY academic_year DESC";
$query = $sql->select();
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
			เพิ่มภาคเรียน
			<small>เพิ่ม-ลบ/แก้ไข ภาคเรียน</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="#"><i class="fa fa-dashboard"></i> จัดการภาคเรียน</a></li>
			<li class="active">เพิ่มภาคเรียน</li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_add_term.php?page=<?php echo $_GET["page"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">เพิ่มภาคเรียน</h3>
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

												<h3 class="block headtext-set-center">เพิ่มปีการศึกษา</h3>
												<div class="form-group">
													<label class="control-label col-md-4">ปีการศึกษา
														<span class="required"> * </span>
													</label>
													<div class="col-md-4">
														<select class="form-control" name="term_year_id">
															<?php 
															while($rs_year = mysqli_fetch_assoc($query)){
																$sel = "";
																if( $rs["id"] == $rs_year["id"] ){
																	$sel = ' selected="1"';
																}

																echo '<option'.$sel.' value="'.$rs_year["id"].'">ปีการศึกษา '.$rs_year["academic_year"].'</option>';
															}
															?>
														</select>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-4">ภาคเรียนที่
														<span class="required"> * </span>
													</label>
													<div class="col-md-4">
														<input type="text" name="term_name" class="form-control" value="" required />
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-4"> ช่วงเวลา
														<span class="required"> * </span>
													</label>
													<div class="col-md-2">
														<input type="date" name="term_start" class="form-control" value="" required />
													</div>
													<div class="col-md-2">
														<input type="date" name="term_end" class="form-control" value="" required />
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<a href="index.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-danger pull-left">ยกเลิก</a>
								<button type="submit" id="btnSubmit" class="btn green button-submit pull-right"><i class="fa fa-check"></i> เพิ่มปีการศึกษา</button>
								<input type="hidden" name="checkSubmit" value="1" />
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
		<?php include("../footer.php"); ?>