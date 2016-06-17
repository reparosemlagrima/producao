<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2015 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if(!isset($_GET["view"]) && isset($_REQUEST["view"]))
$_GET["view"]=$_REQUEST["view"];
if(!isset($_GET["route"]) && isset($_REQUEST["route"]))
$_GET["route"]=$_REQUEST["route"];
if(!isset($_GET["Itemid"]) && isset($_REQUEST["Itemid"]))
$_GET["Itemid"]=$_REQUEST["Itemid"];

if(!isset($_GET["route"]) && isset($_GET["view"])){
	if(isset($_GET["Itemid"])){
		$cur_menu = JFactory::getApplication()->getMenu();
		$cur_params = $cur_menu->getParams($_GET["Itemid"]);		
	}
	if($_GET["view"]=="home")
		$_GET["route"]="common/home";
	elseif($_GET["view"]=="account")
		$_GET["route"]="account/account";
	elseif($_GET["view"]=="cart")
		$_GET["route"]="checkout/cart";
	elseif($_GET["view"]=="checkout")
		$_GET["route"]="checkout/checkout";
	elseif($_GET["view"]=="wishlist")
		$_GET["route"]="account/wishlist";
	elseif($_GET["view"]=="contact")
		$_GET["route"]="information/contact";
	elseif($_GET["view"]=="products" && isset($_GET["Itemid"]) && isset($cur_params)){
		$_GET["product_id"]=$cur_params->get('product_id');
		$_GET["route"]="product/product";
	}
	elseif($_GET["view"]=="categories" && isset($_GET["Itemid"]) && isset($cur_params)){
		$_GET["path"]=$cur_params->get('category_path');
		$_GET["route"]='product/category';
	}
	elseif($_GET["view"]=="manufacturers" && isset($_GET["Itemid"]) && isset($cur_params)){
		$_GET["manufacturer_id"]=$cur_params->get('manufacturer_id');
		$_GET["route"]='product/manufacturer/info';
	}
	elseif($_GET["view"]=="information" && isset($_GET["Itemid"]) && isset($cur_params)){
		$_GET["information_id"]=$cur_params->get('information_id');
		$_GET["route"]='information/information';
	}
	elseif($_GET["view"]=="others" && isset($_GET["Itemid"]) && isset($cur_params)){
		if(strstr($cur_params->get('route'),"&")){
			$pairs = explode('&', "route=".$cur_params->get('route'));
			foreach($pairs as $pair) {
				list($name, $value) = explode('=', $pair, 2);
				$_GET[$name] = $value;
			}			
		}
		else
		$_GET["route"]=$cur_params->get('route');
	}
}
if(isset($_REQUEST["route"]) && $_REQUEST["route"]=="common/login")
$_GET["view"]="admin";
if((isset($_GET["view"]) && $_GET["view"]=="admin" ) || (isset($_GET["token"]) && isset($_SESSION["show_admin"]))){	
	// start admin panel for frontend
	if(version_compare(JVERSION, '1.6.0', '<' ) != 1){
		// Access check. for joomla 1.6
		if (!JFactory::getUser()->authorise('core.manage', 'com_jcart'))
		{
			return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
	}
	if(!defined("ITEM_ID")){
		if(defined("ITEMID"))
			define('ITEM_ID', 'Itemid='.ITEMID.'&');
		elseif(isset($_REQUEST["Itemid"])){
			define('ITEM_ID', 'Itemid='.$_REQUEST["Itemid"].'&');
			define('ITEMID',''.$_REQUEST["Itemid"].'');
		}
		else
			define('ITEM_ID', '');
	}
	$_SESSION["show_admin"]="Yes";
	define('HTTP_SERVER', JURI::base());
	require_once(dirname(__FILE__).'/admin/config.php');	
	//echo opencart output in joomla
	global $replace_outputs_array;
	$prevcurdir=getcwd();
	ob_start();
	chdir(dirname(__FILE__).'/admin');
	require_once("index.php");	
	$replace_outputs_array["../".JCART_RELATIVE_URL."admin/"]=JCART_RELATIVE_URL."admin/";
	$replace_outputs_array["option=com_jcart"]="option=com_jcart&view=admin";
	$output = ob_get_contents();
	ob_end_clean();
	chdir($prevcurdir);
	foreach($replace_outputs_array as $key=>$value){
		$output=str_replace($key,$value,$output);
	}
	global $replace_outputs_check_array;
	
	foreach($replace_outputs_check_array as $single_array){
		if(strstr($output,$single_array["existing_var"])){
			$output=str_replace($single_array["search"],$single_array["replace"],$output);
		}
	}
	echo $output;
	if (isset($_REQUEST['tmpl'])) {
		if($_REQUEST['tmpl']=="component")
			exit();
	}
	// end admin panel for frontend
}
else{
	unset($_SESSION["show_admin"]);
	require_once(dirname(__FILE__).'/config.php');
	$prevcurdir=getcwd();
	ob_start();
	chdir(dirname(__FILE__));
	require_once("index.php");
	$output = ob_get_contents();
	ob_end_clean();
	chdir($prevcurdir);
	global $replace_output_array;
	foreach($replace_output_array as $key=>$value){
		if(defined("JCART_SITE_URL") && defined("HTTP_SERVER") && HTTP_SERVER!=JCART_SITE_URL && !defined("REDIRECT_HTTP_SERVER"))
		$value=str_replace(JCART_SITE_URL,HTTP_SERVER,$value);
		
		$output=str_replace($key,$value,$output);			
	}
	
	global $replace_output_check_array;
	foreach($replace_output_check_array as $single_array){
		if(!strstr($output,$single_array["existing_var"])){
			if(defined("JCART_SITE_URL") && defined("HTTP_SERVER") && HTTP_SERVER!=JCART_SITE_URL && !defined("REDIRECT_HTTP_SERVER"))
			$single_array["replace"]=str_replace(JCART_SITE_URL,HTTP_SERVER,$single_array["replace"]);	
		
			$output=str_replace($single_array["search"],$single_array["replace"],$output);		
		}	
	}
	
	echo $output;
	
	if (isset($_REQUEST['tmpl'])) {
		if($_REQUEST['tmpl']=="component")
			exit();
	}

}


?>