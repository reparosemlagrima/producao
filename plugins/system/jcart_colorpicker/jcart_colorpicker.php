<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );
$appjoomla = JFactory::getApplication();
$document = JFactory::getDocument();
if($appjoomla->isAdmin()) {
	if(file_exists(JPATH_SITE.'/plugins/system/jcart_colorpicker/jscolor/jscolor.js'))
		$document->addScript(JURI::root().'plugins/system/jcart_colorpicker/jscolor/jscolor.js');
	else
		$document->addScript(JURI::root().'plugins/system/jscolor/jscolor.js');

}
if(isset($_GET["route"]) && $_GET["route"]!="" && !isset($_GET["option"]))
$_REQUEST["option"]="com_jcart";
?>