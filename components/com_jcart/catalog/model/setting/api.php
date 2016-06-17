<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2015 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ModelSettingApi extends Model {
	public function login($username, $password) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "api WHERE username = '" . $this->db->escape($username) . "' AND password = '" . $this->db->escape($password) . "'");

		return $query->row;
	}
}