<?php include("header.php"); 

if($resultUser["status_id"] != "4")
{
	header("location:index.php?page=home");
}

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$queryYear = $sql->select();
$resultYear = mysqli_fetch_assoc($queryYear);

$sql->table="tbl_stu_job INNER JOIN tbl_position ON tbl_stu_job.pos_id = tbl_position.id INNER JOIN tbl_corporation ON tbl_position.corp_id = tbl_corporation.id";
$sql->field="tbl_stu_job.id AS id , name_th , pos_name , job_status";
$sql->condition="WHERE tbl_stu_job.stu_id='$user_id' and tbl_corporation.year_id='{$resultYear["id"]}'";
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
					ตำแหน่งที่นักศึกษาได้ลงสมัคร 
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					ตำแหน่งที่นักศึกษาได้ลงสมัคร | ปีการศึกษา <?php echo $resultYear["academic_year"]; ?>
				</div>
			</div>
			<div class="portlet light">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="5%">ลำดับ</th>
								<th width="25%">ชื่อสถานประกอบการ</th>
								<th width="25%">ตำแหน่ง</th>
								<th width="15%">สถานะการสมัคร</th>
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
									<td><?php echo $result["name_th"]; ?></td>
									<td><?php echo $result["pos_name"]; ?></td>
									<td align="center">
										<?php 
										if($result["job_status"] == 0)
										{
											echo "รอการตอบรับ";
										}
										elseif($result["job_status"] == 1)
										{
											echo "ได้รับการคัดเลือก";
										}
										elseif($result["job_status"] == 2)
										{
											echo "ไม่ได้รับการคัดเลือก";
										}
										elseif($result["job_status"] == 3)
										{
											echo "ยืนยันเข้าทำงาน";
										}
										else
										{
											echo "สละสิทธิ์การทำงาน";
										}
										?>
									</td>
									<td align="center">
										<?php 
										if($result["job_status"] == 1)
										{
											?>
											<a href="do_accept_job.php?id=<?php echo $result["id"]; ?>&job_status=3" class="btn btn-success" onclick="return confirm('คุณต้องยืนยันสิทธิ์การเข้าทำงาน \n -> บริษัท <?php echo $result["name_th"]; ?>\n -> ตำแหน่ง <?php echo $result["pos_name"]; ?> ใช่หรือไม่ ? \n * การยืนยันสิทธิ์ที่นี้ จะเป็นการสละสิทธิ์บริษัทและตำแหน่งอื่นที่ไม่ได้เลือก *')">ตอบรับ</a>
											<a href="do_accept_job.php?id=<?php echo $result["id"]; ?>&job_status=4" class="btn btn-danger" onclick="return confirm('คุณต้องการสละสิทธิ์การเข้าทำงาน \n -> บริษัท <?php echo $result["name_th"]; ?>\n -> ตำแหน่ง <?php echo $result["pos_name"]; ?> \n ใช่หรือไม่ ?')">สละสิทธิ์</a>
											<?php 
										}
										elseif($result["job_status"] == 2)
										{
											?>
											<a href="" class="btn btn-danger" disabled><i class="fa fa-times"></i></a>
											<?php
										}
										elseif($result["job_status"] == 3)
										{
											echo "ตอบรับ";
										}
										elseif($result["job_status"] == 4)
										{
											echo "สละสิทธิ์";
										}
										else
										{
											echo "รอการตอบรับ";
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