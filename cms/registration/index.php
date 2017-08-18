<?php
include("../header.php");
include("../sidebar.php");

if(isset($_GET["group"]) and $_GET["group"] != "")
{
	$group = $_GET["group"];
	$condition = "and username LIKE '$group%'";
}
else
{
	$condition = "";
}

$sql->table="tbl_authentication";
$sql->condition="WHERE (status_id='4' or status_id='5') $condition";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			ทะเบียนการฝึกสหกิจ
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">ทะเบียนการฝึกสหกิจ</li>
		</ol>
	</section>
	<section class="content">
		<form action="do_status_all.php?page=<?php echo $_GET["page"]; ?>" method="POST" id="stu_status">
			<input type="hidden" name="checkSubmit" value="1">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title form-inline">
								<select class="form-control" name="group" onchange="window.location='?page=<?php echo $_GET["page"]; ?>&group='+this.value;">
									<option value="">--- นักศึกษาทั้งหมด ---</option>
									<?php 
									$sql->table="tbl_authentication";
									$sql->field="substr(username,1,9) AS stu_group";
									$sql->condition="WHERE status_id='4' or status_id='5' GROUP By stu_group DESC";
									$queryGroup = $sql->select();
									while($resultGroup = mysqli_fetch_assoc($queryGroup))
									{
										?>
										<option value="<?php echo $resultGroup["stu_group"]; ?>" <?php if(isset($_GET["group"]) and $_GET["group"] == $resultGroup["stu_group"]) { echo "selected"; } ?>><?php echo $resultGroup["stu_group"]; ?> [รหัส : <?php echo substr($resultGroup["stu_group"],0,2); ?>]</option>
										<?php
									}
									?>
								</select>
								<button type="submit" class="btn btn-primary">ปรับสถานะ</button>
							</h3>
							<div class="box-tools pull-right">
								<label><input type="checkbox" id="checkAll" /> เลือก/ไม่เลือก ทั้งหมด</label>
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
												<th width="15%">รหัสนักศึกษา</th>
												<th width="20%">ชื่อ-สกุล</th>
												<th width="20%">สถานประกอบการที่ฝึกงาน</th>
												<th width="20%">ตำแหน่ง</th>
												<th width="10%">สถานะ</th>
												<th width="5%">เลือกปรับสถานะ</th>
												<th align="center" width="10%"></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$num = 1;
											while($result = mysqli_fetch_assoc($query)) 
											{ 
												$sql->table="tbl_stu_job";
												$sql->field="*";
												$sql->condition="WHERE stu_id='{$result["id"]}' and job_status='3'";
												$queryJob = $sql->select();
												$numJob = mysqli_num_rows($queryJob);
												$resultJob = mysqli_fetch_assoc($queryJob);
												?>
												<tr>
													<td align="center"><?php echo $num; ?></td>
													<td align="center"><?php echo $result["username"]; ?></td>
													<td><?php echo $result["name"]; ?></td>
													<td>
														<?php 
														$sql->table="tbl_position";
														$sql->field="*";
														$sql->condition="WHERE id='{$resultJob["pos_id"]}'";
														$queryPos = $sql->select();
														$resultPos = mysqli_fetch_assoc($queryPos);

														$sql->table="tbl_corporation";
														$sql->condition="WHERE id='{$resultPos["corp_id"]}'";
														$queryCorp = $sql->select();
														$resultCorp = mysqli_fetch_assoc($queryCorp);
														echo $resultCorp["name_th"];
														?>
													</td>
													<td><?php echo $resultPos["pos_name"]; ?></td>
													<td align="center">
														<?php 
														$sql->table="tbl_status";
														$sql->field="*";
														$sql->condition="WHERE id='".$result["status_id"]."'";
														$queryStatus = $sql->select();
														$resultStatus = mysqli_fetch_assoc($queryStatus);
														echo $resultStatus["name"];
														?>
													</td>
													<td align="center">
														<?php
														if($numJob > 0)
														{
															?>
															<input type="checkbox" name="id[]" value="<?php echo $result["id"]; ?>">
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
													<td align="center">
														<?php
														if($numJob > 0)
														{
															?>
															<a href="do_status.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-success" data-toggle="tooltip" title="ปรับสถานะของ <?php echo $result["name"]; ?>">ปรับสถานะ</a>
															<?php 
														}
														else
														{
															?>
															<button class="btn btn-danger" disabled><i class="fa fa-times"></i></button>
															<?php
														}
														?>
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
				</form>
			</section>
		</div>
		<?php include("../footer.php"); ?>
		<script type="text/javascript">
			$('#checkAll').on('click', function()
			{
				//var rows = table.rows({ 'search': 'applied' }).nodes();
				$('input[type="checkbox"]').prop('checked', this.checked);
			});

			$('tbody').on('change', 'input[type="checkbox"]', function(){
				if(!this.checked){
					var el = $('#checkAll').get(0);

					if(el && el.checked && ('indeterminate' in el))
					{
						el.indeterminate = true;
					}
				}
			});

			$('#stu_status').on('submit', function(e){
				var form = this;

				table.$('input[type="checkbox"]').each(function()
				{
					if(!$.contains(document, this))
					{
						if(this.checked)
						{
							$(form).append($('<input>').attr('type', 'hidden').attr('name', this.name).val(this.value));
						}
					} 
				});
			});
		</script>