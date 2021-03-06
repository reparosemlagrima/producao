<?php echo $header; ?>
<div class="container">
	<div class="row">
		<?php
			echo $column_left;

			if($column_left && $column_right){
				$class = 'col-sm-6';
			}
			elseif ($column_left || $column_right){
				$class = 'col-sm-9';
			}
			else{
				$class = 'col-sm-12';
			}
		?>
		
		<div id="content" class="<?php echo $class; ?>">
			<div class="boss-category-image" id="categorias_loja">
				<div class="main-category" style="width: 0px;">
					<a href="/loja-reparo/ferramentas" title="Ferramentas">
						<img src="/loja/image/catalog/ferramentas-1.jpg" alt="Ferramentas">
						<img src="/loja/image/catalog/ferramentas-2.jpg" alt="Ferramentas">
					</a>
					<a href="/loja-reparo/pecas" title="Peças">
						<img src="/loja/image/catalog/pecas-1.jpg" alt="Peças">
						<img src="/loja/image/catalog/pecas-2.jpg" alt="Peças">
					</a>
					<a href="/recicla" title="Desperdício Zero - Reciclar" id="banner_recicla">
						<img src="/loja/image/catalog/banner_reciclar.jpg" alt="Desperdício Zero - Reciclar">
					</a>
				</div>
			</div>
			
			<?php echo $content_top; ?>
			
			<?php echo $content_bottom; ?>
		</div>
		
		<?php echo $column_right; ?>
	</div>
</div>
<?php echo $footer; ?>


