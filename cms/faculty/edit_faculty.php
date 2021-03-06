<?php
include("../header.php");
include("../sidebar.php");

$page = $_GET["page"];

if( empty($_GET["id"]) ){
	header("location:index.php?page=".$page);
}

$id = mysqli_real_escape_string($sql->connect, $_GET["id"]);

$sql->table="tbl_faculty";
$sql->condition="WHERE faculty_id={$id}";
$query = $sql->select();
$numRow = mysqli_num_rows($query);
if( $numRow < 0 || $numRow > 1 ){
	header("location:index.php?page=".$page);
}

$results = mysqli_fetch_assoc($query);
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
			จัดการคณะ
			<small>เพิ่ม-ลบ/แก้ไข คณะ</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="#"><i class="fa fa-dashboard"></i> จัดการคณะ</a></li>
			<li class="active">เพิ่มข้อมูลคณะ</li>
		</ol>
	</section>
	<section class="content">
		<form class="form-horizontal" action="do_edit_faculty.php?page=<?php echo $_GET["page"]; ?>" name="form_student" method="POST"  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title">แก้ไขข้อมูลคณะ</h3>
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
														<h3 class="block headtext-set-center">แก้ไขคณะ</h3>
														<div class="form-group">
															<label class="control-label col-md-4">ชื่อคณะ
																<span class="required"> * </span>
															</label>
															<div class="col-md-4">
																<input type="text" name="faculty_name" class="form-control" placeholder="ชื่อคณะ" required value="<?php echo $results["faculty_name"]; ?>" />
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
							<a href="index.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-danger pull-left">ยกเลิก</a>
							<button type="submit" id="btnSubmit" class="btn green button-submit pull-right"><i class="fa fa-check"></i> บันทึก</button>
							<input type="hidden" name="checkSubmit" value="1" />
							<input type="hidden" name="id" value="<?php echo $id; ?>" />
						</div>
					</div>
				</div>
			</form>
		</section>
	</div>
	<?php include("../footer.php"); ?>