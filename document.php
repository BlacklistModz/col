<?php 
include("header.php"); 
include("class/DateThai.php");

if(!isset($resultUser["status_id"]) or ($resultUser["status_id"] !="4" and $resultUser["status_id"] !="1"))
{
	header("location:index.php?page=home");
}

$page = $_GET["page"];
$sub = $_GET["sub"];

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$queryYear = $sql->select();
$resultYear = mysqli_fetch_assoc($queryYear);

$sql->table="tbl_document";
$sql->condition="ORDER By id ASC";
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
					ข้อมูลเอกสารสหกิจศึกษา
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					ข้อมูลเอกสารสหกิจศึกษา | ปีการศึกษา <?php echo $resultYear["academic_year"]; ?>
				</div>
			</div>
			<div class="portlet light">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="5%">ลำดับ</th>
								<th width="45%">ชื่อเอกสาร</th>
								<th width="15%">กำหนดส่ง</th>
								<th width="15%">ส่งเมื่อ</th>
								<th width="10%">ดาวน์โหลด</th>
								<th width="10%">ส่งเอกสาร</th>
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
									<td><?php echo $result["doc_name"]; ?></td>
									<td align="center">
										<?php 
										if($result["doc_date"] != "0000-00-00")
										{
											echo DateThai($result["doc_date"]); 
										}
										else
										{
											echo "ไม่มีกำหนดส่ง";
										}
										?>
									</td>
									<td align="center">
										<?php 
										$sql->table="tbl_stu_send";
										$sql->condition="WHERE doc_id='{$result["id"]}'";
										$resultSend = mysqli_fetch_assoc($sql->select());
										if($result["doc_date"] >= $resultSend["send_date"] and $resultSend["send_date"] != "")
										{
											?>
											<font color="blue"><?php echo DateThai($resultSend["send_date"]); ?></font>
											<?php
										}
										elseif($resultSend["send_date"] != "")
										{
											?>
											<span style="color: #fff;background-color: #F44336;"><?php echo DateThai($resultSend["send_date"]); ?></span>
											<?php
										}
										else
										{
											if($result["doc_date"] == "0000-00-00")
											{
												echo "ไม่มีกำหนดส่ง";
											}
											else
											{
												echo "ไม่มีข้อมูล";
											}
										}
										?>
									</td>
									<td align="center"><a href="upload/doc/<?php echo $result["doc_file"]; ?>" class="btn btn-info" target="_blank">ดาวน์โหลด</a></td>
									<td align="center">
										<?php
										if($result["doc_date"] != "0000-00-00")
										{
											if($resultUser["status_id"] == "4")
											{
												$sql->table="tbl_stu_job";
												$sql->condition="WHERE stu_id='$user_id' and job_status='3'";
												$CheckSubmit = mysqli_num_rows($sql->select());
												if($CheckSubmit > 0)
												{
													?>
													<a href="stu_document.php?page=<?php echo $page; ?>&sub=<?php echo $sub; ?>&doc_id=<?php echo $result["id"]; ?>" class="btn btn-success">ส่งเอกสาร</a>
													<?php 
												}
												else
												{
													?>
													<button class="btn btn-warning" disabled>ไม่มีข้อมูลการฝึกงาน</button>
													<?php
												}
											}
										}
										else
										{
											?>
											<button class="btn btn-danger" disabled>ไม่มีกำหนดส่ง</button>
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