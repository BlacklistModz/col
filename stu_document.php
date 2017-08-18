<?php 
include("header.php"); 
include("class/DateThai.php");

$id = addslashes($_GET["doc_id"]);
$page = $_GET["page"];
$sub = $_GET["sub"];

$sql->table="tbl_document";
$sql->condition="WHERE id='$id'";
$queryDoc = $sql->select();
$numDoc = mysqli_num_rows($queryDoc);
if($numDoc <= 0)
{
	header("location:document.php?page=$page&sub=$sub");
}
$resultDoc = mysqli_fetch_assoc($queryDoc);

$sql->table="tbl_student";
$sql->condition="WHERE user_id='$user_id'";
$queryStudent = $sql->select();
$resultStudent = mysqli_fetch_assoc($queryStudent);

$sql->table="tbl_stu_job";
$sql->condition="WHERE stu_id='$user_id' and job_status='3'";
$queryJob = $sql->select();
$resultJob = mysqli_fetch_assoc($queryJob);

$sql->table="tbl_position INNER JOIN tbl_corporation ON tbl_position.corp_id = tbl_corporation.id";
$sql->condition="WHERE tbl_position.id='{$resultJob["pos_id"]}'";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$queryYear = $sql->select();
$resultYear = mysqli_fetch_assoc($queryYear);

?>

