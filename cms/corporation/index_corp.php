<?php
include("../header.php");
include("../sidebar.php");

$user_id = $_GET["user_id"];

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$user_id'";
$queryUser = $sql->select();
$resultUser = mysqli_fetch_assoc($queryUser);

$sql->table="tbl_corporation";
$sql->condition="WHERE user_id='$user_id'";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			สถานประกอบการในความดูแลของคุณ <?php echo $resultUser["name"]; ?> | <?php echo $resultUser["username"]; ?>
			<small>รายชื่อสถานประกอบการ</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="index.php?page=<?php echo $_GET["page"]; ?>"> ตรวจสอบสถานประกอบการ</a></li>
			<li class="active">รายชื่อสถานประกอบการ</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">รายชื่อสถานประกอบการ ในความดูแลของคุณ <?php echo $resultUser["name"]; ?> | <?php echo $resultUser["username"]; ?></h3>
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
											<th width="25%">ชื่อสถานประกอบการ</th>
											<th width="25%">ที่อยู่</th>
											<th width="10%">ลงทะเบียนเมื่อ</th>
											<th width="10%">เบอร์โทร</th>
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
												<td><?php echo $result["address"]; ?></td>
												<td align="center">
													<?php 
													$sql->table="tbl_year";
													$sql->condition="WHERE id='".$result["year_id"]."'";
													$queryYear = $sql->select();
													$numRow = mysqli_num_rows($queryYear);
													if($numRow == 0)
													{
														echo "ยังไม่ได้ลงทะเบียน";
													}
													else
													{
														$resultYear = mysqli_fetch_assoc($queryYear);
														echo "ปีการศึกษา ".$resultYear["academic_year"];
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