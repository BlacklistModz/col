<?php
include("../../class/session_check.php");
include("../../class/DateThai.php");
include("../../class/DateTimeThai.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#db8b0b" />
    <meta name="msapplication-navbutton-color" content="#db8b0b">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>ระบบจัดการ สหกิจศึกษา</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="../../css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/skin-yellow.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/cms-style.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap3-wysihtml5.min.css">
    <style type="text/css">
        .skin-yellow .treeview-menu>li>a {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
        .skin-yellow .sidebar-menu>li:hover>a, .skin-yellow .sidebar-menu>li.active>a {
            color: #f39c12;
        }
        .skin-yellow .treeview-menu>li.active>a, .skin-yellow .treeview-menu>li>a:hover {
            color: #f39c12;
        }
    </style>
</head>

<body class="hold-transition skin-yellow sidebar-mini fixed">
    <div class="wrapper">
        <header class="main-header">
            <a href="index.php" class="logo">
                <span class="logo-mini"><b>ส</b>หกิจ</span>
                <span class="logo-lg"><b>ระบบจัดการ</b>สหกิจ</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                <?php
                                if(!empty($resultAdmin["picture"])) { ?>
                                    <img src="../../upload/profile/<?php echo $resultAdmin["picture"]; ?>" class="user-image" alt="User Image">
                                <?php
                                } else { ?>
                                    <img src="../../img/default_user.png" class="user-image" alt="User Image">
                                <?php } ?>
                                <span class="hidden-xs"><?php echo $resultAdmin["name"]; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <?php
                                    if(!empty($resultAdmin["picture"])) { ?>
                                        <img src="../../upload/profile/<?php echo $resultAdmin["picture"]; ?>" class="img-circle" alt="User Image">
                                    <?php
                                    } else { ?>
                                        <img src="../../img/default_user.png" class="img-circle" alt="User Image">
                                    <?php } ?>
                                    <p>
                                        <?php echo $resultAdmin["name"]." - ".$resultStatus["name"]; ?>
                                        <small>เข้าสู่ระบบล่าสุด : <?php echo DateTimeThai($_SESSION["login_date"]); ?> น.</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-success">โปรไฟล์</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="javascript:;" id="sessionClear" class="btn btn-danger"><i class="fa fa-power-off"></i> ออกจากระบบ</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
