<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
// Version
if(!defined("VERSION"))
define('VERSION', '2.2.0.0');

// Configuration
if (is_file(dirname(__FILE__).'/config.php')) {
	require_once(dirname(__FILE__).'/config.php');
}


// Startup
require_once(DIR_SYSTEM . 'startup.php');

$application_config = 'catalog';

// Application
require_once(DIR_SYSTEM . 'framework.php');