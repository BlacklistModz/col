<?php
include("../header.php");
include("../sidebar.php");

$send_id = $_GET["send_id"];
$stu_id = $_GET["stu_id"];

$sql->table="tbl_stu_send";
$sql->condition="WHERE id='$send_id' and stu_id='$stu_id'";
$querySend = $sql->select();
$resultSend = mysqli_fetch_assoc($querySend);

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$stu_id'";
$resultStudent = mysqli_fetch_assoc($sql->select());

$sql->table="tbl_document";
$sql->condition="WHERE id='{$resultSend["doc_id"]}'";
$resultDoc = mysqli_fetch_assoc($sql->select());

$sql->table="tbl_stu_send_detail";
$sql->condition="WHERE send_id='$send_id'";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			ดาวน์โหลดเอกสาร <?php echo $resultDoc["doc_name"]; ?> | นักศึกษา <?php echo $resultStudent["username"]." - ".$resultStudent["name"]; ?>
			<!-- <small>เพิ่ม-ลบ/แก้ไข ข้อมูลข่าวสารประชาสัมพันธ์</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="doc_detail.php?page=<?php echo $_GET["page"]; ?>&rid=<?php echo $_GET["rid"]; ?>&stu_id=<?php echo $_GET["stu_id"]; ?>"></a> รายงานการส่งเอกสาร</li>
			<li class="active">ดาวน์โหลดเอกสาร</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">เอกสาร <?php echo $resultDoc["doc_name"]; ?> | <?php echo $resultStudent["username"]." - ".$resultStudent["name"]; ?></h3>
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
										<th width="65%">รายชื่อไฟล์</th>
										<th width="15%">วันที่อัพโหลด</th>
										<th width="15%">ดาวน์โหลด</th>
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
											<td><a href="../../upload/student_doc/<?php echo $result["doc_file"]; ?>" target="_blank"><?php echo $resultStudent["username"]."_".$result["upload_date"]."-".$num; ?></a></td>
											<td align="center"><?php echo DateThai($result["upload_date"]); ?></td>
											<td align="center"><a href="../../upload/student_doc/<?php echo $result["doc_file"]; ?>" target="_blank" class="btn btn-success">ดาวน์โหลด</a></td>
										</tr>
										<?php 
										$num++; 
									} 
									?>
								</tbody>
							</table>
						</div>
						<div class="box-footer">
							<a href="doc_detail.php?page=<?php echo $_GET["page"]; ?>&rid=<?php echo $_GET["rid"]; ?>&stu_id=<?php echo $stu_id; ?>" class="btn btn-primary pull-right">กลับหน้าหลัก</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php include("../footer.php"); ?>