<link rel="stylesheet" type="text/css" href="css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="css/form-group.css">
<link rel="stylesheet" type="text/css" href="css/fileinput.min.css">
<style type="text/css">
	span > a {
		color: #337ab7;
		text-decoration: underline;
		line-height: 2.1;
	}
	.send-date > span {
		line-height: 2.1;
		color: #337ab7;
	}
	span > a:hover {
		color: #4caf50;
	}
	.form-read .form-control[disabled],
	.form-read .form-control[readonly],
	.form-read fieldset[disabled] .form-control {
		background-color: rgba(238, 238, 238, 0);
		opacity: 1;
	}
	.form-read .form-control {
		color: #555;
		height: 32px;
		font-size: 16px;
		background-image: none;
		border: none;
		border-radius: 0px;
		-webkit-box-shadow: none;
		box-shadow: none;
		-webkit-transition: none;
		-o-transition: none;
		transition: none;
	}
	.form-read .form-control:focus {
		outline: 0;
		-webkit-box-shadow: none;
		box-shadow: none;
	}
	.form-underline {
		border-top: 2px solid #e7ecf1;
	}
	.close {
		color: white;
		background-color: #F44336;
		padding: 1px 5px;
		border-radius: 15%;
	}
	.close:hover {
		color: white;
	}
	.file-upload-indicator {
		display: none;
	}
	#progress {
		position: relative;
		z-index: 1880;
		width: 100%;
		height: 34px;
		border: 1px solid #ddd;
		padding: 1px;
		border-radius: 3px;
		text-align: center;
	}

	#bar {
		width: 0%;
		height: 30px;
		border-radius: 3px;
		vertical-align: middle;
		text-align: center;
		background-color: #4caf50;
		border-color: #388e3c;
	}

	#percent {
		position: absolute;
		display: inline-block;
		top: 7px;
		vertical-align: middle;
		text-align: center;
		left: 0;
		width: 100%;
	}
	@media (min-width: 992px){
		.card-form {
			margin-top: 10px;
			margin-bottom: 25px;
			padding: 0;
			margin-left: 15%;
			margin-right: 15%;
			border-radius: 4px;
			padding: 25px 20px 20px;
			border-style: dashed;
			border-color: #9E9E9E;
		}
		.card-upload {
			padding: 20px 0px 20px 0px;
			margin-left: 15%;
			margin-right: 15%;
			border-radius: 4px;
			background-color: rgba(158, 158, 158, 0.2);
		}
	}
	.fileinput-upload {
		display: none;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li>
					<a href="index.php"><i class="fa fa-home"></i></a>
				</li>
				<li>
					เอกสาร
				</li>
				<li class="active">
					<?php echo $resultDoc["doc_name"]; ?>
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					<?php echo $resultDoc["doc_name"]; ?> | ปีการศึกษา <?php echo $resultYear["academic_year"]; ?>
				</div>
			</div>
			<div class="portlet light">
				<div class="portlet-body form">
					<form class="form-horizontal" action="stu_upload.php" method="POST" id="doc_form" enctype="multipart/form-data">
						<div class="form-wizard">
							<div class="form-body">
								<div class="card-form">
									<h3 class="block headtext-set-center">ข้อมูลทั่วไป</h3>
									<div class="form-group">
										<div class="form-read">
											<label class="control-label col-md-6">ชื่อ-นามสกุลนักศึกษา</label>
											<div class="col-md-4">
												<input type="text" class="form-control" value="<?php echo $resultUser["name"]; ?>" readonly />
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="form-read">
											<label class="control-label col-md-6">รหัสประจําตัว / I.D. No</label>
											<div class="col-md-4">
												<input type="text" class="form-control" value="<?php echo $resultUser["username"]; ?>" readonly />
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="form-read">
											<label class="control-label col-md-6">สาขาวิชา / Major</label>
											<div class="col-md-4">
												<input type="text" class="form-control" value="<?php echo $resultStudent["major"]; ?>" readonly />
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="form-read">
											<label class="control-label col-md-6">คณะ / Faculty</label>
											<div class="col-md-4">
												<input type="text" class="form-control" value="<?php echo $resultStudent["faculty"]; ?>" readonly />
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="form-read">
											<label class="control-label col-md-6">ปฏิบัติงานสหกิจศึกษา ณ สถานประกอบการ</label>
											<div class="col-md-4">
												<input type="text" class="form-control" value="<?php echo $resultCorp["name_th"]; ?>" readonly />
											</div>
										</div>
									</div>
								</div>
								<?php 
								if($resultDoc["doc_status"] == "2")
								{
									$sql->table="tbl_stu_project";
									$sql->condition="WHERE stu_id='$user_id' and year_id='{$resultYear["id"]}'";
									$query = $sql->select();
									$result = mysqli_fetch_assoc($query);
									?>
									
									<div class="card-form">
										<h3 class="block headtext-set-center">ข้อมูลพี่เลี้ยง</h3>
										<div class="form-group">
											<label class="control-label col-md-4">ชื่อพี่เลี้ยง
												<span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="emp_name" value="<?php echo $result["emp_name"]; ?>" placeholder="ชื่อ-สกุล พี่เลี้ยง" required />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">ตำแหน่ง
												<span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="emp_position" value="<?php echo $result["emp_position"]; ?>" placeholder="ตำแหน่ง" required />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">แผนก
												<span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="emp_department" value="<?php echo $result["emp_department"]; ?>" placeholder="แผนก" required />
											</div>
										</div>
										<h3 class="block headtext-set-center">หัวข้อรายงาน</h3>
										<div class="form-group">
											<label class="control-label col-md-4">ชื่อโครงงาน (ภาษาไทย)
												<span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="project_th" value="<?php echo $result["project_th"]; ?>" placeholder="กรอกชื่อโครงงานภาษาไทย" required />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">ชื่อโครงงาน (ภาษาอังกฤษ)
												<span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="project_en" value="<?php echo $result["project_en"]; ?>" placeholder="กรอกชื่อโครงงานภาษาอังกฤษ" required />
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">รายละเอียดเนื้อหาของรายงาน
												<span class="required"> * </span>
											</label>
											<div class="col-md-6">
												<textarea class="form-control" rows="9" name="project_detail" placeholder="รายละเอียดเนื้อหาของรายงาน (อาจจะขอเปลี่ยนแปลงหรือแก้ไขเพิ่มเติมได้ในภายหลัง)"><?php echo $result["project_detail"]; ?></textarea>
											</div>
										</div>
									</div>
									<?php 
								}

								$multi = "";
								$allow_file = "";
								$name = "doc_file";
								$required = "required";
								$type_files = "mov,";
								$preview = "";
								if($resultDoc["doc_status"] == "1")
								{
									$multi = "multiple";
									$name = "doc_file[]";
									$allow_file = '["mov"]';
								}
								elseif($resultDoc["doc_status"] == "2")
								{
									$required = "";
									$allow_file = '["mov"]';
								}
								elseif ($resultDoc["doc_status"] == "3") {
									$allow_file = '["zip","rar"]';
									$type_files = ".zip,.rar,";
									$preview = 'data-show-preview="false"';
								}
								?>
								<div class="card-upload">
									<h3 class="block headtext-set-center">ส่งไฟล์เอกสารสหกิจ</h3>
									<div class="form-group">
										<label class="control-label col-md-4">อัพโหลดไฟล์
											<span class="required"> * </span>
										</label>
										<div class="col-md-6">
											<input type="file" id="send-doc" class="form-control" name="<?php echo $name; ?>" <?php echo $multi; ?> accept="application/<?php echo $type_files; ?>application" data-allowed-file-extensions='<?php echo $allow_file; ?>' <?php echo $preview; ?> <?php echo $required; ?> />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">สถานะการอัพโหลด
											<span class="required">  </span>
										</label>
										<div class="col-md-6">
											<div id="progress">
												<div id="bar"></div>
												<div id="percent">ยังไม่มีการอัพโหลด</div >
												</div>
												<div id="message"></div>
											</div>
										</div>
										<?php 
										$sql->table="tbl_stu_send";
										$sql->condition="WHERE doc_id='$id' and stu_id='$user_id' and year_id='{$resultYear["id"]}'";
										$queryFile = $sql->select();
										$numRow = mysqli_num_rows($queryFile);
										if($numRow > 0)
										{
											$resultFile = mysqli_fetch_assoc($queryFile);

											$sql->table="tbl_stu_send_detail";
											$sql->condition="WHERE send_id='{$resultFile["id"]}'";
											$queryStuFile = $sql->select();
											if($resultDoc["doc_status"] != "1")
											{
												while($resultStuFile = mysqli_fetch_assoc($queryStuFile))
												{
													?>
													<div id="sendDown">
														<div class="form-group">
															<label class="control-label col-md-4">ดาวน์โหลดไฟล์
																<span class="required">  </span>
															</label>
															<div class="col-md-6" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;">
																<span><a href="upload/student_doc/<?php echo $resultStuFile["doc_file"]; ?>" target="_black" ><?php echo $resultDoc["doc_name"]; ?></a></span>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-4">วันที่ส่งล่าสุด
																<span class="required">  </span>
															</label>
															<div class="col-md-6 send-date">
																<span><?php echo DateThai($resultStuFile["upload_date"]); ?></span>
															</div>
														</div>
													</div>
												</div>
												<?php
											}
										}
										else
										{
											?>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4">ไฟล์ที่อัพโหลด
												<span class="required"> * </span>
											</label>
											<div class="col-md-6 form-inline">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th width="5%">ลำดับ</th>
															<th width="60%">ชื่อไฟล์</th>
															<th width="25%">อัพโหลด</th>
															<th width="10%">ลบ</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$num=1;
														while($resultStuFile = mysqli_fetch_assoc($queryStuFile))
														{
															?>
															<tr>
																<td align="center"><?php echo $num; ?></td>
																<td align="center"><a href="upload/student_doc/<?php echo $resultStuFile["doc_file"]; ?>"><?php echo $resultDoc["doc_name"]; ?>-<?php echo $num; ?></td>
																<td align="center"><?php echo DateThai($resultStuFile["upload_date"]) ?></td>
																<td align="center"><a href="delete_file.php?send_id=<?php echo $resultStuFile["send_id"]; ?>&id=<?php echo $resultStuFile["id"]; ?>" class="btn btn-danger btn-block" onclick="return confirm('คุณต้องการลบ <?php echo $resultDoc["doc_name"]; ?>-<?php echo $num; ?> ใช่หรือไม่ ?')">ลบ</a></td>
															</tr>
															<?php 
															$num++;
														}
														?>
													</tbody>
												</table>
											</div>
										</div>
										<?php
									}
								}
								?>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-12" style="text-align: center">
										<button type="submit" class="btn green"><i class="fa fa-file-text-o" aria-hidden="true"></i> ส่งเอกสาร</button>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="checkSubmit" value="1" />
						<input type="hidden" name="doc_id" value="<?php echo $resultDoc["id"]; ?>" />
						<input type="hidden" name="stu_id" value="<?php echo $user_id; ?>" />
						<input type="hidden" name="year_id" value="<?php echo $resultYear["id"]; ?>" />
						<input type="hidden" name="page" value="<?php echo $page; ?>" />
						<input type="hidden" name="sub" value="<?php echo $sub; ?>" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php") ?>
<script type="text/javascript" src="js/fileinput.min.js"></script>
<script type="text/javascript" src="js/fileinput-th.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		// var page = $("input[name='page']").val();
		// var sub = $("input[name='sub']").val();
		// var doc_id = $("input[name='doc_id']").val();

		var options = {
			beforeSend: function() {
				$("#progress").show();
                //clear everything
                $("#bar").width('0%');
                $("#percent").html("0%").css({ "color": "#fff" });
                $("#message").html("กำลังส่งไฟล์ โปรดรอสักครู่...").css({"position":"relative","z-index":"1880","color":"#fff","margin-top":"5px","text-align":"center"});
                $(".waiting-load").css({ "display": "block" });
            },
            uploadProgress: function(event, position, total, percentComplete) {
            	$("#bar").width(percentComplete + '%');
            	$("#percent").html(percentComplete + '%');
            },
            success: function() {
            	$("#bar").width('100%');
            	$("#percent").html('อัพโหลดเสร็จสิ้น 100%');
            	$(".waiting-load").css({ "display": "none" });
            	$(".fileinput-remove").trigger('click');
            	$("#sendDown").hide();
            },
            complete: function(response) {
                // swal(response.responseText);
                $("#message").html("<span><i class='fa fa-check'> </i> " + response.responseText + "</span>").css({ "margin-top": "5px", "color": "green" });
                console.log(response);
                if(response == "error") {
                	$("#message").html("<span><i class='fa fa-check'> </i> ล้มเหลว! ไม่สามารถส่งไฟล์ได้</span>").css({ "margin-top": "5px", "color": "red" });
                }
            },
            error: function() {
            	$("#message").html("<font color='red'> ERROR: unable to upload files</font>");
            }
            // statusText: function(error) {
            // 	$("#message").html("<span><i class='fa fa-check'> </i> ล้มเหลว! ไม่สามารถส่งไฟล์ได้</span>").css({ "margin-top": "5px", "color": "red" });
            // }
        };

        $("#doc_form").ajaxForm(options);

        $("#send-doc").fileinput({
        	language: 'th',
        	maxFileCount: 9,
        	browseIcon: '<i class="fa fa-folder-open"></i>',
        	removeIcon: '<i class="fa fa-trash"></i>',
        	removeClass: 'btn btn-danger'
        });
    });
</script>