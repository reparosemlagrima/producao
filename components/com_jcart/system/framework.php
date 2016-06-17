<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
// Registry
global $registry;
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Config
$config = new Config();
$config->load('default');
$config->set('application_config', $application_config);
if(isset($application_config_mode))
$config->set('application_config_mode', $application_config_mode);
$config->load($application_config);
$registry->set('config', $config);

// Request
$registry->set('request', new Request());

// Response
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$registry->set('response', $response);

// Database
if ($config->get('db_autostart')) {
	$db=new DB($config->get('db_type'), $config->get('db_hostname'), $config->get('db_username'), $config->get('db_password'), $config->get('db_database'), $config->get('db_port'));
	$registry->set('db', $db);
	// cms database
	global $joomla_db;
	$j_config = new JConfig();
	$joomla_db=new DB($config->get('db_type'), $j_config->host, $j_config->user, $j_config->password, $j_config->db, $config->get('db_port'));
}

// Session
if ($config->get('session_autostart')) {
	$session = new Session();
	$session->start();
	if($application_config == 'catalog') {
		$joomla_lang = JFactory::getLanguage();
		$def_lang=$joomla_lang->getTag();
		$def_lang=explode("-",$def_lang);
		$def_lang=$def_lang[0];
		if(isset($_REQUEST["lang"]) && strlen($_REQUEST["lang"])=="2"){
			if((isset($session->data['language']) && $session->data['language']!=$_REQUEST["lang"]) || !isset($session->data['language'])){
				$session->data['language'] = $_REQUEST["lang"];
			}
		}
		elseif(defined("CHANGE_JCART_LANG_TO_DEFAULT") && CHANGE_JCART_LANG_TO_DEFAULT=="1" && (isset($session->data['language']) && isset($def_lang) && $session->data['language']!=$def_lang) || !isset($session->data['language'])){
			if(isset($def_lang) &&  strlen($def_lang)==2){
				$session->data['language'] = $def_lang;
			}
		}
	}
	$registry->set('session', $session);
}

// Cache 
$registry->set('cache', new Cache($config->get('cache_type'), $config->get('cache_expire')));

// Url
$registry->set('url', new Url($config->get('site_ssl')));

// Language
$language = new Language($config->get('language_default'));
$language->load($config->get('language_default'));
$registry->set('language', $language);

// Document
$registry->set('document', new Document());

// Event
$event = new Event($registry);
$registry->set('event', $event);

// Event Register
if ($config->has('action_event')) {
	foreach ($config->get('action_event') as $key => $value) {
		$event->register($key, new Action($value));
	}
}

// Config Autoload
if ($config->has('config_autoload')) {
	foreach ($config->get('config_autoload') as $value) {
		$loader->config($value);
	}
}

// Language Autoload
if ($config->has('language_autoload')) {
	foreach ($config->get('language_autoload') as $value) {
		$loader->language($value);
	}
}

// Library Autoload
if ($config->has('library_autoload')) {
	foreach ($config->get('library_autoload') as $value) {
		$loader->library($value);
	}
}

// Model Autoload
if ($config->has('model_autoload')) {
	foreach ($config->get('model_autoload') as $value) {
		$loader->model($value);
	}
}

// Front Controller
$controller = new Front($registry);

// Pre Actions
if ($config->has('action_pre_action')) {
	foreach ($config->get('action_pre_action') as $value) {
		$controller->addPreAction(new Action($value));
	}
}

// Dispatch
$controller->dispatch(new Action($config->get('action_router')), new Action($config->get('action_error')));

// Output
$response->setCompression($config->get('config_compression'));
if(!isset($application_config_mode) ||  $application_config_mode != 'module') 
$response->output();