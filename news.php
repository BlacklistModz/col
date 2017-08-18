<?php 
include("header.php"); 
include("class/DateTimeThai.php");

if(!isset($_GET["cate_id"]) or (empty($_GET["cate_id"])))
{
    header("location:index.php?page=home");
}

$cate_id = $_GET["cate_id"];

$sql->table="tbl_news";
$sql->condition="WHERE cate_id='$cate_id' ORDER BY id DESC";
$query = $sql->select();
?>
<link rel="stylesheet" type="text/css" href="css/sidebar.css">
<link rel="stylesheet" type="text/css" href="css/easyPaginate.css">
<link rel="stylesheet" type="text/css" href="css/news.css">
<style type="text/css">
	@media (max-width: 991px){
		.box-news {
			background-color: #f5f5f5 !important;
		}
	}
	.box-news {
		background-color: rgba(255, 255, 255, 0.7);
		padding: 0;
		margin: 15px;
	}
	.newsList .media .media-heading {
		padding-top: 9px;
		margin-bottom: 8px;
		overflow: hidden;
		max-height: 33px;
		min-height: 33px;
		/*text-shadow: 0 0 1px #fff;*/
		/*text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.5), 5px 5px 1px rgba(0, 0, 0, 0.15);*/
		text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.5), 2px 3px 1px rgba(0, 0, 0, 0.15);
	}
	.newsList .media .media-body {
		/*	padding: 10px;*/
		padding-top: 5px;
		padding-left: 0px;
		padding-right: 10px;
	}
	@media (max-width: 768px) {
		.newsList .media .media-body {
			padding-left: 10px;
		}
	}
	.date-info-news {
		font-size: 14px;
		color: #6B7298;
		margin-bottom: 10px;
		min-height: 18px;
		max-height: 18px;
		overflow: hidden;
	}
</style>
<?php include("sidebar.php"); ?>
<div class="search-section">
	<div class="title">
		ข่าวสารประชาสัมพันธ์
	</div>
</div>
<div class="row newsList easyPaginateList" id="easyPaginate">
	<?php 
	while($result = mysqli_fetch_assoc($query))
	{
		$sql->table="tbl_news_img";
		$sql->condition="WHERE news_id='{$result["id"]}' ORDER BY id LIMIT 0,1";
		$queryImg = $sql->select();
		$resultImg = mysqli_fetch_assoc($queryImg);
		?>
		<pagination>
			<div class="col-xs-12" style="padding: 0;">
				<div class="box-news">
					<div class="media">
						<div class="media-left">
							<img src="upload/news/<?php echo $resultImg["img"]; ?>" alt="Image">
							<span class="maskingImage">
								<a data-toggle="modal" href="news_detail.php?page=<?php echo $_GET["page"]; ?>&news_id=<?php echo $result["id"]; ?>" class="btn viewBtn">อ่านต่อ</a>
							</span>
						</div>
						<div class="media-body">
							<h4 class="media-heading"><a href="news_detail.php?page=<?php echo $_GET["page"]; ?>&news_id=<?php echo $result["id"]; ?>"><?php echo $result["topic"]; ?></a></h4>
							<div class="date-info-news"><i class="fa fa-calendar"></i> โพสต์เมื่อ: <?php echo DateTime_Thai($result["create_date"]); if($result["update_date"] != "0000-00-00 00:00:00") { echo " - (ปรับปรุงเมื่อ : ".DateTime_Thai($result["update_date"]).")"; } ?></div>
							<a href="news_detail.php?page=<?php echo $_GET["page"]; ?>&news_id=<?php echo $result["id"]; ?>"><p class="ellipsis"><?php echo $result["short_detail"]; ?>
							</p></a>
						</div>
					</div>
				</div>
			</div>
		</pagination>
		<?php 
	}
	?>
</div>

</div>
</div>
</div>
</section>
<?php include("footer.php");  ?>
<script type="text/javascript" src="js/easyPaginate.js"></script>
<script type="text/javascript" src="js/jquery.dotdotdot.min.js"></script>
<script type="text/javascript">
	$("#easyPaginate").easyPaginate({
		paginateElement: "pagination",
		elementsPerPage: 4,
		effect: "climb"
	});
	$(function(){
		$(".ellipsis").dotdotdot({
			ellipsis: "... (อ่านต่อ)", /* The HTML to add as ellipsis. */
			wrap: "letter", /* How to cut off the text/html: 'word'/'letter'/'children' */
			watch : true /* Whether to update the ellipsis: true/'window' */
		});
	});
</script>