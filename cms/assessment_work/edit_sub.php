<?php
include("../header.php");
include("../sidebar.php");

$id = $_GET["id"];

$sql->table="tbl_assess_sub";
$sql->condition="WHERE id='$id'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);

$sql->table="tbl_assess_work";
$sql->condition="WHERE id='{$result["ass_id"]}'";
$queryAss = $sql->select();
$resultAss = mysqli_fetch_assoc($queryAss);
?>
<link rel="stylesheet" type="text/css" href="../../css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="../../css/cms-forminput.css">
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			แก้ไขหัวข้อการประเมิน | <?php echo $resultAss["topic"]; ?>
			<small>เพิ่ม-ลบ/แก้ไข หัวข้อการประเมิน</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="index.php?page=<?php echo $_GET["page"] ?>aid=<?php echo $_GET["aid"]; ?>"> จัดการแบบประเมินการปฏิบัติงานสหกิจศึกษา</a></li>
			<li><a href="index_sub.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>&ass_id=<?php echo $result["ass_id"]; ?>"><?php echo $resultAss["topic"]; ?></a></li>
			<li class="active"> แก้ไขหัวข้อการประเมิน</li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_edit_sub.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">แก้ไขหัวข้อการประเมิน | <?php echo $resultAss["topic"]; ?></h3>
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
															<label class="control-label col-md-3">ด้าน
																<span class="required"> * </span>
															</label>
															<div class="col-md-7">
																<select name="ass_id" class="form-control">
																	<?php 
																	$sql->table="tbl_assess_work";
																	$sql->condition="ORDER By id ASC";
																	$queryAssess = $sql->select();
																	while($resultAssess = mysqli_fetch_assoc($queryAssess))
																	{
																		?>
																		<option value="<?php echo $resultAssess["id"]; ?>" <?php if($resultAssess["id"] == $result["ass_id"]) { echo "selected"; } ?>><?php echo $resultAssess["topic"]; ?></option>
																		<?php
																	}
																	?>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3">หัวข้อ
																<span class="required"> * </span>
															</label>
															<div class="col-md-7">
																<input type="text" name="sub_topic" class="form-control" placeholder="" required value="<?php echo $result["sub_topic"]; ?>" />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3">รายละเอียด
																<span class="required"> * </span>
															</label>
															<div class="col-md-7">
																<textarea class="form-control" name="sub_detail"><?php echo $result["sub_detail"]; ?></textarea>
															</div>
														</div>
														<!-- <div class="form-group">
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
														</div> -->
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<a href="index_sub.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>&ass_id=<?php echo $_GET["ass_id"]; ?>" class="btn btn-danger pull-left">ยกเลิก</a>
								<button type="submit" id="btnSubmit" class="btn green button-submit pull-right"><i class="fa fa-check"></i> แก้ไขหัวข้อการประเมิน</button>
								<input type="hidden" name="id" value="<?php echo $result["id"]; ?>" />
								<input type="hidden" name="checkSubmit" value="1" />
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
		<?php include("../footer.php"); ?>