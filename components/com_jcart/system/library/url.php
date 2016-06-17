<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class Url {
	private $ssl;
	private $rewrite = array();

	public function __construct($ssl = false) {
		$this->ssl = $ssl;
	}
	
	public function addRewrite($rewrite) {
		$this->rewrite[] = $rewrite;
	}

	public function link($route, $args = '', $secure = false) {
		if (($this->ssl && $secure) || (defined("OC_SSL_SECURE") && ($this->ssl || $secure)) || (strstr(HTTP_SERVER,"https://") && $secure)) {
			$url = 'https://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/.\\') . '/';
		} else {
			$url = 'http://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/.\\') . '/';
		}

		if(defined("ITEM_ID"))
			$url .= 'index.php?option=com_jcart&amp;'.str_replace("&","&amp;",ITEM_ID).'route=' . $route;
		else
			$url .= 'index.php?option=com_jcart&amp;route=' . $route;
		
		if(strstr($url,"route=checkout/success"))
			$url = str_replace("&amp;","&",$url);
		if ($args) {
			if (is_array($args)) {
				$url .= '&amp;' . http_build_query($args);
			} else {
				$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
			}
		}

		foreach ($this->rewrite as $rewrite) {
			$url = $rewrite->rewrite($url);
		}

		return $url;
	}
}