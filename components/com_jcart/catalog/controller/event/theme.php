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
		if (!$this->config->get($this->config->get('config_theme') . '_status')) {
			exit('Error: A theme has not been assigned to this store!');
		}
		
		// This is only here for compatibility with old themes.
		if (substr($view, -4) == '.tpl') {
			$view = substr($view, 0, -4);
		}
		
		if ($this->config->get('config_theme') == 'theme_default') {
			$directory = $this->config->get('theme_default_directory');
		} else {
			$directory = $this->config->get('config_theme');
		}

		if (is_file(DIR_TEMPLATE . $directory . '/template/' . $view . '.tpl')) {
			$view = $directory . '/template/' . $view;
		} else {
			$view = 'default/template/' . $view;
		}			
	}
}
