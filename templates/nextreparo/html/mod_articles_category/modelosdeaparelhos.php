<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

	defined('_JEXEC') or die;


?>


	<div class="uk-grid">
		<?php foreach ($list as $categoria) : ?>
			<div class="uk-grid-width-medium-1-3 uk-grid-width-xlarge-1-3 uk-grid-width-small-1-2">			

				<?php if ($categoria->displayHits) : ?>
					<span class="mod-articles-category-hits">
						(<?php echo $categoria->displayHits; ?>)
					</span>
				<?php endif; ?>	
			
				<?php if ($categoria->displayCategoryTitle) : ?>
					<h4 class="mod-articles-category-category">
						<?php echo $categoria->displayCategoryTitle; ?>
					</h4>
				<?php endif; ?>
		
			</div>
		<?php endforeach; ?>
	</div>
<hr />
<div>
	<?php if ($grouped) : ?>
		<?php foreach ($list as $group_name => $group) : ?>
		
			
			<div class="">
				<?php foreach ($group as $item) : ?>
					<div>
						<?php if ($params->get('link_titles') == 1) : ?>
							<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
								<?php echo $item->title; ?>
							</a>
						<?php else : ?>
							<?php echo $item->title; ?>
						<?php endif; ?>
	
						<?php if ($item->displayHits) : ?>
							<span class="mod-articles-category-hits">
								(<?php echo $item->displayHits; ?>)
							</span>
						<?php endif; ?>
	
						<?php if ($params->get('show_author')) : ?>
							<span class="mod-articles-category-writtenby">
								<?php echo $item->displayAuthorName; ?>
							</span>
						<?php endif;?>
	
						<?php if ($item->displayCategoryTitle) : ?>
							<span class="mod-articles-category-category">
								(<?php echo $item->displayCategoryTitle; ?>)
							</span>
						<?php endif; ?>
	
						<?php if ($item->displayDate) : ?>
							<span class="mod-articles-category-date"><?php echo $item->displayDate; ?></span>
						<?php endif; ?>
	
						<?php if ($params->get('show_introtext')) : ?>
							<p class="mod-articles-category-introtext">
								<?php echo $item->displayIntrotext; ?>
							</p>
						<?php endif; ?>
	
						<?php if ($params->get('show_readmore')) : ?>
							<p class="mod-articles-category-readmore">
								<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
									<?php if ($item->params->get('access-view') == false) : ?>
										<?php echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE'); ?>
									<?php elseif ($readmore = $item->alternative_readmore) : ?>
										<?php echo $readmore; ?>
										<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
											<?php if ($params->get('show_readmore_title', 0) != 0) : ?>
												<?php echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit')); ?>
											<?php endif; ?>
									<?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
										<?php echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE'); ?>
									<?php else : ?>
										<?php echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE'); ?>
										<?php echo JHtml::_('string.truncate', ($item->title), $params->get('readmore_limit')); ?>
									<?php endif; ?>
								</a>
							</p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		
		<?php endforeach; ?>
	<?php else : ?>
		<?php foreach ($list as $item) : ?>
			<div class="uk-panel uk-panel-box uk-panel-box-default-hover">
				<?php if ($params->get('link_titles') == 1) : ?>
					<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
						<h3><?php echo $item->title; ?></h3>
					</a>
				<?php else : ?>
					<h3><?php echo $item->title; ?></h3>
				<?php endif; ?>
	
				<?php if ($item->displayHits) : ?>
						<small><?php echo $item->displayHits; ?></small>
				<?php endif; ?>
				
	
				<?php if ($item->displayCategoryTitle) : ?>
						<small><?php echo "Modelo: ".$item->displayCategoryTitle; ?></small>
				<?php endif; ?>
	
				<?php if ($item->displayDate) : ?>
					<small> | <?php echo $item->displayDate; ?></small>
				<?php endif; ?>
	
				<?php if ($params->get('show_introtext')) : ?>
					<span class="mod-articles-category-introtext">
						<?php echo "<br />".$item->displayIntrotext; ?>
					</span>
				<?php endif; ?>
	
				<?php if ($params->get('show_readmore')) : ?>
					<span class="mod-articles-category-readmore uk-display-block">
						<a class="uk-pull-right uk-button-link <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
							<?php if ($item->params->get('access-view') == false) : ?>
								<?php echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE'); ?>
							<?php elseif ($readmore = $item->alternative_readmore) : ?>
								<?php echo $readmore; ?>
								<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
							<?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
								<?php echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE'); ?>
							<?php else : ?>
								<?php echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE'); ?>
								<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
							<?php endif; ?>
						</a>
					</span>
				<?php endif; ?>
			</div>
			<hr />
		<?php endforeach; ?>
	<?php endif; ?>
</div>
