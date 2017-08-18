<?php
include("../header.php");
include("../sidebar.php");

$id = $_GET["id"];

$sql->table="tbl_authentication";
$sql->condition="WHERE id='$id'";
$queryStudent = $sql->select();
$resultStudent = mysqli_fetch_assoc($queryStudent);

$sql->table="tbl_assess_work";
$sql->condition="ORDER By id ASC";
$query = $sql->select();

$sql->table="tbl_stu_asswork";
$sql->condition="WHERE stu_id='$id'";
$queryWork = $sql->select();
$resultWork = mysqli_fetch_assoc($queryWork);
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			รายงานการประเมินการปฏิบัติงานสหกิจศึกษา
			<!-- <small>เพิ่ม-ลบ/แก้ไข ข้อมูลข่าวสารประชาสัมพันธ์</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="index_assess.php?page=<?php echo $_GET["page"]; ?>&rid=<?php echo $_GET["rid"]; ?>"> รายงานการประเมิน</a></li>
			<li class="active"> รายงานการประเมินการปฏิบัติงานสหกิจศึกษา</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title form-inline">นักศึกษา <?php echo $resultStudent["username"]; ?> | <?php echo $resultStudent["name"]; ?></h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="ซ่อน">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
						<div class="stu_id" data-id="<?php echo $_GET["id"]; ?>" data-stu="<?php echo $resultStudent["username"]; ?>"></div>
						<div class="table-responsive">
							<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th width="5%">ลำดับ</th>
										<th width="85%">ด้านการประเมิน</th>
										<th width="10%">คะแนนที่ได้</th>
										<th width="10%">คิดเป็นเปอร์เซ็น</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$num = 1;
									$sum_point = 0;
									$sum_fullpoint = 0;
									while($result = mysqli_fetch_assoc($query)) 
									{
										$point = 0;

										$sql->table="tbl_assess_sub";
										$sql->condition="WHERE ass_id='{$result["id"]}'";
										$querySub = $sql->select();
										$numAssess = mysqli_num_rows($querySub);
										while($resultSub = mysqli_fetch_assoc($querySub))
										{
											$sql->table="tbl_stu_asswork_detail";
											$sql->condition="WHERE asswork_id='{$resultWork["id"]}' and ass_sub_id='{$resultSub["id"]}'";
											$queryAssess = $sql->select();
											$resultAssess = mysqli_fetch_assoc($queryAssess);
											$point = $point + $resultAssess["ass_point"];
										}
										$FullPoint = $numAssess*5;
										$persent = $point/$FullPoint * 100;

										$sum_point = $sum_point + $point;
										$sum_fullpoint = $sum_fullpoint + $FullPoint;
										?>
										<tr>
											<td align="center"><?php echo $num; ?></td>
											<td><?php echo $result["topic"]; ?></td>
											<td align="center"><?php echo $point." / ".$FullPoint; ?></td>
											<td align="center"><?php echo number_format($persent, 2, '.', '')."%"; ?></td>
										</tr>
										<?php 
										$num++;
									} 
									?>
									<tr>
										<td align="center"><?php echo $num; ?></td>
										<td align="center">คิดเป็นคะแนน / เปอร์เซ็นต์รวม</td>
										<td align="center"><?php echo $sum_point." / ".$sum_fullpoint; ?></td>
										<td align="center">
											<?php 
											$sql->table="tbl_stu_asswork_detail";
											$sql->condition="WHERE asswork_id='{$resultWork["id"]}'";
											$querySum = $sql->select();
											$Sum = mysqli_num_rows($querySum);
											$SumPoint = 0;
											$Full_Point = $Sum*5;
											while($resultSum = mysqli_fetch_assoc($querySum))
											{
												$SumPoint = $SumPoint + $resultSum["ass_point"];
											}
											$persentSum = $SumPoint/$Full_Point * 100;
											echo number_format($persentSum, 2, '.', '')."%";
											?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="box-footer">
						<a href="index_assess.php?page=<?php echo $_GET["page"]; ?>&rid=<?php echo $_GET["rid"]; ?>" class="btn btn-danger pull-right">ยกเลิก</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php include("../footer.php"); ?>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
	$(document).ready(function() 
	{
		var id = $(".stu_id").data("id");
		var stu = $(".stu_id").data("stu");
		var options = {
			chart: {
				renderTo: 'container',
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			title: {
				text: 'กราฟรายงานสถิติการปฏิบัติงานสหกิจศึกษา รหัส '+stu
			},
			tooltip: {
				formatter: function() {
					return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
				}
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						color: '#000000',
						connectorColor: '#000000',
						formatter: function() {
							return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
						}
					}
				}
			},
			series: [{
				type: 'pie',
				name: 'Browser share',
				data: []
			}]
		}
		$.getJSON("report_piechart.php?id="+id, function(json) {
			options.series[0].data = json;
			chart = new Highcharts.Chart(options);
		});
	});   
</script>
