<?php
include("../header.php");
include("../sidebar.php");

$stu_id = $_GET["id"];

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$stu_id'";
$queryStudent = $sql->select();
$resultStudent = mysqli_fetch_assoc($queryStudent);
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
			แก้ไขข้อมูลนักศึกษา
			<small><?php echo $resultStudent["username"]." - ".$resultStudent["name"]; ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="#"><i class="fa fa-dashboard"></i> จัดการข้อมูลนักศึกษา</a></li>
			<li class="active">แก้ไขข้อมูลนักศึกษา</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
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
									<form class="form-horizontal" action="do_edit.php?page=<?php echo $_GET["page"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
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
																<input type="text" name="username" id="username" class="form-control" value="<?php echo $resultStudent["username"]; ?>" readonly />
																<!-- <span class="message"></span> -->
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">รหัสผ่าน
																<span class="required"> * </span>
															</label>
															<div class="col-md-6">
																<input type="text" class="form-control" name="password" value="<?php echo $resultStudent["password"]; ?>" placeholder="รหัสผ่าน (วันเดือนปีเกิด)" required id="password" />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">ชื่อ-สกุล
																<span class="required"> * </span>
															</label>
															<div class="col-md-6">
																<input type="text" name="name" class="form-control" value="<?php echo $resultStudent["name"]; ?>" placeholder="กรอกชื่อ-นามสกุล" required />
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
																		<option value="<?php echo $resultYear["id"]; ?>" <?php if($resultStudent["accept_year_id"] == $resultYear["id"]) { echo "selected"; } ?>>ปีการศึกษา <?php echo $resultYear["academic_year"]; ?></option>
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
																<?php
																if (empty($resultStudent["picture"])) {
																	?>
																	<img id="img1" style="max-width:100%;max-height:230px">
																	<?php
																} else { 
																	?>
																	<img id="img1" src="../../upload/profile/<?php echo $resultStudent["picture"]; ?>" style="max-width:100%;max-height:230px">
																	<?php } ?>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="form-actions">
													<div class="row">
														<div class="col-md-12">
															<button type="submit" class="btn green button-submit"> เพิ่มนักศึกษา <i class="fa fa-check"></i></button>
															<input type="hidden" name="checkEditStudent" value="1" />
															<input type="hidden" name="id" value="<?php echo $resultStudent["id"]; ?>" />
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
				</section>
			</div>
			<?php include("../footer.php"); ?>