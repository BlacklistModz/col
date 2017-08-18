<?php
include("../header.php");
include("../sidebar.php");
require_once("../../plugin/phpexcel/PHPExcel.php");
include("../../plugin/phpexcel/PHPExcel/IOFactory.php");
function utf8_strlen($s) 
{
	$c = strlen($s); $l = 0;
	for ($i = 0; $i < $c; ++$i)
		if ((ord($s[$i]) & 0xC0) != 0x80) ++$l;
	return $l;
}

if(isset($_POST["checkAddStudent"]) and $_POST["checkAddStudent"] == "1")
{
	$page = $_GET["page"];

	$file = $_FILES["studentfile"]["name"];
	$type = $type= strrchr($file,".");
	if($type == ".xls" or $type==".xlsx")
	{
		$inputFileName = $_FILES["studentfile"]["tmp_name"]; 
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
		$objReader->setReadDataOnly(true);  
		$objPHPExcel = $objReader->load($inputFileName);  

		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
		$highestRow = $objWorksheet->getHighestRow();
		$highestColumn = $objWorksheet->getHighestColumn();

		$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
		$headingsArray = $headingsArray[1];

		$r = -1;
		$namedDataArray = array();
		for ($row = 2; $row <= $highestRow; ++$row) {
			$dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
			if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
				++$r;
				foreach($headingsArray as $columnKey => $columnHeading) {
					$namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
				}
			}
		}
		$success = 0; $error =0; $update =0;
		foreach ($namedDataArray as $result) 	
		{
			if(isset($result["Username"]) and isset($result["Password"]) and isset($result["Firstname"]) and isset($result["Lastname"]) and isset($result["Academic"]))
			{
				if(!empty($result["Username"]) and !empty($result["Password"]) and !empty($result["Firstname"]) and !empty($result["Lastname"]) and !empty($result["Academic"]))
				{
					if(is_numeric($result["Username"]) and is_numeric($result["Password"]) and is_numeric($result["Academic"]) and strlen($result["Username"]) == "11" and strlen($result["Password"]) >= "5" and strlen($result["Academic"]) == "4" and utf8_strlen($result["Firstname"])>="3" and utf8_strlen($result["Firstname"])<="100" and utf8_strlen($result["Lastname"])>="3" and utf8_strlen($result["Lastname"])<="100")
					{
						$sql->table="tbl_year";
						$sql->field="*";
						$sql->condition="WHERE academic_year='".$result["Academic"]."'";
						$queryYear = $sql->select();
						$numYear = mysqli_num_rows($queryYear);

						if($numYear > 0)
						{
							$resultYear = mysqli_fetch_assoc($queryYear);

							$username = $result["Username"];
							$name = $result["Firstname"]." ".$result["Lastname"];
							$year_id = $resultYear["id"];

							preg_match_all("/[0-9]/", $result["Password"],$a);
							if(count($a[0]) == 5) 
							{ 
								$password = "0".$result["Password"];
							} 
							else 
							{
								$password = $result["Password"];
							}

							$sql->table="tbl_authentication";
							$sql->condition="WHERE username='$username'";
							$numCheck = mysqli_num_rows($sql->select());
							if($numCheck <= 0)
							{
								$sql->table="tbl_authentication";
								$sql->field="username,password,name,status_id,accept_year_id,create_date";
								$sql->value="'$username','$password','$name','4','$year_id',NOW()";
								if($sql->insert())
								{
									$user_id = mysqli_insert_id($sql->connect);
									$major = "วิศวกรรมซอฟต์แวร์";
									$faculty = "เทคโนโลยีอุตสาหกรรม";

									$sql->table="tbl_student";
									$sql->field="user_id,major,faculty,year_id";
									$sql->value="'$user_id','$major','$faculty','$year_id'";
									$sql->insert();

									$success = $success +1;
								}
								else
								{
									echo mysqli_error($sql->connect);
								}
							}	
							else
							{
								$sql->table="tbl_authentication";
								$sql->value="password='$password',name='$name',accept_year_id='$year_id'";
								$sql->condition="WHERE username='$username'";
								if($sql->update())
								{
									$update = $update+1;
								}
								else
								{
									echo mysqli_error($sql->connect);
								}
							}	
						}
						else
						{
							$nameError[] = $result["Firstname"]." ".$result["Lastname"];
							$studentError[] = $result["Username"];
							$yearError[] = $result["Academic"];
							$error = $error+1;
						}
					}
					else
					{
						$nameError[] = $result["Firstname"]." ".$result["Lastname"];
						$studentError[] = $result["Username"];
						$yearError[] = $result["Academic"];
						$error = $error+1;
					}
				}
				else
				{
					$nameError[] = $result["Firstname"]." ".$result["Lastname"];
					$studentError[] = $result["Username"];
					$yearError[] = $result["Academic"];
					$error = $error+1;
				}
			}
			else
			{
				$alert = "ไฟล์ดังกล่าวข้อมูลไม่ครบ หรือฟอร์มข้อมูลไม่ตรงกับตัวอย่าง กรุณาตรวจสอบ";
				$location = "add_student.php?page=$page";
			}
		}
	}
	else
	{
		$alert = "พบข้อผิดพลาด : สามารถอัพโหลดได้เฉพาะไฟล์ .xls และ .xlsx เท่านั้น";
		$location = "add_student.php?page=$page";
	}
}
else
{
	$location = "index.php?page=$page";
}
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			จัดการข้อมูลนักศึกษา
			<small>เพิ่ม-ลบ/แก้ไข ข้อมูลนักศึกษา</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
			<li><a href="index.php?page=<?php echo $_GET["page"]; ?>"> จัดการข้อมูลนักศึกษา</a></li>
			<li><a href="add_student.php?page=<?php echo $_GET["page"]; ?>"> เพิ่มข้อมูลนักศึกษา</a></li>
			<li class="active"> รายงานผลการอัพโหลดไฟล์ข้อมูลนักศึกษา</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title form-inline">รายงานผลการอัพโหลดไฟล์ข้อมูลนักศึกษา</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="ซ่อน">
								<i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="">
								<?php 
								if(!empty($success) or !empty($update) or !empty($error) or !empty($studentError))
								{
									?>
									<label>ระบบดำเนินการเพิ่มข้อมูลสำเร็จทั้งหมด</label> : <?php echo $success; ?> รายการ<br/>
									<label>ระบบดำเนินการอัพเดตข้อมูลที่ซ้ำกันทั้งหมด</label> : <?php echo $update; ?> รายการ<br/>
									<label>เกิดความผิดพลาดในการบันทึกทั้งหมด</label> : <?php echo $error; ?> รายการ<br/>
									<?php 
									if(isset($studentError))
									{
										?>
										<h4 class="text-center text-red">----ข้อมูลที่ไม่ได้รับการบันทึกมีดังนี้----</h4>
										<div class="table-responsive">
											<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th width="5%">ลำดับ</th>
														<th width="15%">รหัสนักศึกษา</th>
														<th width="50">ชื่อ-นามสกุล</th>
														<th width="15%">ปีการศึกษา</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$num = 1;
													for($i=0;$i<count($studentError);$i++)
													{ 
														?>
														<tr>
															<td align="center"><?php echo $num; ?></td>
															<td align="center"><?php echo $studentError[$i]; ?></td>
															<td><?php echo $nameError[$i]; ?></td>
															<td align="center"><?php echo $yearError[$i]; ?></td>
														</tr>
														<?php 
														$num++; 
													} 
													?>
												</tbody>
											</table>
										</div>
										<?php
									}
									else
									{
										echo "<h4 class='text-blue text-center'>---- ไม่มีข้อมูลที่ไม่ได้รับการบันทึก ----</h4>";
									}
								}
								?>
							</div>
						</div>
						<div class="box-footer">
							<a href="index.php?page=<?php echo $_GET["page"]; ?>" class="btn btn-primary pull-right">กลับหน้าหลัก</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php include("../footer.php"); ?>