<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2015 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//Uncomment and change as required the following settings if you need custom settings for multistore or connect to another opencart installation etc.

//define('USE_JOOMLA_BUTTONS','0');
//define('DONT_SHOW_HEADER_JCART','0');
//define('DONT_SHOW_FOOTER_JCART','0');
//define('DONT_SHOW_MENUS_JCART','1');
//define('SHOP_SEO_KEY','shop'); // don't change it,if you change it then you need to change shop keyword in .httaccess file also
//define('ITEMID','');
//define('MAIN_HTTP_SERVER', '');
//define('USE_MANUAL_DB', '0');
//define('DB_DRIVER', 'mysql');
//define('DB_HOSTNAME', '');
//define('DB_USERNAME', '');
//define('DB_PASSWORD', '');
//define('DB_DATABASE', '');
//define('DB_PREFIX', 'oc_');
//define('DB_PORT', '3306');
//define('SHOW_LOGO_HEADER_JCART','0');
//define('USE_OC_TEMPLATE_WITHOUT_JOOMLA', '0');

define('JCART_SITE_URL', JURI::base());
define('JCART_SITE_HTTPS_URL', str_replace("http://", "https://", JCART_SITE_URL));
define('JCART_COMPONENT_URL',JCART_SITE_URL.'components/com_jcart/');
define('JCART_RELATIVE_URL',str_replace(JCART_SITE_URL,'',JCART_COMPONENT_URL));
define('JCART_COMPONENT_DIR',JPATH_SITE.'/components/com_jcart/');

$j_config=new JConfig();
$mycom_params =  JComponentHelper::getParams('com_jcart');
//start get params
$shop_seo_key="";
$item_id="";
$use_joomla_button="";
$dont_show_header_jcart="";
$dont_show_footer_jcart="";
$dont_show_menus_jcart="";
$dont_include_jquery_library="";
$use_jquery_dollar_variable="";
$enable_joomla_module_title="";
$dont_show_left_right_column="";
$main_http_server="";
$redirect_to_main_http_server="";
$change_lang_to_joomla_default="";
$use_joomla_db="1";
$db_user_name="";
$db_user_password="";
$db_user_host="";
$db_jcart_name="";
$db_user_prefix="";
$show_logo_header="";
$use_oc_template="";
$use_custom_color="";
$default_txt_color="";
$default_link_color="";
$default_button_box_color="";
$default_button_hover_color="";
$default_button_text_color="";
$use_gradient_color="";


