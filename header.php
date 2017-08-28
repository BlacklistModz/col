<?php
ob_start();
session_start();
include("class/SQLiManager.php");
$sql = new SQLiManager();
if(isset($_SESSION["user_id"]) and $_SESSION["user_id"] != "")
{
    $user_id = $_SESSION["user_id"];
    $sql->table="tbl_authentication";
    $sql->condition="WHERE id='$user_id'";
    $querySession = $sql->select();
    $numSession = mysqli_num_rows($querySession);
    if($numSession != "1")
    {
        $location = "class/session_clear.php";
    }
    $resultUser = mysqli_fetch_assoc($querySession);
}

$page_file = basename($_SERVER['PHP_SELF']);
$page = $_GET["page"];
$redirect = "{$page_file}?page={$page}"; 

if(isset($_GET["sub"])){
    $redirect.="&sub=".$_GET["sub"];
}

if(!isset($_GET["page"]) or (empty($_GET["page"])))
{
    header("location:index.php?page=home");
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#fe6711" />
    <meta name="msapplication-navbutton-color" content="#fe6711">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>ศูนย์สหกิจศึกษา มหาวิทยาลัยราชภัฏลำปาง</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="img/coopcenter.png">
    <!-- CSS Libralies -->
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/extension.css">
    <link rel="stylesheet" type="text/css" href="css/carousel.css">
    <link rel="stylesheet" type="text/css" href="css/offcanvas.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css"> 
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="css/effect.css">
    <link rel="stylesheet" type="text/css" href="css/loader.css">
    <!-- ///////////// -->
    <style type="text/css">
        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            vertical-align: middle;
        }

        .no-js #loader {
            display: block;
        }

        .js #loader {
            display: block;
            position: absolute;
            left: 100px;
            top: 0;
        }

        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 1888;
            background: url(img/gears.gif) center no-repeat #fff;
            opacity: 0.7;
        }
        .list-sidebar {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
        .waiting-load {
            display: none;
            width: 100%;
            height: 100%;
            background: #000;
            opacity: 0.7;
            position: fixed;
            overflow: hidden;
            z-index: 1800;
        }
    </style>
</head>

<body>
    <div class="waiting-load"></div>
    <div class="se-pre-con"></div>
    <div class="page-loader">
        <div class="text-loader">กรุณารอสักครู่..</div>
        <div class="loader"></div>
    </div>
    <img src="img/black-ribbon.png" class="black-ribbon">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 grid-brand">
                    <div class="text-center">
                        <a href="index.php?page=home"><img src="img/logo-cool.png" class="logo-header"></a>
                    </div>
                </div>
                <!-- <div class="col-md-8 col-xs-12 grid-client">
                    <div class="client">
                        <img src="img/Award1.png" />
                        <img src="img/Award2.png" />
                        <img src="img/Award3.png" />
                        <img src="img/Award4.png" />
                    </div>
                </div> -->
            </div>
            <nav class="navbar navbar-default navbar-color">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="<?php if($_GET['page']=="home"){ echo "active"; } ?>"><a href="index.php?page=home">หน้าแรก</a></li>
                        <?php 
                        if(!isset($user_id) or (isset($resultUser["status_id"]) and $resultUser["status_id"] == 3))
                        {
                            ?>
                            <li class="dropdown <?php if($_GET['page']=="student"){ echo "active"; } ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">นักศึกษา <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li class="<?php if($_GET['page']=="student" and $_GET['sub']=="stu_status"){ echo "active"; } ?>"><a href="report_doc.php?page=student&sub=stu_status"><i class="fa fa-gear"></i> สถานะการส่งเอกสารของนักศึกษา</a>
                                    </li>
                                </ul>
                            </li>
                            <?php 
                        }

                        if(!isset($user_id) or (isset($resultUser["status_id"]) and $resultUser["status_id"] == 4))
                        {
                            ?>
                            <!-- <li class="<?php if($_GET["page"] == "corperation") { echo "active"; } ?>"><a href="corperation.php?page=corperation">ทะเบียนสถานประกอบการ</a></li> -->

                            <li class="dropdown <?php if($_GET['page']=="company"){ echo "active"; } ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">สถานประกอบการ <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li class="<?php if($_GET['page']=="company" and $_GET['sub']=="corporation"){ echo "active"; } ?>"><a href="corporation.php?page=company&sub=corporation"><i class="fa fa-gear"></i> ทะเบียนสถานประกอบการ</a>
                                    </li>
                                </ul>
                            </li>
                            <?php 
                        }
                        // ----------------- NOT LOGIN AND status permission ----------------------//
                        
                        if(isset($resultUser["status_id"]) and ($resultUser["status_id"] == 1 or $resultUser["status_id"] == 4))
                        {
                            ?>
                            <li class="dropdown <?php if($_GET['page']=="student"){ echo "active"; } ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">นักศึกษา <span class="caret"></span></a>
                                <ul class="dropdown-menu">

                                    <li class="<?php if($_GET['page']=="student" and $_GET['sub']=="coop_03"){ echo "active"; } ?>"><a href="SE-CO-003.php?page=student&sub=coop_03"><i class="fa fa-gear"></i> สมัครงานสหกิจศึกษา</a></li>

                                    <li class="<?php if($_GET['page']=="student" and $_GET['sub']=="job"){ echo "active"; } ?>"><a href="job.php?page=student&sub=job"><i class="fa fa-gear"></i> สมัครเลือกสถานประกอบการและตำแหน่งงาน</a></li>

                                    <li class="<?php if($_GET['page']=="student" and $_GET['sub']=="student_job"){ echo "active"; } ?>"><a href="student_job.php?page=student&sub=student_job"><i class="fa fa-gear"></i> ตำแหน่งที่นักศึกษาได้ลงสมัคร</a></li>

                                    <li class="<?php if($_GET['page']=="student" and $_GET['sub']=="document"){ echo "active"; } ?>"><a href="document.php?page=student&sub=document"><i class="fa fa-gear"></i> ส่งเอกสารสหกิจศึกษา</a></li>

                                    <li class="<?php if($_GET['page']=="student" and $_GET['sub']=="stu_status"){ echo "active"; } ?>"><a href="report_doc_detail.php?page=student&sub=stu_status&stu_id=<?php echo $user_id; ?>"><i class="fa fa-gear"></i> สถานะการส่งเอกสารของนักศึกษา</a></li>
                                    <!-- <li><a href="#"><i class="fa fa-power-off"></i> แบบแจ้งโครงร่างรายงานปฏิบัติงาน</a></li> -->
                                </ul>
                            </li>
                            <?php 
                        }
                        //---------------------------- Student -------------------------------//
                        
                        if(isset($resultUser["status_id"]) and ($resultUser["status_id"] == 1 or $resultUser["status_id"] == 3))
                        {
                            ?>
                            <li class="dropdown <?php if($_GET['page']=="company"){ echo "active"; } ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">สถานประกอบการ <span class="caret"></span></a>

                                <ul class="dropdown-menu">

                                    <li class="<?php if($_GET['page']=="company" and $_GET['sub']=="corporation"){ echo "active"; } ?>"><a href="corporation.php?page=company&sub=corporation"><i class="fa fa-gear"></i> ทะเบียนสถานประกอบการ</a>
                                    </li>
                                    
                                    <li class="<?php if($_GET['page']=="company" and $_GET['sub']=="coop_02"){ echo "active"; } ?>"><a href="SE-CO-002.php?page=company&sub=coop_02"><i class="fa fa-gear"></i> แบบเสนองานสหกิจศึกษา</a>
                                    </li>

                                    <li class="<?php if($_GET['page']=="company" and $_GET['sub']=="corp_job"){ echo "active"; } ?>"><a href="corp_job.php?page=company&sub=corp_job"><i class="fa fa-gear"></i> ตำแหน่งงานที่รับสมัคร</a>
                                    </li>

                                    <li class="<?php if($_GET['page']=="company" and $_GET['sub']=="assess"){ echo "active"; } ?>"><a href="corp_assess.php?page=company&sub=assess"><i class="fa fa-gear"></i> ประเมินผลสหกิจของนักศึกษา</a>
                                    </li>

                                </ul>
                            </li>
                            <?php 
                        }
                        //---------------------------------- Company -------------------------------//
                        ?>
                        <li class="<?php if($_GET["page"] == "download") { echo "active"; } ?>"><a href="download.php?page=download">ดาวน์โหลด</a></li>
                        <!-- <li class="<?php if($_GET["page"] == "document") { echo "active"; } ?>"><a href="report_doc.php?page=document">การส่งเอกสาร</a></li> -->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                     <?php
                     if(!isset($user_id))
                     {
                         ?>
                         <li><a id="btnLoginModal" href="javascript:;">เข้าสู่ระบบ</a></li>
                         <?php 
                     }
                     else
                     {
                         ?>
                         <li class="dropdown user user-menu <?php if($_GET['page']=="manage"){ echo "active"; } ?>">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                 <?php
                                 if($resultUser["picture"])
                                 {
                                    ?>
                                    <img src="upload/profile/<?php echo $resultUser["picture"]; ?>" class="user-image" alt="User Image">
                                    <?php
                                }
                                else
                                {   
                                    ?>
                                    <img src="img/default_user.png" class="user-image" alt="User Image">
                                    <?php
                                }
                                ?>
                                <span class="userNav"><?php echo $resultUser["name"]; ?></span> <span class="caret"></span></a>

                                <ul class="dropdown-menu">
                                    <li class="<?php if($_GET['page']=="manage" and $_GET['sub']=="profile"){ echo "active"; } ?>"><a href="profile.php?page=manage&sub=profile"><i class="fa fa-gear"></i> ตั้งค่าบัญชี</a></li>
                                    <?php if ($resultUser['status_id'] == 1): ?>
                                        <li><a href="cms/index.php"><i class="fa fa-gear"></i> จัดการระบบ</a></li>
                                    <?php endif ?>
                                    <li><a href="javascript:;" id="sessionClear"><i class="fa fa-power-off"></i> ออกจากระบบ</a></li>
                                </ul>
                            </li>
                            <?php 
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <?php include("login.php"); ?>
