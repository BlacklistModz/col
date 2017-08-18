<?php
include("../header.php");
include("../sidebar.php");

if(isset($_GET["group"]) and $_GET["group"] != "")
{
	$group = $_GET["group"];
	$condition = "and username LIKE '$group%'";
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
			จัดการข้อมูลนักศึกษา
			<small>เพิ่ม-ลบ/แก้ไข ข้อมูลนักศึกษา</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">จัดการข้อมูลนักศึกษา</li>
		</ol>
	</section>
	<section class="content">
		<form action="do_status_all.php?page=<?php echo $_GET["page"]; ?>" method="POST">
			<input type="hidden" name="checkSubmit" value="1">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title form-inline">
								<a href="add_student.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-success">เพิ่มนักศึกษา</a>
								<select class="form-control" name="group" onchange="window.location='?page=<?php echo $_GET["page"]; ?>&group='+this.value;">
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
									<i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th align="center" width="5%">ลำดับ</th>
												<th width="10%">รหัสนักศึกษา</th>
												<th width="30%">ชื่อ-สกุล</th>
												<th width="10%">ปีการศึกษา</th>
												<th width="10%">สถานะ</th>
												<th width="5%">ใบสมัคร</th>
												<th width="7%">กรอกใบสมัครเมื่อ</th>
												<th width="10%">จัดการ</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$num = 1;
											while($result = mysqli_fetch_assoc($query)) { ?>
											<tr>
												<td align="center"><?php echo $num; ?></td>
												<td><?php echo $result["username"]; ?></td>
												<td><?php echo $result["name"]; ?></td>
												<td align="center">
													<?php 
													$sql->table="tbl_year";
													$sql->field="*";
													$sql->condition="WHERE id='{$result["accept_year_id"]}'";
													$queryYear = $sql->select();
													$resultYear = mysqli_fetch_assoc($queryYear);
													echo $resultYear["academic_year"];
													?>
												</td>
												<td align="center">
													<?php 
													$sql->table="tbl_status";
													$sql->field="*";
													$sql->condition="WHERE id='".$result["status_id"]."'";
													$queryStatus = $sql->select();
													$resultStatus = mysqli_fetch_assoc($queryStatus);
													echo $resultStatus["name"];
													?>
												</td>
												<td align="center">
													<a href="student_info.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-primary">แก้ไขใบสมัคร</a>
												</td>
												<td align="center">
													<?php 
													$sql->table="tbl_student";
													$sql->condition="WHERE user_id='{$result["id"]}'";
													$queryStu = $sql->select();
													$resultStu = mysqli_fetch_assoc($queryStu);
													if($resultStu["update_date"] != "0000-00-00")
													{
														echo DateThai($resultStu["update_date"]);
													}
													else
													{
														echo "ไม่ได้กรอกใบสมัคร";
													}
													?>
												</td>
												<td align="center">
													<a href="edit_student.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-warning" data-toggle="tooltip" title="แก้ไขข้อมูลของ <?php echo $result["name"]; ?>">แก้ไข</a>
													<a href="do_delete.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบนักศึกษารหัส <?php echo $result["username"]; ?> ใช่หรือไม่ ?')">ลบ</a>
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
			</form>
		</section>
	</div>
	<?php include("../footer.php"); ?>
	<script type="text/javascript">
		$("#checkAll").click(function(){
			$('input:checkbox').not(this).prop('checked', this.checked);
		});
	</script>