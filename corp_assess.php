<?php include("header.php"); 

if($resultUser["status_id"] != "3")
{
	header("location:index.php?page=home");
}

$sql->table="tbl_corporation";
$sql->condition="WHERE user_id='$user_id'";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$queryYear = $sql->select();
$resultYear = mysqli_fetch_assoc($queryYear);

$sql->table="tbl_stu_job INNER JOIN tbl_position ON tbl_stu_job.pos_id = tbl_position.id INNER JOIN tbl_corporation ON tbl_position.corp_id = tbl_corporation.id INNER JOIN tbl_authentication ON tbl_stu_job.stu_id = tbl_authentication.id";
$sql->field="stu_id,username,name,pos_name";
$sql->condition = "WHERE tbl_corporation.user_id='$user_id' and tbl_stu_job.job_status='3' and tbl_stu_job.year_id='{$resultYear["id"]}'";
$query = $sql->select();
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
					ระบบตรวจสอบการรับสมัครของสถานประกอบการ <?php echo $resultCorp["name_th"]; ?>
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					สถานประกอบการ <?php echo $resultCorp["name_th"]; ?> | ปีการศึกษา <?php echo $resultYear["academic_year"]; ?>
				</div>
			</div>
			<div class="portlet light">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="5%">ลำดับ</th>
								<th width="10%">รหัสนักศึกษา</th>
								<th width="20%">ชื่อ-สกุล</th>
								<th width="15%">ฝึกงานในตำแหน่ง</th>
								<th width="10%">ประเมินรายงาน</th>
								<th width="10%">ประเมินปฏิบัติงาน</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$num = 1;
							while($result = mysqli_fetch_assoc($query))
							{
								$sql->table=""
								?>
								<tr>
									<td align="center"><?php echo $num; ?></td>
									<td align="center"><?php echo $result["username"]; ?></td>
									<td><?php echo $result["name"]; ?></td>
									<td align="center"><?php echo $result["pos_name"]; ?></td>
									<td align="center">
										<?php 
										$sql->table="tbl_stu_assreport";
										$sql->field="*";
										$sql->condition="WHERE stu_id='{$result["stu_id"]}'";
										$queryReport = $sql->select();
										$numReport = mysqli_num_rows($queryReport);
										if($numReport <= 0)
										{
											$sql->table="tbl_stu_project";
											$sql->condition="WHERE stu_id='{$result["stu_id"]}'";
											$numProject = mysqli_num_rows($sql->select());
											if($numProject > 0)
											{
												?>
												<a href="SE-CO-011.php?stu_id=<?php echo $result["stu_id"]; ?>&page<?php echo $_GET["page"]; ?>" class="btn btn-primary">ประเมินรายงานโครงงาน</a>
												<?php
											}
											else
											{
												?>
												<button class="btn btn-danger" disabled>นักศึกษาไม่กรอกข้อมูล</button>
												<?php
											}
										}
										else
										{
											?>
											<button class="btn btn-primary" disabled>ประเมินแล้ว</button>
											<?php
										}
										?>
									</td>
									<td align="center">
										<?php 
										$sql->table="tbl_stu_assreport";
										$sql->field="*";
										$sql->condition="WHERE stu_id='{$result["stu_id"]}'";
										$queryReport = $sql->select();
										$numReport = mysqli_num_rows($queryReport);
										if($numReport > 0)
										{
											$sql->table="tbl_stu_asswork";
											$sql->field="*";
											$sql->condition="WHERE stu_id='{$result["stu_id"]}'";
											$queryWork = $sql->select();
											$numWork = mysqli_num_rows($queryWork);
											if($numWork <= 0)
											{
												?>
												<a href="SE-CO-012.php?stu_id=<?php echo $result["stu_id"]; ?>&page<?php echo $_GET["page"]; ?>" class="btn btn-success">ประเมินการปฏิบัติงาน</a>
												<?php 
											}
											else
											{
												?>
												<button class="btn btn-success" disabled>ประเมินแล้ว</button>
												<?php
											}
										}
										else
										{
											?>
											<button class="btn btn-danger" disabled>กรุณาประเมินรายงาน</button>
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