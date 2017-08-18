<?php
include("../header.php");
include("../sidebar.php");

$id = $_GET["id"];

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$id'";
$queryStudent = $sql->select();
$resultStudent = mysqli_fetch_assoc($queryStudent);

$sql->table="tbl_assess_report";
$sql->condition="ORDER By id ASC";
$query = $sql->select();

$sql->table="tbl_stu_assreport";
$sql->condition="WHERE stu_id='$id'";
$queryReport = $sql->select();
$resultReport = mysqli_fetch_assoc($queryReport);
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			รายงานการประเมินรายงานสหกิจศึกษา
			<!-- <small>เพิ่ม-ลบ/แก้ไข ข้อมูลข่าวสารประชาสัมพันธ์</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="index_assess.php?page=<?php echo $_GET["page"]; ?>&rid=<?php echo $_GET["rid"]; ?>"> รายงานการประเมิน</a></li>
			<li class="active"> รายงานการประเมินรายงานสหกิจศึกษา</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title form-inline">นักศึกษา <?php echo $resultStudent["username"]; ?> | <?php echo $resultStudent["name"]; ?></h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="ซ่อน">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="DataAll">
								<thead>
									<tr>
										<th width="5%">ลำดับ</th>
										<th width="85%">หัวข้อ</th>
										<th width="10%">คะแนน</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$num = 1;
									$point = 0;
									while($result = mysqli_fetch_assoc($query)) 
									{
										$sql->table="tbl_stu_assreport_detail";
										$sql->condition="WHERE assreport_id='{$resultReport["id"]}' and ass_topic_id='{$result["id"]}'";
										$queryAssess = $sql->select();
										$resultAssess = mysqli_fetch_assoc($queryAssess);
										?>
										<tr>
											<td align="center"><?php echo $num; ?></td>
											<td><?php echo $result["topic"]; ?></td>
											<td align="center"><?php echo $resultAssess["assess_point"]; ?></td>
										</tr>
										<?php 
										$num++; 
										$point = $point + $resultAssess["assess_point"];
									} 
									?>
									<tr>
										<td colspan="2" align="center"><b>คิดเป็นเปอร์เซ็นต์รวม</b></td>
										<td align="center">
											<b><?php 
												$full_point = $num*5;
												$persent = $point / $full_point * 100;
												echo number_format($persent, 2, '.', '')."%";
												?></b>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="box-footer">
							<a href="index_assess.php?page=<?php echo $_GET["page"]; ?>&rid=<?php echo $_GET["rid"]; ?>" class="btn btn-danger pull-right">ยกเลิก</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php include("../footer.php"); ?>