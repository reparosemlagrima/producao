<!--

	REGRA BREADCRUMB TEMPORÁRIA - CORREÇÃO ERRO PLUGIN E CRIAÇÃO PARA PÁGINAS QUE NÃO TEM BREADCRUMB
	CONTA AFILIADO
	By Mariana Lino
-->
<?php
	$url = $_SERVER["REQUEST_URI"];
	$pieces = explode("/", $url);
	$home = "/".$pieces[1];
	$page = $home."/".$pieces[2];
	$page_var = $pieces[2];

	if(@$page_var != NULL):
		switch ($page_var):
			case "loja":
				$name_page = "Loja";
				$url_page = "/reparosemlagrima/loja/";
			break;
			case "forum-reparo":
				$name_page = "Fórum";
				$url_page = "/reparosemlagrima/forum-reparo";
			break;
			case "tutorial-interno":
				$name_page = "Tutorial";
				$url_page = "/reparosemlagrima/tutorial-interno";
			break;
		endswitch;
	endif;

	unset($breadcrumbs[0]);
?>

<?php echo $header; ?>
<div class="container">
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo $home; ?>">
				<i class="fa fa-home"></i>
			</a>
		</li>
		<?php if(@$page_var != NULL): ?>
			<li>
				<a href="<?php echo $page; ?>">
					<?php echo $name_page; ?>
				</a>
			</li>
		<?php endif; ?>
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li>
				<a href="<?php echo $breadcrumb['href']; ?>">
					<?php echo $breadcrumb['text']; ?>
				</a>
			</li>
		<?php } ?>
	</ul>
	<?php if ($success) { ?>
	<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
	<?php } ?>
	<div class="row"><?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left || $column_right) { ?>
		<?php $class = 'col-sm-9'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
			<h2><?php echo $text_my_account; ?></h2>
			<ul class="list-unstyled">
				<li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
				<li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
				<li><a href="<?php echo $payment; ?>"><?php echo $text_payment; ?></a></li>
			</ul>
			<h2><?php echo $text_my_tracking; ?></h2>
			<ul class="list-unstyled">
				<li><a href="<?php echo $tracking; ?>"><?php echo $text_tracking; ?></a></li>
			</ul>
			<h2><?php echo $text_my_transactions; ?></h2>
			<ul class="list-unstyled">
				<li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
			</ul>
			<?php echo $content_bottom; ?></div>
		<?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>