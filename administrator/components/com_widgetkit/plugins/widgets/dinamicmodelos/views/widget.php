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

					if($catget == 7):
			?>
						<div class="uk-width-medium-1-5">
							<div class="uk-panel uk-panel-box">
								<div class="uk-panel-teaser">
									<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($cat->id)); ?>">
										<img src="<?php echo  $cat->getParams()->get('image'); ?>" alt="<?php echo $cat->getParams()->get('image_alt') ?>" title="<?php echo $cat->getParams()->get('image_alt') ?>" />
									</a>
								</div>
								<h3>
									<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($cat->id)); ?>">
										<?php echo $cat->title ?>
									</a>
								</h3>
							</div>
						</div>
			<?php
					else:
			?>
						<div class="uk-width-medium-1-5 cellphone">
							<div>
								<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($cat->id)); ?>">
									<img src="<?php echo  $cat->getParams()->get('image'); ?>" alt="<?php echo $cat->getParams()->get('image_alt') ?>" title="<?php echo $cat->getParams()->get('image_alt') ?>" />
								</a>
							</div>
							<h3>
								<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($cat->id)); ?>">
									<?php echo $cat->title ?>
								</a>
							</h3>
						</div>
			<?php
					endif;
				endforeach;
			?>
			</div>
<?php
		endif;
	endif;
?>