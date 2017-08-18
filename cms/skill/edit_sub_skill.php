<?php
include("../header.php");
include("../sidebar.php");

$skill_id = $_GET["skill_id"];
$sub_id = $_GET["id"];

$sql->table="tbl_skill";
$sql->condition="WHERE id='$skill_id'";
$querySkill = $sql->select();
$resultSkill = mysqli_fetch_assoc($querySkill);

$sql->table="tbl_sub_skill";
$sql->condition="WHERE id='$sub_id'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);
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
			จัดการข้อมูลความสามารถพิเศษ
			<small>เพิ่ม-ลบ/แก้ไข ประเภทความสามารถพิเศษ</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="index.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>"><i></i> จัดการข้อมูลความสามารถพิเศษ</a></li>
			<li><a href="index_subskill.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>&id=<?php echo $skill_id; ?>"><i></i> จัดการความสามารถพิเศษ (<?php echo $resultSkill["skill_name"]; ?>)</a></li>
			<li class="active">แก้ไขความสามารถพิเศษ</li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_edit_sub_skill.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">แก้ไขความสามารถพิเศษ</h3>
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
														<h3 class="block headtext-set-center">แก้ไขความสามารถพิเศษ</h3>
														<div class="form-group">
															<label class="control-label col-md-4">ประเภทความสามารถพิเศษ
																<span class="required"> * </span>
															</label>
															<div class="col-md-6">
																<select class="form-control" name="skill_id">
																	<?php 
																	$sql->table="tbl_skill";
																	$sql->condition="";
																	$querySelect = $sql->select();
																	while($resultSelect = mysqli_fetch_assoc($querySelect))
																	{
																		?>
																		<option value="<?php echo $resultSelect["id"]; ?>" <?php if($resultSelect["id"] == $skill_id) { echo "selected"; } ?>><?php echo $resultSelect["skill_name"]; ?></option>
																		<?php
																	}
																	?>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">ความสามารถพิเศษ
																<span class="required"> * </span>
															</label>
															<div class="col-md-6">
																<input type="text" class="form-control" name="sub_name" placeholder="กรอกประเภทความสามารถพิเศษ" required value="<?php echo $result["sub_name"]; ?>" />
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
								<a href="index_subskill.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>&id=<?php echo $skill_id; ?>" class="btn btn-danger pull-left">ยกเลิก</a>
								<button type="submit" id="btnSubmit" class="btn green button-submit pull-right"><i class="fa fa-check"></i> บันทึก</button>
								<input type="hidden" name="checkSubmit" value="1" />
								<input type="hidden" name="id" value="<?php echo $result["id"]; ?>"/>
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
		<?php include("../footer.php"); ?>