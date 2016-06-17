<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ControllerEventTheme extends Controller {
	public function index(&$view, &$data) {
		// This is only here for compatibility with old templates
		if (substr($view, -4) == '.tpl') {
			$view = substr($view, 0, -4);
		}
	}
}
