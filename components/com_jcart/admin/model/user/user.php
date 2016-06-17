<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ModelUserUser extends Model {
	public function addUser($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "user` SET username = '" . $this->db->escape($data['username']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
		//################################Start JOOMLA LOGIN Integration#############################################
		if(defined("DONT_SHOW_ADMIN_LOGIN") && DONT_SHOW_ADMIN_LOGIN=="1"){
			global $joomla_db;			
			jimport("joomla.user.helper");			
			$j_config = new JConfig();
			$username_exists="";
			$joomla_user_name="";
			$joomla_user_id="";
			if($data["status"]=="1")
				$block="0";
			else
				$block="1";
						
			$result = $joomla_db->query("SELECT * FROM ".$j_config->dbprefix."users where username='".$joomla_db->escape($data['username'])."'");
			if($result->num_rows){
				$username_exists=$result->row["id"];
				$joomla_user_name=$result->row["username"];
			}
			// if user already not exists in joomla table,then insert new entry to joomla users table
			if($username_exists==""){
				if(isset($data["joomla_user_group_id"])){
					$joomla_user_group_id=explode(":",$data["joomla_user_group_id"]);
					$joomla_user_group_id=$joomla_user_group_id[0];
					$joomla_user_group_name=$joomla_user_group_id[1];
				}
				else{
					$joomla_user_group_id="";
					$joomla_user_group_name="";
				}				
				if(version_compare(JVERSION, '1.6.0', '<' ) != 1){ //if joomla version is greater than>=1.6
					if($joomla_user_group_id==""){
						$joomla_user_group_id=6;
						$joomla_user_group_name="Manager";
					}
					if(class_exists("JUserHelper")){
						$salt=JUserHelper::genRandomPassword(32);
						$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($data['password']),$salt);
						$encrypted_password=$crypt.":".$salt;
					}
					$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',username = '" . $joomla_db->escape($data['username']) . "',email = '" . $joomla_db->escape($data['email']) . "', password = '" . $encrypted_password . "', sendEmail = '0', block='".$block."', registerDate = NOW()");
					$joomla_user_id=$joomla_db->getLastId();
					
					$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "user_usergroup_map SET group_id = '".(int)$joomla_user_group_id."',user_id = '" . $joomla_user_id . "'");
					
					
				}
				else{
					if($joomla_user_group_id==""){
						$joomla_user_group_id=23;						
						$joomla_user_group_name="Manager";
					}
						
					if(class_exists("JUserHelper")){
						$salt=JUserHelper::genRandomPassword(32);
						$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($data['password']),$salt);
						$encrypted_password=$crypt.":".$salt;
					}
					$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',username = '" . $joomla_db->escape($data['username']) . "',email = '" . $joomla_db->escape($data['email']) . "', usertype = '".$joomla_user_group_name."', password = '" . $encrypted_password . "', gid = '" . (int)$joomla_user_group_id . "', sendEmail = '0', block='".$block."', registerDate = NOW()");
					$joomla_user_id=$joomla_db->getLastId();
					$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "core_acl_aro SET section_value = 'users',value = '" . $joomla_user_id . "',order_value = '0', name = '".$joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname'])."', hidden = '0'");
					$joomla_acl_aro_id=$joomla_db->getLastId();
					if(!$joomla_acl_aro_id){
						$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "core_acl_aro SET section_value = 'users',value = '" . $joomla_user_id . "',order_value = '0', name = '".$joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname'])."', hidden = '0'");
						$joomla_acl_aro_id=$joomla_db->getLastId();
					}
					$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "core_acl_groups_aro_map SET group_id = '".$user_group_id."',section_value = '',aro_id = '".$joomla_acl_aro_id."'");
					$result = $joomla_db->query("SELECT * FROM ".$j_config->dbprefix."core_acl_groups_aro_map where group_id='".$user_group_id."' and aro_id = '".$joomla_acl_aro_id."'");
					if($result->num_rows){
						//do nothing
					}
					else{
						$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "core_acl_groups_aro_map SET group_id = '".$user_group_id."',section_value = '',aro_id = '".$joomla_acl_aro_id."'");
					}
				}
				//Community Builder
				$result = $joomla_db->query("SHOW TABLES LIKE '".$j_config->dbprefix."comprofiler'");
				if($result->num_rows){
					$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "comprofiler SET id = '".$joomla_user_id."',user_id = '".$joomla_user_id."'");
				}
				
			}			
			//If user already exists in joomla table then upadate users information including password in joomla user table
			if($username_exists!=""){
				$j_config = new JConfig();
				$joomla_db->query("UPDATE " . $j_config->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',email = '" . $joomla_db->escape($data['email']) . "' WHERE id='".$username_exists."'");
				
				if(class_exists("JUserHelper")){
					$salt=JUserHelper::genRandomPassword(32);
					$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($data['password']),$salt);
					$encrypted_password=$crypt.":".$salt;
				}
				//update joomla password
				$joomla_db->query("UPDATE " . $j_config->dbprefix . "users SET password = '" . $encrypted_password . "' WHERE id='".$username_exists."'");					
			
			}
		}
		//################################End JOOMLA LOGIN Integration###############################################
		return $this->db->getLastId();
	}

	public function editUser($user_id, $data) {
		//################################START JOOMLA LOGIN Integration##############################
		if(defined("DONT_SHOW_ADMIN_LOGIN") && DONT_SHOW_ADMIN_LOGIN=="1"){
			global $joomla_db;
			$result = $this->db->query("SELECT username FROM ".DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");
			if($result->num_rows){
				$username=$result->row["username"];	
			}
						
			if($data["status"]=="1")
				$block="0";
			else
				$block="1";
						
			if(isset($username) && $username!="" && isset($data['username']) && $data['username']!=""){		
				$j_config = new JConfig();
				$joomla_db->query("UPDATE " . $j_config->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',email = '" . $joomla_db->escape($data['email']) . "', block='".$block."',username='".$joomla_db->escape($data['username'])."' WHERE username='".$joomla_db->escape($username)."'");
			}
			if ($data['password']) {
				$password=$data['password'];
				jimport("joomla.user.helper");
				$j_config = new JConfig();
				if(class_exists("JUserHelper")){
					$salt=JUserHelper::genRandomPassword(32);
					$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($password),$salt);
					$encrypted_password=$crypt.":".$salt;
				}
				$joomla_db->query("UPDATE " . $j_config->dbprefix . "users SET password = '" . $encrypted_password . "' WHERE username='".$joomla_db->escape($data['username'])."'");
			}
		}
		//################################End JOOMLA LOGIN Integration################################
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET username = '" . $this->db->escape($data['username']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "' WHERE user_id = '" . (int)$user_id . "'");

		if ($data['password']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE user_id = '" . (int)$user_id . "'");
		}
	}

	public function editPassword($user_id, $password) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE user_id = '" . (int)$user_id . "'");
		// edit joomla password
		if(defined("DONT_SHOW_ADMIN_LOGIN") && DONT_SHOW_ADMIN_LOGIN=="1"){
			global $joomla_db;
			$result = $this->db->query("SELECT username FROM ".DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");
			if($result->num_rows){
				$username=$result->row["username"];	
			}
			
			if (isset($username) && $username!="" && isset($password) && $password!="") {
				jimport("joomla.user.helper");
				$j_config = new JConfig();
				if(class_exists("JUserHelper")){
					$salt=JUserHelper::genRandomPassword(32);
					$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($password),$salt);
					$encrypted_password=$crypt.":".$salt;
				}
				$joomla_db->query("UPDATE " . $j_config->dbprefix . "users SET password = '" . $encrypted_password . "' WHERE username='".$joomla_db->escape($username)."'");
			}
		}
		//end edit joomla password
	}
	public function editCode($email, $code) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET code = '" . $this->db->escape($code) . "' WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}

	public function deleteUser($user_id) {
		// joomla user delete
		if(defined("DONT_SHOW_ADMIN_LOGIN") && DONT_SHOW_ADMIN_LOGIN=="1"){
			global $joomla_db;
			$result = $this->db->query("SELECT username FROM ".DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");
			if($result->num_rows){
				$username=$result->row["username"];	
			}
			if(isset($username) && $username!=""){		
				$j_config = new JConfig();
				$result = $joomla_db->query("SELECT id FROM " . $j_config->dbprefix . "users where username='".$username."'");
				if($result->num_rows){
					$userid=$result->row["id"];	
				}
				$delete_user="no";
				if(isset($userid)){
					$instance = JUser::getInstance($userid);
					if(version_compare(JVERSION, '1.6.0', '<' ) != 1){
						$juser_groups=array();
						$juser_groups=$instance->get('groups');
						if(in_array("8",$juser_groups))
							$delete_user="no";
						else
							$delete_user="yes";
					}
					else{
						if($instance->get('usertype')=="Super Users" || $instance->get('usertype')=="Super Administrator")
							$delete_user="no";
						else
							$delete_user="yes";
					}
					
					if($delete_user=="yes")
					$instance->delete();
				}// end if isset userid				
			}// end if isset username
		}
		// end joomla user delete
		$this->db->query("DELETE FROM `" . DB_PREFIX . "user` WHERE user_id = '" . (int)$user_id . "'");
	}

	public function getUser($user_id) {
		$query = $this->db->query("SELECT *, (SELECT ug.name FROM `" . DB_PREFIX . "user_group` ug WHERE ug.user_group_id = u.user_group_id) AS user_group FROM `" . DB_PREFIX . "user` u WHERE u.user_id = '" . (int)$user_id . "'");

		return $query->row;
	}

	public function getUserByUsername($username) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE username = '" . $this->db->escape($username) . "'");

		return $query->row;
	}

	public function getUserByCode($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE code = '" . $this->db->escape($code) . "' AND code != ''");

		return $query->row;
	}

	public function getUsers($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "user`";

		$sort_data = array(
			'username',
			'status',
			'date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY username";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalUsers() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user`");

		return $query->row['total'];
	}

	public function getTotalUsersByGroupId($user_group_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE user_group_id = '" . (int)$user_group_id . "'");

		return $query->row['total'];
	}

	public function getTotalUsersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}
}