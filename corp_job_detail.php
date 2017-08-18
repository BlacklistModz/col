<?php include("header.php"); 

if($resultUser["status_id"] != "3")
{
	header("location:index.php?page=home");
}

$pos_id = $_GET["pos_id"];

$sql->table="tbl_corporation";
$sql->condition="WHERE user_id='$user_id' ORDER By id DESC LIMIT 0,1";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);

$sql->table="tbl_position";
$sql->condition="WHERE id='$pos_id' and corp_id='{$resultCorp["id"]}'";
$queryPos = $sql->select();
$numPos = mysqli_num_rows($queryPos);
if($numPos <= 0)
{
	header("location:index.php?page=home");
}

$resultPos = mysqli_fetch_assoc($queryPos);

$sql->table="tbl_stu_job INNER JOIN tbl_authentication ON tbl_stu_job.stu_id = tbl_authentication.id";
$sql->field="tbl_stu_job.id AS id , tbl_stu_job.job_status AS job_status , name , stu_id";
$sql->condition="WHERE tbl_stu_job.pos_id='$pos_id'";
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
					สถานประกอบการ <?php echo $resultCorp["name_th"]; ?>
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					สถานประกอบการ <?php echo $resultCorp["name_th"]; ?> | ตำแหน่ง <?php echo $resultPos["pos_name"]; ?>
				</div>
			</div>
			<div class="portlet light">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="5%">ลำดับ</th>
								<th width="35%">ชื่อ-นามสกุล ผู้สมัคร</th>
								<th width="15%">คณะ</th>
								<th width="15%">สาขาวิชา</th>
								<th width="15%">ใบสมัคร</th>
								<th width="10%"></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$num = 1;
							while($result = mysqli_fetch_assoc($query))
							{
								$sql->table="tbl_student";
								$sql->field="*";
								$sql->condition="WHERE user_id='{$result["stu_id"]}'";
								$queryStudent = $sql->select();
								$resultStudent = mysqli_fetch_assoc($queryStudent);
								?>
								<tr>
									<td align="center"><?php echo $num; ?></td>
									<td><?php echo $result["name"]; ?></td>
									<td align="center"><?php echo $resultStudent["faculty"]; ?></td>
									<td align="center"><?php echo $resultStudent["major"]; ?></td>
									<td align="center">
										<a href="reg_report.php?id=<?php echo $result["stu_id"]; ?>&pos_id=<?php echo $pos_id; ?>" class="btn btn-info">ดูใบสมัคร</a>
									</td>
									<td align="center">
										<?php 
										if($result["job_status"] == 0)
										{
											?>
											<a href="do_job_status.php?id=<?php echo $result["id"] ?>&status=1" class="btn btn-success" onclick="return confirm('คุณต้องการรับนักศึกษา <?php echo $result["name"]; ?> เข้าฝึกงาน ใช่หรือไม่ ?')">ตอบรับ</a>
											<a href="do_job_status.php?id=<?php echo $result["id"] ?>&status=2" class="btn btn-danger" onclick="return confirm('คุณต้องการตัดสิทธิ์ <?php echo $result["name"]; ?> เข้าฝึกงาน ใช่หรือไม่ ?')">ไม่ตอบรับ</a>
											<?php
										}
										elseif($result["job_status"] == 1)
										{
											echo "ตอบรับการฝึกงาน";
										}
										elseif($result["job_status"] == 2)
										{
											echo "ไม่ตอบรับการฝึกงาน";
										}
										elseif($result["job_status"] == 3)
										{
											echo "ยืนยันเข้าฝึกงาน";
										}
										else
										{
											echo "สละสิทธิ์เข้าฝึกงาน";
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
				<a class="gg-wp" href="corp_job.php?page=<?php echo $_GET["page"]; ?>&sub=<?php echo $_GET["sub"]; ?>">
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