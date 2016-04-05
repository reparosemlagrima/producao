<!--

	REGRA BREADCRUMB TEMPORÁRIA - CORREÇÃO ERRO PLUGIN E CRIAÇÃO PARA PÁGINAS QUE NÃO TEM BREADCRUMB
	EDITAR SENHA AFILIADO
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
	<div class="row"><?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left || $column_right) { ?>
		<?php $class = 'col-sm-9'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
			<h1><?php echo $heading_title; ?></h1>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				<fieldset>
					<legend><?php echo $text_password; ?></legend>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
						<div class="col-sm-10">
							<input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
							<?php if ($error_password) { ?>
							<div class="text-danger"><?php echo $error_password; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
						<div class="col-sm-10">
							<input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
							<?php if ($error_confirm) { ?>
							<div class="text-danger"><?php echo $error_confirm; ?></div>
							<?php } ?>
						</div>
					</div>
				</fieldset>
				<div class="buttons clearfix">
					<div class="pull-left"><a href="<?php echo $back; ?>" class="btn btn-default"><?php echo $button_back; ?></a></div>
					<div class="pull-right">
						<input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
					</div>
				</div>
			</form>
			<?php echo $content_bottom; ?></div>
		<?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>