<?php
include("../header.php");
include("../sidebar.php");

$stu_id = $_GET["stu_id"];

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$stu_id'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			รายงานการส่งเอกสารและการประเมินของนักศึกษา | <?php echo $result["username"]; ?> : <?php echo $result["name"]; ?>
			<!-- <small>เพิ่ม-ลบ/แก้ไข ข้อมูลข่าวสารประชาสัมพันธ์</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">รายงานการส่งเอกสารและการประเมิน</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title form-inline">
							<label><i class="fa fa-check text-green"></i> ส่งภายในกำหนด , <i class="fa fa-check text-red"></i> ส่งเกินกำหนด , <i class="fa fa-times text-red"></i> ไม่มีข้อมูล การส่ง/การประเมิน , <button class="btn btn-success">ดาวน์โหลด</button> ดาวน์โหลดแบบ 1 ไฟล์ , <button class="btn btn-primary">ดาวน์โหลด</button> ดาวน์โหลดตั้งแต่ 1 ไฟล์ขึ้นไป</label>
						</h3>
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
										<th width="10%">ลำดับ</th>
										<th width="60%">เอกสาร / การประเมิน</th>
										<th width="15%">สถานะ</th>
										<th width="15%">ดาวน์โหลด</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$sql->table="tbl_document";
									$sql->condition="WHERE doc_date NOT LIKE '0000-00-00' ORDER By id ASC";
									$queryDoc = $sql->select();
									$num = 1;
									while($resultDoc = mysqli_fetch_assoc($queryDoc)) 
									{
										?>
										<tr>
											<td align="center"><?php echo $num; ?></td>
											<td><?php echo $resultDoc["doc_name"]; ?></td>
											<td align="center">
												<?php
												$sql->table="tbl_stu_send";
												$sql->condition="WHERE stu_id='$stu_id' and doc_id='{$resultDoc["id"]}'";
												$querySend = $sql->select();
												$numSend = mysqli_num_rows($querySend);
												if($numSend > 0)
												{
													$resultSend = mysqli_fetch_assoc($querySend);

													if($resultSend["send_date"] <= $resultDoc["doc_date"])
													{
														$class = "fa fa-check text-green";
													}
													else
													{
														$class = "fa fa-check text-red";
													}
												}
												else
												{
													$class = "fa fa-times text-red";
												}
												?>
												<i class="<?php echo $class; ?>"></i>
											</td>
											<td align="center">
												<?php
												if($numSend > 0)
												{
													$sql->table="tbl_stu_send_detail";
													$sql->condition="WHERE send_id='{$resultSend["id"]}'";
													$queryDetail = $sql->select();
													$numDetail = mysqli_num_rows($queryDetail);
													$resultDetail = mysqli_fetch_assoc($queryDetail);
													if($numDetail == 1)
													{
														?>
														<a href="../../upload/student_doc/<?php echo $resultDetail["doc_file"]; ?>" class="btn btn-success" target="_blank">ดาวน์โหลด</a>
														<?php
													}
													elseif($numDetail > 1)
													{
														?>
														<a href="download_doc.php?page=<?php echo $_GET["page"]; ?>&rid=<?php echo $_GET["rid"]; ?>&stu_id=<?php echo $_GET["stu_id"]; ?>&send_id=<?php echo $resultSend["id"]; ?>" class="btn btn-primary">ดาวน์โหลด</a>
														<?php
													}
												}
												else
												{
													echo "ไม่มีข้อมูล";
												}
												?>
											</td>
										</tr>
										<?php 
										$num++; 
									} 
									?>
									<tr>
										<td align="center"><?php echo $num; ?></td>
										<td>การประเมินรายงานสหกิจศึกษา</td>
										<td align="center">
											<?php 
											$sql->table="tbl_stu_assreport";
											$sql->condition="WHERE stu_id='{$result["id"]}'";
											$queryReport = $sql->select();
											$numReport = mysqli_num_rows($queryReport);
											if($numReport > 0)
											{
												?>
												<i class="fa fa-check text-green"></i>
												<?php
											}
											else
											{
												?>
												<i class="fa fa-times text-red"></i>
												<?php
											}
											?>
										</td>
										<td align="center"><a href="assess_report.php?page=<?php echo $_GET["page"]; ?>&rid=report&id=<?php echo $_GET["stu_id"]; ?>" class="btn btn-success">ผลการประเมิน</a></td>
									</tr>
									<tr>
										<td align="center"><?php echo $num+1; ?></td>
										<td>การประเมินรายงานสหกิจศึกษา</td>
										<td align="center">
											<?php 
											$sql->table="tbl_stu_asswork";
											$sql->condition="WHERE stu_id='{$result["id"]}'";
											$queryWork = $sql->select();
											$numWork = mysqli_num_rows($queryWork);
											if($numWork > 0)
											{
												?>
												<i class="fa fa-check text-green"></i>
												<?php
											}
											else
											{
												?>
												<i class="fa fa-times text-red"></i>
												<?php
											}
											?>
										</td>
										<td align="center"><a href="assess_work.php?page=<?php echo $_GET["page"]; ?>&rid=report&id=<?php echo $_GET["stu_id"]; ?>" class="btn btn-success">ผลการประเมิน</a></td>
									</tr>
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