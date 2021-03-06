<?php
/**
* @package   yoo_gusto
* @author    YOOtheme http://www.yootheme  om
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));
?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>"  data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>
	<head>
	<?php echo $this['template']->render('head'); ?>

	<?php
		$session_name_user = $_SESSION["__default"]["user"]->name;
		//echo "<pre>";
		//print_r($_SESSION["__default"]);
		//echo "</pre>";
		if($_SERVER['REQUEST_URI'] == "/registra-usuario/profile"){
			header("Location: /forum-reparo/perfil");
		}
	?>

	<?php
		if($session_name_user != NULL):
	?>
			<script type="text/javascript">
				var jQuery = jQuery.noConflict();
				jQuery(window).load(function() {
					if(jQuery(".pag_home").length){
						jQuery(".menu_principal .perfil_home").html('<a href="/forum-reparo/user">Perfil</a>');
						jQuery(".menu_principal .acessar_logout").html('<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena') ?>" method="post" name="login" id="form_logout"><input type="hidden" name="view" value="user" /><input type="hidden" name="task" value="logout" /><input type="hidden" name="<?php echo JFactory::getSession()->getFormToken()?>" value="1" /><input type="submit" name="submit" class="kbutton" value="Sair" /></form>');	
					}
				});
			</script>
	<?php
		endif;
	?>

	<script type="text/javascript">
		var jQuery = jQuery.noConflict();
		jQuery(window).scroll(function() {
			if ( jQuery(".pag_home").length ){
				if (jQuery("#new-menu").offset().top > 750) {
					jQuery("#new-menu").addClass("menu_home-fixed");
				} else {
					jQuery("#new-menu").removeClass("menu_home-fixed");
				}
			}
		});

		jQuery(window).load(function() {
			if(jQuery("#new-status-f").length){
				jQuery("#new-status-f").hide();
				jQuery("#new-status-f").appendTo(".ultimas-form-home h3");
				jQuery("#new-status-f").show();
			}

			if(jQuery("#Kunena form > .kblock > .kheader").length){
				var novo_topico = jQuery("#Kunena .klist-actions > div > a").first();
				jQuery(novo_topico).appendTo("#Kunena form > .kblock > .kheader");
			}

			if(jQuery("#Kunena .uk-grid .uk-width-medium-7-10 > .kblock > .kheader").length){
				var categ = jQuery("#Kunena .uk-grid .uk-width-medium-7-10 .klist-markallcatsread");
				jQuery(categ).appendTo("#Kunena .uk-grid .uk-width-medium-7-10 > .kblock > .kheader");
				jQuery('#Kunena div.uk-grid > .uk-width-medium-7-10 .klist-markallcatsread').css("display","block");
			}

			if(jQuery("#Kunena .kmsg .kmessage-buttons-cover").length){
				jQuery("#Kunena > .kblock > .kcontainer > .kbody > table.kmsg").each(function(i){
					var same_problem = jQuery("#Kunena .klist-actions .klist-actions-forum").last().find("a.kicon-button.kbuttonuser");
					jQuery(same_problem).appendTo(jQuery(this).find(".kmessage-buttons-cover"));

					jQuery(this).find(".kbuttonbar-left > .kpost-thankyou a").appendTo(jQuery(this).find(".kmessage-buttons-cover"));
					jQuery(this).find(".kbuttonbar-left > .kpost-unthankyou a").appendTo(jQuery(this).find(".kmessage-buttons-cover"));

					var favorite = jQuery("#Kunena .klist-actions .klist-actions-forum").first().find("a.kicon-button.kbuttonuser:nth-child(3)");
					jQuery(favorite).appendTo(jQuery(this).find(".kmessage-buttons-cover"));

					var qtd_same_problem = jQuery("#Kunena .klist-actions .klist-actions-forum").last().find("small.similar-smallinfo");
					jQuery(qtd_same_problem).appendTo(jQuery(this).find(".kmessage-left .kmsgdate"));
				});
				
				jQuery("#Kunena > .kblock > .kcontainer > .kbody > table.kmsg:not(:first)").each(function(i){
					var data_post = jQuery(this).find("h2 span.kmsgdate").html();
					jQuery(jQuery(this).find("tbody .data_post span")).html(data_post);
				});
			}
		});
	</script>

	<?php
		$url = $_SERVER["REQUEST_URI"];
		$pieces = explode("/", $url);
		//echo "<pre>";
		//var_dump($pieces);
		//echo "</pre>";
		$page_var = $pieces[1];
		@$sublink = $pieces[2];
		$pieces2 = explode("?", $page_var);
		$page_var2 = $pieces2[0];

		if(@$page_var2 != NULL && @$page_var2 == ("tutorial-interno" || "forum-reparo" || "registra-usuario")):
	?>
	<script type="text/javascript">
		jQuery(window).load(function() {
			// Adiciona ícone home em breadcrumb
			jQuery(".uk-breadcrumb li:first-of-type a").html("<i class='fa fa-home'></i>");
			jQuery(".uk-breadcrumb li:first-of-type").show();
		});
	</script>
	<?php
		endif;

		if(@$page_var2 != NULL && @$page_var2 == "forum-reparo"):
	?>
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery(".uk-breadcrumb li:nth-child(2)").show();
		});
	</script>
	<?php
		endif;

		if(@$page_var2 != NULL && @$page_var2 == "loja-reparo" && (@$sublink == "" || @$sublink == "home")):
	?>
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery("body").addClass("loja_home");
			jQuery("#tm-top-a").show();
		});
	</script>
	<?php
		endif;

		if(@$page_var2 != NULL && @$page_var2 == "loja-reparo"):
	?>
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery("body.pag_loja").find(".list-group").prepend("<a style='font-size: 16px; line-height: 20px; padding-top: 9px; display: block; font-weight: bold; cursor: default;'>NAVEGAR CATEGORIAS</a>");
		});
	</script>
	<?php
		endif;

		if(@$page_var2 != NULL && @$page_var2 == "tutorial-interno"):
	?>
	<script type="text/javascript">
		jQuery(window).load(function() {
			// Limpa variável 'Confira alguns tutoriais mais visualizados'
			var string = jQuery("body.pag_tutoriais div#tm-main main#tm-content .uk-panel > h2, body.pag_tutoriais div#tm-main main#tm-content .blogpag_tutoriais > h2").text();
			var new_string = jQuery.trim(string);
			// Reescreve texto 'Confira alguns tutoriais mais visualizados'
			jQuery("body.pag_tutoriais div#tm-main main#tm-content .uk-panel > h2, body.pag_tutoriais div#tm-main main#tm-content .blogpag_tutoriais > h2").text(new_string);
			// Esconde texto
			jQuery("body.pag_tutoriais div#tm-main main#tm-content .uk-panel > h2, body.pag_tutoriais div#tm-main main#tm-content .blogpag_tutoriais > h2").hide();
			// Adiciona imagem ao lado do texto
			jQuery("body.pag_tutoriais div#tm-main main#tm-content .uk-panel > h2, body.pag_tutoriais div#tm-main main#tm-content .blogpag_tutoriais > h2").prepend("<span class='icon_rsl'></span>");
			// Exibe texto
			jQuery("body.pag_tutoriais div#tm-main main#tm-content .uk-panel > h2, body.pag_tutoriais div#tm-main main#tm-content .blogpag_tutoriais > h2").show();
		});
	</script>
	<?php
		endif;

		if(@$page_var2 != NULL && @$page_var2 == "tutorial-interno" && (@$pieces[2] != NULL && @$pieces[3] != NULL)):
	?>
	<script type="text/javascript">
		jQuery(window).load(function() {
			// Modifica elemento de lugar
			jQuery("body.pag_tutoriais #tm-top-b").prependTo("body.pag_tutoriais #tm-main .blogpag_tutoriais #mais_acessadas");
			// Exibe elemento
			jQuery("body.pag_modelo #tm-top-b").show();

			var content_maisacessadas = jQuery("body.pag_tutoriais #tm-main .blogpag_tutoriais #mais_acessadas").html();
			if(content_maisacessadas == "&nbsp;"){
				jQuery("#mais_acessadas").css("display", "none");
				jQuery(".blogpag_tutoriais.pag_modelo .type").css({"margin":"0 auto", "float": "none"});
			}

			jQuery(".blogpag_tutoriais.pag_modelo .type").show();
			jQuery(".blogpag_tutoriais.pag_modelo #outros_maisacessados").show();
		});
	</script>
	<?php
		endif;
	?>
	</head>

	<body class="<?php echo $this['config']->get('body_classes'); ?>">
		<?php if ($this['widgets']->count('toolbar')) : ?>
			<div class="tm-block-toolbar uk-hidden-small">
				<div class="uk-container uk-container-center">
					<div class="tm-toolbar-container">
						<?php echo $this['widgets']->render('toolbar'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($this['widgets']->count('logo + menu')) : ?>
			<div class="tm-navbar <?php echo $navbar; ?>" <?php echo $sticky; ?>>
				<div class="uk-container uk-container-center" id="topo_site">
					<nav class="tm-navbar-container">
						<?php if ($this['widgets']->count('logo')) : ?>
							<div class="tm-nav-logo uk-hidden-small" id="logo_site">
								<a class="tm-logo uk-navbar-brand uk-responsive-width uk-responsive-height" href="<?php echo $this['config']->get('site_url'); ?>" title="Reparo Sem Lagrima">
									<!--<?php //echo $this['widgets']->render('logo'); ?>-->
								</a>
							</div>
						<?php endif; ?>

						<?php if ($this['widgets']->count('search-top')) : ?>
							<div class="uk-container uk-container-center" id="search_topo">
								<?php echo $this['widgets']->render('search-top'); ?>
							</div>
						<?php endif; ?>

						<?php if ($this['widgets']->count('menu')) : ?>
							<?php $class_login = ($session_name_user == NULL) ? "" : "loggedin"; ?>
							<div class="tm-nav uk-hidden-small <?php echo $class_login; ?>" id="menu_topo">
								<div id="wishlist_menu_topo">
									<a href="/loja-reparo/account/wishlist" id="wishlist-total" title="Lista de desejos"></a>
								</div>

								<div id="loja_menu_topo">
									<a href="/loja-reparo/index.php?route=checkout/cart" title="Loja"></a>
								</div>

								<?php
									if($session_name_user == NULL):
								?>
								<?php echo $this['widgets']->render('menu'); ?>
								<?php
									else:
								?>
									<div id="profile_user">
										<p>
											Bem-Vindo(a), <?php echo $session_name_user; ?>!
										</p>
									</div>
									<ul class="uk-navbar-nav uk-hidden-small">
										<li>
											<a href="/forum-reparo/user">Perfil</a>
										</li>
										<li>
											<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena') ?>" method="post" name="login" id="form_logout">
												<input type="hidden" name="view" value="user" />
												<input type="hidden" name="task" value="logout" />
												<input type="hidden" name="<?php echo JFactory::getSession()->getFormToken()?>" value="1" />
												<input type="submit" name="submit" class="kbutton" value="Sair" />
											</form>
										</li>
									</ul>
								<?php
									endif;
								?>
							</div>
						<?php endif; ?>
						
						<?php if ($this['widgets']->count('cart-loja')) : ?>
							<?php echo $this['widgets']->render('cart-loja'); ?>
						<?php endif; ?>

						<?php if ($this['widgets']->count('offcanvas')) : ?>
							<a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
						<?php endif; ?>

						<?php if ($this['widgets']->count('logo-small')) : ?>
							<div class="uk-navbar-content uk-navbar-center uk-visible-small" id="logo_responsivo">
								<a class="uk-responsive-width uk-responsive-height" href="<?php echo $this['config']->get('site_url'); ?>">
									<!-- <?php //echo $this['widgets']->render('logo-small'); ?> -->
								</a>
							</div>
						<?php endif; ?>
					</nav>
				</div>
				<?php if ($this['widgets']->count('top-menu')) : ?>
					<div class="top-menu menu_principal" id="top-menu">
						<!--
						<div class="tm-toolbar uk-clearfix uk-hidden-small uk-hidden-medium">
							<div class="uk-container uk-container-center">
						-->
						<?php echo $this['widgets']->render('top-menu'); ?>
						<!--
							</div>
						</div>
						-->
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
			
		<?php if ($this['widgets']->count('new-top-a')) : ?>
			<div class="new-top-a" id="new-top-a">
				<a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>                        
				
				<?php if ($this['widgets']->count('new-menu')) : ?>
					<div class="new-menu menu_home" id="new-menu">
						<div class="uk-container uk-container-center">
							<h1 id="logo_topo_menu">
								<a href="/">Reparo Sem Lagrima</a>
							</h1>

							<?php echo $this['widgets']->render('new-menu'); ?> 
						</div>
					</div>
				<?php endif; ?>

				<div class="newlogo-top-a">
					<a href="<?php echo $this['config']->get('site_url'); ?>" id="logo_banner">
						<?php echo strip_tags($this['widgets']->render('new-top-a'),'<img>'); ?>
					</a>    
				</div>

				<?php if ($this['widgets']->count('search-home')) : ?>
					<div class="uk-container uk-container-center" id="search_banner">
						<?php echo $this['widgets']->render('search-home'); ?>
					</div>
				<?php endif; ?>
					
				

				<?php if ($this['widgets']->count('new-status')) : ?>
					<div class="new-status" id="new-status">
						
						<div class="uk-container uk-container-center">
							<div data-uk-grid-margin="" class="uk-grid hgfh uk-grid-medium uk-grid-divider"  data-uk-scrollspy="{cls:'uk-animation-fade', delay:900}">
							
								<?php echo $this['widgets']->render('new-status',array('layout'=>$this['config']->get('grid.new-status.layout'))); ?>

								<!--
								<div class="uk-width-large-1-3 uk-width-medium-1-2">
									<div class="uk-panel uk-panel-box uk-panel-box-primary">
										modulo 1
									</div>
								</div>
								<div class="uk-width-large-1-3 uk-width-medium-1-2">
									<div class="uk-panel uk-panel-box uk-panel-box-primary">
										modulo 1
									</div>
								</div>
								<div class="uk-width-large-1-3 uk-width-medium-1-2">
									<div class="uk-panel uk-panel-box uk-panel-box-primary">
										modulo 1
									</div>
								</div>
								-->
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ($this['widgets']->count('new-top-b')) : ?>
			<div class="new-top-b" id="new-top-b">
				<div class="uk-container uk-container-center">
					<?php echo $this['widgets']->render('new-top-b'); ?>
				</div>
			</div>
		<?php endif; ?>

		<section>
			<?php if ($this['widgets']->count('top-a')) : ?>
				<div id="tm-top-a" class="tm-block-top-a uk-block <?php echo $classes['block.top-a']; ?>" <?php echo $styles['block.top-a']; ?>>
					<!--
					<div class="uk-container uk-container-center">
						<section class="<?php //echo $classes['grid.top-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
					-->
							<?php echo $this['widgets']->render('top-a', array('layout'=>$this['config']->get('grid.top-a.layout'))); ?>
					<!--
						</section>
					</div>
					-->
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('top-b')) : ?>
				<div id="tm-top-b" class="tm-block-top-b uk-block <?php echo $classes['block.top-b']; ?>" <?php echo $styles['block.top-b']; ?>>
					<div class="uk-container uk-container-center">
						<section class="<?php echo $classes['grid.top-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
							<?php echo $this['widgets']->render('top-b', array('layout'=>$this['config']->get('grid.top-b.layout'))); ?>
						</section>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('top-c')) : ?>
				<div id="tm-top-c" class="tm-block-top-c uk-block <?php echo $classes['block.top-c']; ?>" <?php echo $styles['block.top-c']; ?>>
					<div class="uk-container uk-container-center">
						<section class="<?php echo $classes['grid.top-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
							<?php echo $this['widgets']->render('top-c', array('layout'=>$this['config']->get('grid.top-c.layout'))); ?>
						</section>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('top-banner-recicla')) : ?>
				<div class="top-banner-recicla" id="top-banner-recicla">
					<div class="uk-container uk-container-center">
						<?php echo $this['widgets']->render('top-banner-recicla'); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('top-d')) : ?>
				<div id="tm-top-d" class="tm-block-top-d uk-block <?php echo $classes['block.top-d']; ?>" <?php echo $styles['block.top-d']; ?>>
					<div class="uk-container uk-container-center">
						<section class="<?php echo $classes['grid.top-d']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
							<?php echo $this['widgets']->render('top-d', array('layout'=>$this['config']->get('grid.top-d.layout'))); ?>
						</section>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
				<?php if(@$page_var2 != NULL && @$page_var2 == "tutorial-interno" && ((@$pieces[3] == NULL && @$pieces[4] == NULL) || (@$pieces[3] != NULL && @$pieces[4] != NULL))): ?>
					<div id="tm-main" class="tm-block-main uk-block <?php echo $classes['block.main']; ?>" <?php echo $styles['block.main']; ?>>
						<div class="uk-container uk-container-center">
							<div class="tm-middle uk-grid" data-uk-grid-match data-uk-grid-margin>
								<?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
									<div class="<?php echo $classes['layout.main'] ?>">
										<?php if ($this['widgets']->count('main-top')) : ?>
											<section id="tm-main-top" class="tm-main-top <?php echo $classes['grid.main-top']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
												<?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?>
											</section>	
										<?php endif; ?>

										<?php if ($this['config']->get('system_output', true)) : ?>
											<main id="tm-content" class="tm-content">
												<?php if ($this['widgets']->count('breadcrumbs')) : ?>
													<?php echo $this['widgets']->render('breadcrumbs'); ?>
												<?php endif; ?>
					
												<?php echo $this['template']->render('content'); ?>
											</main>
										<?php endif; ?>

										<?php if ($this['widgets']->count('main-bottom')) : ?>
											<section id="tm-main-bottom" class="tm-main-bottom <?php echo $classes['grid.main-bottom']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
												<?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?>
											</section>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<?php foreach($sidebars as $name => $sidebar) : ?>
									<aside class="<?php echo $classes["layout.$name"] ?>"><?php echo $this['widgets']->render($name) ?></aside>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				<?php elseif(@$page_var2 == ("forum-reparo" || "post-recentes")): ?>
					<div id="tm-main" class="tm-block-main uk-block <?php echo $classes['block.main']; ?>" <?php echo $styles['block.main']; ?>>

						<div class="uk-container uk-container-center">

							<div class="tm-middle uk-grid" data-uk-grid-match data-uk-grid-margin>

								<?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
								<div class="<?php echo $classes['layout.main'] ?>">

									<?php if ($this['widgets']->count('main-top')) : ?>
									<section id="tm-main-top" class="tm-main-top <?php echo $classes['grid.main-top']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
										<?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?>
									</section>
									<?php endif; ?>

									<?php if ($this['config']->get('system_output', true)) : ?>
									<main id="tm-content" class="tm-content">

										<?php if ($this['widgets']->count('breadcrumbs')) : ?>
										<?php echo $this['widgets']->render('breadcrumbs'); ?>
										<?php endif; ?>

										<?php echo $this['template']->render('content'); ?>

									</main>
									<?php endif; ?>

									<?php if ($this['widgets']->count('main-bottom')) : ?>
									<section id="tm-main-bottom" class="tm-main-bottom <?php echo $classes['grid.main-bottom']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
										<?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?>
									</section>
									<?php endif; ?>

								</div>
								<?php endif; ?>

								<?php foreach($sidebars as $name => $sidebar) : ?>
								<aside class="<?php echo $classes["layout.$name"] ?>"><?php echo $this['widgets']->render($name) ?></aside>
								<?php endforeach ?>

							</div>

						</div>

					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ($this['widgets']->count('top-e')) : ?>
				<div id="top-e" class="top-e">
					<div class="uk-container uk-container-center">
						
							
						<?php echo $this['widgets']->render('top-e'); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('top-f')) : ?>
				<div id="top-f" class="top-f">
					<div class="uk-container uk-container-center">
						<?php if ($this['widgets']->count('new-status-f')) : ?>
							<div class="new-status-f" id="new-status-f">
								
								<div data-uk-grid-margin="" class="uk-grid hgfh uk-grid-medium uk-grid-divider"  data-uk-scrollspy="{cls:'uk-animation-fade', delay:900}">
									<?php echo $this['widgets']->render('new-status-f',array('layout'=>$this['config']->get('grid.new-status.layout'))); ?>
								</div>

							</div>
						<?php endif; ?>
						<?php echo $this['widgets']->render('top-f'); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('top-h')) : ?>
				<div id="top-h" class="top-h">
					<div class="uk-container uk-container-center">
						<?php echo $this['widgets']->render('top-h'); ?>
					</div>
				</div>
			<?php endif; ?>
		</section>

		<?php if ($this['widgets']->count('bottom-a')) : ?>
			<div id="tm-bottom-a" class="tm-block-bottom-a uk-block <?php echo $classes['block.bottom-a']; ?>" <?php echo $styles['block.bottom-a']; ?>>
				<div class="uk-container uk-container-center">
					<section class="<?php echo $classes['grid.bottom-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
						<?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?>
					</section>
				</div>
			</div>
		<?php endif; ?>

		<a href="/recicla" title="Recicla" id="banner_recicla" target="_blank"></a>
		
		<?php if ($this['widgets']->count('bottom-b')) : ?>
			<!--
			<div id="tm-bottom-b" class="tm-block-bottom-b uk-block <?php //echo $classes['block.bottom-b']; ?>" <?php //echo $styles['block.bottom-b']; ?>>
				<div class="uk-container uk-container-center">
					<section class="<?php //echo $classes['grid.bottom-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
						<?php //echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?>
					</section>
				</div>
			</div>
			-->
		<?php endif; ?>

		<?php if ($this['widgets']->count('bottom-c')) : ?>
			<div id="tm-bottom-c" class="tm-block-bottom-c uk-block <?php echo $classes['block.bottom-c']; ?>" <?php echo $styles['block.bottom-c']; ?>>
				<div class="uk-container uk-container-center">
					<section class="<?php echo $classes['grid.bottom-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
						<?php echo $this['widgets']->render('bottom-c', array('layout'=>$this['config']->get('grid.bottom-c.layout'))); ?>
					</section>
				</div>
			</div>
		<?php endif; ?>
		
		<section id="social_media">
			<div>
				<ul>
					<li>
						<a href="#" class="uk-icon-hover uk-icon-facebook uk-icon-small"></a>
					</li>
					<li>
						<a href="#" class="uk-icon-hover uk-icon-twitter uk-icon-small"></a>
					</li>
					<li>
						<a href="#" class="uk-icon-hover uk-icon-linkedin uk-icon-small"></a>
					</li>
					<li>
						<a href="#" class="uk-icon-hover uk-icon-instagram uk-icon-small"></a>
					</li>
				</ul>
			</div>
		</section>

		<?php if ($this['widgets']->count('bottom-d')) : ?>
			<!--
			<div id="tm-bottom-d" class="tm-block-bottom-d uk-block <?php //echo $classes['block.bottom-d']; ?>" <?php //echo $styles['block.bottom-d']; ?>>
				<div class="uk-container uk-container-center">
					<section class="<?php //echo $classes['grid.bottom-d']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
						<?php //echo $this['widgets']->render('bottom-d', array('layout'=>$this['config']->get('grid.bottom-d.layout'))); ?>
					</section>
				</div>
			</div>
			-->
		<?php endif; ?>

		<?php if ($this['widgets']->count('bottom-e')) : ?>
			<div id="tm-bottom-e" class="rodape_mapasite uk-block <?php echo $classes['block.bottom-e']; ?>" <?php echo $styles['block.bottom-e']; ?>>
				<div class="uk-container uk-container-center">
					<!--
					<section class="<?php //echo $classes['grid.bottom-e']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
					-->
						<?php echo $this['widgets']->render('bottom-e', array('layout'=>$this['config']->get('grid.bottom-e.layout'))); ?>
					<!--
					</section>
					-->
				</div>
				<span class="line_bottom"></span>
			</div>
		<?php endif; ?>

		<section id="sub_menu_footer">
			<nav>
				<ul>
					<li>Acesse:</li>
					<li>|</li>
					<li>
						<a href="/politica-de-privacidade" title="">Política de Privacidade</a>
					</li>
					<li>|</li>
					<li>
						<a href="/como-anunciar" title="">Como anunciar</a>
					</li>
					<li>|</li>
					<li>
						<a href="#" title="">Suporte</a>
					</li>
				</ul>

				<br/>

				<p>Reparo sem Lagrima © 2016</p>
			</nav>
		</section>

		<!--
		<div id="tm-footer" class="tm-block-footer">
			<div class="uk-container uk-container-center">

				<?php //if ($this['widgets']->count('footer + debug') || $this['config']->get('warp_branding', true) || $this['config']->get('totop_scroller', true)) : ?>
					<footer class="tm-footer tm-link-muted">
						<?php //if ($this['config']->get('totop_scroller', true)) : ?>
							<!-- <a id="tm-anchor-bottom" class="tm-totop-scroller" data-uk-smooth-scroll href="#"></a> -->
						<!--<?php //endif; ?>

						<?php
							//echo $this['widgets']->render('footer');
							//$this->output('warp_branding');
							//echo $this['widgets']->render('debug');
						?>
					</footer>
				<?php //endif; ?>
			</div>
		</div>
		->

		<?php //if ($this['widgets']->count('search')) : ?>
			<div class="tm-search uk-hidden-small">
				<?php //echo $this['widgets']->render('search'); ?>
			</div>
		<?php //endif; ?>

		<?php //if ($this['widgets']->count('modal')) : ?>
			<div>
				<?php //echo $this['widgets']->render('modal'); ?>
			</div>
		<?php //endif; ?>

		<?php //if ($this['widgets']->count('offcanvas')) : ?>
			<div id="offcanvas" class="uk-offcanvas">
				<div class="uk-offcanvas-bar"><?php //echo $this['widgets']->render('offcanvas'); ?></div>
			</div>
		<?php //endif; ?>

		<?php //echo $this->render('footer'); ?>
	</body>
</html>
