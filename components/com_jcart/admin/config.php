<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2015 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//define('DONT_SHOW_ADMIN_LOGIN', '0');
//define('USE_MANUAL_DB', '0');
//define('DB_DRIVER', 'mysql');
//define('DB_HOSTNAME', '');
//define('DB_USERNAME', '');
//define('DB_PASSWORD', '');
//define('DB_DATABASE', '');
//define('DB_PREFIX', 'oc_');
//define('DB_PORT', '3306');
define('SHOW_LOGO_HEADER_JCART','0');
define('USE_OC_TEMPLATE_WITHOUT_JOOMLA', '0');

define('JCART_SITE_URL', str_replace('administrator/','',JURI::base()));
define('JCART_COMPONENT_URL',JCART_SITE_URL.'components/com_jcart/');
define('JCART_RELATIVE_URL',str_replace(JCART_SITE_URL,'',JCART_COMPONENT_URL));
define('JCART_COMPONENT_DIR',JPATH_SITE.'/components/com_jcart/');

$j_config=new JConfig();
// HTTP
if(!defined("HTTP_SERVER"))
define('HTTP_SERVER', JCART_SITE_URL.'administrator/');
define('HTTP_CATALOG', JCART_SITE_URL);
define('HTTPS_CATALOG', JCART_SITE_URL);
define('HTTP_IMAGE', JCART_COMPONENT_URL.'image/');

// DIR
define('DIR_APPLICATION', JCART_COMPONENT_DIR.'admin/');
define('DIR_SYSTEM', JCART_COMPONENT_DIR.'system/');
define('DIR_IMAGE', JCART_COMPONENT_DIR.'image/');
define('DIR_LANGUAGE', JCART_COMPONENT_DIR.'admin/language/');
define('DIR_TEMPLATE', JCART_COMPONENT_DIR.'admin/view/template/');
define('DIR_CONFIG', JCART_COMPONENT_DIR.'system/config/');
define('DIR_CACHE', JCART_COMPONENT_DIR.'system/storage/cache/');
define('DIR_DOWNLOAD', JCART_COMPONENT_DIR.'system/storage/download/');
define('DIR_LOGS', JCART_COMPONENT_DIR.'system/storage/logs/');
define('DIR_MODIFICATION', JCART_COMPONENT_DIR.'system/storage/modification/');
define('DIR_UPLOAD', JCART_COMPONENT_DIR.'system/storage/upload/');
define('DIR_CATALOG', JCART_COMPONENT_DIR.'catalog/');

