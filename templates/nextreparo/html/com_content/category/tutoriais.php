<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');
	$url = $_SERVER["REQUEST_URI"];
	$pieces = explode("/", $url);
	$page_var = $pieces[2];
	$pieces2 = explode("?", $page_var);
	$page_var2 = $pieces2[0];
?>
	<div class="blog<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog">
		<?php echo $this->category->description; ?>
		<!--
		TEXTO CABEÇALHO
		<?php if ($this->params->get('show_page_heading')) : ?>
			<div class="page-header">
				<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
			</div>
		<?php endif; ?>
		-->

		<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
			<h2>
				<?php echo $this->escape($this->params->get('page_subheading')); ?>
				<?php if ($this->params->get('show_category_title')) : ?>
					<span class="subheading-category"><?php echo $this->category->title; ?></span>
				<?php endif; ?>
			</h2>
		<?php endif; ?>
		
		<!--
		CATEGORIAS / TAGS
		<?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
			<?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
			<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
		<?php endif; ?>
		-->

		<!--
		DESCRIÇÃO
		<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
			<div class="category-desc clearfix">
				<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
					<img src="<?php echo $this->category->getParams()->get('image'); ?>" alt="<?php echo htmlspecialchars($this->category->getParams()->get('image_alt')); ?>"/>
				<?php endif; ?>
				<?php if ($this->params->get('show_description') && $this->category->description) : ?>
					<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		-->

		<!--
		TEXTO 'SEM ARTIGOS'
		<?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
			<?php if ($this->params->get('show_no_articles', 1)) : ?>
				<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
			<?php endif; ?>
		<?php endif; ?>
		-->

		<!--
		ARTIGOS PRINCIPAIS
		<?php $leadingcount = 0; ?>
		<?php if (!empty($this->lead_items)) : ?>
			<div class="items-leading clearfix">
				<?php foreach ($this->lead_items as &$item) : ?>
					<div class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
						<?php
							$this->item = & $item;
							echo $this->loadTemplate('newitem');
						?>
					</div>
					<?php $leadingcount++; ?>
				<?php endforeach; ?>
			</div><!-- end items-leading -->
		<!--
		<?php endif; ?>
		-->

		<!--
		ZERAGEM CONTADOR
		<?php
			$introcount = (count($this->intro_items));
			$counter = 0;
		?>
		-->

		<br class="clear" />
		<!--
		<div class="uk-grid-width-1-1 uk-grid-width-medium-1-3 uk-grid-small uk-grid uk-grid-match"  data-uk-grid-margin data-uk-grid-match="{target:'.uk-panel'}">
		-->

		<?php if (!empty($this->intro_items)) : ?>
			<?php //if (count($this->intro_items) > 2) : ?>
				<?php
					//if(@$page_var2 != NULL && @$page_var2 == "tutorial-interno" && (@$pieces[3] != NULL && @$pieces[4] != NULL)):
						//unset($this->intro_items[0]);
						//unset($this->intro_items[1]);
					//endif;
				?>
				<div id="outros_maisacessados">
					<h4 id="titulo_outros_maisacessados">Todos</h4>
					<ul class="lista_outros_maisacessados">
						<?php foreach ($this->intro_items as $key => $item) : ?>
							<?php
								$rowcount = ((int) $key % (int) $this->columns) + 1;
								$itens = $item->images;
								$pieces = explode(",",$itens);
								$path = explode(":",$pieces[0]);
								$image = str_replace("\\", "",substr($path[1],1,-1));

								$categ_pieces = explode("/", $item->category_route);
								unset($categ_pieces[0]);
								$categoria = implode("/", $categ_pieces);
								$link = "tutorial-interno/".$categoria."/".$item->id."-".$item->alias;
							?>
								<li>
									<a href="<?php echo $link; ?>">
										<span>
											<img src="<?php echo $image; ?>" alt="<?php echo $item->title; ?>" title="<?php echo $item->title; ?>" />
										</span>
										<div>
											<p>
												<span>
													<?php echo $item->title; ?>
												</span>
											</p>
										</div>
									</a>
								</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php //endif; ?>
		<?php endif; ?>

		<!--
		LINKS
		<?php if (!empty($this->link_items)) : ?>
			<div class="items-more">
				<?php echo $this->loadTemplate('links'); ?>
			</div>
		<?php endif; ?>
		-->

	 	<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
			<div class="uk-pagination">
				<?php if ($this->params->def('show_pagination_results', 1)) : ?>
					<p class="counter pull-right">
						<?php echo $this->pagination->getPagesCounter(); ?>
					</p>
				<?php endif; ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
		<?php endif; ?>
	</div>