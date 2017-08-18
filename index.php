<?php include("header.php"); ?>
<link rel="stylesheet" href="css/sidebar.css">
<style type="text/css">
    @media (max-width: 991px) {
        .news-details {
            background-color: #f5f5f5 !important;
        }
    }
    .news-details {
        padding-top: 1px;
        padding-right: 15px;
        padding-bottom: 10px;
        padding-left: 15px;
        /*background-color: rgba(58, 58, 58, 0.7);*/
        background-color: rgba(255, 255, 255, 0.7);
    }
    /*.grid-news .news-content > a {
        color: #fff;
    }*/
    .grid-news .news-content {
        max-height: 40px;
        min-height: 40px;
    }
    .grid-news .news-title {
        text-overflow: ellipsis;
        white-space: nowrap;
        text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.5), 2px 3px 1px rgba(0, 0, 0, 0.15);
    }
    /*.glitch {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url(https://d22e57szuniygl.cloudfront.net/img/glitch-fc435e90a4249f15c823d7bc51795a4eb303388c6d3fc6f6e53054d5c11d265324cb8f566ccb07a14269ca46eadcbb56224462688f066a4e11fb85b4e5fced26.gif);
        background-repeat: no-repeat;
        background-size: cover;
        pointer-events: none;
    }*/
</style>
<?php
include("sidebar.php");
include("slide.php");
?>
</div>
</div>
</div>
</section>
<?php 
$sql->table="tbl_news";
$sql->condition="WHERE news_status='0' and cate_id='1' ORDER By id desc LIMIT 0,3";
$queryNews = $sql->select();

$sql->table="tbl_news";
$sql->condition="WHERE news_status='0' and cate_id='2' ORDER By id desc LIMIT 0,3";
$queryActivity = $sql->select();
?>
<!-- <div class="glitch"></div> -->
<section class="news-section">
    <div class="container">
        <div class="title">
            <h2 style="text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.5), 3px 4px 1px rgba(0, 0, 0, 0.15);">ข่าวประชาสัมพันธ์</h2>
        </div>
        <div class="row">
            <?php 
            while($resultNews = mysqli_fetch_assoc($queryNews))
            {
                $sql->table="tbl_news_img";
                $sql->condition="WHERE news_id ='".$resultNews["id"]."' ORDER BY id LIMIT 1";
                $queryImg = $sql->select();
                $resultImg = mysqli_fetch_assoc($queryImg);
                ?>
                <div class="col-md-4">
                    <div class="grid-news">
                        <div class="news-thumbnail">
                            <a href="news_detail.php?page=news&news_id=<?php echo $resultNews["id"]; ?>">
                                <img src="upload/news/<?php echo $resultImg["img"]; ?>" />
                            </a>
                        </div>
                        <div class="news-details">
                            <div class="news-title">
                                <?php echo $resultNews["topic"]; ?>
                            </div>
                            <div class="news-content ellipsis">
                                <a href="news_detail.php?page=news&news_id=<?php echo $resultNews["id"]; ?>"><?php echo $resultNews["short_detail"]; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
            }
            ?>
        </div>
        <div class="bottom">
            <a class="gg-wp" href="news.php?page=news&cate_id=1">
                <div class="btn-view">
                    ดูทั้งหมด
                </div>
            </a>
        </div>
        <br />
        <div class="title">
            <h2 style="text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.5), 3px 4px 1px rgba(0, 0, 0, 0.15);">ข่าวกิจกรรม</h2>
        </div>
        <div class="row">
            <?php 
            while($resultActivity = mysqli_fetch_assoc($queryActivity))
            {
                $sql->table="tbl_news_img";
                $sql->condition="WHERE news_id ='".$resultActivity["id"]."' ORDER BY id LIMIT 1";
                $queryImg = $sql->select();
                $resultImg = mysqli_fetch_assoc($queryImg);
                ?>
                <div class="col-md-4">
                    <div class="grid-news">
                        <div class="news-thumbnail">
                            <a href="news_detail.php?page=activity&news_id=<?php echo $resultActivity["id"]; ?>">
                                <img src="upload/news/<?php echo $resultImg["img"]; ?>" />
                            </a>
                        </div>
                        <div class="news-details">
                            <div class="news-title">
                                <?php echo $resultActivity["topic"]; ?>
                            </div>
                            <div class="news-content ellipsis">
                                <a href="news_detail.php?page=activity&news_id=<?php echo $resultActivity["id"]; ?>"><?php echo $resultActivity["short_detail"]; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
            }
            ?>
        </div>
        <div class="bottom">
            <a class="gg-wp" href="news.php?page=activity&cate_id=2">
                <div class="btn-view">
                    ดูทั้งหมด
                </div>
            </a>
        </div>
    </div>
</section>
<?php include("footer.php"); ?>
<script type="text/javascript" src="js/jquery.dotdotdot.min.js"></script>
<script type="text/javascript">
    $(function(){
        $(".ellipsis").dotdotdot({
            ellipsis: "... (อ่านต่อ)", /* The HTML to add as ellipsis. */
            wrap: "letter", /* How to cut off the text/html: 'word'/'letter'/'children' */
            watch : true /* Whether to update the ellipsis: true/'window' */
        });
    });
</script>