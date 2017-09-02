<?php
include("../header.php");
include("../sidebar.php");

$id = $_GET["id"];
$sql->table="tbl_year";
$sql->condition="WHERE id={$id}";
$q_year = $sql->select();

$numRow = mysqli_num_rows($q_year);
if( empty($numRow) ) header("location:index.php?page={$_GET["page"]}");

$rs_year = mysqli_fetch_assoc($q_year);

$sql->table="tbl_term";
$sql->condition="";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการภาคเรียน
			<small>เพิ่ม-ลบ/แก้ไข รูปภาพสไลด์</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="index.php?page=<?=$_GET["page"]?>"> ปีการศึกษา <?=$rs_year["academic_year"]?></a></li>
			<li class="active">จัดการภาคเรียน</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title"><a href="add_term.php?page=<?php echo $_GET["page"]; ?>&id=<?=$rs_year["id"]?>" class="btn btn-success">เพิ่มภาคเรียน</a></h3>
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
										<th width="60%"></th>
										<th width="20%">ช่วงเวลา</th>
										<th width="10%">จัดการ</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=0; while($result = mysqli_fetch_assoc($query)) { $no++; ?>
									<tr>
										<td class="text-center"><?=$no?></td>
										<td>ภาคเรียนที่ <?=$result["term_name"]?></td>
										<td class="text-center">
											<?php 
											$start = DateThai($result["term_start"], true);
											$end = DateThai($result["term_end"], true);

											echo "<b>{$start}</b>  -  <b>{$end}</b>";
											?>
										</td>
										<td class="text-center">
											<a href="edit_term.php?page=<?=$_GET["page"]?>&id=<?=$result["term_id"]?>" class="btn btn-warning"> แก้ไข</a>
											<?php 
											$sql->table="tbl_corporation";
											$sql->condition="WHERE term_id={$result["term_id"]}";
											$numRow = mysqli_num_rows($sql->select());

											$cls = 'btn btn-danger';
											$dis = '';
											if( $numRow > 1 ){
												$cls .= ' disabled';
												$dis = ' disabled="1"';
											}
											?>
											<a href="del_term.php?page=<?=$_GET["page"]?>&id=<?=$result["term_id"]?>" class="<?=$cls?>" <?=$dis?>> ลบ</a>
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