$mycom_params =  JComponentHelper::getParams('com_jcart');
$dont_show_login="";
$dont_include_jquery_library="";
$use_jquery_dollar_variable="";
$main_http_server="";
$use_joomla_db="1";
$db_user_name="";
$db_user_password="";
$db_user_host="";
$db_jcart_name="";
$db_user_prefix="";
$show_logo_header="";
$use_oc_template="";
if(version_compare(JVERSION, '1.6.0', '<' ) == 1){
	if($mycom_params->get('dontShowLogin')!=""){
		$dont_show_login=$mycom_params->get('dontShowLogin');
	}
	if($mycom_params->get('dontIncludejQueryLibrary')!=""){
		$dont_include_jquery_library=$mycom_params->get('dontIncludejQueryLibrary');
	}
	if($mycom_params->get('usejQueryDollarVariable')!=""){
		$use_jquery_dollar_variable=$mycom_params->get('usejQueryDollarVariable');
	}
	if($mycom_params->get('mainHttpServer')!=""){
		$main_http_server=$mycom_params->get('mainHttpServer');
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
}
else{
	if($mycom_params->get('params.dontShowLogin')!=""){
		$dont_show_login=$mycom_params->get('params.dontShowLogin');
	}
	if($mycom_params->get('params.dontIncludejQueryLibrary')!=""){
		$dont_include_jquery_library=$mycom_params->get('params.dontIncludejQueryLibrary');
	}
	if($mycom_params->get('params.usejQueryDollarVariable')!=""){
		$use_jquery_dollar_variable=$mycom_params->get('params.usejQueryDollarVariable');
	}
	if($mycom_params->get('params.mainHttpServer')!=""){
		$main_http_server=$mycom_params->get('params.mainHttpServer');
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
}

if(!defined("DONT_SHOW_ADMIN_LOGIN") && $dont_show_login!=""){
	define('DONT_SHOW_ADMIN_LOGIN', $dont_show_login);
}
elseif(!defined("DONT_SHOW_ADMIN_LOGIN")){
	define('DONT_SHOW_ADMIN_LOGIN', "0");
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

if(!defined("MAIN_HTTP_SERVER") && $main_http_server!=""){
	define('MAIN_HTTP_SERVER', $main_http_server);
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
global $replace_outputs_array;
$replace_outputs_array=array(
		'index.php?route='=>'index.php?option=com_jcart&route=',
		'index.php?token='=>'index.php?option=com_jcart&token=',
		'Powered By <a href="http://www.opencart.com">OpenCart</a>'=>'Powered By <a href="http://www.soft-php.com">jCart</a>',
		'="view/'=>'="'.JCART_COMPONENT_URL.'admin/view/',
		HTTP_SERVER.'view/'=>JCART_COMPONENT_URL.'admin/view/',
		'\'view/image/'=>'\''.JCART_COMPONENT_URL.'admin/view/image/',
		'"view/image/'=>'"'.JCART_COMPONENT_URL.'admin/view/image/',
		HTTP_CATALOG.'image/'=>JCART_COMPONENT_URL.'image/',
		HTTP_CATALOG.'catalog/'=>JCART_COMPONENT_URL.'catalog/',
		'$.'=>'jQuery.',
		'$('=>'jQuery(',		
		'load(\'index.php?option=com_jcart&'=>'load(\'index.php?option=com_jcart&tmpl=component&',
		'load(\\\'index.php?option=com_jcart&'=>'load(\\\'index.php?option=com_jcart&tmpl=component&',
		'index.php?option=com_jcart&route=checkout/manual&token='=>'index.php?option=com_jcart&tmpl=component&route=checkout/manual&token=',
		'index.php?option=com_jcart&route=common/filemanager&token='=>'index.php?option=com_jcart&route=common/filemanager&tmpl=component&token=',
		': \'index.php?option=com_jcart&'=>': \'index.php?option=com_jcart&tmpl=component&',
		HTTP_CATALOG.'index.php?option=com_jcart&route=feed/'=>HTTP_CATALOG.'index.php?option=com_jcart&tmpl=component&route=feed/',
		'index.php?option=com_jcart&route=sale/order/invoice&'=>'index.php?option=com_jcart&route=sale/order/invoice&tmpl=component&',
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
		'index.php?option=com_jcart&route=tool/backup/backup&'=>'index.php?option=com_jcart&route=tool/backup/backup&tmpl=component&',
		'="../'=>'="'.JCART_COMPONENT_URL,
		''.JCART_RELATIVE_URL.JCART_RELATIVE_URL.''=>''.JCART_RELATIVE_URL.'',
		'class="form-control summernote"'=>'class="form-control mce_editable"',
		'/tshirtecommerce/admin/'=>'../components/com_jcart/tshirtecommerce/admin/',
		'="language/'=>'="'.JCART_COMPONENT_URL.'admin/language/',
		/*'.summernote'=>'.addClass("mce_editable").css({',
		'<nav '=>'<nav-oc ',
		'<nav>'=>'<nav-oc>',
		'</nav>'=>'</nav-oc>',
		'<header '=>'<header-oc ',
		'<header>'=>'<header-oc>',
		'</header>'=>'</header-oc>',
		'<footer '=>'<footer-oc ',
		'<footer>'=>'<footer-oc>',
		'</footer>'=>'</footer-oc>',*/
		);
if(isset($_REQUEST["route"]) && $_REQUEST["route"]=="common/home")
$_GET["route"] = $_REQUEST["route"] = "common/dashboard";

$stylesheet_class_replace_array=array('container','content','header','button','left','right','center','search','menu','breadcrumb','box','list','filter','banner','footer','logo','nav','top','modal','modal-backdrop');
foreach($stylesheet_class_replace_array as $key){
		$replace_outputs_array['class="'.$key.'"']='class="'.$key.'-oc"';
		$replace_outputs_array['class=\"'.$key.'\"']='class=\"'.$key.'-oc\"';
		$replace_outputs_array['class="'.$key.' ']='class="'.$key.'-oc ';
		$replace_outputs_array['class=\"'.$key.' ']='class=\"'.$key.'-oc ';
		$replace_outputs_array['id="'.$key.'"']='id="'.$key.'-oc"';
		$replace_outputs_array['id=\"'.$key.'\"']='id=\"'.$key.'-oc\"';
		// some extra changes for css
		$replace_outputs_array['#'.$key.' ']='#'.$key.'-oc ';
		$replace_outputs_array['\#'.$key.' ']='\#'.$key.'-oc ';
		$replace_outputs_array['\'#'.$key.'\'']='\'#'.$key.'-oc\'';
		$replace_outputs_array['#'.$key.'{']='#'.$key.'-oc{';
		$replace_outputs_array['#'.$key.',']='#'.$key.'-oc,';
		$replace_outputs_array['#'.$key.':']='#'.$key.'-oc:';
		$replace_outputs_array['\'.'.$key.' ']='\'.'.$key.'-oc ';
		$replace_outputs_array['.'.$key.'{']='.'.$key.'-oc{';
		
		/* 
		// for css changes(enable them if needed)
		$replace_outputs_array['.'.$key.' ']='.'.$key.'-oc ';
		$replace_outputs_array['.'.$key.',']='.'.$key.'-oc,';
		$replace_outputs_array['.'.$key.':']='.'.$key.'-oc:';
		*/
		
}

$replace_outputs_array['class="nav-oc"']='class="nav nav-oc"';
$replace_outputs_array['class=\"nav-oc\"']='class=\"nav nav-oc\"';
$replace_outputs_array['class="nav-oc ']='class="nav nav-oc ';

$replace_outputs_array['class="breadcrumb-oc"']='class="breadcrumb breadcrumb-oc"';
$replace_outputs_array['class=\"breadcrumb-oc\"']='class=\"breadcrumb breadcrumb-oc\"';
$replace_outputs_array['class="breadcrumb-oc ']='class="breadcrumb breadcrumb-oc ';


//$replace_outputs_array['class="container-oc"']='class="container container-oc"';
//$replace_outputs_array['class=\"container-oc\"']='class=\"container container-oc\"';
//$replace_outputs_array['class="container-oc ']='class="container container-oc ';


global $replace_outputs_check_array;
if(file_exists(JPATH_SITE.'/media/editors/tinymce/tinymce.min.js'))
$tinymce_js_path = JCART_SITE_URL.'media/editors/tinymce/tinymce.min.js';
else
$tinymce_js_path = '//tinymce.cachefly.net/4.1/tinymce.min.js';

$replace_outputs_check_array[]=array(
'search'=>'font-awesome.min.css" type="text/css" rel="stylesheet" />','replace'=>'font-awesome.min.css" type="text/css" rel="stylesheet" />
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
</script>','existing_var'=>'mce_editable');

global $replace_templates_files_array;
$replace_templates_files_array=array(			
			'#container{
	width:'=>'#container{
	speech-rate:',
			'#container {
	width:'=>'#container {
	speech-rate:',			
			'.container{
	width:'=>'.container{
	speech-rate:',
			'.container {
	width:'=>'.container {
	speech-rate:',
			'html {'=>'html-oc {',
			'html,'=>'html-oc,',
			'html{'=>'html-oc{',
			'body{'=>'body-oc{',
			'width: 510px;'=>'',
			'960px;'=>'100%;',
			'980px;'=>'100%;',
			'.htabs {'=>'.htabs { overflow: auto;',
			'background: url(\'../image/tab_'=>'background_image: url(\'../image/tab_',
			'background: url(\'../image/header_'=>'background_image: url(\'../image/header_',
			'margin-left: 190px;'=>'margin-left: 0px;',
			//'body {'=>'body-oc {',
			//'body,'=>'body-oc,',
			);
$stylesheet_class_replace_array=array('container','content','header','button','left','right','center','search','menu','breadcrumb','box','list','filter','banner','footer','logo','nav','top','modal','modal-backdrop','btn-primary','btn-default','btn-warning','btn-danger','btn-success','btn-info','btn-inverse',);
foreach($stylesheet_class_replace_array as $key){
		$replace_templates_files_array['#'.$key.' ']='#'.$key.'-oc ';
		$replace_templates_files_array['.'.$key.' ']='.'.$key.'-oc ';
		$replace_templates_files_array['#'.$key.'{']='#'.$key.'-oc{';
		$replace_templates_files_array['.'.$key.'{']='.'.$key.'-oc{';
		$replace_templates_files_array['#'.$key.',']='#'.$key.'-oc,';
		$replace_templates_files_array['.'.$key.',']='.'.$key.'-oc,';
		$replace_templates_files_array['#'.$key.':']='#'.$key.'-oc:';
		$replace_templates_files_array['.'.$key.':']='.'.$key.'-oc:';	
		
}
if(defined("USE_OC_TEMPLATE_WITHOUT_JOOMLA") && USE_OC_TEMPLATE_WITHOUT_JOOMLA == "1")
$replace_templates_files_array=array('-oc'=>'');

$module_name_array=array('information','bestseller','category','featured','latest','special');
global $replace_files_array;
foreach($module_name_array as $key){
	$replace_files_array[]=array(
'file'=>'catalog/controller/module/'.$key.'.php','search'=>'if (file_exists(DIR_TEMPLATE . $this->config->get(\'theme_default_directory\') . \'/template/module/','replace'=>'global $replace_module_output_check_array;
		$replace_module_output_check_array[]=array(\'search\'=>\'<h3>\'.(isset($data[\'heading_title\'])?$data[\'heading_title\']:"").\'</h3>\',\'replace\'=>\'\',\'existing_var\'=>\'heading_title\');
		if (file_exists(DIR_TEMPLATE . $this->config->get(\'theme_default_directory\') . \'/template/module/','existing_var'=>'global ');
}

$replace_files_array[]=array(
'file'=>'catalog/model/checkout/order.php','search'=>'index.php?route=','replace'=>'index.php?option=com_jcart&route=','existing_var'=>'com_jcart');
?>