<!--

	REGRA BREADCRUMB TEMPORÁRIA - CORREÇÃO ERRO PLUGIN E CRIAÇÃO PARA PÁGINAS QUE NÃO TEM BREADCRUMB

	By Mariana Lino
-->
<?php
	$url = $_SERVER["REQUEST_URI"];
	$pieces = explode("/", $url);
	$home = "/".$pieces[1];
	$page = $home."/".$pieces[2];
	$inter = $page."/".$pieces[3];
	$page_var = $pieces[2];
	$inter_var = $pieces[3];

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
?>
<script type="text/javascript">
	var title;
	var myVar = setInterval(
		function(){
			title = document.title;
			
			if(title != ""){
				clearInterval(myVar);
			}
			document.getElementById("bc_title").innerHTML = title;
		},
		1000
	);
</script>
<?php endif; ?>

$breadcrumb = "<ul class="breadcrumb">
		<li>
			<a href="<?php echo $home; ?>"><i class="fa fa-home"></i></a>
		</li>
		<?php if(@$page_var != NULL): ?>
			<li>
				<a href="<?php echo $page; ?>"><?php echo $name_page; ?></a>
			</li>
		<?php endif; ?>
		<?php if(@$inter_var != NULL): ?>
			<li>
				<a href="<?php echo $inter; ?>" id="bc_title"></a>
			</li>
		<?php endif; ?>
	</ul>";