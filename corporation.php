<?php include("header.php"); 

if(isset($_GET["year_id"]) and $_GET["year_id"] != "")
{
	$sql->table="tbl_year";
	$sql->condition="WHERE id='".$_GET["year_id"]."'";
	$queryYear = $sql->select();
	$resultYear = mysqli_fetch_assoc($queryYear);
}
else
{
	$sql->table="tbl_year";
	$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
	$queryYear = $sql->select();
	$resultYear = mysqli_fetch_assoc($queryYear);

	$_GET["year_id"] = $resultYear["id"];
}

$sql->table="tbl_corporation";
$sql->condition="WHERE year_id='".$_GET["year_id"]."'";
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
					ทะเบียนสถานประกอบการ ปีการศึกษา <?php echo $resultYear["academic_year"]; ?>
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					ทะเบียนสถานประกอบการ ปีการศึกษา <?php echo $resultYear["academic_year"]; ?>
				</div>
			</div>
			<div class="breadcrumb">
				<div class="form-inline">
					แสดงผล : 
					<select class="form-control" name="year_id" onchange="window.location='?page=<?php echo $_GET["page"]; ?>&sub=<?php echo $_GET["sub"]; ?>&year_id='+this.value;">
						<?php 
						$sql->table="tbl_year";
						$sql->condition="ORDER By academic_year DESC";
						$queryYear = $sql->select();
						while($resultYear = mysqli_fetch_assoc($queryYear))
						{
							?>
							<option value="<?php echo $resultYear["id"]; ?>" <?php if(isset($_GET["year_id"]) and $resultYear["id"] == $_GET["year_id"]) { echo "selected"; } ?>>ปีการศึกษา <?php echo $resultYear["academic_year"]; ?></option>
							<?php
						}
						?>
					</select>
				</div>
			</div>
			<div class="portlet light">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="5%">ลำดับ</th>
								<th width="55%">ชื่อสถานประกอบการ</th>
								<th width="15%">ที่อยู่</th>
								<th width="15%">ตำแหน่งที่รับสมัคร</th>
								<th width="10%">เบอร์โทรศัพท์</th>
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
									<td><?php echo $result["name_th"]; ?></td>
									<td align="center"><?php echo nl2br($result["address"]);; ?></td>
									<td align="center">
										<?php
										$sql->table="tbl_position";
										$sql->condition="WHERE corp_id='{$result["id"]}'";
										$queryPos = $sql->select();
										while($resultPos = mysqli_fetch_assoc($queryPos))
										{
											echo $resultPos["pos_name"]."<br/>";
										} 
										?>
									</td>
									<td align="center"><?php echo $result["phone"]; ?></td>
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