<?php
include("../header.php");
include("../sidebar.php");

$skill_id = $_GET["id"];

$sql->table="tbl_sub_skill";
$sql->condition="WHERE skill_id='$skill_id'";
$query = $sql->select();

$sql->table="tbl_skill";
$sql->condition="WHERE id='$skill_id'";
$querySkill = $sql->select();
$resultSkill = mysqli_fetch_assoc($querySkill);
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการข้อมูลความสามารถพิเศษ (ประเภท <?php echo $resultSkill["skill_name"]; ?>)
			<small>เพิ่ม-ลบ/แก้ไข ความสามารถพิเศษ</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="index.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>&skill_id=<?php echo $skill_id; ?>"><i></i>จัดการประเภทความสามารถพิเศษ</a></li>
			<li class="active">จัดการความสามารถพิเศษ</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title"><a href="add_sub_skill.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>&id=<?php echo $_GET["id"]; ?>" class="btn btn-success">เพิ่มความสามารถพิเศษ</a></h3>
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
											<th width="10%">ลำดับ</th>
											<th width="70%">ความสามารถพิเศษ</th>
											<th width="20%">จัดการ</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$num = 1;
										while($result = mysqli_fetch_assoc($query)) { ?>
										<tr>
											<td align="center"><?php echo $num; ?></td>
											<td><?php echo $result["sub_name"]; ?></td>
											<td align="center">
												<a href="edit_sub_skill.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>&id=<?php echo $result["id"]; ?>&skill_id=<?php echo $_GET["id"]; ?>" class="btn btn-warning">แก้ไข</a>
												<a href="do_delete_sub_skill.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>&id=<?php echo $result["id"]; ?>&skill_id=<?php echo $_GET["id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบ <?php echo $result["sub_name"]; ?> ใช่หรือไม่ ?')">ลบ</a>
											</td>
										</tr>
										<?php $num++; } ?>
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