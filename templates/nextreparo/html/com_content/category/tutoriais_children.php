<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

	$class = ' class="first"';
	$lang  = JFactory::getLanguage();

	if (count($this->children[$this->category->id]) > 0 && $this->maxLevel != 0) : ?>
		<div data-uk-grid-margin="" class="uk-grid">    
			<?php
				foreach ($this->children[$this->category->id] as $id => $child):
					if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())):
						if (!isset($this->children[$this->category->id][$id + 1])) :
							$class = ' class="last"';
						endif;
			?>
						<div class="uk-width-medium-1-4 uk-row-first">
							<div class="uk-panel uk-panel-box">
								<div class="uk-panel-teaser">
									 <img src="http://www.reparosemlagrima.com/imagens/moto.jpg" alt="">
								</div>
					
								<?php
									$class = '';
							
									if($lang->isRtl()):
								?>

										<h4 class="uk-panel-title">
											<?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
												<span class="badge badge-info tip hasTooltip" title="<?php echo JHtml::tooltipText('COM_CONTENT_NUM_ITEMS'); ?>">
													<?php echo $child->getNumItems(true); ?>
												</span>
											<?php endif; ?>
											
											<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id)); ?>">
												<?php echo $this->escape($child->title); ?>
											</a>

											<?php if (count($child->getChildren()) > 0 && $this->maxLevel > 1) : ?>
												<a href="#category-<?php echo $child->id;?>" data-toggle="collapse" data-toggle="button" class="btn btn-mini pull-right">
													<span class="icon-plus"></span>
												</a>
											<?php endif;?>
										</h4>

								<?php
									else:
								?>

										<h3 class="uk-panel-title">
											<!-- <a href="<?php //echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>"> -->
											<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>">
												<?php echo $this->escape($child->title); ?>
											</a>

											<?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
												<span class="badge badge-info tip hasTooltip" title="<?php echo JHtml::tooltipText('COM_CONTENT_NUM_ITEMS'); ?><?php echo " ".$child->getNumItems(true); ?>">
													<?php echo $child->getNumItems(true); ?>
												</span>
											<?php endif; ?>

											<?php if (count($child->getChildren()) > 0 && $this->maxLevel > 1) : ?>
												<a href="#category-<?php echo $child->id;?>" data-toggle="collapse" data-toggle="button" class="btn btn-mini pull-right">
													<span class="icon-plus"></span>
												</a>
											<?php endif;?>

										</h3>
							</div>

							<?php
								if ($this->params->get('show_subcat_desc') == 1):
									if ($child->description):
							?>
										<div class="category-desc">
											<?php echo JHtml::_('content.prepare', $child->description, '', 'com_content.category'); ?>
										</div>
							<?php
									endif;
								endif;
							?>

							<?php if (count($child->getChildren()) > 0 && $this->maxLevel > 1) : ?>
								<div class="collapse fade" id="category-<?php echo $child->id; ?>">

									<?php
										$this->children[$child->id] = $child->getChildren();
										$this->category = $child;
										$this->maxLevel--;
										echo $this->loadTemplate('children');
										$this->category = $child->getParent();
										$this->maxLevel++;
									?>
								</div>
							<?php endif; ?>
						</div>
			<?php
					endif;
				endforeach;
			?>
		</div>
<?php
	endif;
