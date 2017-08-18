<?php include("header.php"); ?>
<link rel="stylesheet" type="text/css" href="css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="plugin/fancybox/jquery.fancybox.css">
<style type="text/css">
	.btn-msg {
		color: red;
	}
	.image-preview-input {
		position: relative;
		overflow: hidden;
		margin: 0px;
	}
	.image-preview-input input[type=file] {
		position: absolute;
		top: 0;
		right: 0;
		margin: 0;
		padding: 0;
		font-size: 20px;
		cursor: pointer;
		opacity: 0;
		filter: alpha(opacity=0);
	}
	.image-preview-input-title {
		margin-left:2px;
	}
	.close {
		color: red !important;
	}
	@media (max-width: 991px) {
		.mail-text {
			text-align: left !important;
		}
	}
	@media (min-width: 992px) {
		.mail-text {
			padding-top: 0px !important;
		}
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li>
					<a href="index.php?page=home"><i class="fa fa-home"></i></a>
				</li>
				<li class="active">
					แก้ไขโปรไฟล์ <?php echo $resultUser["name"]; ?>
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					แก้ไขโปรไฟล์ <?php echo $resultUser["username"]; ?>
				</div>
			</div>
			<div class="portlet light">
				<div class="portlet-body form">
					<form class="form-horizontal" id="form_profile" method="POST" enctype="multipart/form-data">
						<div class="form-wizard">
							<div class="form-body">
								<h3 class="block headtext-set-center">ข้อมูลโปรไฟล์</h3>
								<p style="text-align: center;">
								<?php
								if($resultUser["picture"])
                                {
                                    ?>
									<a class="fancybox" href="upload/profile/<?php echo $resultUser["picture"]; ?>" data-fancybox-group="gallery">
										<img src="upload/profile/<?php echo $resultUser["picture"]; ?>" style="max-width: 250px;margin-bottom: 20px;" />
									</a>
									<?php
								} else { ?>
									<a class="fancybox" href="img/default_user.png" data-fancybox-group="gallery">
										<img src="img/default_user.png" style="max-width: 250px;margin-bottom: 20px;" />
									</a>
									<?php
								}
								?>

								</p>
								<div class="form-group">
									<label class="control-label col-md-4">ชื่อ-สกุล
										<span class="required"> * </span>
									</label>
									<div class="col-md-5">
										<input type="text" name="name" class="form-control" value="<?php echo $resultUser["name"]; ?>" placeholder="กรอกชื่อ-นามสกุลของท่าน" required />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">รหัสผ่าน (เดิม)
										<span class="required"> * </span>
									</label>
									<div class="col-md-5">
										<input type="password" name="password_old" id="password_old" class="form-control" placeholder="โปรดกรอกรหัสผ่านเดิมของคุณ" required />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">รหัสผ่าน (ใหม่)
										<span class="required"> * </span>
									</label>
									<div class="col-md-5">
										<input type="password" name="password" id="password" class="form-control" placeholder="กรอกรหัสผ่านใหม่" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">ยืนยันรหัสผ่าน
										<span class="required"> * </span>
									</label>
									<div class="col-md-5">
										<input type="password" id="confirm_pass" class="form-control" placeholder="ใส่รหัสผ่านเดิมอีกครั้ง" />
										<span class="message-pass"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4">รูปประจำตัว
										<span class="required"></span>
									</label>
									<div class="col-md-5">
										<div class="input-group image-preview">
											<input type="text" class="form-control image-preview-filename" disabled="disabled">
											<span class="input-group-btn">
												<button type="button" class="btn btn-danger image-preview-clear" style="display:none;">
													<i class="fa fa-times" aria-hidden="true"></i> ลบ
												</button>
												<div class="btn btn-primary image-preview-input">
													<i class="fa fa-folder-open" aria-hidden="true"></i>
													<span class="image-preview-input-title">เลือกรูป</span>
													<input type="file" accept="image/gif,image/jpeg,image/jpg,image/png" name="picture" id="img" />
												</div>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-12">
									<h4 class="btn-msg"><span class="msg-show"></span></h4>
									<button type="submit" id="btnSubmit" class="btn green button-submit"> บันทึกข้อมูล <i class="fa fa-check"></i></button>
									<input type="hidden" name="checkProfile" value="1" />
									<input type="hidden" name="id" value="<?php echo $resultUser["id"]; ?>" />
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php") ?>
<script type="text/javascript" src="plugin/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="plugin/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#form_profile').on('submit', function(event) {
			event.preventDefault();
			var fd = new FormData();
			var file_data = $('#img').prop('files')[0];
			fd.append("picture", file_data);

			var other_data = $(this).serializeArray();
			$.each(other_data, function(key, input) {
				fd.append(input.name, input.value);
			});
			console.log(file_data,other_data);
			$.ajax({
				url: 'edit_profile.php',
				type: 'POST',
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: fd,
				beforeSend: function(bfs) {
					$(".page-loader").css({"display": "block"});
					console.log(bfs);
				},
			})
			.done(function(reply) {
				if (reply == 1) {
					$(".page-loader").css({"display": "none"});
					swal("ทำรายการสำเร็จ!", "แก้ไขข้อมูลโปรไฟล์เรียบร้อย", "success");
					$('.confirm').click(function() {
						window.location.href="index.php?page=home";
					});
				} else if (reply == 2) {
					$(".page-loader").css({"display": "none"});
					swal("พบข้อผิดพลาด!", "Password ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง!", "error");
				} else {
					$(".page-loader").css({"display": "none"});
					swal("พบข้อผิดพลาด!", "ไม่แก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง!", "error");
				}
			});
		});

		$('.fancybox').fancybox({
			openEffect : 'elastic',
			openSpeed  : 150,
			closeEffect : 'elastic',
			closeSpeed  : 150
		});

		$("#confirm_pass").keyup(checkPassMatch);
		$("#password").keyup(checkPassMatch);

	});

	function checkPassMatch() {
		var password = $("#password").val();
		var confirm_pass = $("#confirm_pass").val();
		if (password != confirm_pass) {
			$(".message-pass").html('<i class="fa fa-times" aria-hidden="true"></i> กรุณากรอกรหัสผ่านให้ตรงกัน !').css({ "color": "red", "font-size": "14px" });
			$("#password").css({ "background-color": "#F44336", "color": "#fff", "border": "1px solid red", "margin-bottom": "3px" });
			$("#confirm_pass").css({ "background-color": "#F44336", "color": "#fff", "border": "1px solid red", "margin-bottom": "3px" });
			document.getElementById("btnSubmit").disabled = true;
		} else {
			$(".message-pass").html('');
			$("#password").css({ "background-color": "", "color": "", "border": "", "margin-bottom": "" });
			$("#confirm_pass").css({ "background-color": "", "color": "", "border": "", "margin-bottom": "" });
			document.getElementById("btnSubmit").disabled = false;
		}
	}
</script>