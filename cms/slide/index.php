<?php
include("../header.php");
include("../sidebar.php");

$sql->table="tbl_slide";
$sql->condition="ORDER By rank asc";
$query = $sql->select();
$numRow = mysqli_num_rows($query);

$sql->table="tbl_slide";
$sql->condition="ORDER By rank DESC limit 0,1";
$queryLast = $sql->select();
$result_last = mysqli_fetch_assoc($queryLast);
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการรูปภาพสไลด์
			<small>เพิ่ม-ลบ/แก้ไข รูปภาพสไลด์</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">จัดการรูปภาพสไลด์</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title"><a href="add.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-success">เพิ่มรูปภาพ</a></h3>
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
										<th width="25%">รูปภาพ</th>
										<th width="10%">ลำดับการแสดง</th>
										<th width="10%">สถานะ</th>
										<th width="7%">เลื่อน</th>
										<th width="13%">จัดการ</th>
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
											<td align="center">
												<?php 
												if($result["img"])
												{
													?>
													<img src="../../upload/slide/<?php echo $result["img"]; ?>" style="max-width:100%;max-height:150px">
													<?php
												}
												else
												{
													?>
													<img style="max-width:100%;max-height:150px">
													<?php
												}
												?>
											</td>
											<td align="center"><?php echo $result["rank"]; ?></td>
											<td align="center">
												<?php 
												if($result["slide_status"] == "0")
												{
													echo "แสดงผล";
												}
												else
												{
													echo "ไม่แสดงผล";
												}
												?>
											</td>
											<td align="center">
												<?php
												if($numRow != "1")
												{
													if($result["rank"]=="1")
													{ 
														?>
														<a href="do_rank.php?page=<?php echo $_GET["page"]; ?>&action=down&id=<?php echo $result["id"]; ?>"><i class="fa fa-long-arrow-down" style="font-size:20px"></i></a>
														<?php 
													}
													elseif($result["rank"]==$result_last["rank"])
													{ 
														?>
														<a href="do_rank.php?page=<?php echo $_GET["page"]; ?>&action=up&id=<?php echo $result["id"]; ?>" class="text-green" style="padding-right:5px"><i class="fa fa-long-arrow-up" style="font-size:20px"></i></a>
														<?php 
													}
													else
													{ 
														?>
														<a href="do_rank.php?page=<?php echo $_GET["page"]; ?>&action=up&id=<?php echo $result["id"]; ?>" class="text-green" style="padding-right:5px"><i class="fa fa-long-arrow-up" style="font-size:20px"></i></a>
														<a href="do_rank.php?page=<?php echo $_GET["page"]; ?>&action=down&id=<?php echo $result["id"]; ?>"><i class="fa fa-long-arrow-down" style="font-size:20px"></i></a>
														<?php 
													} 
												}
												else
												{
													?>
													<a href="#" class="text-red"><i class="fa fa-times" tyle="font-size:20px"></i></a>
													<?php
												}
												?>
											</td>
											<td align="center">
												<a href="do_status.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-info">ปรับสถานะ</a>
												<a href="edit.php?page=<?php echo $_GET["page"] ?>&id=<?php echo $result["id"]; ?>" class="btn btn-warning">แก้ไข</a>
												<a href="do_delete.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบสไลด์ลำดับที่ <?php echo $result["rank"]; ?> ใช่หรือไม่ ?')">ลบ</a>
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