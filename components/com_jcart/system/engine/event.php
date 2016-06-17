<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
/*
* Event System Userguide
* 
* https://github.com/opencart/opencart/wiki/Events-(script-notifications)-2.2.x.x
*/
class Event {
	protected $registry;
	public $data = array();

	public function __construct($registry) {
		$this->registry = $registry;
	}

	public function register($trigger, $action) {
		$this->data[$trigger][] = $action;
	}
	
	public function unregister($trigger, $action) {
		if (isset($this->data[$trigger])) {
			unset($this->data[$trigger]);
		}
	}

	public function trigger($trigger, $args = array()) {
		foreach ($this->data as $key => $value) {
			if (preg_match('/^' . str_replace(array('\*', '\?'), array('.*', '.'), preg_quote($key, '/')) . '/', $trigger)) {
				foreach ($value as $event) {
					$result = $event->execute($this->registry, $args);
					
					if (!is_null($result) && !($result instanceof Exception)) {
						return $result;
					}
				}
			}
		}
	}
}