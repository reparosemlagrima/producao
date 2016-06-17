<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2015 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
// finding extension id
if($params->get("extension_id")=="" && isset($module_file_name) && $module_file_name!=""){
	$extension_id= basename($module_file_name, ".php");
	if(strstr($extension_id,"."))
		$extension_id = explode(".", $extension_id);
	elseif(strstr($extension_id,"_"))
		$extension_id = explode("_", $extension_id);
	if(is_array($extension_id))
		$extension_id = end($extension_id);
		
	$extension_real_id=$extension_id;
	if($extension_id=="shopping_cart")
		$extension_id="cart";
	elseif($extension_id=="categories")
		$extension_id="category";
	elseif($extension_id=="specials")
		$extension_id="special";
	elseif($extension_id=="bestsellers")
		$extension_id="bestseller";
}else{
	if($params->get("extension_id")!="")
	$extension_id = $params->get("extension_id");	
	$extension_real_id=$extension_id;
	if($extension_id=="shopping_cart")
		$extension_id="cart";
}
if(strstr($extension_id, "_multiple_columns"))
$extension_id=str_replace("_multiple_columns", "", $extension_id);
// end finding extension id
// Loading module data to mod_output variable
global $config,$module_extension_id,$registry;
$module_extension_id = $extension_id;
require_once("index_mod.php");
if(!isset($registry))
require("index_mod.php");
$load=$registry->get('load');
$template_name=$config->get('theme_default_directory');
if(file_exists("catalog/view/theme/".$template_name."/template/common/".$extension_id.".tpl")){
	$mod_output = $load->controller('common/' . $extension_id);
} else {
	$mod_db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	
	$extension_id_parts  = explode('.', $extension_id);
	if(isset($extension_id_parts[0]))
	$extension_id = $extension_id_parts[0];
	
	if(isset($extension_id_parts[1]))
	$mod_query = @$mod_db->query("SELECT * FROM " . DB_PREFIX . "module WHERE module_id = '" . (int)$extension_id_parts[1] . "' limit 1");
	else
	$mod_query = @$mod_db->query("SELECT * FROM " . DB_PREFIX . "module WHERE code = '" . $extension_id . "' limit 1");
	if ($mod_query->row)
	$mod_settings = @json_decode($mod_query->row['setting'], true);
	if(!isset($mod_settings)){
		$mod_settings = $config->get($extension_id . "_module");
		if(is_array($mod_settings))
		foreach($mod_settings as $mod_setting){
			$mod_settings = $mod_setting;
			break;
		}
	}
	if(is_array($mod_settings))
		$mod_output = @$load->controller('module/' . $extension_id, $mod_settings);
	else
		$mod_output = @$load->controller('module/' . $extension_id);	
}
// End loading module data to mod_output variable
// Formatting normal module output value to joomla module output
if(isset($mod_output) && $mod_output !=""){
	global $replace_output_array;
	foreach($replace_output_array as $key=>$value){
		$mod_output=str_replace($key,$value,$mod_output);
	}
	$exclude_modules=array("header","footer","cart");
	if(!in_array($extension_real_id,$exclude_modules)){
		global $replace_module_output_check_array;
		foreach($replace_module_output_check_array as $single_array){
			if(!strstr($mod_output,$single_array["existing_var"])){
				// exclude mulitple columns replacement for  latest,featured etc module
				if(!(strstr($single_array["search"],"col-lg-3 col-md-3") && strstr($extension_real_id, "_multiple_columns")))				
				$mod_output=str_replace($single_array["search"],$single_array["replace"],$mod_output);
			}
		}
	}
	if(isset($config) && $params->get("use_jcart_stylesheet")!="0"){		
		$document = JFactory::getDocument();		
		$document->addStyleSheet(JCART_COMPONENT_URL."catalog/view/javascript/font-awesome/css/font-awesome.min.css");
		if(!isset($_REQUEST["option"]) || $_REQUEST["option"]!="com_jcart"){		
			if(method_exists($document,'addStyleSheet'))
			$document->addStyleSheet(JCART_COMPONENT_URL.'catalog/view/theme/'.$template_name.'/stylesheet/stylesheet.css');
			if(defined("USE_CUSTOM_COLOR_TEMPLATE")&& USE_CUSTOM_COLOR_TEMPLATE=="1"){
				ob_start();	
				require_once(DIR_SYSTEM."../catalog/view/theme/default/stylesheet/stylesheet.css.php");
				$mod_css_output = ob_get_contents();
				ob_end_clean();
				if(method_exists($document,'addCustomTag') && $mod_css_output !="")
				$document->addCustomTag($mod_css_output);
			}
		}
	}
	$change_modules=array("language","currency","cart");
	if(in_array($extension_real_id,$change_modules)){
		echo '<div class="body-oc"><div class="header-oc">'.$mod_output.'</div></div>';
	}
	else
	echo '<div class="body-oc">'.$mod_output.'</div>';;
	
	if(isset($heading_title) && defined("ENABLE_JOOMLA_MODULE_TITLE") && ENABLE_JOOMLA_MODULE_TITLE=="0")
	$module->title=$heading_title;
}
else{
	echo "Enable module from jCart admin: Extensions->Modules";
}
// End formatting normal module output value to joomla module output
?>