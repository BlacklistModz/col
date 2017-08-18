<?php
include("../header.php");
include("../sidebar.php");

$sql->table="tbl_skill";
$sql->condition="";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการประเภทความสามารถพิเศษ
			<small>เพิ่ม-ลบ/แก้ไข ประเภทความสามารถพิเศษ</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">จัดการประเภทความสามารถพิเศษ</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title"><a href="add_skill.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>" class="btn btn-success">เพิ่มประเภทความสามารถพิเศษ</a></h3>
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
											<th width="70%">ประเภทความสามารถพิเศษ</th>
											<th width="20%">จัดการ</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$num = 1;
										while($result = mysqli_fetch_assoc($query)) { ?>
										<tr>
											<td align="center"><?php echo $num; ?></td>
											<td><a href="index_subskill.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>&id=<?php echo $result["id"]; ?>"><?php echo $result["skill_name"]; ?></a></td>
											<td align="center">
												<a href="add_sub_skill.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-success"> เพิ่มความสามารถพิเศษ</a>
												<a href="edit_skill.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-warning">แก้ไข</a>
												<a href="do_delete_skill.php?page=<?php echo $_GET["page"]; ?>&fid=<?php echo $_GET["fid"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบ <?php echo $result["skill_name"]; ?> ใช่หรือไม่ ? \n ** การลบข้อมูลประเภทความสามารถพิเศษ ** \n ** จะรวมถึงการลบข้อมูลความสามารถพิเศษของประเภทที่เลือก **')">ลบ</a>
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