<?php include("header.php"); ?>
<link rel="stylesheet" type="text/css" href="css/sidebar.css">
<link rel="stylesheet" type="text/css" href="plugin/owl-carousel/owl.theme.css">
<link rel="stylesheet" type="text/css" href="plugin/fancybox/jquery.fancybox.css">
<?php include("sidebar.php"); ?>
<style type="text/css">
	.search-section .title {
		line-height: 0.9;
		padding: 10px;
	}
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
$id = $_GET["page"];

$sql->table="tbl_infomation";
$sql->condition="WHERE id='$id'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);

?>
<section class="news-section">
	<div class="search-section">
		<div class="title">
			<?php echo $result["name"]; ?>
		</div>
	</div>
	<div class="card-form">
		<?php echo nl2br($result["detail"]); ?>
	</div>
</section>
</div>
</div>
</div>
</section>

<?php include("footer.php"); ?>