if(version_compare(JVERSION, '1.6.0', '<' ) == 1){
	if($mycom_params->get('shopSeoKey')!=""){
		$shop_seo_key=$mycom_params->get('shopSeoKey');
	}
	if($mycom_params->get('itemID')!=""){
		$item_id=$mycom_params->get('itemID');
	}
	if($mycom_params->get('useJoomlaButton')!=""){
		$use_joomla_button=$mycom_params->get('useJoomlaButton');
	}
	if($mycom_params->get('dontShowHeaderjCart')!=""){
		$dont_show_header_jcart=$mycom_params->get('dontShowHeaderjCart');
	}
	if($mycom_params->get('dontShowFooterjCart')!=""){
		$dont_show_footer_jcart=$mycom_params->get('dontShowFooterjCart');
	}
	if($mycom_params->get('dontShowMenusjCart')!=""){
		$dont_show_menus_jcart=$mycom_params->get('dontShowMenusjCart');
	}
	if($mycom_params->get('enableJoomlaModuleTitle')!=""){
		$enable_joomla_module_title=$mycom_params->get('enableJoomlaModuleTitle');
	}
	if($mycom_params->get('dontIncludejQueryLibrary')!=""){
		$dont_include_jquery_library=$mycom_params->get('dontIncludejQueryLibrary');
	}
	if($mycom_params->get('usejQueryDollarVariable')!=""){
		$use_jquery_dollar_variable=$mycom_params->get('usejQueryDollarVariable');
	}
	if($mycom_params->get('dontShowLeftRightColumn')!=""){
		$dont_show_left_right_column=$mycom_params->get('dontShowLeftRightColumn');
	}
	if($mycom_params->get('mainHttpServer')!=""){
		$main_http_server=$mycom_params->get('mainHttpServer');
	}
	if($mycom_params->get('redirectToMainHttpServer')!=""){
		$redirect_to_main_http_server=$mycom_params->get('redirectToMainHttpServer');
	}
	if($mycom_params->get('changeLangToJoomlaDefault')!=""){
		$change_lang_to_joomla_default=$mycom_params->get('changeLangToJoomlaDefault');
	}
	if($mycom_params->get('useJoomlaDB')!=""){
		$use_joomla_db=$mycom_params->get('useJoomlaDB');
	}
	if($mycom_params->get('dbuserName')!=""){
		$db_user_name=$mycom_params->get('dbuserName');
	}
	if($mycom_params->get('dbuserPassword')!=""){
		$db_user_password=$mycom_params->get('dbuserPassword');
	}
	if($mycom_params->get('dbuserHost')!=""){
		$db_user_host=$mycom_params->get('dbuserHost');
	}
	if($mycom_params->get('dbName')!=""){
		$db_jcart_name=$mycom_params->get('dbName');
	}
	if($mycom_params->get('dbuserPrefix')!=""){
		$db_user_prefix=$mycom_params->get('dbuserPrefix');
	}
	if($mycom_params->get('showLogoHeader')!=""){
		$show_logo_header=$mycom_params->get('showLogoHeader');
	}
	if($mycom_params->get('useOcTemplate')!=""){
		$use_oc_template=$mycom_params->get('useOcTemplate');
	}
	if($mycom_params->get('useCustomColor')!=""){
		$use_custom_color=$mycom_params->get('useCustomColor');
	}
	if($mycom_params->get('defaultTxtColor')!=""){
		$default_txt_color=$mycom_params->get('defaultTxtColor');
	}
	if($mycom_params->get('defaultLinkColor')!=""){
		$default_link_color=$mycom_params->get('defaultLinkColor');
	}
	if($mycom_params->get('defaultButtonBoxColor')!=""){
		$default_button_box_color=$mycom_params->get('defaultButtonBoxColor');
	}
	if($mycom_params->get('defaultButtonHoverColor')!=""){
		$default_button_hover_color=$mycom_params->get('defaultButtonHoverColor');
	}
	if($mycom_params->get('defaultButtonTextColor')!=""){
		$default_button_text_color=$mycom_params->get('defaultButtonTextColor');
	}	
	if($mycom_params->get('useGradientColor')!=""){
		$use_gradient_color=$mycom_params->get('useGradientColor');
	}
}
else{
	if($mycom_params->get('params.shopSeoKey')!=""){
		$shop_seo_key=$mycom_params->get('params.shopSeoKey');
	}
	if($mycom_params->get('params.itemID')!=""){
		$item_id=$mycom_params->get('params.itemID');
	}
	if($mycom_params->get('params.useJoomlaButton')!=""){
		$use_joomla_button=$mycom_params->get('params.useJoomlaButton');
	}
	if($mycom_params->get('params.dontShowHeaderjCart')!=""){
		$dont_show_header_jcart=$mycom_params->get('params.dontShowHeaderjCart');
	}
	if($mycom_params->get('params.dontShowFooterjCart')!=""){
		$dont_show_footer_jcart=$mycom_params->get('params.dontShowFooterjCart');
	}
	if($mycom_params->get('params.dontShowMenusjCart')!=""){
		$dont_show_menus_jcart=$mycom_params->get('params.dontShowMenusjCart');
	}
	if($mycom_params->get('params.dontIncludejQueryLibrary')!=""){
		$dont_include_jquery_library=$mycom_params->get('params.dontIncludejQueryLibrary');
	}
	if($mycom_params->get('params.usejQueryDollarVariable')!=""){
		$use_jquery_dollar_variable=$mycom_params->get('params.usejQueryDollarVariable');
	}
	if($mycom_params->get('params.enableJoomlaModuleTitle')!=""){
		$enable_joomla_module_title=$mycom_params->get('params.enableJoomlaModuleTitle');
	}
	if($mycom_params->get('params.dontShowLeftRightColumn')!=""){
		$dont_show_left_right_column=$mycom_params->get('params.dontShowLeftRightColumn');
	}
	if($mycom_params->get('params.mainHttpServer')!=""){
		$main_http_server=$mycom_params->get('params.mainHttpServer');
	}
	if($mycom_params->get('params.redirectToMainHttpServer')!=""){
		$redirect_to_main_http_server=$mycom_params->get('params.redirectToMainHttpServer');
	}
	if($mycom_params->get('params.changeLangToJoomlaDefault')!=""){
		$change_lang_to_joomla_default=$mycom_params->get('params.changeLangToJoomlaDefault');
	}
	if($mycom_params->get('params.useJoomlaDB')!=""){
		$use_joomla_db=$mycom_params->get('params.useJoomlaDB');
	}
	if($mycom_params->get('params.dbuserName')!=""){
		$db_user_name=$mycom_params->get('params.dbuserName');
	}
	if($mycom_params->get('params.dbuserPassword')!=""){
		$db_user_password=$mycom_params->get('params.dbuserPassword');
	}
	if($mycom_params->get('params.dbuserHost')!=""){
		$db_user_host=$mycom_params->get('params.dbuserHost');
	}
	if($mycom_params->get('params.dbName')!=""){
		$db_jcart_name=$mycom_params->get('params.dbName');
	}
	if($mycom_params->get('params.dbuserPrefix')!=""){
		$db_user_prefix=$mycom_params->get('params.dbuserPrefix');
	}
	if($mycom_params->get('params.showLogoHeader')!=""){
		$show_logo_header=$mycom_params->get('params.showLogoHeader');
	}
	if($mycom_params->get('params.useOcTemplate')!=""){
		$use_oc_template=$mycom_params->get('params.useOcTemplate');
	}
	if($mycom_params->get('params.useCustomColor')!=""){
		$use_custom_color=$mycom_params->get('params.useCustomColor');
	}
	if($mycom_params->get('params.defaultTxtColor')!=""){
		$default_txt_color=$mycom_params->get('params.defaultTxtColor');
	}
	if($mycom_params->get('params.defaultLinkColor')!=""){
		$default_link_color=$mycom_params->get('params.defaultLinkColor');
	}
	if($mycom_params->get('params.defaultButtonBoxColor')!=""){
		$default_button_box_color=$mycom_params->get('params.defaultButtonBoxColor');
	}
	if($mycom_params->get('params.defaultButtonHoverColor')!=""){
		$default_button_hover_color=$mycom_params->get('params.defaultButtonHoverColor');
	}
	if($mycom_params->get('params.defaultButtonTextColor')!=""){
		$default_button_text_color=$mycom_params->get('params.defaultButtonTextColor');
	}
	if($mycom_params->get('params.useGradientColor')!=""){
		$use_gradient_color=$mycom_params->get('params.useGradientColor');
	}

}
//end get params

// assing params to defined varialbes

if(!defined("SHOP_SEO_KEY") && $shop_seo_key!=""){
	define('SHOP_SEO_KEY', $shop_seo_key);
}
elseif(!defined("SHOP_SEO_KEY")){
	define('SHOP_SEO_KEY','shop');
}

