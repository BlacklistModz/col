<?php
include("../header.php");
include("../sidebar.php");

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
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			รายงานการประเมินของนักศึกษา
			<!-- <small>เพิ่ม-ลบ/แก้ไข ข้อมูลข่าวสารประชาสัมพันธ์</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">รายงานการประเมิน</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title form-inline">แสดงผล : 
							<select class="form-control" name="group" onchange="window.location='?page=<?php echo $_GET["page"]; ?>&rid=<?php echo $_GET["rid"]; ?>&group='+this.value;">
								<option value="">--- นักศึกษาทั้งหมด ---</option>
								<?php 
								$sql->table="tbl_authentication";
								$sql->field="substr(username,1,9) AS stu_group";
								$sql->condition="WHERE status_id='4' or status_id='5' GROUP By stu_group DESC";
								$queryGroup = $sql->select();
								while($resultGroup = mysqli_fetch_assoc($queryGroup))
								{
									?>
									<option value="<?php echo $resultGroup["stu_group"]; ?>" <?php if(isset($_GET["group"]) and $_GET["group"] == $resultGroup["stu_group"]) { echo "selected"; } ?>><?php echo $resultGroup["stu_group"]; ?> [รหัส : <?php echo substr($resultGroup["stu_group"],0,2); ?>]</option>
									<?php
								}
								?>
							</select>
						</h3>
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
										<th width="10%">รหัสนักศึกษา</th>
										<th width="35%">ชื่อ-สกุล</th>
										<th width="10%">สถานะ</th>
										<th width="10%">ประเมินรายงาน</th>
										<th width="10%">ประเมินปฏิบัติงาน</th>
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
												if($result["status_id"] == "4")
												{
													echo "นักศึกษา";
												}
												else
												{
													echo "ศิษย์เก่า";
												}
												?>
											</td>
											<td align="center">
												<?php 
												$sql->table="tbl_stu_assreport";
												$sql->field="*";
												$sql->condition="WHERE stu_id='{$result["id"]}'";
												$queryReport = $sql->select();
												$checkReport = mysqli_num_rows($queryReport);
												if($checkReport <= 0)
												{
													echo "ไม่มีผลประเมิน";
												}
												else
												{
													?>
													<a href="assess_report.php?page=<?php echo $_GET["page"]; ?>&rid=<?php echo $_GET["rid"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-primary"><?php echo "ผลการประเมินรายงาน"; ?></a>
													<?php 
												}
												?>
											</td>
											<td align="center">
												<?php 
												$sql->table="tbl_stu_asswork";
												$sql->condition="WHERE stu_id='{$result["id"]}'";
												$queryWork = $sql->select();
												$checkWork = mysqli_num_rows($queryWork);
												if($checkWork <= 0)
												{
													echo "ไม่มีผลประเมิน";
												}
												else
												{
													?>
													<a href="assess_work.php?page=<?php echo $_GET["page"]; ?>&rid=<?php echo $_GET["rid"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-success"><?php echo "ผลการประเมินปฏิบัติงาน"; ?></a>
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
	</section>
</div>
<?php include("../footer.php"); ?>