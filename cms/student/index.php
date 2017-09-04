<?php
include("../header.php");
include("../sidebar.php");

$condition = "";

if( !empty($_GET["group"]) ){
	$condition .= " AND a.username LIKE '{$_GET["group"]}%'";
}

if( !empty($_GET["faculty"]) ){
	$condition .= " AND s.faculty_id={$_GET["faculty"]}";
}

if( !empty($_GET["majors"]) ){
	$condition .= " AND s.major_id={$_GET["majors"]}";
}

if( !empty($_GET["year"]) ){
	$condition .= " AND s.year_id={$_GET["year"]}";
}

$sql->table="tbl_authentication a LEFT JOIN tbl_student s ON a.id=s.user_id";
$sql->condition="WHERE (status_id='4' or status_id='5') $condition";
$query = $sql->select();
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการข้อมูลนักศึกษา
			<small>เพิ่ม-ลบ/แก้ไข ข้อมูลนักศึกษา</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li class="active">จัดการข้อมูลนักศึกษา</li>
		</ol>
	</section>
	<section class="content">
		<div class="js-page" data-page="<?=$_GET["page"]?>"></div>
		<form action="do_status_all.php?page=<?php echo $_GET["page"]; ?>" method="POST">
			<input type="hidden" name="checkSubmit" value="1">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title form-inline">
								<a href="add_student.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-success">เพิ่มนักศึกษา</a>
								<select class="form-control js-change-group" name="group">
									<option value="">--- เลือกกลุ่มนักศึกษา ---</option>
									<?php 
									$sql->table="tbl_authentication";
									$sql->field="substr(username,1,2) AS stu_group";
									$sql->condition="WHERE status_id='4' or status_id='5' GROUP By stu_group DESC";
									$queryGroup = $sql->select();
									while($resultGroup = mysqli_fetch_assoc($queryGroup))
									{
										?>
										<option value="<?php echo $resultGroup["stu_group"]; ?>" <?php if(isset($_GET["group"]) and $_GET["group"] == $resultGroup["stu_group"]) { echo "selected"; } ?>>รหัส : <?php echo $resultGroup["stu_group"]; ?></option>
										<?php
									}
									?>
								</select>
								<select class="form-control js-change-faculty" name="faculty">
									<option value="">--- เลือกคณะ ---</option>
									<?php 
									$sql->table="tbl_faculty";
									$sql->field="*";
									$sql->condition="";
									$queryFaculty = $sql->select();
									while($resultFaculty = mysqli_fetch_assoc($queryFaculty)){
										$sel = '';
										if( !empty($_GET["faculty"]) ){
											if( $_GET["faculty"] == $resultFaculty["faculty_id"] ) {
												$sel = ' selected="1"';
											}
										}
										echo '<option'.$sel.' value="'.$resultFaculty["faculty_id"].'">'.$resultFaculty["faculty_name"].'</option>';
									}
									?>
								</select>
								<select class="form-control js-change-majors" name="majors">
									<option value="">--- เลือกสาขา ---</option>
									<?php 
									$m_condition = "";
									if( !empty($_GET["faculty"]) ) $m_condition = "WHERE major_faculty_id={$_GET["faculty"]}";

									$sql->table="tbl_majors";
									$sql->condition=$m_condition;
									$queryMajors = $sql->select();
									while($resultMajors = mysqli_fetch_assoc($queryMajors)){
										$sel = '';
										if( !empty($_GET["majors"]) ){
											if($_GET["majors"] == $resultMajors["major_id"]) $sel = ' selected="1"';
										}
										echo '<option'.$sel.' value="'.$resultMajors["major_id"].'">'.$resultMajors["major_name"].'</option>';
									}
									?>
								</select>
								<select class="form-control js-change-year" name="year">
									<option value="">--- เลือกปีการศึกษา ---</option>
									<?php 
									$sql->table="tbl_year";
									$sql->condition="ORDER BY academic_year DESC";
									$query_Year = $sql->select();

									while($result_Year = mysqli_fetch_assoc($query_Year)){
										$sel = '';
										if( !empty($_GET["year"]) ){
											if($_GET["year"] == $result_Year["id"]) $sel = ' selected="1"';
										}
										echo '<option'.$sel.' value="'.$result_Year["id"].'">'.$result_Year["academic_year"].'</option>';
									}
									?>
								</select>
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
												<th width="5%">รหัสนักศึกษา</th>
												<th width="30%">ชื่อ-สกุล</th>
												<th width="15%">คณะ/สาขา</th>
												<th width="10%">ปีการศึกษา</th>
												<th width="10%">สถานะ</th>
												<th width="5%">ใบสมัคร</th>
												<th width="7%">กรอกใบสมัครเมื่อ</th>
												<th width="10%">จัดการ</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$num = 1;
											while($result = mysqli_fetch_assoc($query)) { ?>
											<tr>
												<td align="center"><?php echo $num; ?></td>
												<td><?php echo $result["username"]; ?></td>
												<td><?php echo $result["name"]; ?></td>
												<td>
												<?php
												$sql->table="tbl_faculty";
												$sql->condition="WHERE faculty_id={$result["faculty_id"]}";
												$faculty = mysqli_fetch_assoc($sql->select());

												$sql->table="tbl_majors";
												$sql->condition="WHERE major_id={$result["major_id"]}";
												$majors = mysqli_fetch_assoc($sql->select());

												echo "<strong>คณะ</strong> {$faculty["faculty_name"]} <br/> <strong>สาขา</strong> {$majors["major_name"]}";
												?>
												</td>
												<td align="center">
													<?php 
													$sql->table="tbl_year";
													$sql->field="*";
													$sql->condition="WHERE id='{$result["accept_year_id"]}'";
													$queryYear = $sql->select();
													$resultYear = mysqli_fetch_assoc($queryYear);
													echo $resultYear["academic_year"];
													?>
												</td>
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
													<a href="student_info.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-primary">แก้ไขใบสมัคร</a>
												</td>
												<td align="center">
												<?php 
												if( $result["update_date"] != '0000-00-00' ){
													echo DateThai($result["update_date"]);
												}
												else{
													echo "-";
												}
												?>
												</td>
												<td align="center">
													<a href="edit_student.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-warning" data-toggle="tooltip" title="แก้ไขข้อมูลของ <?php echo $result["name"]; ?>">แก้ไข</a>
													<a href="do_delete.php?page=<?php echo $_GET["page"]; ?>&id=<?php echo $result["id"]; ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบนักศึกษารหัส <?php echo $result["username"]; ?> ใช่หรือไม่ ?')">ลบ</a>
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
		$("#checkAll").click(function(){
			$('input:checkbox').not(this).prop('checked', this.checked);
		});

		var page = $(".js-page").data("page");
		var group = $(".js-change-group").val();
		var faculty = $(".js-change-faculty").val();
		var majors = $(".js-change-majors").val();
		var year = $(".js-change-year").val();

		$(".js-change-group").change(function(){
			window.location = "?page="+page+"&group="+$(this).val()+"&faculty="+faculty+"&majors="+majors+"&year="+year;
		});
		$(".js-change-faculty").change(function(){
			window.location = "?page="+page+"&group="+group+"&faculty="+$(this).val()+"&majors="+majors+"&year="+year;
		});
		$(".js-change-majors").change(function(){
			window.location = "?page="+page+"&group="+group+"&faculty="+faculty+"&majors="+$(this).val()+"&year="+year;
		});
		$(".js-change-year").change(function(){
			window.location = "?page="+page+"&group="+group+"&faculty="+faculty+"&majors="+majors+"&year="+$(this).val();
		})
	</script>