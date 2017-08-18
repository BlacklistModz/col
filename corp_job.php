<?php include("header.php"); 

if($resultUser["status_id"] != "3")
{
	header("location:index.php?page=home");
}

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$queryYear = $sql->select();
$resultYear = mysqli_fetch_assoc($queryYear);

$sql->table="tbl_corporation";
$sql->condition="WHERE user_id='$user_id' and year_id='{$resultYear["id"]}'";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);

$sql->table="tbl_position";
$sql->condition="WHERE corp_id='{$resultCorp["id"]}'";
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
					ตำแหน่งที่เปิดรับสมัคร <?php echo $resultCorp["name_th"]; ?>
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					ตำแหน่งงานในสถานประกอบการ <?php echo $resultCorp["name_th"]; ?> | ปีการศึกษา <?php echo $resultYear["academic_year"]; ?>
				</div>
			</div>
			<div class="portlet light">
				<a href="add_position.php?page=<?php echo $_GET["page"]; ?>&sub=<?php echo $_GET["sub"]; ?>" class="btn btn-primary">เพิ่มตำแหน่งงาน</a>
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="5%">ลำดับ</th>
								<th width="65%">ตำแหน่ง</th>
								<th width="10%">จำนวนผู้สมัคร</th>
								<th width="20%">จัดการ</th>
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
									<td><?php echo $result["pos_name"]; ?></td>
									<td align="center">
										<?php 
										$sql->table="tbl_stu_job";
										$sql->condition="WHERE pos_id='".$result["id"]."'";
										$numStu = mysqli_num_rows($sql->select());
										echo $numStu." ใบ";
										?>
									</td>
									<td align="center">
										<a href="corp_job_detail.php?pos_id=<?php echo $result["id"]; ?>&page=<?php echo $_GET["page"]; ?>&sub=<?php echo $_GET["sub"]; ?>" class="btn btn-info">ผู้สมัคร</a>
										<a href="edit_position.php?id=<?php echo $result["id"]; ?>&page=<?php echo $_GET["page"]; ?>&sub=<?php echo $_GET["sub"]; ?>" class="btn btn-warning">แก้ไข</a>
										<?php 
										if($numStu == 0)
										{
											?>
											<a href="javascript:;" data-corp_id="<?php echo $resultCorp["id"]; ?>" data-id="<?php echo $result["id"]; ?>" class="btn btn-danger gg-wp">ลบ</a>
											<?php 
										}
										else
										{
											?>
											<button class="btn btn-danger" disabled>ลบ</button>
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

		$('.gg-wp').click(function(e) {

			var href = $(this).attr('href');
			var corp_id = $(this).data("corp_id");
			var pos_id = $(this).data("id");
			
			console.log(pos_id,corp_id);
			swal({
				title: "ต้องการลบตำแหน่งนี้?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "ใช่, ลบ!",
				cancelButtonText: "ไม่, ยกเลิก!",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm) 
			{
				if(isConfirm)
				{
					$.ajax({
						url: 'do_del_position.php?corp_id='+corp_id+'&pos_id='+pos_id,
						type: 'GET',
						beforeSend: function(bfs) {
							$(".item").css({"display": "block"});
							console.log(bfs);
						},
					})
					.done(function(reply) {
						if(reply == 1) 
						{
							$(".item").css({"display": "none"});
							swal("เสร็จสิ้น!", "ลบข้อมูลเรียบร้อยแล้ว", "success");
							$('.confirm').click(function() 
							{
								location.reload();
								//window.location.href="corp_job.php?page=company&sub=corp_job";
							});
						} 
						else
						{
							$(".item").css({"display": "none"});
							swal("พบข้อผิดพลาด!", "ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง! \n หรือติดต่อสาขาวิชาวิศวกรรมซอฟต์แวร์ \n โทร 054-237399 ต่อ (6000)", "error");
						}
					});
				}
			});
			return false;
		});
	});
</script>