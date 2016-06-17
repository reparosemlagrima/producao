<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2015 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
namespace Cache;
defined( '_JEXEC' ) or die( 'Restricted access' );
class APC {
	private $expire;
	private $cache;

	public function __construct($expire) {
		$this->expire = $expire;
	}

	public function get($key) {
		return apc_fetch(CACHE_PREFIX . $key);
	}

	public function set($key, $value) {
		return apc_store(CACHE_PREFIX . $key, $value, $this->expire);
	}

	public function delete($key) {
		apc_delete(CACHE_PREFIX . $key);
	}
}