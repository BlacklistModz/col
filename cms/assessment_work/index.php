<?php
include("../header.php");
include("../sidebar.php");

$sql->table="tbl_assess_work";
$sql->condition="ORDER By id ASC";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการแบบประเมินนักศึกษา | การปฏิบัติงานสหกิจศึกษา
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">จัดการแบบประเมิน การปฏิบัติงานสหกิจศึกษา</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">
							<a href="add.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>" class="btn btn-success">เพิ่มด้านการประเมิน</a>
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
										<th width="35%">ด้านการประเมิน</th>
										<th width="10%">จำนวนหัวข้อ</th>
										<th width="10%">สถานะ</th>
										<th width="15%">จัดการ</th>
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
											<td>
												<a href="index_sub.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>&ass_id=<?php echo $result["id"]; ?>"><?php echo $result["topic"]; ?></a>
											</td>
											<td align="center">
												<?php 
												$sql->table="tbl_assess_sub";
												$sql->condition="WHERE ass_id='{$result["id"]}'";
												$querySub = $sql->select();
												echo mysqli_num_rows($querySub);
												?>
											</td>
											<td align="center"><?php if($result["ass_status"] == 0){ echo "แสดงผล"; } else { echo "ไม่แสดงผล"; } ?></td>
											<td align="center">
												<a href="add_sub.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>&ass_id=<?php echo $result["id"]; ?>" class="btn btn-success">เพิ่มหัวข้อ</a>
												<a href="edit.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-warning">แก้ไข</a>
												<a href="delete.php?page=<?php echo $_GET["page"]; ?>&aid=<?php echo $_GET["aid"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบด้าน <?php echo $result["topic"]; ?> ใช่หรือไม่ \n - การลบด้านการประเมิน จะเป็นการลบหัวข้อภายในด้านนั้นๆด้วย')">ลบ</a>
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