<?php
	function checkChildren($id)
	{
		$categories = JCategories::getInstance('Content');
		$categoria = $categories->get($id);
		$filhosdap = $categoria->getChildren();
		return $filhosdap;
	}

	$app = JFactory::getApplication();
	$option = $app->input->get('option',0,'STRING');
	$view = $app->input->get('view',0,'STRING');
	$catget = $app->input->get('id',0,'INT');
	
	if($catget && $view == 'category' && $option == 'com_content'):
		$filhosdaps = checkChildren($catget);

		if($filhosdaps):
?>
			<div data-uk-grid-margin="" class="uk-grid uk-grid-small">    
			<?php
				foreach($filhosdaps as $k => $cat):
					$subfilhos = checkChildren($cat->id);

					// categoria base das marcas dos celulares
					if($catget == 7):
			?>
						<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($cat->id)); ?>" class="uk-width-medium-1-5 modelos_brands">
							<span>
								<img src="<?php echo  $cat->getParams()->get('image'); ?>" alt="<?php echo htmlspecialchars($cat->getParams()->get('image_alt')); ?>" title="<?php echo htmlspecialchars($cat->getParams()->get('image_alt')); ?>" />
							</span>
							<h3>
								<p>
									<span>
										<?php echo $cat->title ?>
									</span>
								</p>
							</h3>
						</a>
			<?php
					else:
			?>
						<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($cat->id)); ?>" class="uk-width-medium-1-5 cellphone">
							<span>
								<img src="<?php echo  $cat->getParams()->get('image'); ?>" alt="<?php echo htmlspecialchars($cat->getParams()->get('image_alt')); ?>" title="<?php echo htmlspecialchars($cat->getParams()->get('image_alt')); ?>" />
							</span>
							<h3>
								<?php echo $cat->title ?>
							</h3>
						</a>
			<?php
					endif;
				endforeach;
			?>
			</div>
<?php
		endif;
	endif;
?>