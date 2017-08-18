<section>
    <div class="container">
        <div class="row row-offcanvas row-offcanvas-left">
            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
                <div class="list-group">
                    <div class="list-group-item group-categories">ข้อมูลทั่วไป</div>
                    <a href="news.php?cate_id=1&page=news" class="list-group-item list-sidebar <?php if($_GET["page"] == "news") { echo "active-sub-menu"; } ?>">ข่าวประชาสัมพันธ์</a>
                    <a href="news.php?cate_id=2&page=activity" class="list-group-item list-sidebar <?php if($_GET["page"] == "activity") { echo "active-sub-menu"; } ?>">ข่าวกิจกรรม</a>
                    <?php 
                    $sql->table="tbl_infomation";
                    $sql->condition="ORDER By id asc";
                    $queryMenu = $sql->select();
                    while($resultMenu = mysqli_fetch_assoc($queryMenu))
                    {
                        ?>
                        <a href="info_detail.php?page=<?php echo $resultMenu["id"]; ?>" class="list-group-item list-sidebar <?php if($resultMenu["id"] == $_GET["page"]) { echo "active-sub-menu"; } ?>"><?php echo $resultMenu["name"]; ?></a>
                        <?php 
                    }
                    ?>
                </div>
            </div>
            <p class="pull-left visible-xs">
                <button type="button" class="btn btn-warning btn-categories" data-toggle="offcanvas"><i class="fa fa-bars" aria-hidden="true"></i>ข้อมูลทั่วไป</button>
            </p>
            <div class="col-xs-12 col-sm-9">
                <section id="search">
                    <marquee class="text-slide" behavior="scroll" scrollamount="2" scrolldelay="1" onmouseover="this.stop()" onmouseout="this.start()">
                        <span style="white-space: nowrap;">สหกิจศึกษา สาขาวิชาวิศวกรรมซอฟต์แวร์ มหาวิทยาลัยราชภัฏลำปาง ยินดีต้อนรับ</span>
                    </marquee>
                </section>
