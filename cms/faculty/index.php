<?php
include("../header.php");
include("../sidebar.php");

$sql->table="tbl_faculty";
$sql->condition="";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการข้อมูลคณะ / สาขาวิชา
			<small>เพิ่ม-ลบ/แก้ไข ข้อมูลคณะ / สาขาวิชา</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">จัดการข้อมูลคณะ / สาขาวิชา</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">
							<a href="add_faculty.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-success">เพิ่มคณะ</a>
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
											<th width="5%">ลำดับ</th>
											<th width="60%">ชื่อคณะ</th>
											<th width="10%">จำนวนนักศึกษา (คน)</th>
											<th width="10%">จำนวนสาขาวิชา</th>
											<th width="15%">จัดการ</th>
										</tr>
									</thead>

									<tbody>
										<?php $num=0; while($results = mysqli_fetch_assoc($query)){ $num++; ?>
										<tr>
											<td class="text-center"><?=$num?></td>
											<td>
												<a href="index_major.php?page=<?=$_GET["page"]?>&id=<?=$results['faculty_id']?>">
													<?=$results['faculty_name']?>
												</a>
											</td>
											<td class="text-center">
												<?php 
												$sql->table="tbl_student";
												$sql->condition="WHERE faculty_id={$results['faculty_id']}";
												$numStu = mysqli_num_rows($sql->select());
												echo number_format($numStu);
												?>
											</td>
											<td class="text-center">
												<?php 
												$sql->table="tbl_majors";
												$sql->condition="WHERE major_faculty_id={$results['faculty_id']}";
												$numRow = mysqli_num_rows($sql->select());
												echo number_format($numRow);
												?>
											</td>
											<td>
												<a href="add_major.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $results['faculty_id']; ?>" class="btn btn-primary" data-toggle="tooltip" title="เพิ่มสาขาวิชาภายในคณะ <?php echo $results["faculty_name"]; ?>">เพิ่มสาขาวิชา
												</a>
												<a href="edit_faculty.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $results["faculty_id"]; ?>" class="btn btn-warning" data-toggle="tooltip" title="แก้ไขข้อมูลของ <?php echo $results["faculty_name"]; ?>">แก้ไข
												</a>
												<?php 
												$cls = "btn btn-danger";
												$attr = "";
												$name = "ลบ";
												if ( !empty($numRow) ) {
													$cls .= " disabled";
													$attr .= 'disabled="disabled"';
													$name =  '<i class="fa fa-lock"></i>';
												} 
												?>
												<a href="delete_faculty.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $results["faculty_id"]; ?>" class="<?=$cls?>" <?=$attr?> onclick="return confirm('คุณต้องการลบ <?php echo $results["faculty_name"]; ?> ใช่หรือไม่ ?')"><?=$name?>
												</a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php include("../footer.php"); ?>