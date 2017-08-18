<?php 
include("header.php"); 

$stu_id = $_GET["stu_id"];

$sql->table="tbl_stu_job";
$sql->condition="WHERE stu_id='$stu_id' and job_status='3'";
$queryJob = $sql->select();
$numJob = mysqli_fetch_assoc($queryJob);
if($numJob <= 0)
{
	header("location:index.php?page=home");
}


$sql->table="tbl_authentication";
$sql->condition="WHERE id='$stu_id'";
$queryStu = $sql->select();
$resultStu = mysqli_fetch_assoc($queryStu);

$sql->table="tbl_student";
$sql->condition="WHERE user_id='$stu_id'";
$queryStudent = $sql->select();
$resultStudent = mysqli_fetch_assoc($queryStudent);

$sql->table="tbl_corporation";
$sql->condition="WHERE user_id='$user_id' ORDER By id DESC LIMIT 0,1";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);

$sql->table="tbl_stu_project";
$sql->condition="WHERE stu_id='$stu_id'";
$queryProject = $sql->select();
$resultProject = mysqli_fetch_assoc($queryProject);

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$queryYear = $sql->select();
$resultYear = mysqli_fetch_assoc($queryYear);

$sql->table="tbl_assess_report";
$sql->condition="ORDER By id ASC";
$query = $sql->select();
?>
<link rel="stylesheet" type="text/css" href="css/form-group.css">
<link rel="stylesheet" type="text/css" href="css/input-form-wizard.css">
<style type="text/css">
	.md-radio label>span {
		position: relative;
	}
	.md-radio label>.check {
		top: 15px;
		background: #ff9800;
	}
	.md-radio label {
		padding-left: 0px;
	}
	.md-radio {
		text-align: center;
	}
	
	.text-u {
		text-decoration: underline;
	}
	.h4color {
		color: #fe6711;
	}
	.form-read .form-control[disabled],
	.form-read .form-control[readonly],
	.form-read fieldset[disabled] .form-control {
		background-color: rgba(238, 238, 238, 0);
		opacity: 1;
	}
	.form-read .form-control {
		color: #555;
		height: 32px;
		font-size: 16px;
		background-image: none;
		border: none;
		border-radius: 0px;
		-webkit-box-shadow: none;
		box-shadow: none;
		-webkit-transition: none;
		-o-transition: none;
		transition: none;
	}
	.form-read .form-control:focus {
		outline: 0;
		-webkit-box-shadow: none;
		box-shadow: none;
	}
	.form-underline {
		border-top: 2px solid #e7ecf1;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li>
					<a href="index.php"><i class="fa fa-home"></i></a>
				</li>
				<li class="active">
					แบบประเมินผลรายงานสหกิจ
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					แบบประเมินผลรายงานสหกิจ
				</div>
			</div>
			<div class="portlet light">
				<div class="portlet-body form">
					<form class="form-horizontal" method="POST" action="ass_report.php">
						<div class="form-wizard">
							<div class="form-body">
								<h4 class="h4color">ข้อมูลทั่วไป / Work Term Information</h4>
								<div class="form-group">
									<div class="form-read">
										<label class="control-label col-md-6">ชื่อ-นามสกุลนักศึกษา / Student Name</label>
										<div class="col-md-4">
											<input type="text" class="form-control" value="<?php echo $resultStu["name"]; ?>" readonly />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="form-read">
										<label class="control-label col-md-6">รหัสประจําตัว / I.D. No</label>
										<div class="col-md-4">
											<input type="text" class="form-control" value="<?php echo $resultStu["username"]; ?>" readonly />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="form-read">
										<label class="control-label col-md-6">สาขาวิชา / Major</label>
										<div class="col-md-4">
											<input type="text" class="form-control" value="<?php echo $resultStudent["major"]; ?>" readonly />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="form-read">
										<label class="control-label col-md-6">คณะ / Faculty</label>
										<div class="col-md-4">
											<input type="text" class="form-control" value="<?php echo $resultStudent["faculty"]; ?>" readonly />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="form-read">
										<label class="control-label col-md-6">ชื่อสถานประกอบการ / Employer Name</label>
										<div class="col-md-4">
											<input type="text" class="form-control" value="<?php echo $resultCorp["name_th"]; ?>" readonly />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="form-read">
										<label class="control-label col-md-6">ชื่อ-นามสกุลผู้ประเมิน / Evaluator Name</label>
										<div class="col-md-4">
											<input type="text" class="form-control" value="<?php echo $resultProject["emp_name"]; ?>" readonly />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="form-read">
										<label class="control-label col-md-6">ตําแหน่ง / Position</label>
										<div class="col-md-4">
											<input type="text" class="form-control" value="<?php echo $resultProject["emp_position"]; ?>" readonly />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="form-read">
										<label class="control-label col-md-6">แผนก / Department</label>
										<div class="col-md-4">
											<input type="text" class="form-control" value="<?php echo $resultProject["emp_department"]; ?>" readonly />
										</div>
									</div>
								</div>

								<div class="form-underline">
									<h4 class="h4color">หัวข้อรายงาน / Report title</h4>
									<div class="form-group">
										<div class="form-read">
											<label class="control-label col-md-6">ภาษาไทย / Thai</label>
											<div class="col-md-4">
												<input type="text" class="form-control" value="<?php echo $resultProject["project_th"]; ?>" readonly />
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="form-read">
											<label class="control-label col-md-6">ภาษาอังกฤษ / English</label>
											<div class="col-md-4">
												<input type="text" class="form-control" value="<?php echo $resultProject["project_en"]; ?>" readonly />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="table-responsive">
							<table class="table table-striped table-bordered" cellspacing="0" width="100%">

								<thead>
									<tr>
										<th width="5%">ลำดับ</th>
										<th width="45%">หัวข้อการประเมิน</th>
										<th width="10%">ดีเยี่ยม</th>
										<th width="10%">ดี</th>
										<th width="10%">ปานกลาง</th>
										<th width="10%">พอใช้</th>
										<th width="10%">ควรปรับปรุง</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i=0;
									$num = 1;
									while($result = mysqli_fetch_assoc($query))
									{
										?>
										<tr>
											<td align="center"><?php echo $num; ?></td>
											<td><?php echo $result["topic"]; ?></td>
											<td>
												<div class="md-radio">
													<input type="radio" id="radio1<?php echo $i; ?>" name="ass_point[<?php echo $i; ?>]" value="5" data-title="มากที่สุด" class="md-radiobtn" />
													<label for="radio1<?php echo $i; ?>">
														<span class="check"></span>
														<span class="box"></span>
													</label>
												</div>
											</td>
											<td>
												<div class="md-radio">
													<input type="radio" id="radio2<?php echo $i; ?>" name="ass_point[<?php echo $i; ?>]" value="4" data-title="มาก" class="md-radiobtn" />
													<label for="radio2<?php echo $i; ?>">
														<span class="check"></span>
														<span class="box"></span>
													</label>
												</div>
											</td>
											<td>
												<div class="md-radio">
													<input type="radio" id="radio3<?php echo $i; ?>" name="ass_point[<?php echo $i; ?>]" value="3" data-title="มาก" class="md-radiobtn" />
													<label for="radio3<?php echo $i; ?>">
														<span class="check"></span>
														<span class="box"></span>
													</label>
												</div>
											</td>
											<td>
												<div class="md-radio">
													<input type="radio" id="radio4<?php echo $i; ?>" name="ass_point[<?php echo $i; ?>]" value="2" data-title="ปานกลาง" class="md-radiobtn" />
													<label for="radio4<?php echo $i; ?>">
														<span class="check"></span>
														<span class="box"></span>
													</label>
												</div>
											</td>
											<td>
												<div class="md-radio">
													<input type="radio" id="radio5<?php echo $i; ?>" name="ass_point[<?php echo $i; ?>]" value="1" data-title="มาก" class="md-radiobtn" />
													<label for="radio5<?php echo $i; ?>">
														<span class="check"></span>
														<span class="box"></span>
													</label>
												</div>
											</td>
										</tr>
										<input type="hidden" name="ass_topic_id[<?php echo $i; ?>]" value="<?php echo $result["id"] ?>"/>
										<?php 
										$i++;$num++;
									}
									?>
								</tbody>
							</table>
						</div>
						<div class="form-wizard">
							<div class="form-body">
								<div class="form-group">
									<label class="control-label col-md-4">ข้อคิดเห็นเพิ่มเติม / Other Comments</label>
									<div class="col-md-6">
										<textarea class="form-control" rows="3" name="assess_comment" placeholder="กรุณาข้อคิดเห็นเพิ่มเติม / Other Comments"></textarea>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="checkSubmit" value="1" />
						<input type="hidden" name="stu_id" value="<?php echo $resultStu["id"]; ?>" />
						<input type="hidden" name="corp_id" value="<?php echo $resultCorp["id"]; ?>" />
						<input type="hidden" name="year_id" value="<?php echo $resultYear["id"]; ?>" />
						<button class="btn btn-success" type="submit">บันทึก</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>