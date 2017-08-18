<?php 
include("header.php"); 
if($resultUser["status_id"] != "3")
{
	header("location:index.php?page=home");
}

$stu_id = $_GET["stu_id"];

$sql->table="tbl_stu_asswork";
$sql->condition="WHERE stu_id='$stu_id'";
$queryAssess = $sql->select();
$numAssess = mysqli_num_rows($queryAssess);
if($numAssess > 0)
{
	$alert = "ไม่สามารถทำการประเมินนักศึกษาคนที่ได้รับการประเมินแล้ว";
	$location = "corp_assess.php";
}

$sql->table="tbl_stu_job INNER JOIN tbl_position ON tbl_stu_job.pos_id = tbl_position.id INNER JOIN tbl_corporation ON tbl_position.corp_id = tbl_corporation.id INNER JOIN tbl_authentication ON tbl_stu_job.stu_id = tbl_authentication.id";
$sql->field="stu_id,username,name,pos_name";
$sql->condition = "WHERE tbl_corporation.user_id='$user_id' and tbl_stu_job.job_status='3' and tbl_stu_job.stu_id='$stu_id'";
$queryCheck = $sql->select();
$numRowCheck = mysqli_num_rows($queryCheck);
if($numRowCheck != "1")
{
	header("location:index.php?page=home");
}
$resultPos = mysqli_fetch_assoc($queryCheck);

$sql->table="tbl_corporation";
$sql->field="*";
$sql->condition="WHERE user_id='$user_id' ORDER By id DESC LIMIT 0,1";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$stu_id'";
$queryStu = $sql->select();
$resultStu = mysqli_fetch_assoc($queryStu);

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$queryYear = $sql->select();
$resultYear = mysqli_fetch_assoc($queryYear);

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
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li>
					<a href="index.php"><i class="fa fa-home"></i></a>
				</li>
				<li class="active">
					แบบประเมินผลการปฏิบัติงานสหกิจ
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					แบบประเมินผลการปฏิบัติงานสหกิจ | <?php echo $resultStu["username"]." - ".$resultStu["name"]; ?> (ปีการศึกษา <?php echo $resultYear["academic_year"]; ?>)
				</div>
			</div>
			<div class="portlet light">
				<form action="ass_work.php" method="POST" name="ass_work">
					<?php 
					$sql->table="tbl_assess_work";
					$sql->condition="WHERE ass_status='0' ORDER By id ASC";
					$query = $sql->select();
					$num=1;
					$i=0;
					while($result = mysqli_fetch_assoc($query))
					{
						?>
						<h4 class="h4color"><?php echo $result["topic"]; ?></h4>
						<div class="table-responsive">
							<table class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th width="5%">ลำดับ</th>
										<th width="45%">หัวข้อการประเมิน</th>
										<th width="10%">มากที่สุด</th>
										<th width="10%">มาก</th>
										<th width="10%">ปานกลาง</th>
										<th width="10%">น้อย</th>
										<th width="10%">น้อยที่สุด</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$sql->table="tbl_assess_sub";
									$sql->condition="WHERE ass_id='{$result["id"]}'";
									$querySub = $sql->select();
									while($resultSub = mysqli_fetch_assoc($querySub))
									{
										?>
										<tr>
											<td align="center"><?php echo $num; ?></td>
											<td>
												<label class="text-u"><?php echo $resultSub["sub_topic"]; ?></label><br/>
												<?php echo nl2br($resultSub["sub_detail"]); ?>
											</td>
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
											<input type="hidden" name="ass_sub_id[<?php echo $i; ?>]" value="<?php echo $resultSub["id"]; ?>" />
										</tr>
										<?php 
										$num++; $i++;
									}
									?>
								</tbody>
							</table>
						</div>
						<?php 
					}
					?>
					<h4 class="h4color">โปรดให้ข้อคิดเห็นที่เป็นประโยชน์แก่นักศึกษา / Please give comments on the student.</h4>
					<div class="table-responsive">
						<table class="table table-bordered" cellspacing="0" width="100%">

							<thead>
								<tr>
									<th width="50%" class="text-u">จุดเด่นของนักศึกษา / Strength</th>
									<th width="50%" class="text-u">ข้อควรปรับปรุงของนักศึกษา / Improvement</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<textarea class="form-control" rows="3" name="stu_strength" placeholder="กรุณาระบุ จุดเด่นของนักศึกษา"></textarea>
									</td>
									<td>
										<textarea class="form-control" rows="3" name="stu_improvement" placeholder="กรุณาระบุ ข้อควรปรับปรุงของนักศึกษา"></textarea>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<h4 class="h4color">หากนักศึกษาผู้นี้สําเรจการศึกษาแล้ว ท่านจะรับเข้าทำงานในสถานประกอบการนี้หรือไม่</h4>
					<div class="table-responsive">
						<table class="table table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th width="55%">หัวข้อการประเมิน</th>
									<th width="15%">รับ / Yes</th>
									<th width="15%">ไม่แน่ใจ / Not sure</th>
									<th width="15%">ไม่รับ / No</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>(หากมีโอกาสเลือก) Once this student graduate, will you be interested to offer him/her a job?</td>
									<td>
										<div class="md-radio">
											<input type="radio" id="radio6" name="offer" value="1" class="md-radiobtn" />
											<label for="radio6">
												<span class="check"></span>
												<span class="box"></span>
											</label>
										</div>
									</td>
									<td>
										<div class="md-radio">
											<input type="radio" id="radio7" name="offer" value="2" class="md-radiobtn" />
											<label for="radio7">
												<span class="check"></span>
												<span class="box"></span>
											</label>
										</div>
									</td>
									<td>
										<div class="md-radio">
											<input type="radio" id="radio8" name="offer" value="3" class="md-radiobtn" />
											<label for="radio8">
												<span class="check"></span>
												<span class="box"></span>
											</label>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<input type="hidden" name="stu_id" value="<?php echo $resultStu["id"]; ?>" />
					<input type="hidden" name="year_id" value="<?php echo $resultYear["id"]; ?>" />
					<input type="hidden" name="corp_id" value="<?php echo $resultCorp["id"]; ?>" />
					<input type="hidden" name="pos_name" value="<?php echo $resultPos["pos_name"];  ?>" />
					<input type="hidden" name="checkSubmit" value="1" />
					<button class="btn btn-success" type="submit">บันทึก</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<?php include("footer.php"); ?>