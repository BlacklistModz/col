<?php
include("../header.php");
include("../sidebar.php");

if(isset($_GET["year_id"]) and $_GET["year_id"] != "")
{
	$sql->table="tbl_year";
	$sql->condition="WHERE id='".$_GET["year_id"]."'";
	$queryYear = $sql->select();
	$resultYear = mysqli_fetch_assoc($queryYear);
}
else
{
	$sql->table="tbl_year";
	$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
	$queryYear = $sql->select();
	$resultYear = mysqli_fetch_assoc($queryYear);

	$_GET["year_id"] = $resultYear["id"];
}

$sql->table="tbl_corporation";
$sql->condition="WHERE year_id='".$_GET["year_id"]."'";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			รายงานทะเบียนสถานประกอบการ <?php if(isset($_GET["year_id"]) and $_GET["year_id"] != "") { echo "| ปีการศึกษา".$resultYear["academic_year"]; } else { echo "(กรุณาเลือกปีการศึกษา)"; } ?>
			<!-- <small>เพิ่ม-ลบ/แก้ไข ข้อมูลข่าวสารประชาสัมพันธ์</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">รายงานทะเบียนสถานประกอบการ</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title form-inline">แสดงผล : 
							<select class="form-control" name="year_id" onchange="window.location='?page=<?php echo $_GET["page"]; ?>&rid=<?php echo $_GET["rid"]; ?>&year_id='+this.value;">
								<?php 
								$sql->table="tbl_year";
								$sql->condition="ORDER By academic_year DESC";
								$queryYear = $sql->select();
								while($resultYear = mysqli_fetch_assoc($queryYear))
								{
									?>
									<option value="<?php echo $resultYear["id"]; ?>" <?php if(isset($_GET["year_id"]) and $resultYear["id"] == $_GET["year_id"]) { echo "selected"; } ?>>ปีการศึกษา <?php echo $resultYear["academic_year"]; ?></option>
									<?php
								}
								?>
							</select>
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
										<th width="5%">ลำดับ</th>
										<th width="30%">ชื่อสถานประกอบการ</th>
										<th width="25%">ที่อยู่</th>
										<th width="20%">ตำแหน่งที่รับสมัคร</th>
										<th width="15%">เบอร์โทรศัพท์</th>
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
											<td><?php echo $result["name_th"]; ?></td>
											<td><?php echo nl2br($result["address"]); ?></td>
											<td align="center">
												<?php
												$sql->table="tbl_position";
												$sql->condition="WHERE corp_id='{$result["id"]}'";
												$queryPos = $sql->select();
												while($resultPos = mysqli_fetch_assoc($queryPos))
												{
													echo $resultPos["pos_name"]."<br/>";
												} 
												?>
											</td>
											<td align="center"><?php echo $result["phone"]; ?></td>
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