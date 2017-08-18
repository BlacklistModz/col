<?php include("header.php"); 

if(isset($_GET["group"]) and $_GET["group"] != "")
{
	$condition = "and username LIKE '".$_GET["group"]."%'";
}
else
{
	$condition = "";
}

$sql->table="tbl_authentication";
$sql->condition="WHERE (status_id='4' or status_id='5') $condition";
$query = $sql->select();

?>
<link rel="stylesheet" type="text/css" href="css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/select2.min.css">
<link rel="stylesheet" type="text/css" href="css/select2-bootstrap.min.css">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li>
					<a href="index.php"><i class="fa fa-home"></i></a>
				</li>
				<li class="active">
					รายงานการส่งเอกสารของนักศึกษา <?php if(isset($_GET["group"])) { echo "กลุ่มรหัส ".$_GET["group"]; } ?>
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					รายงานการส่งเอกสารของนักศึกษา <?php if(isset($_GET["group"])) { echo "กลุ่มรหัส ".$_GET["group"]; } ?>
				</div>
			</div>
			<ul class="breadcrumb">
				<div class="form-inline">
					แสดงผล : 
					<select class="form-control" name="group" onchange="window.location='?page=<?php echo $_GET["page"]; ?>&group='+this.value;">
						<option value="">นักศึกษาทั้งหมด</option>
						<?php 
						$sql->table="tbl_authentication";
						$sql->field="substr(username,1,9) AS stu_group";
						$sql->condition="WHERE status_id='4' or status_id='5' GROUP By stu_group DESC";
						$queryGroup = $sql->select();
						while($resultGroup = mysqli_fetch_assoc($queryGroup))
						{
							?>
							<option value="<?php echo $resultGroup["stu_group"]; ?>" <?php if(isset($_GET["group"]) and $_GET["group"] == $resultGroup["stu_group"]) { echo "selected"; } ?>><?php echo $resultGroup["stu_group"]; ?> (รหัส : <?php echo substr($resultGroup["stu_group"],0,2); ?>)</option>
							<?php
						}
						?>
					</select>
				</div>
			</ul>
			<div class="portlet light">
				
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="5%">ลำดับ</th>
								<th width="15%">รหัสนักศึกษา</th>
								<th width="15%">ชื่อ-สกุล</th>
								<th width="15%">ชื่อโครงการ</th>
								<th width="15%">ชื่อพี่เลี้ยง</th>
								<th width="10%">รายงาน</th>
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
									<td align="center">
										<?php 
										$sql->table="tbl_stu_project";
										$sql->field="*";
										$sql->condition="WHERE stu_id='{$result["id"]}'";
										$queryStu = $sql->select();
										$resultStu = mysqli_fetch_assoc($queryStu);
										echo $resultStu["project_th"];
										?>
									</td>
									<td align="center">
										<?php echo $resultStu["emp_name"]; ?>
									</td>
									<td align="center">
										<a href="report_doc_detail.php?page=<?php echo $_GET["page"]; ?>&stu_id=<?php echo $result["id"]; ?>" class="btn btn-info">การส่งเอกสาร</a>
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
<script type="text/javascript" src="js/select2.full.min.js"></script>
<script type="text/javascript" src="js/select2.th.js"></script>
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
		$('select').select2();
	});
</script>