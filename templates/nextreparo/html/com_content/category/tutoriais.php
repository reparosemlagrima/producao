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
		<?php if ($this->params->get('show_page_heading')) : ?>
			<div class="page-header">
				<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
			</div>
		<?php endif; ?>

		<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
			<h2>
				<?php echo $this->escape($this->params->get('page_subheading')); ?>
				<?php if ($this->params->get('show_category_title')) : ?>
					<span class="subheading-category"><?php echo $this->category->title; ?></span>
				<?php endif; ?>
			</h2>
		<?php endif; ?>

		<?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
			<?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
			<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
		<?php endif; ?>
		<?php echo $this->category->description; ?>
		<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
			<div class="category-desc clearfix">
				
				<?php if ($this->params->get('show_description') && $this->category->description) : ?>
					<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
			<?php if ($this->params->get('show_no_articles', 1)) : ?>
				<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
			<?php endif; ?>
		<?php endif; ?>

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
		<?php endif; ?>

		<?php
			$introcount = (count($this->intro_items));
			$counter = 0;
		?>
		<!--
		<div class="uk-grid-width-1-1 uk-grid-width-medium-1-3 uk-grid-small uk-grid uk-grid-match"  data-uk-grid-margin data-uk-grid-match="{target:'.uk-panel'}">
		-->

		<?php if (!empty($this->intro_items)) : ?>
			<?php foreach ($this->intro_items as $key => &$item) : ?>
				<?php $rowcount = ((int) $key % (int) $this->columns) + 1; ?>
				<?php if ($rowcount == 1) : ?>
					<?php $row = $counter / $this->columns; ?>
					<div class="items-row cols-<?php echo (int) $this->columns; ?> <?php echo 'row-' . $row; ?> row-fluid clearfix">
				<?php endif; ?>
				<div class="span<?php echo round((12 / $this->columns)); ?> rk-margin-tutorial">
			
					<div class="item column-<?php echo $rowcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
						<?php
							$this->item = & $item;
							echo $this->loadTemplate('newitem');
						?>
					</div>
					<!-- end item -->
					<?php $counter++; ?>
				</div><!-- end span -->
				<?php if (($rowcount == $this->columns) or ($counter == $introcount)) : ?>
					</div><!-- end row -->
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if (!empty($this->link_items)) : ?>
			<div class="items-more">
				<?php echo $this->loadTemplate('links'); ?>
			</div>
		<?php endif; ?>

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