<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$application_config_mode = 'module';
if (is_file(dirname(__FILE__).'/index.php')) {
	require(dirname(__FILE__).'/index.php');
}