<link rel="stylesheet" type="text/css" href="/reparosemlagrima/templates/nextreparo/js/bxslider/jquery.bxslider.css" />
<script type="text/javascript" src="/reparosemlagrima/templates/nextreparo/js/bxslider/jquery.bxslider.min.js"></script>

<link rel="stylesheet" type="text/css" href="/reparosemlagrima/templates/nextreparo/js/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript" src="/reparosemlagrima/templates/nextreparo/js/fancybox/jquery.fancybox.js?v=2.1.5"></script>

<script type="text/javascript">
	var jQuery = jQuery.noConflict();
	jQuery(window).load(function() {

		jQuery(".slider_tutorial").each(function(index){
			var num 	= (index+1);
			var nome 	= 'slider_tutorial_'+num;
			var id 		= '#'+nome;
			jQuery(this).attr('id',nome);

			jQuery(this).find('div.pager_imagens_tutorial > a').each(function(i){
				jQuery(this).attr('data-slide-index',i);
			});

			jQuery(this).find('ul.bxslider_imagens_tutorial a').each(function(i){
				jQuery(this).attr('data-fancybox-group','gallery');
			});

			jQuery(id+' .bxslider_imagens_tutorial').bxSlider({
				pagerCustom : id+' .pager_imagens_tutorial',
				infiniteLoop: false,
				controls 	: false,
				mode 		: 'vertical'
			});
			jQuery(id+' .pager_imagens_tutorial').bxSlider({
				infiniteLoop 	: false,
				hideControlOnEnd: true,
				pager 			: false,
				minSlides 		: 4,
				maxSlides 		: 4,
				slideWidth 		: 110,
				slideMargin 	: 4,
				mode 			: 'vertical'
			});
		});

		jQuery(".fancybox").fancybox({
				wrapCSS		: 'fancybox-custom',
				padding 	: 10,

				closeClick 	: true,

				minWidth	: 300,
				maxWidth	: 1500,

				openEffect  : 'elastic',
				closeEffect	: 'elastic',

				openSpeed	: 'fast',
				closeSpeed	: 'fast',

				helpers 	: {
					title 	: {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(78, 78, 78, 0.9)'
						}
					}
				}
			});
	});
</script>

<article class="uk-article <?php echo $this['config']->get('article', ''); ?>" <?php if ($permalink) echo 'data-permalink="'.$permalink.'"'; ?>>
	<?php if ($image && $image_alignment != 'none') : ?>
	<div class="uk-grid uk-grid-width-medium-1-2" data-uk-grid-match="{target:'.uk-panel'}">
	<?php endif; ?>

		<?php if ($image && $image_alignment == 'left') : ?>
		<div>
			<div class="uk-panel tm-article-image" style="background:url(<?php echo $image; ?>) #FFF 50% 50% no-repeat; background-size: cover;">
				<?php if ($url) : ?><a class="uk-position-cover" href="<?php echo $url; ?>" title="<?php echo $image_caption; ?>"><?php endif; ?>
				<img class="uk-invisible" src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
				<?php if ($url) : ?></a><?php endif; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ($image && $image_alignment != 'none') : ?>
		<div class="uk-flex uk-flex-center uk-flex-middle">
			<div class="uk-panel tm-panel-medium-padding">
		<?php endif; ?>

				<?php if ($image && $image_alignment == 'none') : ?>

					<?php if ($url) : ?>
					<a href="<?php echo $url; ?>" title="<?php echo $title; ?>" class="tm-article-image tm-article-image-large uk-display-block" style="background:url(<?php echo $image; ?>) #FFF 50% 50% no-repeat; background-size: cover;">
					<?php else : ?>
					<div class="tm-article-image tm-article-image-large" style="background:url(<?php echo $image; ?>) #FFF 50% 50% no-repeat; background-size: cover;">
					<?php endif; ?>
						<img class="uk-invisible" src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
					<?php if ($url) : ?>
					</a>
					<?php else : ?>
					</div>
					<?php endif; ?>

				<?php endif; ?>

				<?php if ($title) : ?>
				<h1 class="tm-article-title uk-article-title">
					<?php if ($url && $title_link) : ?>
						<a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
					<?php else : ?>
						<?php echo $title; ?>
					<?php endif; ?>
				</h1>
				<?php endif; ?>
				<?php echo $hook_aftertitle; ?>

				<?php echo $hook_beforearticle; ?>

				<?php if ($article) : ?>
				<div class="tm-article-content uk-margin">
					<?php echo $article; ?>
				</div>
				<?php endif; ?>

				<?php if ($author || $date || $category) : ?>
				<p class="tm-article-meta uk-article-meta">

					<?php

						$author   = ($author && $author_url) ? '<a href="'.$author_url.'">'.$author.'</a>' : $author;
						$date     = ($date) ? ($datetime ? '<time datetime="'.$datetime.'">'.JHtml::_('date', $date, JText::_('DATE_FORMAT_LC3')).'</time>' : JHtml::_('date', $date, JText::_('DATE_FORMAT_LC3'))) : '';
						$category = ($category && $category_url) ? '<a href="'.$category_url.'">'.$category.'</a>' : $category;

						if($author && $date) {
							printf(JText::_('TPL_WARP_META_AUTHOR_DATE'), $author, $date);
						} elseif ($author) {
							printf(JText::_('TPL_WARP_META_AUTHOR'), $author);
						} elseif ($date) {
							printf(JText::_('TPL_WARP_META_DATE'), $date);
						}

						if ($category) {
							echo ' ';
							printf(JText::_('TPL_WARP_META_CATEGORY'), $category);
						}

					?>

				</p>
				<?php endif; ?>

				<?php if ($tags) : ?>
				<p><?php echo JText::_('TPL_WARP_TAGS').': '.$tags; ?></p>
				<?php endif; ?>

				<?php if ($more) : ?>
				<p>
					<a class="uk-button uk-button-small uk-button-primary" href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $more; ?></a>
				</p>
				<?php endif; ?>

				<?php if ($edit) : ?>
				<p><?php echo $edit; ?></p>
				<?php endif; ?>

		<?php if ($image && $image_alignment != 'none') : ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ($image && $image_alignment == 'right') : ?>
		<div>
			<div class="uk-panel tm-article-image" style="background:url(<?php echo $image; ?>) #FFF 50% 50% no-repeat; background-size: cover;">
				<?php if ($url) : ?><a class="uk-position-cover" href="<?php echo $url; ?>" title="<?php echo $image_caption; ?>"><?php endif; ?>
				<img class="uk-invisible" src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
				<?php if ($url) : ?></a><?php endif; ?>
			</div>
		</div>
		<?php endif; ?>

	<?php if ($image && $image_alignment != 'none') : ?>
	</div>
	<?php endif; ?>

	<?php if ($previous || $next) : ?>
	<ul class="uk-pagination">
		<?php if ($previous) : ?>
		<li class="uk-pagination-previous">
			<a href="<?php echo $previous; ?>"><i class="uk-icon-angle-double-left"></i> <?php echo JText::_('JPREV'); ?></a>
		</li>
		<?php endif; ?>

		<?php if ($next) : ?>
		<li class="uk-pagination-next">
			<a href="<?php echo $next; ?>"><?php echo JText::_('JNEXT'); ?> <i class="uk-icon-angle-double-right"></i></a>
		</li>
		<?php endif; ?>
	</ul>
	<?php endif; ?>

	<?php echo $hook_afterarticle; ?>

</article>