if(!defined("ITEMID") && $item_id!=""){
	if(!is_numeric($item_id)){ // check if itemID is numeric or not
		$joomla_lang = JFactory::getLanguage();
		$def_lang=$joomla_lang->getTag();
		$def_lang=explode("-",$def_lang);
		$def_lang=$def_lang[0];		
		if($def_lang!="" && strstr($item_id,$def_lang."=")){
			$item_id=explode($def_lang."=",$item_id);
			if(isset($item_id[1]))
			$item_id=$item_id[1];		
			if(strstr($item_id,",")){
				$item_id=explode(",",$item_id);
				if(isset($item_id[0]))
				$item_id=$item_id[0];
			}			
		}
	} // end check numeric
	if(is_numeric($item_id) && !defined("ITEMID"))
	define('ITEMID', $item_id);
}

if(!defined("USE_JOOMLA_BUTTONS") && $use_joomla_button!=""){
	define('USE_JOOMLA_BUTTONS', $use_joomla_button);
}
elseif(!defined("USE_JOOMLA_BUTTONS")){
	define('USE_JOOMLA_BUTTONS', "0");
}

if(!defined("DONT_SHOW_HEADER_JCART") && $dont_show_header_jcart!=""){
	define('DONT_SHOW_HEADER_JCART', $dont_show_header_jcart);
}
elseif(!defined("DONT_SHOW_HEADER_JCART")){
	define('DONT_SHOW_HEADER_JCART', "0");
}

if(!defined("DONT_SHOW_FOOTER_JCART") && $dont_show_footer_jcart!=""){
	define('DONT_SHOW_FOOTER_JCART', $dont_show_footer_jcart);
}
elseif(!defined("DONT_SHOW_FOOTER_JCART")){
	define('DONT_SHOW_FOOTER_JCART', "0");
}

if(!defined("DONT_SHOW_MENUS_JCART") && $dont_show_menus_jcart!=""){
	define('DONT_SHOW_MENUS_JCART', $dont_show_menus_jcart);
}
elseif(!defined("DONT_SHOW_MENUS_JCART")){
	define('DONT_SHOW_MENUS_JCART', "1");
}

if(!defined("DONT_INCLUDE_JQUERY_JCART") && $dont_include_jquery_library!=""){
	define('DONT_INCLUDE_JQUERY_JCART', $dont_include_jquery_library);
}
elseif(!defined("DONT_INCLUDE_JQUERY_JCART")){
	define('DONT_INCLUDE_JQUERY_JCART', "0");
}

if(!defined("USE_JQUERY_DOLLAR_JCART") && $use_jquery_dollar_variable!=""){
	define('USE_JQUERY_DOLLAR_JCART', $use_jquery_dollar_variable);
}
elseif(!defined("USE_JQUERY_DOLLAR_JCART")){
	define('USE_JQUERY_DOLLAR_JCART', "1");
}

if(!defined("ENABLE_JOOMLA_MODULE_TITLE") && $enable_joomla_module_title!=""){
	define('ENABLE_JOOMLA_MODULE_TITLE', $enable_joomla_module_title);
}
elseif(!defined("ENABLE_JOOMLA_MODULE_TITLE")){
	define('ENABLE_JOOMLA_MODULE_TITLE', "1");
}

if(!defined("DONT_SHOW_LEFTRIGHT_COLUMN") && $dont_show_left_right_column!=""){
	define('DONT_SHOW_LEFTRIGHT_COLUMN', $dont_show_left_right_column);
}
elseif(!defined("DONT_SHOW_LEFTRIGHT_COLUMN")){
	define('DONT_SHOW_LEFTRIGHT_COLUMN', "1");
}

if(!defined("MAIN_HTTP_SERVER") && $main_http_server!=""){
	define('MAIN_HTTP_SERVER', $main_http_server);
}

if(!defined("CHANGE_JCART_LANG_TO_DEFAULT") && $change_lang_to_joomla_default!=""){
	define('CHANGE_JCART_LANG_TO_DEFAULT', $change_lang_to_joomla_default);
}
elseif(!defined("CHANGE_JCART_LANG_TO_DEFAULT")){
	define('CHANGE_JCART_LANG_TO_DEFAULT', "1");
}

if(!defined("SHOW_LOGO_HEADER_JCART") && $show_logo_header!=""){
	define('SHOW_LOGO_HEADER_JCART', $show_logo_header);
}
elseif(!defined("SHOW_LOGO_HEADER_JCART")){
	define('SHOW_LOGO_HEADER_JCART', "0");
}

if(!defined("USE_OC_TEMPLATE_WITHOUT_JOOMLA") && $use_oc_template!=""){
	define('USE_OC_TEMPLATE_WITHOUT_JOOMLA', $use_oc_template);
}
elseif(!defined("USE_OC_TEMPLATE_WITHOUT_JOOMLA")){
	define('USE_OC_TEMPLATE_WITHOUT_JOOMLA', "0");
}

