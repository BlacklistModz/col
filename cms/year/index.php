<?php
include("../header.php");
include("../sidebar.php");

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year desc";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการปีการศึกษา
			<small>เพิ่ม-ลบ/แก้ไข ปีการศึกษา</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">จัดการปีการศึกษา</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title"><a href="add.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-success">เพิ่มปีการศึกษา</a></h3>
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
										<th width="70%">ปีการศึกษา</th>
										<th width="10%">จำนวนภาคเรียน</th>
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
											<td><a href="index_term.php?page=<?=$_GET["page"]?>&id=<?=$result["id"]?>">ปีการศึกษา <?php echo $result["academic_year"]; ?></a></td>
											<td class="text-center">
												<?php 
												$sql->table="tbl_term";
												$sql->condition="WHERE term_year_id={$result["id"]}";
												echo mysqli_num_rows($sql->select());
												?>
											</td>
											<td align="center">
												<a href="add_term.php?page=<?=$_GET["page"]?>&id=<?=$result["id"]?>" class="btn btn-primary">เพิ่มภาคเรียน</a>
												<a href="edit.php?page=<?php echo $_GET["page"] ?>&id=<?php echo $result["id"]; ?>" class="btn btn-warning">แก้ไข</a>
												<a href="do_delete.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบปีการศึกษา <?php echo $result["academic_year"]; ?> ใช่หรือไม่ ?')">ลบ</a>
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