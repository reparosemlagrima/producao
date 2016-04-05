<!--

	REGRA BREADCRUMB TEMPORÁRIA - CORREÇÃO ERRO PLUGIN E CRIAÇÃO PARA PÁGINAS QUE NÃO TEM BREADCRUMB
	PONTOS
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
			<p><?php echo $text_total; ?> <b><?php echo $total; ?></b>.</p>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td class="text-left"><?php echo $column_date_added; ?></td>
							<td class="text-left"><?php echo $column_description; ?></td>
							<td class="text-right"><?php echo $column_points; ?></td>
						</tr>
					</thead>
					<tbody>
						<?php if ($rewards) { ?>
						<?php foreach ($rewards  as $reward) { ?>
						<tr>
							<td class="text-left"><?php echo $reward['date_added']; ?></td>
							<td class="text-left"><?php if ($reward['order_id']) { ?>
								<a href="<?php echo $reward['href']; ?>"><?php echo $reward['description']; ?></a>
								<?php } else { ?>
								<?php echo $reward['description']; ?>
								<?php } ?></td>
							<td class="text-right"><?php echo $reward['points']; ?></td>
						</tr>
						<?php } ?>
						<?php } else { ?>
						<tr>
							<td class="text-center" colspan="3"><?php echo $text_empty; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
				<div class="col-sm-6 text-right"><?php echo $results; ?></div>
			</div>
			<div class="buttons clearfix">
				<div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
			</div>
			<?php echo $content_bottom; ?></div>
		<?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>