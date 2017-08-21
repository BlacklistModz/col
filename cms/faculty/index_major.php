<?php
include("../header.php");
include("../sidebar.php");

$page = $_GET["page"];
$id = $_GET["id"];

$sql->table="tbl_faculty";
$sql->condition="WHERE faculty_id={$id}";
$query = $sql->select();
$numRow = mysqli_num_rows($query);

if( empty($numRow) ){
	header("location:index.php?page={$page}");
}

$faculty = mysqli_fetch_assoc($query);

$sql->table="tbl_majors";
$sql->condition="WHERE major_faculty_id={$id}";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			คณะ<?=$faculty['faculty_name']?>
			<small>เพิ่ม-ลบ/แก้ไข ข้อมูลคณะ<?=$faculty['faculty_name']?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="index.php?page=<?=$page?>"> จัดการข้อมูลคณะ / สาขาวิชา</a></li>
			<li class="active">คณะ<?=$faculty['faculty_name']?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">
							<a href="add_major.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $_GET["id"]; ?>" class="btn btn-success">เพิ่มสาขาวิชา</a>
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
											<th width="75%">ชื่อสาขาวิชา</th>
											<th width="10%">จำนวนนักศึกษา (คน)</th>
											<th width="10%">จัดการ</th>
										</tr>
									</thead>
									<tbody>
									<?php $num=0; while($results = mysqli_fetch_assoc($query)) { $num++; ?>
										<tr>
											<td class="text-center"><?=$num?></td>
											<td><?=$results['major_name']?></td>
											<td class="text-center">
												<?php 
												$sql->table="tbl_student";
												$sql->condition="WHERE major_id={$results['major_id']}";
												$numRow = mysqli_num_rows($sql->select());
												echo $numRow;
												?>
											</td>
											<td class="text-center">
												<?php 
												$cls = "btn btn-danger";
												$attr = "";
												$name = "ลบ";
												if( !empty($numRow) ){
													$cls .= " disabled";
													$attr .= 'disabled="disabled"';
													$name =  '<i class="fa fa-lock"></i>';
												}
												?>
												<a href="edit_major.php?page=<?=$page?>&id=<?=$results["major_id"]?>&faculty=<?=$results["major_faculty_id"]?>" class="btn btn-warning">แก้ไข</a>
												<a href="del_major.php?page=<?=$page?>&id=<?=$results["major_id"]?>" class="<?=$cls?>" <?=$attr?>><?=$name?></a>
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
		</section>
	</div>
	<?php include("../footer.php"); ?>