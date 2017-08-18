<?php
include("../header.php");
include("../sidebar.php");

$cate_id = $_GET["cate_id"];

if($cate_id == "1")
{
	$cate_name = "ประชาสัมพันธ์";
}
elseif($cate_id == "2")
{
	$cate_name = "กิจกรรม";
}
else
{
	header("location:index.php?page={$_GET["page"]}&wid={$_GET["wid"]}&cate_id=1");
}

$sql->table="tbl_news";
$sql->condition="WHERE cate_id = '$cate_id' and news_status = '0' ORDER By id desc";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการข้อมูลข่าวสาร<?php echo $cate_name; ?>
			<small>เพิ่ม-ลบ/แก้ไข ข้อมูลข่าวสาร<?php echo $cate_name; ?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">จัดการข้อมูลข่าวสาร<?php echo $cate_name; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title"><a href="add.php?page=<?php echo $_GET["page"]; ?>&wid=<?php echo $_GET["wid"]; ?>&cate_id=<?php echo $cate_id; ?>" class="btn btn-success">เพิ่มข่าวสาร<?php echo $cate_name; ?></a></h3>
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
										<th>ลำดับ</th>
										<th>หัวข้อข่าวสาร<?php echo $cate_name; ?></th>
										<th>ประกาศเมื่อ</th>
										<th>ปรับปรุงเมื่อ</th>
										<th>สถานะ</th>
										<th>จัดการ</th>
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
											<td><?php echo $result["topic"]; ?></td>
											<td align="center"><?php echo DateTimeThai($result["create_date"]); ?></td>
											<td align="center">
												<?php 
												if($result["update_date"] == "0000-00-00 00:00:00")
												{
													echo "ยังไม่มีการปรับปรุง";
												}
												else
												{
													echo DateTimeThai($result["update_date"]);
												}
												?>
											</td>
											<td align="center">
												<?php 
												if($result["news_status"] == "0")
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
												<a href="do_status.php?page=<?php echo $_GET["page"]; ?>&wid=<?php echo $_GET["wid"]; ?>&cate_id=<?php echo $_GET["cate_id"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-info">ปรับสถานะ</a>
												<a href="edit.php?page=<?php echo $_GET["page"]; ?>&wid=<?php echo $_GET["wid"]; ?>&cate_id=<?php echo $_GET["cate_id"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-warning">แก้ไข</a>
												<a href="do_delete.php?page=<?php echo $_GET["page"]; ?>&wid=<?php echo $_GET["wid"]; ?>&cate_id=<?php echo $_GET["cate_id"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบ <?php echo $result["topic"]; ?> ใช่หรือไม่ ?')">ลบ</a>
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