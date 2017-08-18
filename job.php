<?php include("header.php"); 

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$queryYear = $sql->select();
$resultYear = mysqli_fetch_assoc($queryYear);

$sql->table="tbl_rulejob";
$sql->condition="WHERE id='1'";
$resultRule = mysqli_fetch_assoc($sql->select());

$sql->table="tbl_stu_job";
$sql->condition="WHERE stu_id='$user_id'";
$numJob = mysqli_num_rows($sql->select());

$sql->table="tbl_corporation INNER JOIN tbl_position ON tbl_corporation.id = tbl_position.corp_id INNER JOIN tbl_province ON tbl_corporation.province_id = tbl_province.PROVINCE_ID";
$sql->field="tbl_corporation.id AS id , tbl_corporation.name_th , tbl_corporation.address , tbl_province.PROVINCE_NAME , SUM(tbl_position.stu_count) AS sum_stu";
$sql->condition="WHERE tbl_corporation.year_id ='{$resultYear["id"]}' GROUP By tbl_corporation.id";
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
					สถานประกอบการที่เปิดรับสมัคร 
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					สถานประกอบการที่เปิดรับสมัคร | ปีการศึกษา <?php echo $resultYear["academic_year"]; ?>
				</div>
			</div>
			<div class="portlet light">
				<div class="">
					นักศึกษาสามารถสมัครงานได้อีก <?php echo $resultRule["num_job"]-$numJob; ?> ตำแหน่ง | สูงสุด <?php echo $resultRule["num_job"]; ?> ตำแหน่ง
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="5%">ลำดับ</th>
								<th width="25%">ชื่อสถานประกอบการ</th>
								<th width="25%">ที่อยู่</th>
								<th width="10%">จังหวัด</th>
								<th width="10%">จำนวนที่รับ</th>
								<th width="10%">จำนวนผู้สมัคร</th>
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
									<td><a href="job_detail.php?id=<?php echo $result["id"]; ?>"><?php echo $result["name_th"]; ?></a></td>
									<td><?php echo $result["address"]; ?></td>
									<td align="center">จ.<?php echo $result["PROVINCE_NAME"]; ?></td>
									<td align="center"><?php echo $result["sum_stu"]; ?> คน</td>
									<td align="center">
										<?php
										$sql->table="tbl_stu_job INNER JOIN tbl_position ON tbl_stu_job.pos_id = tbl_position.id";
										$sql->field="*";
										$sql->condition="WHERE tbl_position.corp_id='{$result["id"]}'";
										$numJob = mysqli_num_rows($sql->select());
										echo $numJob;
										?> คน
									</td>
									<td align="center"><a href="job_detail.php?id=<?php echo $result["id"]; ?>&page=<?php echo $_GET["page"]; ?>" class="btn btn-primary">ดูรายละเอียด</a></td>
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