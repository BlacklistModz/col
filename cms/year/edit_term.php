<?php
include("../header.php");
include("../sidebar.php");
include("../../class/DateSwitch.Bootstrap.php");

$id = $_GET["id"];

$sql->table="tbl_term";
$sql->condition="WHERE term_id={$id}";
$query = $sql->select();
$numRow = mysqli_num_rows($query);

$sql->table="tbl_year";
$sql->condition="ORDER BY academic_year DESC";
$q_year = $sql->select();

if( empty($numRow) || $numRow > 1 ) header("location : index.php?page={$_GET["page"]}");

$result = mysqli_fetch_assoc($query);
?>
<link rel="stylesheet" type="text/css" href="../../css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="../../css/cms-forminput.css">
<link rel="stylesheet" type="text/css" href="../../css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="../../css/jquery-ui-timepicker-addon.css">
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
			แก้ไขภาคเรียน
			<small>เพิ่ม-ลบ/แก้ไข ภาคเรียน</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="#"><i class="fa fa-dashboard"></i> จัดการภาคเรียน</a></li>
			<li class="active">แก้ไขภาคเรียน</li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_edit_term.php?page=<?php echo $_GET["page"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">แก้ไขภาคเรียน</h3>
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

												<h3 class="block headtext-set-center">แก้ไขภาคเรียน</h3>
												<div class="form-group">
													<label class="control-label col-md-4">ปีการศึกษา
														<span class="required"> * </span>
													</label>
													<div class="col-md-4">
														<select class="form-control" name="term_year_id">
															<?php 
															while($rs_year = mysqli_fetch_assoc($q_year)){
																$sel = "";
																if( $result["term_year_id"] == $rs_year["id"] ){
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
														<input type="text" name="term_name" class="form-control" value="<?=$result["term_name"]?>" required />
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-4"> ช่วงเวลา
														<span class="required"> * </span>
													</label>
													<div class="col-md-2">
														<div class="input-group">
														<div class="input-group-addon">เริ่ม</div>
															<input type="text" name="term_start" id="term_start" class="form-control" required readonly value="<?=DateOutSQL($result["term_start"])?>"/>
														</div>
													</div>
													<div class="col-md-2">
														<div class="input-group">
														<div class="input-group-addon">สิ้นสุด</div>
															<input type="text" name="term_end" id="term_end" class="form-control" required readonly value="<?=DateOutSQL($result["term_end"])?>"/>
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
								<button type="submit" id="btnSubmit" class="btn green button-submit pull-right"><i class="fa fa-check"></i> เพิ่มปีการศึกษา</button>
								<input type="hidden" name="checkSubmit" value="1" />
								<input type="hidden" name="id" value="<?=$id?>" />
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
		<?php include("../footer.php"); ?>
		<script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../../js/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="../../js/jquery-ui-sliderAccess.js"></script>
		<script type="text/javascript" src="../../js/jquery-start-end-date.js"></script>