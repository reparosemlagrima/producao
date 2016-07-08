<!--

	REGRA BREADCRUMB TEMPORÁRIA - CORREÇÃO ERRO PLUGIN E CRIAÇÃO PARA PÁGINAS QUE NÃO TEM BREADCRUMB

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
				$url_page = "/loja-home/";
			break;
			case "forum-reparo":
				$name_page = "Fórum";
				$url_page = "/forum-reparo";
			break;
			case "tutorial-interno":
				$name_page = "Tutorial";
				$url_page = "/tutorial-interno";
			break;
		endswitch;
	endif;

	unset($breadcrumbs[0]);
?>

$breadcrumb = "<ul class="breadcrumb">
		<li>
			<a href="<?php echo $home; ?>"><i class="fa fa-home"></i></a>
		</li>
		<?php if(@$page_var != NULL): ?>
			<li>
				<a href="<?php echo $page; ?>"><?php echo $name_page; ?></a>
			</li>
		<?php endif; ?>
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li>
				<a href="<?php echo $breadcrumb['href']; ?>">
					<?php echo $breadcrumb['text']; ?>
				</a>
			</li>
		<?php } ?>
	</ul>";