if(!defined("USE_CUSTOM_COLOR_TEMPLATE") && $use_custom_color!=""){
	define('USE_CUSTOM_COLOR_TEMPLATE', $use_custom_color);
}
elseif(!defined("USE_CUSTOM_COLOR_TEMPLATE")){
	define('USE_CUSTOM_COLOR_TEMPLATE', "0");
}
if(!defined("DEFAULT_TXT_COLOR_TEMPLATE") && $default_txt_color!=""){
	define('DEFAULT_TXT_COLOR_TEMPLATE', $default_txt_color);
}
elseif(!defined("DEFAULT_TXT_COLOR_TEMPLATE")){
	define('DEFAULT_TXT_COLOR_TEMPLATE', "000000");
}
if(!defined("DEFAULT_LINK_COLOR_TEMPLATE") && $default_link_color!=""){
	define('DEFAULT_LINK_COLOR_TEMPLATE', $default_link_color);
}
elseif(!defined("DEFAULT_LINK_COLOR_TEMPLATE")){
	define('DEFAULT_LINK_COLOR_TEMPLATE', "00A7E5");
}
if(!defined("DEFAULT_BUTTONBOX_COLOR_TEMPLATE") && $default_button_box_color!=""){
	define('DEFAULT_BUTTONBOX_COLOR_TEMPLATE', $default_button_box_color);
}
elseif(!defined("DEFAULT_BUTTONBOX_COLOR_TEMPLATE")){
	define('DEFAULT_BUTTONBOX_COLOR_TEMPLATE', "00A7E5");
}
if(!defined("DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE") && $default_button_hover_color!=""){
	define('DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE', $default_button_hover_color);
}
elseif(!defined("DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE")){
	define('DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE', "267799");
}
if(!defined("DEFAULT_BUTTON_TEXT_COLOR_TEMPLATE") && $default_button_text_color!=""){
	define('DEFAULT_BUTTON_TEXT_COLOR_TEMPLATE', $default_button_text_color);
}
elseif(!defined("DEFAULT_BUTTON_TEXT_COLOR_TEMPLATE")){
	define('DEFAULT_BUTTON_TEXT_COLOR_TEMPLATE', "FFFFFF");
}
if(!defined("USE_GRADIENT_COLOR") && $use_gradient_color!=""){
	define('USE_GRADIENT_COLOR', $use_gradient_color);
}
elseif(!defined("USE_GRADIENT_COLOR")){
	define('USE_GRADIENT_COLOR', "0");
}


if($redirect_to_main_http_server!="" && $redirect_to_main_http_server=="1" && defined("MAIN_HTTP_SERVER") && !defined("HTTP_SERVER")){
	define('HTTP_SERVER', MAIN_HTTP_SERVER);
	define('HTTP_IMAGE', JCART_COMPONENT_URL.'image/');
	define('REDIRECT_HTTP_SERVER', "Yes");
}

if(!defined("USE_MANUAL_DB") && $use_joomla_db=="0"){
	define('USE_MANUAL_DB', '1');
}
elseif(!defined("USE_MANUAL_DB")){
	define('USE_MANUAL_DB', '0');
}

if(defined("USE_MANUAL_DB") && USE_MANUAL_DB=="1"){
	if(!defined("DB_DRIVER")){
		if(isset($j_config->dbtype) && $j_config->dbtype!="")
		define('DB_DRIVER', $j_config->dbtype);
		else
		define('DB_DRIVER', 'mysql');
	}
	if(!defined("DB_USERNAME"))
	define('DB_USERNAME', $db_user_name);
	if(!defined("DB_PASSWORD"))
	define('DB_PASSWORD', $db_user_password);
	if(!defined("DB_HOSTNAME"))
	define('DB_HOSTNAME', $db_user_host);
	if(!defined("DB_DATABASE"))
	define('DB_DATABASE', $db_jcart_name);
	if(!defined("DB_PREFIX"))
	define('DB_PREFIX', $db_user_prefix);
	if(!defined("DB_PORT") && ini_get("mysqli.default_port"))
	define('DB_PORT', ini_get("mysqli.default_port"));
	elseif(!defined("DB_PORT"))
	define('DB_PORT', '3306');
}
else{
	if(!defined("DB_DRIVER")){
		if(isset($j_config->dbtype) && $j_config->dbtype!="")
		define('DB_DRIVER', $j_config->dbtype);
		else
		define('DB_DRIVER', 'mysql');
	}
	if(!defined("DB_USERNAME"))
	define('DB_USERNAME', $j_config->user);
	if(!defined("DB_PASSWORD"))
	define('DB_PASSWORD', $j_config->password);
	if(!defined("DB_HOSTNAME"))
	define('DB_HOSTNAME', $j_config->host);
	if(!defined("DB_DATABASE"))
	define('DB_DATABASE', $j_config->db);
	if(!defined("DB_PREFIX"))
	define('DB_PREFIX', 'oc_');
	if(!defined("DB_PORT") && ini_get("mysqli.default_port"))
	define('DB_PORT', ini_get("mysqli.default_port"));
	elseif(!defined("DB_PORT"))
	define('DB_PORT', '3306');
}

// DIR
if(!defined("DIR_APPLICATION"))
define('DIR_APPLICATION', JCART_COMPONENT_DIR.'catalog/');

if(!defined("DIR_SYSTEM"))
define('DIR_SYSTEM', JCART_COMPONENT_DIR.'system/');

if(!defined("DIR_LANGUAGE"))
define('DIR_LANGUAGE', JCART_COMPONENT_DIR.'catalog/language/');

if(!defined("DIR_TEMPLATE") && !defined("DIR_DEFAULT_TEMPLATE"))
define('DIR_TEMPLATE', JCART_COMPONENT_DIR.'catalog/view/theme/');

if(!defined("DIR_CONFIG"))
define('DIR_CONFIG', JCART_COMPONENT_DIR.'system/config/');

if(!defined("DIR_IMAGE"))
define('DIR_IMAGE', JCART_COMPONENT_DIR.'image/');

if(!defined("DIR_CACHE"))
define('DIR_CACHE', JCART_COMPONENT_DIR.'system/storage/cache/');

if(!defined("DIR_DOWNLOAD"))
define('DIR_DOWNLOAD', JCART_COMPONENT_DIR.'system/storage/download/');

if(!defined("DIR_UPLOAD"))
define('DIR_UPLOAD', JCART_COMPONENT_DIR.'system/storage/upload/');

if(!defined("DIR_MODIFICATION"))
define('DIR_MODIFICATION', JCART_COMPONENT_DIR.'system/storage/modification/');

if(!defined("DIR_LOGS"))
define('DIR_LOGS', JCART_COMPONENT_DIR.'system/storage/logs/');

