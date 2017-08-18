<?php
include("../header.php");
include("../sidebar.php");

$sql->table="tbl_authentication";
$sql->condition="ORDER By last_login DESC";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			ระบบตรวจสอบการเข้าใช้งานของผู้ใช้งาน
			<!-- <small>เพิ่ม-ลบ/แก้ไข ข้อมูลข่าวสารประชาสัมพันธ์</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">ตรวจสอบการเข้าใช้งานของผู้ใช้งาน</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title"></h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="ซ่อน">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th width="5%">ลำดับ</th>
										<th width="15%">ชื่อผู้ใช้(Username)</th>
										<th width="20%">ชื่อ-นามสกุล</th>
										<th width="15%">สถานะ</th>
										<th width="15%">เข้าใช้งานล่าสุด</th>
										<th width="10%">ไอพีแอสเดรส (IP)</th>
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
											<td align="center"><?php echo $result["username"]; ?></td>
											<td><?php echo $result["name"]; ?></td>
											<td align="center">
												<?php 
												if($result["status_id"] != 0)
												{
													$sql->table="tbl_status";
													$sql->condition="WHERE id='{$result["status_id"]}'";
													$queryStatus = $sql->select();
													$resultStatus = mysqli_fetch_assoc($queryStatus);
													echo $resultStatus["name"];
												}
												else
												{
													echo "ไม่ได้ยืนยันตัวตน";
												}
												?>
											</td>
											<td align="center">
												<?php 
												if($result["last_login"] != "0000-00-00 00:00:00")
												{
													echo DateTimeThai($result["last_login"]); 
												}
												else
												{
													echo "ไม่มีข้อมูล";
												}
												?>
											</td>
											<th align="center"><?php echo $result["IP_login"]; ?></th>
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
	</section>
</div>
<?php include("../footer.php"); ?>