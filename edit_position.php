<?php include("header.php"); 

if($resultUser["status_id"] != "3")
{
	header("location:index.php?page=home");
}

$sql->table="tbl_year";
$sql->condition="ORDER By academic_year DESC LIMIT 0,1";
$queryYear = $sql->select();
$resultYear = mysqli_fetch_assoc($queryYear);

$sql->table="tbl_corporation";
$sql->condition="WHERE user_id='$user_id' and year_id='{$resultYear["id"]}'";
$queryCorp = $sql->select();
$resultCorp = mysqli_fetch_assoc($queryCorp);

$sql->table="tbl_position";
$sql->condition="WHERE corp_id='{$resultCorp["id"]}' and id='".$_GET["id"]."'";
$query = $sql->select();

$numPos = mysqli_num_rows($query);
if($numPos <= 0)
{
	header("location:corp_job.php?page=company&sub=corp_job");
}

$result = mysqli_fetch_assoc($query);
?>
<link rel="stylesheet" type="text/css" href="css/input-form-wizard.css">
<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/responsive.bootstrap.min.css">
<style type="text/css">
	.sweet-alert button.cancel {
		background-color: #e81d1d;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li>
					<a href="index.php"><i class="fa fa-home"></i></a>
				</li>
				<li class="active">
					ระบบตรวจสอบการรับสมัครของสถานประกอบการ <?php echo $resultCorp["name_th"]; ?>
				</li>
			</ul>
			<div class="search-section">
				<div class="title">
					สถานประกอบการ <?php echo $resultCorp["name_th"]; ?> | ปีการศึกษา <?php echo $resultYear["academic_year"]; ?>
				</div>
			</div>
			<div class="portlet light">
				<form name="position_form" id="position_form">
					<div class="form-group">
						<label class="control-label col-md-4">ชื่อตำแหน่ง
							<span class="required"> * </span>
						</label>
						<div class="col-md-6">
							<input type="text" name="pos_name" value="<?php echo $result["pos_name"]; ?>" class="form-control" required />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">ลักษณะงานที่นักศึกษาต้องปฏิบัติ
							<span class="required"> * </span>
						</label>
						<div class="col-md-6">
							<textarea class="form-control" rows="3" name="job_description" placeholder="อาจเป็นงานโครงงาน งานวิจัย หรืองานที่สอดคล้องกับสาขาวิชา"><?php echo $result["job_description"]; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">จํานวนนักศึกษาที่รับ
							<span class="required"> * </span>
						</label>
						<div class="col-md-6">
							<input type="number" name="stu_count" value="<?php echo $result["stu_count"]; ?>" class="form-control" required />
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success">บันทึก</button>
						<a href="corp_job.php?page=<?php echo $_GET["page"]; ?>&sub=<?php echo $_GET["sub"]; ?>" class="btn btn-danger">ยกเลิก</a>
					</div>
					<input type="hidden" name="checkSubmit" value="1" />
					<input type="hidden" name="id" value="<?php echo $result["id"]; ?>" />
					<input type="hidden" name="crop_id" value="<?php echo $resultCorp["id"]; ?>" />
				</form>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>
<script type="text/javascript">
	var el = document.getElementById("position_form");
	if (el) {
		el.addEventListener("submit", function(e) {
			var form = this;
			e.preventDefault();

			var fd = new FormData();
			var other_data = $(this).serializeArray();
			$.each(other_data, function(key, input) {
				fd.append(input.name, input.value);
			});
			//console.log(other_data);
			swal({
				title: "ยืนยันการแก้ไขข้อมูล ?",
				text: "บันทึกข้อมูลที่แก้ไข",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#33cc33',
				confirmButtonText: 'ใช่, ตกลง!',
				cancelButtonText: "ไม่, ยกเลิก!",
				//cancelButtonColor: "#DD6B55",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm) {
				if (isConfirm) {
					$.ajax({
						url: 'do_edit_position.php',
						type: 'POST',
						dataType: 'json',
						cache: false,
						contentType: false,
						processData: false,
						data: fd,
						beforeSend: function(bfs) {
							$(".item").css({"display": "block"});
							console.log(bfs);
						},
					})
					.done(function(reply) {
						if(reply == 1) 
						{
							$(".item").css({"display": "none"});
							swal("เสร็จสิ้น!", "บันทึกข้อมูลเรียบร้อย", "success");
							$('.confirm').click(function() {
								window.location.href="corp_job.php?page=company&sub=corp_job";
							});
						} 
						else
						{
							$(".item").css({"display": "none"});
							swal("พบข้อผิดพลาด!", "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง! \n หรือติดต่อสาขาวิชาวิศวกรรมซอฟต์แวร์ \n โทร 054-237399 ต่อ (6000)", "error");
						}
					});
				} 
			});
		});
	}
</script>