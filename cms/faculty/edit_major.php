<?php
include("../header.php");
include("../sidebar.php");

$page = $_GET["page"];
$id = $_GET["id"];
$f_id = $_GET["faculty"];

$sql->table="tbl_majors";
$sql->condition="WHERE major_id={$id}";
$query = $sql->select();
$numRow = mysqli_num_rows($query);

if( empty($numRow) ) header("location : index_major.php?page={$page}&id={$f_id}");

$results = mysqli_fetch_assoc($query);

$sql->table="tbl_faculty";
$sql->condition="WHERE faculty_id={$f_id}";
$faculty = mysqli_fetch_assoc($sql->select());

$sql->table = "tbl_faculty";
$sql->condition = "";
$query_faculty = $sql->select();
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
			จัดการสาชาวิชา
			<small>เพิ่ม-ลบ/แก้ไข สาขาวิชา</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="#"> คณะ<?=$faculty['faculty_name']?></a></li>
			<li class="active">แก้ไขสาขาวิชา <?=$results['major_name']?></li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_edit_major.php?page=<?php echo $_GET["page"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">แก้ไขสาขาวิชา <?=$results['major_name']?></h3>
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
														<h3 class="block headtext-set-center">แก้ไขสาขาวิชา <?=$results['major_name']?></h3>
														<div class="form-group">
															<label class="control-label col-md-4">เลือกคณะ
																<span class="required"> * </span>
															</label>
															<div class="col-md-4">
																<select class="form-control" name="major_faculty_id" required>
																	<?php 
																	while($result = mysqli_fetch_assoc($query_faculty)){
																		$sel = '';
																		if( $result['faculty_id'] == $id ){
																			$sel = ' selected="1"';
																		}

																		echo '<option'.$sel.' value="'.$result['faculty_id'].'">'.$result['faculty_name'].'</option>';
																	}
																	?>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">ชื่อสาขาวิชา
																<span class="required"> * </span>
															</label>
															<div class="col-md-4">
																<input type="text" name="major_name" class="form-control" placeholder="ชื่อคณะ" required  value="<?=$results['major_name']?>"/>
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
							<a href="index_faculty.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-danger pull-left">ยกเลิก</a>
							<button type="submit" id="btnSubmit" class="btn green button-submit pull-right"><i class="fa fa-check"></i> บันทึก</button>
							<input type="hidden" name="checkSubmit" value="1" />
							<input type="hidden" name="id" value="<?=$result["major_id"]?>"/>
						</div>
					</div>
				</div>
			</form>
		</section>
	</div>
	<?php include("../footer.php"); ?>