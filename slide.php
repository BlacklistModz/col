<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<?php 
		$sql->table="tbl_slide";
		$sql->condition="WHERE slide_status='0' ORDER By rank ASC";
		$querySlide = $sql->select();
		$sumSlide = mysqli_num_rows($querySlide);
		for($i=0;$i<$sumSlide;$i++)
		{
			?>
			<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) { echo "active"; } ?>"></li>
			<?php 
		}
		?>
	</ol>
	<div class="carousel-inner" role="listbox">
		<?php 
		$num = 0;
		while($resultSlide = mysqli_fetch_assoc($querySlide))
		{
			?>
			<div class="item <?php if($num == 0) { echo "active"; }  ?>">
				<img class="slide" src="upload/slide/<?php echo $resultSlide["img"]; ?>">
			</div>
			<?php
			$num++; 
		}
		?>
	</div>
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>