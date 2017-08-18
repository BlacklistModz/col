<?php include("header.php"); ?>
<link rel="stylesheet" type="text/css" href="css/sidebar.css">
<link rel="stylesheet" type="text/css" href="plugin/owl-carousel/owl.theme.css">
<link rel="stylesheet" type="text/css" href="plugin/fancybox/jquery.fancybox.css">
<?php include("sidebar.php"); ?>
<style type="text/css">
	/*.search-section .title {
		line-height: 0.9;
		padding: 10px;
	}*/
	.card-form {
		margin-top: 10px;
		margin-bottom: 25px;
		padding: 0;
		border-radius: 4px;
		padding: 12px 20px 15px;
		background: linear-gradient(#fff, rgba(255, 193, 7, 0));
	}
	@media (max-width: 991px){
		.card-form {
			background: linear-gradient(#f5f5f5, rgba(255, 193, 7, 0));
		}
	}
	#owl-demo .item {
		margin: 3px;
	}
	#owl-demo .item img {
		display: block;
		width: 100%;
		height: auto;
	}
</style>
<?php

if(!isset($_GET["news_id"]) or (empty($_GET["news_id"])))
{
    header("location:index.php?page=home");
}

$id = $_GET["news_id"];
$sql->table="tbl_news";
$sql->condition="WHERE id='$id'";
$result = mysqli_fetch_assoc($sql->select());
?>
<section class="news-section">
	<div class="search-section">
		<div class="title">
			<?php echo $result["topic"]; ?>
		</div>
	</div>
	<div class="card-form">
		<?php echo $result["detail"]; ?>
		<div id="owl-demo" class="itemsScaleUp-true owl-carousel">
			<?php 
			$sql->table="tbl_news_img";
			$sql->condition="WHERE news_id='$id'";
			$queryImg = $sql->select();
			while($resultImg = mysqli_fetch_assoc($queryImg))
			{
				?>
				<div class="item">
					<a class="fancybox" href="upload/news/<?php echo $resultImg["img"]; ?>" data-fancybox-group="gallery">
						<img src="upload/news/<?php echo $resultImg["img"]; ?>" alt="Owl Image">
					</a>
				</div>
				<?php 
			}
			?>
		</div>
	</div>
</section>
</div>
</div>
</div>
</section>

<?php include("footer.php"); ?>
<script type="text/javascript" src="plugin/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="plugin/fancybox/jquery.fancybox.pack.js"></script>
<script>
	$(document).ready(function() {
		$(".itemsScaleUp-true").owlCarousel({
			items : 7,
			itemsScaleUp:true,
			transitionStyle : "backSlide"
		});
		$('.fancybox').fancybox({
			openEffect : 'elastic',
			openSpeed  : 150,
			closeEffect : 'elastic',
			closeSpeed  : 150
		});
	});
</script>