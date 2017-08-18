<?php
include("../header.php");
include("../sidebar.php");

$id = $_GET["wid"];

$sql->table="tbl_infomation";
$sql->condition="WHERE id='$id'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);
?>
<link rel="stylesheet" type="text/css" href="../../css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="../../css/cms-forminput.css">
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการข้อมูล <?php echo $result["name"]; ?>
			<!-- <small>เพิ่ม-ลบ/แก้ไข ข้อมูลนักศึกษา</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active"><i class="fa fa-dashboard"></i> จัดการข้อมูล <?php echo $result["name"]; ?></li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_edit.php?page=<?php echo $_GET["page"]; ?>&wid=<?php echo $_GET["wid"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title"><?php echo $result["name"]; ?></h3>
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
														<h3 class="block headtext-set-center">จัดการข้อมูล <?php echo $result["name"]; ?></h3>
														<div class="form-group">
															<label class="control-label col-md-2">หัวข้อเมนู
																<span class="required"> * </span>
															</label>
															<div class="col-md-10">
																<input type="text" name="name" class="form-control" placeholder="หัวข้อข่าวสารประชาสัมพันธ์" required value="<?php echo $result["name"]; ?>" />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-2">รายละเอียด
																<span class="required"> * </span>
															</label>
															<div class="col-md-10">
																<textarea class="textarea form-control" name="detail" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
																	<?php echo $result["detail"]; ?>
																</textarea>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-2">สถานะ
																<span class="required"> * </span>
															</label>
															<div class="col-md-10">
																<div class="radio">
																	<label><input type="radio" name="info_status" value="0" <?php if($result["info_status"] == "0") {  echo "checked"; } ?>> แสดงผล</label>
																</div>
																<div class="radio">
																	<label><input type="radio" name="info_status" value="1"  <?php if($result["info_status"] == "1") {  echo "checked"; } ?>> ไม่แสดงผล</label>
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
								<button type="submit" id="btnSubmit" class="btn green button-submit"><i class="fa fa-check"></i> บันทึก <?php echo $result["name"]; ?></button>
								<input type="hidden" name="checkSubmit" value="1" />
								<input type="hidden" name="id" value="<?php echo $result["id"]; ?>" />
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
		<?php include("../footer.php"); ?>
		<script type="text/javascript">
			$(function () 
			{
				$(".textarea").wysihtml5();
			});
		</script>