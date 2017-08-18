<?php
include("../header.php");
include("../sidebar.php");

$id = $_GET["id"];

$sql->table="tbl_news";
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
			แก้ไขข้อมูลนักศึกษา
			<small>เพิ่ม-ลบ/แก้ไข ข้อมูลนักศึกษา</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="#"><i class="fa fa-dashboard"></i> จัดการข้อมูลข่าวสารประชาสัมพันธ์</a></li>
			<li class="active">แก้ไขข้อมูลข่าวสารประชาสัมพันธ์</li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_edit.php?page=<?php echo $_GET["page"]; ?>&wid=<?php echo $_GET["wid"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">แก้ไขข้อมูลนักศึกษา</h3>
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
														<h3 class="block headtext-set-center">แก้ไขข่าวสารประชาสัมพันธ์</h3>
														<div class="form-group">
															<label class="control-label col-md-2">ประเภทข่าวสาร
																<span class="required"> * </span>
															</label>
															<div class="col-md-10">
																<select class="form-control" name="cate_id">
																	<option value="1" <?php if($result["cate_id"] == "1") { echo "selected"; } ?>>ข่าวสารประชาสัมพันธ์</option>
																	<option value="2" <?php if($result["cate_id"] == "2") { echo "selected"; } ?>>ข่าวสารกิจกรรม</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-2">หัวข้อ
																<span class="required"> * </span>
															</label>
															<div class="col-md-10">
																<input type="text" name="topic" class="form-control" placeholder="หัวข้อข่าวสารประชาสัมพันธ์" required value="<?php echo $result["topic"]; ?>" />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-2">รายละเอียด(ย่อ)
																<span class="required"> * </span>
															</label>
															<div class="col-md-10">
																<input type="text" name="short_detail" class="form-control" placeholder="รายละเอียดอย่างสั้น<?php echo $cate_name; ?>" required value="<?php echo $result["short_detail"]; ?>" />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-2">รายละเอียด
																<span class="required"> * </span>
															</label>
															<div class="col-md-10">
																<textarea class="textarea form-control" name="detail" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $result["detail"]; ?></textarea>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-2">รูปภาพ
																<span class="required"><br/>สามารถเลือกได้หลายรูป</span>
															</label>
															<div class="col-md-10">
																<span>อัพโหลดรูปโปรไฟล์</span>
																<input type="file" name="img[]" id="img" accept="image/gif,image/jpeg,image/jpg,image/png" multiple />
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-2">
																<span class="required"></span>
															</label>
															<div class="col-md-10">
																<?php
																$sql->table="tbl_news_img";
																$sql->condition="WHERE news_id='$id'";
																$queryImg = $sql->select();
																$numImg = mysqli_num_rows($queryImg);
																if($numImg > 0)
																{
																	while($resultImg = mysqli_fetch_assoc($queryImg))
																	{
																		?>
																		<div class="col-md-3">
																			<img id="img1" src="../../upload/news/<?php echo $resultImg["img"]; ?>" style="max-width:100%;max-height:250px">
																			<a href="do_delete_img.php?page=<?php echo $_GET["page"]; ?>&wid=<?php echo $_GET["wid"]; ?>&cate_id=<?php echo $_GET["cate_id"]; ?>&id=<?php echo $resultImg["id"]; ?>" class="btn btn-danger pull-right">X</a>
																		</div>
																		<?php
																	}
																}
																else
																{
																	?>
																	<div class="text-center">
																		<img id="img1" src="../../img/noimg.jpg" style="max-width:100%;max-height:500px">
																	</div>
																	<?php
																}
																?>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-2">สถานะ
																<span class="required"> * </span>
															</label>
															<div class="col-md-10">
																<div class="radio">
																	<label><input type="radio" name="news_status" value="0" <?php if($result["news_status"] == "0") {  echo "checked"; } ?>> แสดงผล</label>
																</div>
																<div class="radio">
																	<label><input type="radio" name="news_status" value="1"  <?php if($result["news_status"] == "1") {  echo "checked"; } ?>> ไม่แสดงผล</label>
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
								<a href="index.php?page=<?php echo $_GET["page"]; ?>&wid=<?php echo $_GET["wid"]; ?>&cate_id=<?php echo $_GET["cate_id"]; ?>" class="btn btn-danger pull-left">ยกเลิก</a>
								<button type="submit" id="btnSubmit" class="btn green button-submit pull-right"><i class="fa fa-check"></i> เพิ่มข่าวสารประชาสัมพันธ์</button>
								<input type="hidden" name="checkEditNews" value="1" />
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
