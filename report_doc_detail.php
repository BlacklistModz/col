<?php include("header.php"); 

if(!isset($_GET["stu_id"]) or (empty($_GET["stu_id"])))
{
    header("location:index.php?page=home");
}

$stu_id = $_GET["stu_id"];

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$stu_id'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);

?>
<link rel="stylesheet" type="text/css" href="css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/responsive.bootstrap.min.css">
<style type="text/css">
	.check-green {
		color: green;
	}
	.check-red {
		color: red;
	}
	.check-orange {
		color: orange;
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
					รายงานการส่งเอกสาร | <?php echo $result["username"]; ?> : <?php echo $result["name"]; ?>
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					รายงานการส่งเอกสาร | <?php echo $result["username"]; ?> : <?php echo $result["name"]; ?>
				</div>
			</div>
			<ul class="breadcrumb">
				<i class="fa fa-check check-green"></i> ส่งภายในกำหนด, <i class="fa fa-check check-orange"></i> ส่งเกินกำหนด, <i class="fa fa-times check-red"></i> ไม่พบข้อมูลการส่ง
			</ul>
			<div class="portlet light">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="10%">ลำดับ</th>
								<th width="75%">เอกสาร / การประเมิน</th>
								<th width="15%">สถานะ</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sql->table="tbl_document";
							$sql->condition="WHERE doc_date NOT LIKE '0000-00-00' ORDER By id ASC";
							$queryDoc = $sql->select();
							$num = 1;
							while($resultDoc = mysqli_fetch_assoc($queryDoc)) 
							{
								?>
								<tr>
									<td align="center"><?php echo $num; ?></td>
									<td><?php echo $resultDoc["doc_name"]; ?></td>
									<td align="center">
										<?php
										$sql->table="tbl_stu_send";
										$sql->condition="WHERE stu_id='$stu_id' and doc_id='{$resultDoc["id"]}'";
										$querySend = $sql->select();
										$numSend = mysqli_num_rows($querySend);
										if($numSend > 0)
										{
											$resultSend = mysqli_fetch_assoc($querySend);

											if($resultSend["send_date"] <= $resultDoc["doc_date"])
											{
												$class = "fa fa-check check-green";
											}
											else
											{
												$class = "fa fa-check check-orange";
											}
										}
										else
										{
											$class = "fa fa-times check-red";
										}
										?>
										<i class="<?php echo $class; ?>"></i>
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