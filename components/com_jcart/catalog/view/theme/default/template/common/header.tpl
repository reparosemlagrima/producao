<?php global $module_extension_id; if(!isset($module_extension_id) || trim($module_extension_id)==""){?>
<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<?php $document = JFactory::getDocument();?>
<?php foreach ($links as $link) { ?>
<?php if(method_exists($document,'addCustomTag')) { ?>
		<?php $document->addCustomTag('<link href="'.$link['href'].'" rel="'.$link['rel'].'" />'); ?>
<?php } ?>		
<?php } ?>
<?php if(defined("DONT_INCLUDE_JQUERY_JCART") && DONT_INCLUDE_JQUERY_JCART!="1" && DONT_INCLUDE_JQUERY_JCART!="3"){ ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<?php } ?>
<?php if(defined("DONT_INCLUDE_JQUERY_JCART") && DONT_INCLUDE_JQUERY_JCART!="2" && DONT_INCLUDE_JQUERY_JCART!="3"){ ?>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<?php } ?>
<?php $document->addStyleSheet(JCART_COMPONENT_URL.'catalog/view/javascript/bootstrap/css/bootstrap.min.css');?>
<!--<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />-->
<?php $document->addStyleSheet(JCART_COMPONENT_URL.'catalog/view/javascript/font-awesome/css/font-awesome.min.css');?>
<!--<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
<?php $document->addStyleSheet('//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700');?>
<!--<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />-->
<?php // $document->addStyleSheet(JCART_COMPONENT_URL.'catalog/view/theme/default/stylesheet/stylesheet.css');?>
<!--<link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">-->
<?php foreach ($styles as $style) { ?>
<?php $document->addStyleSheet(JCART_COMPONENT_URL.$style['href']);?>
<!--<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />-->
<?php } ?>
<?php if(defined("USE_JQUERY_DOLLAR_JCART") && USE_JQUERY_DOLLAR_JCART=="1"){ ?>
<script type="text/javascript">$=jQuery.noConflict();</script>
<?php } else { ?>
<script type="text/javascript">jQuery.noConflict();</script>
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php if(defined("SHOW_LOGO_HEADER_JCART") && SHOW_LOGO_HEADER_JCART == "0" && $logo) { $logo = ''; } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
<!--</head> -->
<!--<body>-->
<?php } ?>
<div class="body-oc">
<?php if(DONT_SHOW_HEADER_JCART!="2" || (isset($module_extension_id) && $module_extension_id!="")){?>
<nav id="top">
<input type="hidden" name="item_param_id" value="<?php echo str_replace("&","&amp;",ITEM_ID); ?>" />
<input type="hidden" name="http_serv" value="<?php echo HTTP_SERVER; ?>" />
	<div class="container" <?php if(DONT_SHOW_HEADER_JCART=="1" && (!isset($module_extension_id) || trim($module_extension_id)=="")){?> style="display:none;" <?php }?>>
		<?php echo $currency; ?>
		<?php echo $language; ?>
		<div id="top-links" class="nav pull-right">
			<ul class="list-inline">
				<li><a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i></a> <span class="hidden-xs hidden-sm hidden-md"><?php echo $telephone; ?></span></li>
		<?php if(defined("DONT_INCLUDE_JQUERY_JCART") && (DONT_INCLUDE_JQUERY_JCART=="2" || DONT_INCLUDE_JQUERY_JCART=="3")){ ?>
		<li class="dropdown"><a href="#" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> <span class="fa fa-caret-down"></span></a>
		<?php } else { ?>
				<li class="dropdown"><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> <span class="fa fa-caret-down"></span></a>
		<?php } ?>
					<ul class="dropdown-menu dropdown-menu-right">
						<?php if ($logged) { ?>
						<li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
						<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
						<li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
						<li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
						<li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
						<?php } else { ?>
						<li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
						<li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
						<?php } ?>
					</ul>
				</li>
				<li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_wishlist; ?></span></a></li>
				<li><a href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_shopping_cart; ?></span></a></li>
				<li><a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_checkout; ?></span></a></li>
			</ul>
		</div>
	</div>
</nav>
<header>
	<div class="container" <?php if(DONT_SHOW_HEADER_JCART=="1" && (!isset($module_extension_id) || trim($module_extension_id)=="")){?> style="display:none;" <?php }?>>
		<div class="row" style="display:inline-block;min-width:100%;">
		<?php if ($logo) { ?>
			<div class="col-sm-4">
		<?php } else { ?>
		 <div style="display:none;">
		<?php } ?>
				<div id="logo">
					<?php if ($logo) { ?>
					<a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
					<?php } else { ?>
					<h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
					<?php } ?>
				</div>
			</div>
		 <?php if ($logo) { ?>
			<div class="col-sm-5"><?php echo $search; ?>
		<?php } else { ?>
		<div class="col-sm-9"><?php echo $search; ?>
		<?php } ?>
			</div>
			<div class="col-sm-3"><?php echo $cart; ?></div>
		</div>
	</div>
</header>
<?php } ?>
<?php if(!isset($module_extension_id) || trim($module_extension_id)==""){?>
<?php if (DONT_SHOW_MENUS_JCART!="1" && $categories) { ?>
<div class="container" style="padding: 0 13px;">
	<nav id="menu" class="navbar">
		<div class="navbar-header"><span id="category" class="visible-xs"><?php echo $text_category; ?></span>
			<button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<?php foreach ($categories as $category) { ?>
				<?php if ($category['children']) { ?>
				<li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>
					<div class="dropdown-menu">
						<div class="dropdown-inner">
							<?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
							<ul class="list-unstyled">
								<?php foreach ($children as $child) { ?>
								<li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
								<?php } ?>
							</ul>
							<?php } ?>
						</div>
						<a href="<?php echo $category['href']; ?>" class="see-all"><?php echo $text_all; ?> <?php echo $category['name']; ?></a> </div>
				</li>
				<?php } else { ?>
				<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
				<?php } ?>
				<?php } ?>
			</ul>
		</div>
	</nav>
</div>
<?php } ?>
<?php } ?>