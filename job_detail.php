<?php 
include("header.php"); 

$id = $_GET["id"];

$sql->table="tbl_corporation";
$sql->condition="WHERE id='$id'";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);

$sql->table="tbl_rulejob";
$sql->condition="WHERE id='1'";
$resultRule = mysqli_fetch_assoc($sql->select());

$sql->table="tbl_stu_job";
$sql->condition="WHERE stu_id='$user_id'";
$numJob = mysqli_num_rows($sql->select());

$sql->table="tbl_position";
$sql->condition="WHERE corp_id='$id'";
$query = $sql->select();

if(isset($user_id))
{
	$sql->table="tbl_student";
	$sql->condition="WHERE user_id='$user_id'";
	$resultStudent = mysqli_fetch_array($sql->select());
}
?>
<link rel="stylesheet" type="text/css" href="css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/responsive.bootstrap.min.css">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li>
					<a href="index.php"><i class="fa fa-home"></i></a>
				</li>
				<li class="active">
					สถานประกอบการ <?php echo $resultCorp["name_th"]; ?>
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					สถานประกอบการ <?php echo $resultCorp["name_th"]; ?>
				</div>
			</div>
			<div class="portlet light">
				<div class="">
					สามารถสมัครงานได้อีก <?php echo $resultRule["num_job"]-$numJob; ?> ตำแหน่ง <br/>
					** หากไม่สามารถสมัครงานได้ แสดงว่านักศึกษาได้ยืนยันการเข้าทำงานในตำแหน่งที่เคยสมัครแล้ว **
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="5%">ลำดับ</th>
								<th width="25%">ตำแหน่งงาน</th>
								<th width="25%">ลักษณะงาน</th>
								<th width="10%">จำนวนที่รับ</th>
								<th width="10%"></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$num = 1;
							while($result = mysqli_fetch_assoc($query))
							{
								?>
								<tr>
									<td align="center"><?php echo $num; ?></td>
									<td><?php echo $result["pos_name"]; ?></td>
									<td><?php echo nl2br($result["job_description"]); ?></td>
									<td align="center"><?php echo $result["stu_count"]; ?> คน</td>
									<td align="center">
										<?php
										if(isset($user_id) and $resultUser["status_id"] == "4" and $resultStudent["update_date"] != "0000-00-00")
										{
											if($resultRule["num_job"] != $numJob)
											{
												$sql->table="tbl_stu_job";
												$sql->condition="WHERE stu_id='$user_id' and job_status='3'";
												$CheckSubmit = mysqli_num_rows($sql->select());
												if($CheckSubmit <= 0)
												{
													$sql->table="tbl_stu_job";
													$sql->condition="WHERE pos_id='{$result["id"]}' and stu_id='$user_id'";
													$CheckJOB = mysqli_num_rows($sql->select());
													if($CheckJOB == "0")
													{
														?>
														<a href="do_job.php?id=<?php echo $result["id"]; ?>" class="btn btn-success">สมัครงาน</a>
														<?php 
													}
													else
													{
														?>
														<a href="#" class="btn btn-danger" disabled>สมัครแล้ว</a>
														<?php 
													}
												}
												else
												{
													?>
													<a href="#" class="btn btn-danger" disabled>ไม่สามารถสมัครได้</a>
													<?php
												}
											}
											else
											{
												?>
												<a href="#" class="btn btn-success" disabled>สมัครครบโควต้า</a>
												<?php
											}
										}
										else
										{
											?>
											<a href="#" class="btn btn-success" disabled>สมัครงาน</a>
											<?php 
										}
										?>
									</td>
								</tr>
								<?php 
								$num++;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="bottom">
				<a class="gg-wp" href="job.php">
					<div class="btn-view">
						กลับ
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="js/responsive.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$.extend(true, $.fn.dataTable.defaults, {
			"language": {
				"sProcessing": "กำลังดำเนินการ...",
				"sLengthMenu": "แสดง _MENU_ แถว",
				"sZeroRecords": "ไม่พบข้อมูล",
				"sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
				"sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
				"sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
				"sInfoPostFix": "",
				"sSearch": "ค้นหา:",
				"sUrl": "",
				"oPaginate": {
					"sFirst": "เิริ่มต้น",
					"sPrevious": "ก่อนหน้า",
					"sNext": "ถัดไป",
					"sLast": "สุดท้าย"
				}
			}
		});
		$('.table').DataTable({responsive : true});
	});
</script>