<h3><?php echo $heading_title; ?></h3>
<div class="row">
	<?php foreach ($products as $product) { ?>
	<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="product-thumb transition">
			<?php $name_img = substr($product['thumb'],0,-6).".jpg"; ?>
			<div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $name_img; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
			<div class="caption">
				<?php if ($product['price']) { ?>
				<p class="price">
					<?php if (!$product['special']) { ?>
					<?php echo $product['price']; ?>
					<?php } else { ?>
					<span class="price-new"><?php echo $product['special']; ?></span>
					<?php } ?>
				</p>
				<?php } ?>
				<h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
			</div>
		</div>
	</div>
	<?php } ?>
</div>