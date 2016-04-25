<?php
/**
 * Kunena Latest Module
 * @package Kunena.mod_kunenalatest
 *
 * @copyright (C) 2008 - 2015 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();
?>

<div class="<?php echo $this->params->get ( 'moduleclass_sfx' )?> klatest <?php echo $this->params->get ( 'sh_moduleshowtype' )?>">
	<div data-uk-grid-margin="" class="uk-grid"  data-uk-scrollspy="{cls:'uk-animation-fade', delay:900}">
		<?php if (empty ( $this->topics )) : ?>
			<li class="klatest-item"><?php echo JText::_('MOD_KUNENALATEST_NO_MESSAGE') ?></li>
		<?php else : ?>
			<ul id="lista_forum">
				<li class="item_lista_forum">
					<div class="titulo_categ_forum">
						<p>
							Perguntas
						</p>
					</div>

					<div class="autor_tempo_forum">
						&nbsp;
					</div>

					<div class="foto_forum">
						&nbsp;
					</div>

					<div class="qtd_posts_forum">
						Respostas
					</div>
				</li>
				<?php $this->displayRows (); ?>
			</ul>
			
			<div style="display: block; width: 100%;">
				<a href="/reparosemlagrima/forum-reparo" class="leia_mais_home">Leia mais</a>
			</div>
		<?php endif; ?>
	</div>
	<?php if ($this->topics && $this->params->get ( 'sh_morelink' )): ?>
		<p class="klatest-more">
			<?php echo JHtml::_('kunenaforum.link', $this->params->get ( 'moreuri' ), JText::_ ( 'MOD_KUNENALATEST_MORE_LINK' ) ); ?>
		</p>
	<?php endif; ?>
</div> 

<!-- <div data-uk-grid-margin="" class="uk-grid">
    <div class="uk-width-large-1-3 uk-width-medium-1-2">
	    <div class="uk-panel uk-panel-box">
	    	<code>.uk-width-medium-1-2</code>
	    </div>
    </div>
    <div class="uk-width-large-1-3 uk-width-medium-1-2">
    	<div class="uk-panel uk-panel-box">
    		<code>.uk-hidden-medium</code>
   		 </div>
    </div>
    <div class="uk-width-large-1-3 uk-width-medium-1-2">
    	<div class="uk-panel uk-panel-box">
    		<code>.uk-width-medium-1-2</code>
    	</div>
    </div>
</div> -->