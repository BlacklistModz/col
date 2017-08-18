<?php
include("../header.php");
include("../sidebar.php");

$sql->table="tbl_document";
$sql->condition="ORDER By id";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการข้อมูลเอกสารสหกิจศึกษา
			<small>เพิ่ม-ลบ/แก้ไข ข้อมูลเอกสารสหกิจศึกษา</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">จัดการข้อมูลเอกสารสหกิจศึกษา</li>
		</ol>
	</section>
	<section class="content">
		<input type="hidden" name="checkSubmit" value="1">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">
							<a href="add.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-success">เพิ่มเอกสาร</a>
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
											<th width="40%">ชื่อเอกสาร</th>
											<th width="15%">วันที่ปรับปรุง</th>
											<th width="15%">กำหนดส่ง</th>
											<th align="center" width="10%">จัดการ</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$num = 1;
										while($result = mysqli_fetch_assoc($query)) { ?>
										<tr>
											<td align="center"><?php echo $num; ?></td>
											<td><a href="../../upload/doc/<?php echo $result["doc_file"]; ?>" target="_blank"><?php echo $result["doc_name"]; ?></a></td>
											<td align="center"><?php echo DateThai($result["upload_date"]); ?></td>
											<td align="center">
											<?php
											if($result["doc_date"] == "0000-00-00")
											{
												echo "ไม่มีกำหนดส่ง";
											} 
											else
											{
												echo DateThai($result["doc_date"]);
											}
											?>
											</td>
											<td align="center">
												<a href="edit.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-warning" data-toggle="tooltip" title="แก้ไขข้อมูลของ <?php echo $result["doc_name"]; ?>">แก้ไข</a>
												<a href="do.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบ <?php echo $result["doc_name"]; ?> ใช่หรือไม่ ?')">ลบ</a>
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
	<script type="text/javascript">
		$("#checkAll").click(function(){
			$('input:checkbox').not(this).prop('checked', this.checked);
		});
	</script>