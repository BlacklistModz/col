<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<?php
                if(!empty($resultAdmin["picture"])) { ?>
                <img src="../../upload/profile/<?php echo $resultAdmin["picture"]; ?>" class="user-image" alt="User Image">
                <?php
            } else { ?>
            <img src="../../img/default_user.png" class="user-image" alt="User Image">
            <?php } ?>
        </div>
        <div class="pull-left info">
            <p><?php echo $resultAdmin['name']; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> ออนไลน์</a>
        </div>
    </div>
    <ul class="sidebar-menu">
        <li class="header">เมนูการจัดการข้อมูล</li>
        <li>
            <a href="../../index.php?page=home">
                <i class="fa fa-home"></i> <span>กลับไปหน้าเว็บสหกิจ</span>
                <!-- <span class="pull-right-container"></span> -->
            </a>
        </li>
        <li class="<?php if($_GET["page"] == "corporation") { echo "active"; } ?>">
            <a href="../corporation/index.php?page=corporation"><i class="fa fa-sitemap" aria-hidden="true"></i>
                <span>จัดการข้อมูลสถานประกอบการ</span>
                <!-- <span class="pull-right-container"></span> -->
            </a>
        </li>
        <li class="<?php if($_GET["page"] == "student") { echo "active"; } ?>">
            <a href="../student/index.php?page=student"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>จัดการข้อมูลนักศึกษา</span>
                <!-- <span class="pull-right-container"></span> -->
            </a>
        </li>
        <li class="<?=($_GET["page"]=="faculty" ? "active" : "")?>">
             <a href="../faculty/index.php?page=faculty"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>จัดการข้อมูลคณะ/สาขาวิชา</span>
            </a>
        </li>
        <li class="treeview <?php if($_GET["page"] == "website") { echo "active"; } ?>">
            <a href="#">
                <i class="fa fa-users"></i> <span>จัดการข้อมูลทั่วไป</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="<?php if($_GET["page"] == "website" and $_GET["wid"] == "news") { echo "active"; } ?>">
                    <a href="../news/index.php?page=website&wid=news&cate_id=1"><i class="fa fa-circle-o"></i> ข้อมูลข่าวสารประชาสัมพันธ์</a>
                </li>
                <li class="<?php if($_GET["page"] == "website" and $_GET["wid"] == "activity") { echo "active"; } ?>">
                    <a href="../news/index.php?page=website&wid=activity&cate_id=2"><i class="fa fa-circle-o"></i> ข้อมูลข่าวสารกิจกรรม</a>
                </li>
                <?php 
                $sql->table="tbl_infomation";
                $sql->condition="ORDER By id asc";
                $queryInfo = $sql->select();
                while($resultInfo = mysqli_fetch_assoc($queryInfo))
                {
                    ?>
                    <li class="<?php if($_GET["page"] == "website" and $_GET["wid"] == $resultInfo["id"]) { echo "active"; } ?>">
                        <a href="../infomation/index.php?page=website&wid=<?php echo $resultInfo["id"]; ?>"><i class="fa fa-circle-o"></i> <?php echo $resultInfo["name"]; ?></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </li>
        <li class="<?php if($_GET["page"] == "slide") { echo "active"; } ?>">
            <a href="../slide/index.php?page=slide"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>จัดการรูปสไลด์หน้าเว็บไซต์</span>
                <!-- <span class="pull-right-container"></span> -->
            </a>
        </li>
        <li class="treeview <?php if($_GET["page"] == "student_from") { echo "active"; } ?>">
            <a href="#">
                <i class="fa fa-users"></i> <span>จัดการใบสมัครนักศึกษา</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="<?php if($_GET["page"] == "student_from" and $_GET["fid"] == "skill") { echo "active"; } ?>">
                    <a href="../skill/index.php?page=student_from&fid=skill"><i class="fa fa-circle-o"></i> จัดการความสามารถพิเศษ</a>
                </li>
                <li class="<?php if($_GET["page"] == "student_from" and $_GET["fid"] == "regjob") { echo "active"; } ?>">
                    <a href="../regjob/index.php?page=student_from&fid=regjob"><i class="fa fa-circle-o"></i> จัดการสิทธิ์การสมัครงาน</a>
                </li>
            </ul>
        </li>
        <li class="<?php if($_GET["page"] == "document") { echo "active"; } ?>">
            <a href="../document/index.php?page=document"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>จัดการเอกสารสหกิจศึกษา</span>
                <!-- <span class="pull-right-container"></span> -->
            </a>
        </li>
        <li class="<?php if($_GET["page"] == "registration") { echo "active"; } ?>">
            <a href="../registration/index.php?page=registration"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>ทะเบียนการฝึกสหกิจ</span>
                <!-- <span class="pull-right-container"></span> -->
            </a>
        </li>
        <li class="<?php if($_GET["page"] == "year") { echo "active"; } ?>">
            <a href="../year/index.php?page=year"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>จัดการปีการศึกษา/ภาคเรียน</span>
                <!-- <span class="pull-right-container"></span> -->
            </a>
        </li>
        <li class="treeview <?php if($_GET["page"] == "assessment") { echo "active"; } ?>">
            <a href="#">
                <i class="fa fa-users"></i> <span>จัดการแบบประเมินนักศึกษา</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="<?php if($_GET["page"] == "assessment" and $_GET["aid"] == "011") { echo "active"; } ?>">
                    <a href="../assessment_report/index.php?page=assessment&aid=011"><i class="fa fa-circle-o"></i> แบบประเมินรายงานการฝึกสหกิจ</a>
                </li>
                <li class="<?php if($_GET["page"] == "assessment" and $_GET["aid"] == "012") { echo "active"; } ?>">
                    <a href="../assessment_work/index.php?page=assessment&aid=012"><i class="fa fa-circle-o"></i> แบบประเมินผลการปฏิบัติงาน</a>
                </li>
            </ul>
        </li>
        <li class="treeview <?php if($_GET["page"] == "report") { echo "active"; } ?>">
            <a href="#">
                <i class="fa fa-users"></i> <span>รายงาน</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="<?php if($_GET["page"] == "report" and $_GET["rid"] == "corp") { echo "active"; } ?>">
                    <a href="../report/index_corp.php?page=report&rid=corp"><i class="fa fa-circle-o"></i> ทะเบียนการสถานประกอบการ</a>
                </li>
                <li class="<?php if($_GET["page"] == "report" and $_GET["rid"] == "log") { echo "active"; } ?>">
                    <a href="../report/index_log.php?page=report&rid=log"><i class="fa fa-circle-o"></i> ตรวจสอบการเข้าใช้งาน</a>
                </li>
                <li class="<?php if($_GET["page"] == "report" and $_GET["rid"] == "doc") { echo "active"; } ?>">
                    <a href="../report/index_doc.php?page=report&rid=doc"><i class="fa fa-circle-o"></i> ตรวจสอบการส่งเอกสาร</a>
                </li>
                <li class="<?php if($_GET["page"] == "report" and $_GET["rid"] == "assess") { echo "active"; } ?>">
                    <a href="../report/index_assess.php?page=report&rid=assess"><i class="fa fa-circle-o"></i> รายงานผลการประเมิน</a>
                </li>
            </ul>
        </li>
    </ul>
</section>
</aside>
