<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
namespace Cart;
defined( '_JEXEC' ) or die( 'Restricted access' );
class User {
	private $user_id;
	private $username;
	private $permission = array();

	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		//joomla admin login integration start
		if(defined("DONT_SHOW_ADMIN_LOGIN") && DONT_SHOW_ADMIN_LOGIN=="1" && !isset($_SESSION['user_id'])){
			jimport("joomla.user.helper");
			$joomla_user= \JFactory::getUser();
			if($joomla_user->get('username')!="")
			{
				if(($joomla_user->get('usertype')=="" || $joomla_user->get('usertype')=="deprecated") && is_array($joomla_user->get('groups')))
					$juser_groups=$joomla_user->get('groups');
				else
					$juser_groups=array();
				$username_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $joomla_user->get('username'). "' AND status = '1'");
				if ($username_query->num_rows) {
					$this->session->data['user_id']=$username_query->row["user_id"];
					$this->session->data['token'] = md5(mt_rand());
					$this->request->get['token'] = $this->session->data['token'];	
				}
				elseif($joomla_user->get('username')!="" && ($joomla_user->get('usertype')=="Super Users" ||$joomla_user->get('usertype')=="Super Administrator" || $joomla_user->get('usertype')=="Administrator" || in_array("6",$juser_groups) || in_array("7",$juser_groups) || in_array("8",$juser_groups)))
				{
					$this->session->data['user_id']=1;
					$this->session->data['token'] = md5(mt_rand());
					$this->request->get['token'] = $this->session->data['token'];				
				}
			}
		}
		// end joomla admin login integration
		if(isset($this->session->data['token']) && !isset($this->session->data['store_token_id']) && isset($this->session->data['user_id'])){
			$this->db->query("UPDATE " . DB_PREFIX . "user SET code = '" . $this->db->escape($this->session->data['token']) . "' WHERE user_id = '" . (int)$this->session->data['user_id'] . "'");
			$this->session->data['store_token_id']=$this->session->data['token'];
		}
		if (isset($this->session->data['user_id'])) {
			// start creating api user for first time
			// create order API user first time
			$ap_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "api");
			if (!$ap_query->num_rows) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "api` SET name = 'Default', `key` = '" . $this->db->escape(token(256)) . "', status = 1, date_added = NOW(), date_modified = NOW()");
				
				$api_id = $this->db->getLastId();
				
				$this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_api_id'");
				$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `code` = 'config', `key` = 'config_api_id', value = '" . (int)$api_id . "'");
				
				//create encryption key
				$this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_encryption'");
				$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `code` = 'config', `key` = 'config_encryption', value = '" . $this->db->escape(token(1024)) . "'");
				
				// $this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_url'");
				// $this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `code` = 'config', `key` = 'config_url', value = '" . $this->db->escape(HTTP_CATALOG) . "'");
			}
			// end creating api user for first time
			$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");

			if ($user_query->num_rows) {
				$this->user_id = $user_query->row['user_id'];
				$this->username = $user_query->row['username'];
				$this->user_group_id = $user_query->row['user_group_id'];

				$this->db->query("UPDATE " . DB_PREFIX . "user SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE user_id = '" . (int)$this->session->data['user_id'] . "'");

				$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");

				$permissions = json_decode($user_group_query->row['permission'], true);

				if (is_array($permissions)) {
					foreach ($permissions as $key => $value) {
						$this->permission[$key] = $value;
					}
				}
			} else {
				$this->logout();
			}
		}
	}

	public function login($username, $password) {
		$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $this->db->escape($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");

		if ($user_query->num_rows) {
			$this->session->data['user_id'] = $user_query->row['user_id'];

			$this->user_id = $user_query->row['user_id'];
			$this->username = $user_query->row['username'];
			$this->user_group_id = $user_query->row['user_group_id'];

			$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");

			$permissions = json_decode($user_group_query->row['permission'], true);

			if (is_array($permissions)) {
				foreach ($permissions as $key => $value) {
					$this->permission[$key] = $value;
				}
			}

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		unset($this->session->data['user_id']);
		if(isset($_SESSION["wrong_db_info"]))
		unset($_SESSION["wrong_db_info"]);

		$this->user_id = '';
		$this->username = '';
		if(defined("DONT_SHOW_ADMIN_LOGIN") && DONT_SHOW_ADMIN_LOGIN=="1"){
			$mainframe = \JFactory::getApplication();
			$mainframe->logout();
			if(isset($_SESSION))			
			session_destroy();
		}
	}

	public function hasPermission($key, $value) {
		if (isset($this->permission[$key])) {
			return in_array($value, $this->permission[$key]);
		} else {
			return false;
		}
	}

	public function isLogged() {
		return $this->user_id;
	}

	public function getId() {
		return $this->user_id;
	}

	public function getUserName() {
		return $this->username;
	}

	public function getGroupId() {
		return $this->user_group_id;
	}
}