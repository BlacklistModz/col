<?php
include("../header.php");
include("../sidebar.php");

$sql->table="tbl_authentication";
$sql->condition="WHERE status_id='3' or status_id='0' ORDER By id DESC";
$query = $sql->select();

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$resultNow = mysqli_fetch_assoc($sql->select());
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			ตรวจสอบสถานประกอบการ
			<small>ยืนยัน/ยกเลิก สถานประกอบการ</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">ตรวจสอบสถานประกอบการ</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">รายชื่อสถานประกอบการ</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="ซ่อน">
								<i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th align="center">ลำดับ</th>
											<th>ชื่อสถานประกอบการ</th>
											<th>ไอดีผู้ใช้</th>
											<th>เบอร์โทร</th>
											<th>ลงทะเบียนเมื่อ</th>
											<th>สถานะ</th>
											<th align="center">จัดการ</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$num = 1;
										while($result = mysqli_fetch_assoc($query)) 
										{ 
											$sql->table="tbl_corporation";
											$sql->condition="WHERE user_id='{$result["id"]}' ORDER By id DESC LIMIT 0,1";
											$resultCorp = mysqli_fetch_assoc($sql->select());
											?>
											<tr>
												<td align="center"><?php echo $num; ?></td>
												<td>
												<a href="index_corp.php?page=<?php echo $_GET["page"]; ?>&user_id=<?php echo $result["id"]; ?>"><?php echo $resultCorp["name_th"]; ?></a>
												</td>
												<td><?php echo $result["username"]; ?></td>
												<td><?php echo $resultCorp["phone"]; ?></td>
												<td align="center"><?php echo DateThai($result["create_date"]); ?></td>
												<td align="center">
													<?php
													if($result["status_id"] == 0) 
													{
														echo "ไม่ได้ยืนยันอีเมล";
													} 
													elseif($result["accept_year_id"] == 0 or $result["accept_year_id"] != $resultNow["id"])
													{
														echo "ไม่ได้ยืนยันปีการศึกษา ".$resultNow["academic_year"];
													}
													else
													{
														echo "ยืนยันปีการศึกษา ".$resultNow["academic_year"];
													} 
													?>
												</td>
												<td align="center">
													<?php
													if($result["accept_year_id"] != $resultNow["id"])
													{
														?>
														<a href="update_status.php?page=<?php echo $_GET["page"]; ?>&corp_id=<?php echo $resultCorp["id"]; ?>&user_id=<?php echo $result["id"]; ?>" class="btn btn-success" onclick="return confirm('คุณต้องการยืนยันสถานประกอบการ <?php echo $resultCorp["name_th"]; ?>\n -> ในปีการศึกษา <?php echo $resultNow["academic_year"]; ?> \n ใช่หรือไม่ ?')">ยีนยัน</a>
														<?php
													}
													else
													{
														?>
														<a href="update_status.php?page=<?php echo $_GET["page"]; ?>&corp_id=<?php echo $resultCorp["id"]; ?>&user_id=<?php echo $result["id"]; ?>" class="btn btn-warning">ระงับ</a>
														<?php
													}
													?>
													<a href="edit_corp.php?page=<?php echo $_GET["page"]; ?>&corp_id=<?php echo $resultCorp["user_id"]; ?>" class="btn btn-info">แก้ไข</a>
													<a href="delete_corp.php?page=<?php echo $_GET["page"]; ?>&corp_id=<?php echo $resultCorp["user_id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบสถานประกอบการ <?php echo $resultCorp["name_th"]; ?>') ใช่หรือไม่">ลบ</a>
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
		</section>
	</div>
	<?php include("../footer.php"); ?>