<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2015 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<style type="text/css">
<!--
#content-oc, #content-oc h1, #content-oc h2, #content-oc h3, #content-oc h4, #content-oc h5, #content-oc h6, #top-oc .btn-link:hover, #top-links a:hover, .footer-oc a:hover, .footer-oc h5, #cart .dropdown-menu, #column-left h3, #column-right h3, .alert {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
}

#content-oc a, #top-oc .btn-link, #top-links li, #top-links a, .footer-oc a, #cart .dropdown-menu a, .breadcrumb-oc a, .list-group a, .alert a {
	color: <?php echo "#".DEFAULT_LINK_COLOR_TEMPLATE;?>;
}

#top-oc #currency .dropdown-menu, #top-oc #language .dropdown-menu, #top-links .dropdown-menu, #menu-oc, #menu-oc .nav-oc > li.open > a, #menu-oc .dropdown-menu, .btn-primary-oc, .btn-default-oc, .btn-warning-oc, .btn-danger-oc, .btn-success-oc, .btn-info-oc, .btn-inverse-oc, .product-thumb .button-group, .product-thumb .button-group button, .list-group .active, .list-group a:hover, input.btn-primary-oc {
	color: <?php echo "#".DEFAULT_BUTTON_TEXT_COLOR_TEMPLATE;?> !important;
	background-color: <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?> !important;
	<?php if(defined("USE_GRADIENT_COLOR") && USE_GRADIENT_COLOR==1) { ?>
	background-image: linear-gradient(to bottom, <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>, <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>);
	<?php } else { ?>
	background-image: linear-gradient(to bottom, <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>, <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>);
	<?php } ?>
	border-color: <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
}
#menu-oc .btn-navbar:hover, #menu-oc .btn-navbar:focus, #menu-oc .btn-navbar:active, #menu-oc .btn-navbar.disabled, #menu-oc .btn-navbar[disabled] {
	color: <?php echo "#".DEFAULT_BUTTON_TEXT_COLOR_TEMPLATE;?> !important;
	background-color: <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?> !important;
	background-image: linear-gradient(to bottom, <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>, <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>);
}

.dropdown-menu li > a:hover, #top-oc #currency .currency-select:hover, #top-links .dropdown-menu a:hover, #menu-oc .nav-oc > li > a:hover, #menu-oc .dropdown-inner li a:hover, #menu-oc .see-all:hover, #menu-oc .see-all:focus, .btn-primary-oc:hover, .btn-default-oc:hover, .btn-warning-oc:hover, .btn-danger-oc:hover, .btn-success-oc:hover, .btn-info-oc:hover, .btn-inverse-oc:hover, .btn-primary-oc:active, .btn-default-oc:active, .btn-warning-oc:active, .btn-danger-oc:active, .btn-success-oc:active, .btn-info-oc:active, .btn-inverse-oc:active, .btn-primary-oc.active, .btn-default-oc.active, .btn-warning-oc.active, .btn-danger-oc.active, .btn-success-oc.active, .btn-info-oc.active, .btn-inverse-oc.active, .btn-primary-oc.disabled, .btn-default-oc.disabled, .btn-warning-oc.disabled, .btn-danger-oc.disabled, .btn-success-oc.disabled, .btn-info-oc.disabled, .btn-inverse-oc.disabled, .btn-primary-oc[disabled], .btn-default-oc[disabled], .btn-warning-oc[disabled], .btn-danger-oc[disabled], .btn-success-oc[disabled], .btn-info-oc[disabled], .btn-inverse-oc[disabled], .product-thumb .button-group button:hover, #cart.open > .btn, #menu-oc .btn-navbar, #top-oc .btn-link:hover, #top-oc .btn-link:active, #top-oc .btn-link.disabled, input.btn-primary-oc:hover, input.btn-primary-oc.disabled, input.btn-primary-oc[disabled], .list-group a.active:hover {
	color: <?php echo "#".DEFAULT_BUTTON_TEXT_COLOR_TEMPLATE;?> !important;
	background-color: <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?> !important;
	background-image: linear-gradient(to bottom, <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>, <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>);
	border-color: <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>;	
}

#top-oc #currency .currency-select, #top-oc #language a, #top-links .dropdown-menu a, #menu-oc .dropdown-inner a, #menu-oc .see-all, #menu-oc #category, #menu-oc .btn-navbar, #menu-oc .btn-navbar:hover, #menu-oc .btn-navbar:focus, #menu-oc .btn-navbar:active, #menu-oc .btn-navbar.disabled, #menu-oc .btn-navbar[disabled], #menu-oc .nav-oc > li > a {
	color: <?php echo "#".DEFAULT_BUTTON_TEXT_COLOR_TEMPLATE;?>;
}

#menu-oc .nav-oc > li > a {
	text-shadow: 0 -1px 0 <?php echo "#".DEFAULT_LINK_COLOR_TEMPLATE;?>;
	
}

#menu-oc .see-all {
	border-top: 1px solid <?php echo "#".DEFAULT_BUTTON_TEXT_COLOR_TEMPLATE;?>;	
}
.product-thumb {
	border-color: <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
}
@media (max-width: 767px) {
	#menu-oc div.dropdown-menu, #menu-oc .nav-oc > li.open > a {
		background-color: <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?> !important;
		background-image: linear-gradient(to bottom, <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>, <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>);
		border-color: <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>;
	}
	#menu-oc .dropdown-inner li a:hover, #menu-oc .see-all:hover {
		background-color: <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?> !important;
		background-image: linear-gradient(to bottom, <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>, <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>);
		border-color: <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	}
}

-->
</style>