if(!defined("ITEM_ID")) {
	if(defined("ITEMID")) {
		define('ITEM_ID', 'Itemid='.ITEMID.'&');
	} elseif(isset($_REQUEST["Itemid"])) {
		define('ITEM_ID', 'Itemid='.$_REQUEST["Itemid"].'&');
		define('ITEMID',''.$_REQUEST["Itemid"].'');
	} else {
		define('ITEM_ID', '');
	}
}
if(!isset($_REQUEST["Itemid"]) && defined("ITEMID") && isset($_REQUEST["option"]) && $_REQUEST["option"]=="com_jcart")
$_REQUEST["Itemid"] = ITEMID;
global $replace_output_array;
if(defined("USE_OC_TEMPLATE_WITHOUT_JOOMLA") && USE_OC_TEMPLATE_WITHOUT_JOOMLA == "1"){
global $replace_output_array1;
$replace_output_array1=array(
			'index.php?route='=>'index.php?option=com_jcart&'.ITEM_ID.'route=',
			'index.php?option=com_jcart&route=module/manufacturer/css'=>'index.php?option=com_jcart&tmpl=component&route=module/manufacturer/css',
			'catalog/view/javascript/jquery/thickbox/thickbox-compressed.js'=>'catalog/view/javascript/jquery/thickbox/thickbox.js',
			'"catalog/'=>'"'.JCART_COMPONENT_URL.'catalog/',
			'=\"catalog'=>'=\"'.JCART_COMPONENT_URL.'catalog',
			'src="image/'=>'src="'.JCART_COMPONENT_URL.'image/',
			JCART_SITE_URL.'image/'=>JCART_COMPONENT_URL.'image/',
			JCART_SITE_HTTPS_URL.'image/'=>JCART_COMPONENT_URL.'image/',
			'\'catalog/'=>'\''.JCART_COMPONENT_URL.'catalog/',
			'$.'=>'jQuery.',
			'$('=>'jQuery(',
			'load(\'index.php?option=com_jcart&'=>'load(\'index.php?option=com_jcart&tmpl=component&',
			'load(\\\'index.php?option=com_jcart&'=>'load(\\\'index.php?option=com_jcart&tmpl=component&',
			'index.php?option=com_jcart&route=common/filemanager&token='=>'index.php?option=com_jcart&route=common/filemanager&tmpl=component&token=',
			': \'index.php?option=com_jcart&'=>': \'index.php?option=com_jcart&tmpl=component&',
			'.post(\'index.php?option=com_jcart&'=>'.post(\'index.php?option=com_jcart&tmpl=component&',
			'.get(\'index.php?option=com_jcart&'=>'.get(\'index.php?option=com_jcart&tmpl=component&',
			'index.php?option=com_jcart&tmpl=component&'=>'index.php?option=com_jcart&'.ITEM_ID.'tmpl=component&',
			'name="option"'=>'name="option_oc"',
			'name=\'option\''=>'name=\'option_oc\'',
			'name=\\\'option\\\''=>'name=\\\'option_oc\\\'',
			'name=\\"option\\"'=>'name=\\"option_oc\\"',
			'name="option['=>'name="option_oc[',
			'name="option ['=>'name="option_oc [',
			'name=\'option['=>'name=\'option_oc[',
			'name=\\\'option['=>'name=\\\'option_oc[',
			'name=\\"option['=>'name=\\"option_oc[',
			'<img src="index.php?option=com_jcart&'=>'<img src="index.php?option=com_jcart&tmpl=component&',
			'<link rel="stylesheet" type="text/css" href="index.php?option=com_jcart&'=>'<link rel="stylesheet" type="text/css" href="index.php?option=com_jcart&tmpl=component&',
			'jQuery(\'#cart_total\').html(json[\'total\']);'=>'jQuery(\'#cart_total\').html(json[\'total\']);
			jQuery(\'#module-cart .content-oc\').html(json[\'output\']);
			',
			'Powered By <a href="http://www.opencart.com">OpenCart</a>'=>'Powered By <a href="http://www.soft-php.com">jCart</a>',
			'<a class="colorbox" href="index.php?option=com_jcart&'=>'<a class="colorbox" href="index.php?option=com_jcart&tmpl=component&',
			'<a class="colorbox" href="'.JCART_SITE_URL.'index.php?option=com_jcart&'=>'<a class="colorbox" href="'.JCART_SITE_URL.'index.php?option=com_jcart&tmpl=component&',
			'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",JCART_SITE_URL).'index.php?option=com_jcart&'=>'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",JCART_SITE_URL).'index.php?option=com_jcart&tmpl=component&',
			'<img src="'.JCART_SITE_URL.'index.php?option=com_jcart&'=>'<img src="'.JCART_SITE_URL.'index.php?option=com_jcart&amp;tmpl=component&amp;',
			'url: \'index.php?option=com_jcart'=>'url: \''.JCART_SITE_URL.'index.php?option=com_jcart',
			'load(\'index.php?option=com_jcart'=>'load(\''.JCART_SITE_URL.'index.php?option=com_jcart',
			'<a class="colorbox" href="'.JCART_SITE_URL.SHOP_SEO_KEY.'/information/information/info?'=>'<a class="colorbox" href="'.JCART_SITE_URL.'index.php?option=com_jcart&tmpl=component&route=information/information/info&',
			'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",JCART_SITE_URL.SHOP_SEO_KEY.'/information/information/info?')=>'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",JCART_SITE_URL.'index.php?option=com_jcart&tmpl=component&route=information/information/info&'),
			'json[\'redirect\'];'=>'json[\'redirect\'].replace(/&amp;/g,"&");',
			'})($);'=>'})(jQuery);',
			'"admin/'=>'"'.JCART_COMPONENT_URL.'admin/',
			'src="../components/'=>'src="components/',
			''.JCART_RELATIVE_URL.JCART_RELATIVE_URL.''=>''.JCART_RELATIVE_URL.'',
			'class="form-control summernote"'=>'class="form-control mce_editable"',
			);
} 
$replace_output_array=array(
			'index.php?route='=>'index.php?option=com_jcart&'.ITEM_ID.'route=',
			'index.php?option=com_jcart&route=module/manufacturer/css'=>'index.php?option=com_jcart&tmpl=component&route=module/manufacturer/css',
			'catalog/view/javascript/jquery/thickbox/thickbox-compressed.js'=>'catalog/view/javascript/jquery/thickbox/thickbox.js',
			'"catalog/'=>'"'.JCART_COMPONENT_URL.'catalog/',
			'=\"catalog'=>'=\"'.JCART_COMPONENT_URL.'catalog',
			'src="image/'=>'src="'.JCART_COMPONENT_URL.'image/',
			JCART_SITE_URL.'image/'=>JCART_COMPONENT_URL.'image/',
			JCART_SITE_HTTPS_URL.'image/'=>JCART_COMPONENT_URL.'image/',
			'\'catalog/'=>'\''.JCART_COMPONENT_URL.'catalog/',
			'$.'=>'jQuery.',
			'$('=>'jQuery(',
			'class="button"'=>(USE_JOOMLA_BUTTONS=="1")?'class="button"':'class="button-oc"',
			'class=\"button\"'=>(USE_JOOMLA_BUTTONS=="1")?'class=\"button\"':'class=\"button-oc\"',
			'id="button"'=>(USE_JOOMLA_BUTTONS=="1")?'id="button"':'id="button-oc"',
			'id=\"button\"'=>(USE_JOOMLA_BUTTONS=="1")?'id=\"button\"':'id=\"button-oc\"',
			'class="btn btn-primary'=>(USE_JOOMLA_BUTTONS=="1")?'class="btn btn-primary':'class="btn btn-primary btn-primary-oc',
			'class=\"btn btn-primary'=>(USE_JOOMLA_BUTTONS=="1")?'class=\"btn btn-primary':'class=\"btn btn-primary btn-primary-oc',
			'class="btn btn-default'=>(USE_JOOMLA_BUTTONS=="1")?'class="btn btn-default':'class="btn btn-default btn-default-oc',
			'class=\"btn btn-default'=>(USE_JOOMLA_BUTTONS=="1")?'class=\"btn btn-default':'class=\"btn btn-default btn-default-oc',
			'class="btn btn-warning'=>(USE_JOOMLA_BUTTONS=="1")?'class="btn btn-warning':'class="btn btn-warning btn-warning-oc',
			'class=\"btn btn-warning'=>(USE_JOOMLA_BUTTONS=="1")?'class=\"btn btn-warning':'class=\"btn btn-warning btn-warning-oc',
			'class="btn btn-danger'=>(USE_JOOMLA_BUTTONS=="1")?'class="btn btn-danger':'class="btn btn-danger btn-danger-oc',
			'class=\"btn btn-danger'=>(USE_JOOMLA_BUTTONS=="1")?'class=\"btn btn-danger':'class=\"btn btn-danger btn-danger-oc',
			'class="btn btn-success'=>(USE_JOOMLA_BUTTONS=="1")?'class="btn btn-success':'class="btn btn-success btn-success-oc',
			'class=\"btn btn-success'=>(USE_JOOMLA_BUTTONS=="1")?'class=\"btn btn-success':'class=\"btn btn-success btn-success-oc',
			'class="btn btn-info'=>(USE_JOOMLA_BUTTONS=="1")?'class="btn btn-info':'class="btn btn-info btn-info-oc',
			'class=\"btn btn-info'=>(USE_JOOMLA_BUTTONS=="1")?'class=\"btn btn-info':'class=\"btn btn-info btn-info-oc',
			'class="btn btn-inverse'=>'class="btn btn-inverse btn-inverse-oc',
			'class=\"btn btn-inverse'=>'class=\"btn btn-inverse btn-inverse-oc',
			'load(\'index.php?option=com_jcart&'=>'load(\'index.php?option=com_jcart&tmpl=component&',
			'load(\\\'index.php?option=com_jcart&'=>'load(\\\'index.php?option=com_jcart&tmpl=component&',
			'index.php?option=com_jcart&route=common/filemanager&token='=>'index.php?option=com_jcart&route=common/filemanager&tmpl=component&token=',
			': \'index.php?option=com_jcart&'=>': \'index.php?option=com_jcart&tmpl=component&',
			'.post(\'index.php?option=com_jcart&'=>'.post(\'index.php?option=com_jcart&tmpl=component&',
			'.get(\'index.php?option=com_jcart&'=>'.get(\'index.php?option=com_jcart&tmpl=component&',
			'index.php?option=com_jcart&tmpl=component&'=>'index.php?option=com_jcart&'.ITEM_ID.'tmpl=component&',
			'name="option"'=>'name="option_oc"',
			'name=\'option\''=>'name=\'option_oc\'',
			'name=\\\'option\\\''=>'name=\\\'option_oc\\\'',
			'name=\\"option\\"'=>'name=\\"option_oc\\"',
			'name="option['=>'name="option_oc[',
			'name="option ['=>'name="option_oc [',
			'name=\'option['=>'name=\'option_oc[',
			'name=\\\'option['=>'name=\\\'option_oc[',
			'name=\\"option['=>'name=\\"option_oc[',
			'<img src="index.php?option=com_jcart&'=>'<img src="index.php?option=com_jcart&tmpl=component&',
			'<link rel="stylesheet" type="text/css" href="index.php?option=com_jcart&'=>'<link rel="stylesheet" type="text/css" href="index.php?option=com_jcart&tmpl=component&',
			'-x.jpg"'=>'-80x80.jpg"',
			'jQuery(\'#cart_total\').html(json[\'total\']);'=>'jQuery(\'#cart_total\').html(json[\'total\']);
			jQuery(\'#module-cart .content-oc\').html(json[\'output\']);
			',
			'Powered By <a href="http://www.opencart.com">OpenCart</a>'=>'Powered By <a href="http://www.soft-php.com">jCart</a>',
			'<a class="colorbox" href="index.php?option=com_jcart&'=>'<a class="colorbox" href="index.php?option=com_jcart&tmpl=component&',
			'<a class="colorbox" href="'.JCART_SITE_URL.'index.php?option=com_jcart&'=>'<a class="colorbox" href="'.JCART_SITE_URL.'index.php?option=com_jcart&tmpl=component&',
			'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",JCART_SITE_URL).'index.php?option=com_jcart&'=>'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",JCART_SITE_URL).'index.php?option=com_jcart&tmpl=component&',
			'<img src="'.JCART_SITE_URL.'index.php?option=com_jcart&'=>'<img src="'.JCART_SITE_URL.'index.php?option=com_jcart&amp;tmpl=component&amp;',
			'url: \'index.php?option=com_jcart'=>'url: \''.JCART_SITE_URL.'index.php?option=com_jcart',
			'load(\'index.php?option=com_jcart'=>'load(\''.JCART_SITE_URL.'index.php?option=com_jcart',
			'<a class="colorbox" href="'.JCART_SITE_URL.SHOP_SEO_KEY.'/information/information/info?'=>'<a class="colorbox" href="'.JCART_SITE_URL.'index.php?option=com_jcart&tmpl=component&route=information/information/info&',
			'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",JCART_SITE_URL.SHOP_SEO_KEY.'/information/information/info?')=>'<a class=\"colorbox\" href=\"'.str_replace("/","\\/",JCART_SITE_URL.'index.php?option=com_jcart&tmpl=component&route=information/information/info&'),
			'json[\'redirect\'];'=>'json[\'redirect\'].replace(/&amp;/g,"&");',
			'})($);'=>'})(jQuery);',
			'"admin/'=>'"'.JCART_COMPONENT_URL.'admin/',
			'<nav>'=>'<nav class="nav-oc">',
			'<header>'=>'<div class="header-oc">',
			'<footer>'=>'<div class="footer-oc">',
			'</header>'=>'</div>',
			'</footer>'=>'</div>',
			'src="../components/'=>'src="components/',
			''.JCART_RELATIVE_URL.JCART_RELATIVE_URL.''=>''.JCART_RELATIVE_URL.'',
			'data-toggle="collapse" data-parent="#accordion"'=>(defined("DONT_INCLUDE_JQUERY_JCART") && (DONT_INCLUDE_JQUERY_JCART=="2" || DONT_INCLUDE_JQUERY_JCART=="3"))?'data-toggle="collapse" data-parent="#accordion"':'data-toggle="collapse" data-parent="#accordion" onclick="collapseToggle(this);"',
			'data-toggle="collapse" data-target=".navbar-ex1-collapse"'=>(defined("DONT_INCLUDE_JQUERY_JCART") && (DONT_INCLUDE_JQUERY_JCART=="2" || DONT_INCLUDE_JQUERY_JCART=="3"))?'data-toggle="collapse" data-target=".navbar-ex1-collapse"':'data-toggle="collapse" data-target=".navbar-ex1-collapse" onclick="collapseToggle(this);"',
			'class="form-control summernote"'=>'class="form-control mce_editable"',
			);
			
$stylesheet_class_replace_array=array('container','content','header','left','right','center','search','menu','box','list','filter','banner','footer','logo','nav','top','breadcrumb','modal','modal-backdrop');
foreach($stylesheet_class_replace_array as $key){
		$replace_output_array['class="'.$key.'"']='class="'.$key.'-oc"';
		$replace_output_array['class=\"'.$key.'\"']='class=\"'.$key.'-oc\"';
		$replace_output_array['class="'.$key.' ']='class="'.$key.'-oc ';
		$replace_output_array['class=\"'.$key.' ']='class=\"'.$key.'-oc ';
		$replace_output_array['id="'.$key.'"']='id="'.$key.'-oc"';
		$replace_output_array['id=\"'.$key.'\"']='id=\"'.$key.'-oc\"';
		// some extra changes for css
		$replace_output_array['#'.$key.' ']='#'.$key.'-oc ';
		$replace_output_array['\#'.$key.' ']='\#'.$key.'-oc ';
		$replace_output_array['\'#'.$key.'\'']='\'#'.$key.'-oc\'';
		$replace_output_array['#'.$key.'{']='#'.$key.'-oc{';
		$replace_output_array['#'.$key.',']='#'.$key.'-oc,';
		$replace_output_array['#'.$key.':']='#'.$key.'-oc:';
		$replace_output_array['\'.'.$key.'\'']='\'.'.$key.'-oc\'';
		$replace_output_array['\'.'.$key.' ']='\'.'.$key.'-oc ';
		$replace_output_array['.'.$key.'{']='.'.$key.'-oc{';
		
		/* 
		// for css changes(enable them if needed)
		$replace_output_array['.'.$key.' ']='.'.$key.'-oc ';
		$replace_output_array['.'.$key.',']='.'.$key.'-oc,';
		$replace_output_array['.'.$key.':']='.'.$key.'-oc:';
		*/
		
}

$replace_output_array['class="nav-oc"']='class="nav nav-oc"';
$replace_output_array['class=\"nav-oc\"']='class=\"nav nav-oc\"';
$replace_output_array['class="nav-oc ']='class="nav nav-oc ';

//$replace_output_array['class="breadcrumb-oc"']='class="breadcrumb breadcrumb-oc"';
//$replace_output_array['class=\"breadcrumb-oc\"']='class=\"breadcrumb breadcrumb-oc\"';
//$replace_output_array['class="breadcrumb-oc ']='class="breadcrumb breadcrumb-oc ';

//$replace_output_array['class="container-oc"']='class="container container-oc"';
//$replace_output_array['class=\"container-oc\"']='class=\"container container-oc\"';
//$replace_output_array['class="container-oc ']='class="container container-oc ';

global $replace_output_check_array;
$replace_output_check_array[]=array(
'search'=>'bootstrap.min.js" type="text/javascript"></script>','replace'=>'bootstrap.min.js" type="text/javascript"></script>
			<script type="text/javascript">
		'.((defined("USE_JQUERY_DOLLAR_JCART") && USE_JQUERY_DOLLAR_JCART=="1")?'$=':'').'jQuery.noConflict();
	</script>','existing_var'=>'jQuery.noConflict();');

if(file_exists(JPATH_SITE.'/media/editors/tinymce/tinymce.min.js'))
$tinymce_js_path = JCART_SITE_URL.'media/editors/tinymce/tinymce.min.js';
else
$tinymce_js_path = '//tinymce.cachefly.net/4.1/tinymce.min.js';

$replace_output_check_array[]=array(
'search'=>'summernote.css" type="text/css" rel="stylesheet" media="screen" />','replace'=>'summernote.css" type="text/css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="'.$tinymce_js_path.'"></script>
<script type="text/javascript">
tinyMCE.init({
	selector: "textarea.mce_editable",
	plugins : "table link image code hr charmap autolink lists importcss print preview anchor searchreplace visualblocks fullscreen insertdatetime media contextmenu",
	toolbar: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | formatselect | bullist numlist | outdent indent | undo redo | link unlink anchor image insertdatetime media hr table | subscript superscript charmap | print preview searchreplace visualblocks code",
	removed_menuitems: "newdocument",
	content_css : "'.JCART_SITE_URL.'templates/system/css/editor.css",
	file_browser_callback : function (field_name, url, type, win) {
        ocFileManager(field_name, url, type, win);
    },
});
</script>','existing_var'=>'tinymce.min.js');

//for main system(not module)

$replace_output_check_array[]=array('search'=>'method="post" enctype="multipart/form-data" id="product">','replace'=>'method="post" enctype="multipart/form-data" id="product"><input type="hidden" name="item_param"  value="'.ITEM_ID.'" />','existing_var'=>'<input type="hidden" name="item_param"');

//for module
global $replace_module_output_check_array;
$replace_module_output_check_array[]=array('search'=>'<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">','replace'=>'<div style="padding-left:5px;">','existing_var'=>'<div style="padding-left:5px;">');
$replace_module_output_check_array[]=array('search'=>'<div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">','replace'=>'<div style="padding-left:5px;">','existing_var'=>'<div style="padding-left:5px;">');
$replace_module_output_check_array[]=array('search'=>'<div class="col-lg-3 col-md-3s col-sm-6 col-xs-12">','replace'=>'<div style="padding-left:5px;">','existing_var'=>'<div style="padding-left:5px;">');

$replace_module_output_check_array[]=array('search'=>'<div class="box-heading">','replace'=>'<div style="display:none;" class="box-heading">','existing_var'=>'<div style="display:none;" class="box-heading">');

$replace_module_output_check_array[]=array('search'=>'<div class="bottom">&nbsp;</div>','replace'=>'<div class="bottom" style="display:none;">&nbsp;</div>','existing_var'=>'<div class="bottom" style="display:none;">&nbsp;</div>');

$replace_module_output_check_array[]=array('search'=>'<div class="top">','replace'=>'<div class="top"  style="display:none;">','existing_var'=>'<div class="top"  style="display:none;">');

$replace_module_output_check_array[]=array('search'=>'<div id="cart" class="btn-group btn-block">','replace'=>'<div id="module-cart">','existing_var'=>'<div id="module-cart">');
$replace_module_output_check_array[]=array('search'=>'<button type="button" data-toggle="dropdown" data-loading-text="','replace'=>'<button  style="display:none;" type="button" data-toggle="dropdown" data-loading-text="','existing_var'=>'<button  style="display:none;" type="button" data-toggle="dropdown" data-loading-text="');
$replace_module_output_check_array[]=array('search'=>'<ul class="dropdown-menu pull-right">','replace'=>'<ul style="display:none;">','existing_var'=>'<ul style="list-style:none;">');
$replace_module_output_check_array[]=array('search'=>'<span id="cart-total"','replace'=>'<span id="module-cart-total"','existing_var'=>'<span id="module-cart-total"');
$replace_module_output_check_array[]=array('search'=>'<div class="heading">','replace'=>'<div style="display:none;" class="heading">','existing_var'=>'<div style="display:none;" class="heading">');
$replace_module_output_check_array[]=array('search'=>'class="img-thumbnail"','replace'=>'style="display:none;"','existing_var'=>'image-thumbnail-hidden');
$replace_module_output_check_array[]=array('search'=>'class="btn btn-danger btn-xs"','replace'=>'','existing_var'=>'button-remove-hidden');
$replace_module_output_check_array[]=array('search'=>'<input type="text" name="search" value=','replace'=>'<input type="text" name="search_mod_oc" value=','existing_var'=>'<input type="text" name="search_mod_oc" value=');
$replace_module_output_check_array[]=array('search'=>'<div class="sidebar">','replace'=>'<div>','existing_var'=>'<div class="sidebar-hidden">');		
$replace_module_output_check_array[]=array('search'=>'<ul class="nav nav-oc nav-tabs nav-stacked">','replace'=>'<ul>','existing_var'=>'<ul class="nav nav-tabs nav-stacked-hidden">');
$replace_module_output_check_array[]=array('search'=>'class="hidden-xs hidden-sm hidden-md"','replace'=>'class="hidden-xs hidden-sm hidden-md hidden-lg"','existing_var'=>'class="hidden-xs hidden-sm hidden-md hidden-lg"');
?>