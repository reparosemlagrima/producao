<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2015 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
if(file_exists(JPATH_SITE.'/components/com_jcart/system/library/joomla_module_data.php')){
	$prevcurdir=getcwd();
	chdir(JPATH_SITE . '/components/com_jcart/');
	$module_file_name = __FILE__;
	include('system/library/joomla_module_data.php');
	chdir($prevcurdir);
}
?>