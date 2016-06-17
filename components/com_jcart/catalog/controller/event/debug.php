<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ControllerEventDebug extends Controller {
	public function before(&$route, &$data) {
		if ($route == '') {
			$this->log->write(func_get_args());
		}
	}
	
	public function after(&$route, &$data, &$output) {
		if ($route == '') {
			$this->log->write(func_get_args());
		}
	}	
}
