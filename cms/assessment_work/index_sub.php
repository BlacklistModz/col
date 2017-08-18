<?php
include("../header.php");
include("../sidebar.php");

$ass_id = $_GET["ass_id"];

$sql->table="tbl_assess_work";
$sql->condition="WHERE id='$ass_id'";
$queryAss = $sql->select();
$resultAss = mysqli_fetch_assoc($queryAss);

$sql->table="tbl_assess_sub";
$sql->condition="WHERE ass_id='$ass_id'";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการหัวข้อการประเมิน | <?php echo $resultAss["topic"]; ?>
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="index.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>">จัดการแบบประเมิน การปฏิบัติงานสหกิจศึกษา</a></li>
			<li class="active">จัดการหัวข้อการประเมิน</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">
							<a href="add_sub.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>&ass_id=<?php echo $_GET["ass_id"]; ?>" class="btn btn-success">เพิ่มหัวข้อการประเมิน</a>
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
										<th width="20%">หัวข้อประเมิน</th>
										<th width="25%">รายละเอียด</th>
										<th width="10%">จัดการ</th>
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
											<td><?php echo $result["sub_topic"]; ?></td>
											<td><?php echo nl2br($result["sub_detail"]); ?></td>
											<td align="center">
												<a href="edit_sub.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>&ass_id=<?php echo $result["ass_id"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-warning">แก้ไข</a>
												<a href="delete_sub.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบหัวข้อ <?php echo $result["sub_topic"]; ?> ใช่หรือไม่')">ลบ</a>
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