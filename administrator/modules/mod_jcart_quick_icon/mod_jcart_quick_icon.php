<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$class_code='class="oc_icon"';
?>
<style type="text/css">
.oc_admin_quickicons_cpanel.grid:after {
   	visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}
* html .oc_admin_quickicons_cpanel.grid             { zoom: 1; } /* IE6 */
*:first-child+html .oc_admin_quickicons_cpanel.grid { zoom: 1; } /* IE7 */
.oc_admin_quickicons_cpanel div.oc_icon {
    float: left;
    margin-bottom: 15px;
    margin-right: 15px;
    text-align: center;
}
.oc_admin_quickicons_cpanel div.oc_icon a {
    background-color: #FFFFFF;
    background-position: -30px center;
    border: 1px solid #CCCCCC;
    border-radius: 5px 5px 5px 5px;
    color: #565656;
    display: block;
    float: left;
    height: 97px;
    text-decoration: none;
    transition-duration: 0.8s;
    transition-property: background-position, -moz-border-radius-bottomleft, -moz-box-shadow;
    vertical-align: middle;
    width: 108px;
}
.oc_admin_quickicons_cpanel div.oc_icon a:hover,
.oc_admin_quickicons_cpanel div.oc_icon a:focus,
.oc_admin_quickicons_cpanel div.oc_icon a:active,
.oc_admin_quickicons_cpanel div.oc_icon a:hover,
.oc_admin_quickicons_cpanel div.oc_icon a:focus,
.oc_admin_quickicons_cpanel div.oc_icon a:active {
	background-position: 0;
	-webkit-border-bottom-left-radius: 50% 20px;
	-moz-border-radius-bottomleft: 50% 20px;
	border-bottom-left-radius: 50% 20px;
	-webkit-box-shadow: -5px 10px 15px rgba(0, 0, 0, 0.25);
	-moz-box-shadow: -5px 10px 15px rgba(0, 0, 0, 0.25);
	box-shadow: -5px 10px 15px rgba(0, 0, 0, 0.25);
	position: relative;
	z-index: 10;
}
div.oc_icon img {
    margin: 0 auto;
    padding: 10px 0;
}
div.oc_icon span {
    display: block;
    text-align: center;
		font-size: 11px;
}
.oc_inline {display:inline-block;}
</style>
<div class="cpanel oc_admin_quickicons_cpanel grid">
	<div <?php echo $class_code;?>>
		<div class="icon"><a href="index.php?option=com_jcart"> <img src="modules/mod_jcart_quick_icon/images/icon-48-dashboard.png" border="0" alt="" /><span><?php echo JText::_("Dashboard");?></span> </a></div>
	</div>
	<div <?php echo $class_code;?>>
		<div class="icon"><a href="index.php?option=com_jcart&amp;route=catalog/category"> <img src="modules/mod_jcart_quick_icon/images/icon-48-category.png" border="0" alt="" /><span><?php echo JText::_("Categories");?></span> </a></div>
	</div>
	<div <?php echo $class_code;?>>
		<div class="icon"><a href="index.php?option=com_jcart&amp;route=catalog/product"> <img src="modules/mod_jcart_quick_icon/images/icon-48-product.png" border="0" alt="" /><span><?php echo JText::_("Products");?></span> </a></div>
	</div>
	<div <?php echo $class_code;?>>
		<div class="icon"><a href="index.php?option=com_jcart&amp;route=extension/module"> <img src="modules/mod_jcart_quick_icon/images/icon-48-modules.png" border="0" alt="" /><span><?php echo JText::_("Modules");?></span> </a></div>
	</div>
	<div <?php echo $class_code;?>>
	<div class="icon"><a href="index.php?option=com_jcart&amp;route=sale/order"> <img src="modules/mod_jcart_quick_icon/images/icon-48-orders.png" border="0" alt="" /><span><?php echo JText::_("Orders");?></span> </a></div>
	</div>
	<div <?php echo $class_code;?>>
	<div class="icon"><a href="index.php?option=com_jcart&amp;route=sale/customer"> <img src="modules/mod_jcart_quick_icon/images/icon-48-user.png" border="0" alt="" /><span><?php echo JText::_("Customers");?></span> </a></div>
	</div>
	<div <?php echo $class_code;?>>
		<div class="icon"><a href="index.php?option=com_jcart&amp;route=setting/store"> <img src="modules/mod_jcart_quick_icon/images/icon-48-config.png" border="0" alt="" /><span><?php echo JText::_("Settings");?></span> </a></div>
	</div>
</div>