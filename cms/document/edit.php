<?php
include("../header.php");
include("../sidebar.php");

$id = $_GET["id"];

$sql->table="tbl_document";
$sql->condition="WHERE id='$id'";
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
			จัดการเอกสารสหกิจศึกษา
			<small>แก้ไข-ลบ/แก้ไข เอกสารสหกิจศึกษา</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="#"><i class="fa fa-dashboard"></i> จัดการเอกสารสหกิจศึกษา</a></li>
			<li class="active">แก้ไขข้อมูลเอกสารสหกิจ</li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_edit.php?page=<?php echo $_GET["page"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">แก้ไขข้อมูลเอกสารสหกิจ</h3>
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
														<h3 class="block headtext-set-center">แก้ไขเอกสารสหกิจศึกษา</h3>
														<div class="form-group">
															<label class="control-label col-md-4">ชื่อเอกสาร
																<span class="required"> * </span>
															</label>
															<div class="col-md-6">
																<input type="text" class="form-control" name="doc_name" placeholder="กรอกชื่อเอกสาร" required value="<?php echo $result["doc_name"]; ?>" />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">เอกสาร : 
																<span class="required"></span>
															</label>
															<div class="col-md-6">
																<div class="fileUpload btn btn-warning">
																	<span>อัพโหลดเอกสาร</span>
																	<input type="file" name="doc_file" class="upload" accept="application/pdf,application/msword" />
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">กำหนดส่งเอกสาร
																<br/><span class="required"> (หากไม่ต้องส่ง ไม่ต้องกรอกข้อมูล) </span>
															</label>
															<div class="col-md-6">
																<input type="date" class="form-control" name="doc_date" placeholder="" value="<?php echo $result["doc_date"]; ?>"/>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">รูปแบบเอกสาร : 
																<span class="required"></span>
															</label>
															<div class="col-md-6">
																<div class="radio">
																	<label><input type="radio" name="doc_status" value="0" <?php if($result["doc_status"] == "0") { echo "checked"; } ?> /> ส่งแบบครั้งเดียว</label>
																</div>
																<div class="radio">
																	<label><input type="radio" name="doc_status" value="1" <?php if($result["doc_status"] == "1") { echo "checked"; } ?> /> ส่งมากกว่า 1 ครั้ง</label>
																</div>
																<div class="radio">
																	<label><input type="radio" name="doc_status" value="2" <?php if($result["doc_status"] == "2") { echo "checked"; } ?> /> เอกสารโครงร่างรายงานปฏิบัติงาน (SE-CO-007)</label>
																</div>
																<div class="radio">
																	<label><input type="radio" name="doc_status" value="3" <?php if($result["doc_status"] == "3") { echo "checked"; } ?> /> ส่งสมุดคู่มือฯ และรายงานผลงานสหกิจ)</label>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">หมายเหตุ 
																<span class="required"></span>
															</label>
															<div class="col-md-6">
																<label class="text-blue">1. เอกสารสหกิจแบบส่งครั้งเดียว คือ เอกสารที่ส่งได้แค่ 1 ไฟล์ หากนักศึกษาอัพโหลดมากกว่า 1 ครั้ง ระบบจะลบไฟล์เดิม และแทนที่ด้วยไฟล์ใหม่</label>
																<label class="text-blue">2. เอกสารแบบส่งมากกว่า 1 ครั้ง คือ เอกสารที่สามารถส่งได้หลายครั้ง ครั้งละตั้งแต่ 1 ไฟล์ขึ้นไป นักศึกษาสามารถ "ลบ" เอกสารที่อัพโหลดผิดพลาดได้เอง</label>
																<label class="text-blue">3. เอกสารโครงร่างรายงานปฏิบัติงาน (SE-CO-007) คือ เอกสารที่ต้องมีการระบุ ชื่อโครงงาน , ชื่อ-นามสกุลผู้มอบหมายงาน และรายละเอียดต่างๆของผู้มอบหมายงาน (เป็นการส่งแบบ 1 ครั้ง จะดำเนินการลบไฟล์เดิม และแทนที่ด้วยไฟล์ใหม่ให้อัตโนมัติ)</label>
																<label class="text-blue">4. สมุดคู่มือการปฏิบัติงาน (SE-CO-009) และรายงานผลงานสหกิจ (ส่งแบบครั้งเดียว หากส่งครั้งต่อไป ระบบจะลบไฟล์เดิม และแทนที่ด้วยไฟล์ใหม่ให้อัตโนมัติ)</label>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">ดูไฟล์เอกสารปัจจุบัน
																<span class="required"> (ดาวโหลด) </span>
															</label>
															<div class="col-md-6">
																<a href="../../upload/doc/<?php echo $result["doc_file"]; ?>" class="form-control" target="_blank"><?php echo $result["doc_name"]; ?></a>
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
								<input type="hidden" name="id" value="<?php echo $result["id"]; ?>" />
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
		<?php include("../footer.php"); ?>