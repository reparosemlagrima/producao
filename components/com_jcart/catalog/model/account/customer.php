<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ModelAccountCustomer extends Model {
	public function addCustomer($data) {
		if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $data['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$this->load->model('account/customer_group');

		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

		//#############################Start JOOMLA LOGIN Integration################################
		global $joomla_db;
		jimport("joomla.user.helper");
		$j_config = new JConfig();
		$username_exists="";
		$joomla_user_name="";
		$joomla_user_id="";
		$result = $joomla_db->query("SELECT * FROM ".$j_config->dbprefix."users where email like '".$joomla_db->escape($data['email'])."'");
		if($result->num_rows){
			$username_exists=$result->row["id"];
			$joomla_user_name=$result->row["username"];
			$joomla_user_email=$result->row["email"];
		}
		// if user already not exists in joomla table,then insert new entry to joomla users table
		if($username_exists==""){
			if(version_compare(JVERSION, '1.6.0', '<' ) != 1){ //if joomla version is greater than>=1.6
				if(class_exists("JUserHelper")){
					$salt=JUserHelper::genRandomPassword(32);
					$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($data['password']),$salt);
					$encrypted_password=$crypt.":".$salt;
				}
				$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',username = '" . $joomla_db->escape($data['email']) . "',email = '" . $joomla_db->escape($data['email']) . "', password = '" . $encrypted_password . "', sendEmail = '0', registerDate = NOW()");
				$joomla_user_id=$joomla_db->getLastId();
				$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "user_usergroup_map SET group_id = '2',user_id = '" . $joomla_user_id . "'");
			}
			else{
				$result = $joomla_db->query("SELECT * FROM ".$j_config->dbprefix."core_acl_aro_groups where name ='Registered'");
				$user_group_id=$result->row["id"];
				if($user_group_id=="")
					$user_group_id=18;
				if(class_exists("JUserHelper")){
					$salt=JUserHelper::genRandomPassword(32);
					$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($data['password']),$salt);
					$encrypted_password=$crypt.":".$salt;
				}
				$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',username = '" . $joomla_db->escape($data['email']) . "',email = '" . $joomla_db->escape($data['email']) . "', usertype = 'Registered', password = '" . $encrypted_password . "', gid = '" . (int)$user_group_id . "', sendEmail = '0', registerDate = NOW()");
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
			} // end if joomla version check
			//Community Builder
			$result = $joomla_db->query("SHOW TABLES LIKE '".$j_config->dbprefix."comprofiler'");
			if($result->num_rows){
				$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "comprofiler SET id = '".$joomla_user_id."',user_id = '".$joomla_user_id."'");
			}
		} // end if username_exists
		//block user in joomla table if it needs aproval
		if ($customer_group_info['approval']) {
			$joomla_db->query("UPDATE " . $j_config->dbprefix . "users SET block = '1' WHERE email='".$joomla_db->escape($data['email'])."'");		
		}					
		//joomla user profile integration	
		//find joomla_user_id if $joomla_user_id variable is not already declared
		global $joomla_db;
		if(!isset($data['email']))
		$data['email']=$this->customer->getEmail();
		$j_config = new JConfig();
		if(!isset($joomla_user_id) && isset($data['email'])){				
			$result = $joomla_db->query("SELECT * FROM ".$j_config->dbprefix."users where email like '".$joomla_db->escape($data['email'])."'");
			if($result->num_rows){
				$joomla_user_id=$result->row["id"];					
			}
		}
		//run this script for only joomla >=1.6		
		if(version_compare(JVERSION, '1.6.0', '<' ) != 1 && isset($joomla_user_id)){			
			//check whether user_profiles table exists
			$user_profile_result = $joomla_db->query("SHOW TABLES LIKE '".$j_config->dbprefix."user_profiles'");
			if ($user_profile_result->num_rows){
				$profiles_entry_array[]=array("key"=>"address1","value"=>"address_1","ordering"=>"1");
				$profiles_entry_array[]=array("key"=>"address2","value"=>"address_2","ordering"=>"2");
				$profiles_entry_array[]=array("key"=>"city","value"=>"city","ordering"=>"3");
				$profiles_entry_array[]=array("key"=>"postal_code","value"=>"postcode","ordering"=>"6");
				$profiles_entry_array[]=array("key"=>"phone","value"=>"telephone","ordering"=>"7");
				//find zone name
				if(isset($data["zone_id"])){
					$result = $this->db->query("SELECT name FROM ".DB_PREFIX."zone where zone_id = '".(int)$data["zone_id"]."'");
					if($result->num_rows){
						$data["region"]=$result->row["name"];
						$profiles_entry_array[]=array("key"=>"region","value"=>"region","ordering"=>"4");				
					}
				}
				//find country name
				if(isset($data["country_id"])){
					$result = $this->db->query("SELECT name FROM ".DB_PREFIX."country where country_id = '".(int)$data["country_id"]."'");
					if($result->num_rows){
						$data["country"]=$result->row["name"];
						$profiles_entry_array[]=array("key"=>"country","value"=>"country","ordering"=>"5");				
					}
				}
				foreach($profiles_entry_array as $single_entry){
					if(isset($data[$single_entry["value"]]) && $data[$single_entry["value"]]!="" ){
						$result = $joomla_db->query("SELECT * FROM ".$j_config->dbprefix."user_profiles where user_id = '".(int) $joomla_user_id."' and profile_key='profile.".$single_entry["key"]."'");
						if(!$result->num_rows){
							$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "user_profiles SET user_id = '".$joomla_user_id."',profile_key = 'profile.".$single_entry["key"]."',profile_value='\"".$data[$single_entry["value"]]."\"',ordering='".(int)$single_entry["ordering"]."'");
						}
						else{
							$joomla_db->query("UPDATE  " . $j_config->dbprefix . "user_profiles SET profile_value='\"".$data[$single_entry["value"]]."\"' WHERE  user_id = '".$joomla_user_id."' and profile_key = 'profile.".$single_entry["key"]."'");
						}
					}//end if isset
				}//end foreach
			}//end if $user_profile_result(table)
		}//end if joomla version check
		//end joomla user profile integration
		//#############################End JOOMLA LOGIN Integration#######################
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$customer_group_id . "', store_id = '" . (int)$this->config->get('config_store_id') . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']['account']) ? json_encode($data['custom_field']['account']) : '') . "', salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : 0) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', date_added = NOW()");

		$customer_id = $this->db->getLastId();

		$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', city = '" . $this->db->escape($data['city']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "', custom_field = '" . $this->db->escape(isset($data['custom_field']['address']) ? json_encode($data['custom_field']['address']) : '') . "'");

		$address_id = $this->db->getLastId();

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");

		$this->load->language('mail/customer');

		$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

		$message = sprintf($this->language->get('text_welcome'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8')) . "\n\n";

		if (!$customer_group_info['approval']) {
			$message .= $this->language->get('text_login') . "\n";
		} else {
			$message .= $this->language->get('text_approval') . "\n";
		}

		$message .= $this->url->link('account/login', '', true) . "\n\n";
		$message .= $this->language->get('text_services') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($subject);
		$mail->setText($message);
		$mail->send();

		// Send to main admin email if new account email is enabled
		if ($this->config->get('config_account_mail')) {
			$message  = $this->language->get('text_signup') . "\n\n";
			$message .= $this->language->get('text_website') . ' ' . html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8') . "\n";
			$message .= $this->language->get('text_firstname') . ' ' . $data['firstname'] . "\n";
			$message .= $this->language->get('text_lastname') . ' ' . $data['lastname'] . "\n";
			$message .= $this->language->get('text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
			$message .= $this->language->get('text_email') . ' '  .  $data['email'] . "\n";
			$message .= $this->language->get('text_telephone') . ' ' . $data['telephone'] . "\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($this->language->get('text_new_customer'), ENT_QUOTES, 'UTF-8'));
			$mail->setText($message);
			$mail->send();

			// Send to additional alert emails if new account email is enabled
			$emails = explode(',', $this->config->get('config_mail_alert'));

			foreach ($emails as $email) {
				if (utf8_strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}

		return $customer_id;
	}

	public function editCustomer($data) {
		//################################START JOOMLA LOGIN Integration##########################
		global $joomla_db;
		$result = $this->db->query("SELECT email FROM ".DB_PREFIX . "customer WHERE customer_id = '" . (int)$this->customer->getId() . "'");
		if($result->num_rows){
			$customer_email=$result->row["email"];	
		}
		if(isset($customer_email) && $customer_email!=""){		
			$j_config = new JConfig();
			$joomla_db->query("UPDATE " . $j_config->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',email = '" . $joomla_db->escape($data['email']) . "' WHERE email='".$joomla_db->escape($customer_email)."'");
			$joomla_db->query("UPDATE " . $j_config->dbprefix . "users SET username = '" . $joomla_db->escape($data['email']) . "' WHERE username='".$joomla_db->escape($customer_email)."'");
		}
		//################################End JOOMLA LOGIN Integration#############################
		$customer_id = $this->customer->getId();

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "' WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function editPassword($email, $password) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
		//################################START JOOMLA LOGIN Integration#########################
		global $joomla_db;
		jimport("joomla.user.helper");
		$j_config = new JConfig();
		if(class_exists("JUserHelper")){
			$salt=JUserHelper::genRandomPassword(32);
			$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($password),$salt);
			$encrypted_password=$crypt.":".$salt;
		}
		$joomla_db->query("UPDATE " . $j_config->dbprefix . "users SET password = '" . $encrypted_password . "' WHERE email='".$joomla_db->escape($email)."'");
		//################################End JOOMLA LOGIN Integration############################
	}

	public function editCode($email, $code) {
		$this->db->query("UPDATE `" . DB_PREFIX . "customer` SET code = '" . $this->db->escape($code) . "' WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}

	public function editNewsletter($newsletter) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET newsletter = '" . (int)$newsletter . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");
	}

	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	public function getCustomerByCode($code) {
		$query = $this->db->query("SELECT customer_id, firstname, lastname FROM `" . DB_PREFIX . "customer` WHERE code = '" . $this->db->escape($code) . "' AND code != ''");

		return $query->row;
	}

	public function getCustomerByToken($token) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE token = '" . $this->db->escape($token) . "' AND token != ''");

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = ''");

		return $query->row;
	}

	public function getTotalCustomersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		if(!$query->row['total']){
			$j_config = new JConfig();
			global $joomla_db;
			$query = $joomla_db->query("SELECT COUNT(*) AS total FROM " . $j_config->dbprefix . "users WHERE LOWER(email) = '" . $joomla_db->escape(utf8_strtolower($email)) . "'");
		}
		
		return $query->row['total'];
	}

	public function getRewardTotal($customer_id) {
		$query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}

	public function getIps($customer_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ip` WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->rows;
	}

	public function addLoginAttempt($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_login WHERE email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");

		if (!$query->num_rows) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_login SET email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', total = 1, date_added = '" . $this->db->escape(date('Y-m-d H:i:s')) . "', date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "customer_login SET total = (total + 1), date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE customer_login_id = '" . (int)$query->row['customer_login_id'] . "'");
		}
	}

	public function getLoginAttempts($email) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	public function deleteLoginAttempts($email) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}
}
