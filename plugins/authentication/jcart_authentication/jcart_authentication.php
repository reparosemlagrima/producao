<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class plgAuthenticationJcart_Authentication extends JPlugin
{	
	function onAuthenticate( $credentials, $options, &$response_joomla )
	{
		$this->onUserAuthenticate($credentials, $options, $response_joomla);
	}
	function onUserAuthenticate($credentials, $options, &$response_joomla)
	{
		$mainframe = JFactory::getApplication();
		if ($mainframe->isAdmin()) { // bypass plugin when logging in through administrator
			return true;
		}	
		if (!isset($_SESSION['customer_id']) && isset($credentials['username']) && isset($credentials['password'])){
			global $registry;
			require_once(JPATH_SITE."/components/com_jcart/index_mod.php");
			if(!isset($registry))
				require(JPATH_SITE."/components/com_jcart/index_mod.php");
			global $joomla_db;
			$db_jcart = $db;
			$email= $credentials['username'];
			$password=$credentials['password'];
			$joomla_user_id="";
			$address_id=0;
			$JConfig = new JConfig();
			$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."users where email like '". $joomla_db->escape(strtolower($email)) ."' OR username like '". $joomla_db->escape(strtolower($email)) ."'");
			if(!$result->num_rows){
				$customer_query = $db_jcart->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $db_jcart->escape(strtolower($email)) . "' AND status='1' AND approved='1' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $db_jcart->escape($password) . "'))))) OR password = '" . $db_jcart->escape(md5($password)) . "' OR password ='".$db_jcart->escape($password)."')");
				if ($customer_query->num_rows) { // if user exists in jCart but not in Joomla then input this user in Joomla too
					$data=array();
					$data["password"]=$db_jcart->escape($password);
					$data['email']=$email;
					$data['firstname']=$customer_query->row["firstname"];
					$data['lastname']=$customer_query->row["lastname"];
					$data['telephone']=$customer_query->row["telephone"];						
					$address_id=$customer_query->row["address_id"];
					if($address_id>0){
						$address_query=$db_jcart->query("SELECT * FROM " . DB_PREFIX . "address WHERE address_id ='".$db_jcart->escape($address_id)."'");
						if ($address_query->num_rows) {
							$data['address_1']=$address_query->row["address_1"];
							$data['address_2']=$address_query->row["address_2"];
							$data['city']=$address_query->row["city"];
							$data['postcode']=$address_query->row["postcode"];
							$data['zone_id']=$address_query->row["zone_id"];
							$data['country_id']=$address_query->row["country_id"];
							$data['fax']="";
							$data['newsletter']="";
							$data['company']="";
						}
					} // end if address id 				
					jimport("joomla.user.helper");
					// if user already not exists in joomla table,then insert new entry to joomla users table				
					if(version_compare(JVERSION, '1.6.0', '<' ) != 1){ //if joomla version is greater than>=1.6
						if(class_exists("JUserHelper")){
							$salt=JUserHelper::genRandomPassword(32);
							$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($data['password']),$salt);
							$encrypted_password=$crypt.":".$salt;
						}
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',username = '" . $joomla_db->escape($data['email']) . "',email = '" . $joomla_db->escape($data['email']) . "', password = '" . $encrypted_password . "', sendEmail = '1', registerDate = NOW()");
						$joomla_user_id=$joomla_db->getLastId();
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "user_usergroup_map SET group_id = '2',user_id = '" . $joomla_user_id . "'");
					}
					else{
						$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."core_acl_aro_groups where name ='Registered'");
						$user_group_id=$result->row["id"];
						if($user_group_id=="")
							$user_group_id=18;
						if(class_exists("JUserHelper")){
							$salt=JUserHelper::genRandomPassword(32);
							$crypt=JUserHelper::getCryptedPassword($joomla_db->escape($data['password']),$salt);
							$encrypted_password=$crypt.":".$salt;
						}
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "users SET name = '" . $joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname']) . "',username = '" . $joomla_db->escape($data['email']) . "',email = '" . $joomla_db->escape($data['email']) . "', usertype = 'Registered', password = '" . $encrypted_password . "', gid = '" . (int)$user_group_id . "', sendEmail = '1', registerDate = NOW()");
						$joomla_user_id=$joomla_db->getLastId();
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "core_acl_aro SET section_value = 'users',value = '" . $joomla_user_id . "',order_value = '0', name = '".$joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname'])."', hidden = '0'");
						$joomla_acl_aro_id=$joomla_db->getLastId();
						if(!$joomla_acl_aro_id){
							$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "core_acl_aro SET section_value = 'users',value = '" . $joomla_user_id . "',order_value = '0', name = '".$joomla_db->escape($data['firstname']) . " " . $joomla_db->escape($data['lastname'])."', hidden = '0'");
							$joomla_acl_aro_id=$joomla_db->getLastId();
						}
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "core_acl_groups_aro_map SET group_id = '".$user_group_id."',section_value = '',aro_id = '".$joomla_acl_aro_id."'");
						$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."core_acl_groups_aro_map where group_id='".$user_group_id."' and aro_id = '".$joomla_acl_aro_id."'");
						if($result->num_rows){
							//do nothing
						}
						else{
							$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "core_acl_groups_aro_map SET group_id = '".$user_group_id."',section_value = '',aro_id = '".$joomla_acl_aro_id."'");
						}
					} // end if joomla version check
					//Community Builder
					$result = $joomla_db->query("SHOW TABLES LIKE '".$JConfig->dbprefix."comprofiler'");
					if($result->num_rows){
						$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "comprofiler SET id = '".$joomla_user_id."',user_id = '".$joomla_user_id."'");
					}
									
					//joomla user profile integration	
					//run this script for only joomla >=1.6		
					if(version_compare(JVERSION, '1.6.0', '<' ) != 1 && isset($joomla_user_id) && $address_id>0){			
						//check whether user_profiles table exists
						$user_profile_result = $joomla_db->query("SHOW TABLES LIKE '".$JConfig->dbprefix."user_profiles'");
						if ($user_profile_result->num_rows){
							$profiles_entry_array[]=array("key"=>"address1","value"=>"address_1","ordering"=>"1");
							$profiles_entry_array[]=array("key"=>"address2","value"=>"address_2","ordering"=>"2");
							$profiles_entry_array[]=array("key"=>"city","value"=>"city","ordering"=>"3");
							$profiles_entry_array[]=array("key"=>"postal_code","value"=>"postcode","ordering"=>"6");
							$profiles_entry_array[]=array("key"=>"phone","value"=>"telephone","ordering"=>"7");
							//find zone name
							if(isset($data["zone_id"])){
								$result = $db_jcart->query("SELECT name FROM ".DB_PREFIX."zone where zone_id = '".(int)$data["zone_id"]."'");
								if($result->num_rows){
									$data["region"]=$result->row["name"];
									$profiles_entry_array[]=array("key"=>"region","value"=>"region","ordering"=>"4");				
								}
							}
							//find country name
							if(isset($data["country_id"])){
								$result = $db_jcart->query("SELECT name FROM ".DB_PREFIX."country where country_id = '".(int)$data["country_id"]."'");
								if($result->num_rows){
									$data["country"]=$result->row["name"];
									$profiles_entry_array[]=array("key"=>"country","value"=>"country","ordering"=>"5");				
								}
							}
							foreach($profiles_entry_array as $single_entry){
								if(isset($data[$single_entry["value"]]) && $data[$single_entry["value"]]!="" ){
									$result = $joomla_db->query("SELECT * FROM ".$JConfig->dbprefix."user_profiles where user_id = '".(int) $joomla_user_id."' and profile_key='profile.".$single_entry["key"]."'");
									if(!$result->num_rows){
										$joomla_db->query("INSERT INTO " . $JConfig->dbprefix . "user_profiles SET user_id = '".$joomla_user_id."',profile_key = 'profile.".$single_entry["key"]."',profile_value='\"".$data[$single_entry["value"]]."\"',ordering='".(int)$single_entry["ordering"]."'");
									}
									else{
										$joomla_db->query("UPDATE  " . $JConfig->dbprefix . "user_profiles SET profile_value='\"".$data[$single_entry["value"]]."\"' WHERE  user_id = '".$joomla_user_id."' and profile_key = 'profile.".$single_entry["key"]."'");
									}
								}//end if isset
							}//end foreach
						}//end if $user_profile_result(table)
					}//end if joomla version check
					//end joomla user profile integration				
					$response_joomla->email = $email;
					$response_joomla->fullname = $data['firstname'] . " " . $data['lastname'];
					if(defined("JAUTHENTICATE_STATUS_SUCCESS"))
					$response_joomla->status = JAUTHENTICATE_STATUS_SUCCESS;
					else
					$response_joomla->status = JAuthentication::STATUS_SUCCESS;
					$response_joomla->error_message = '';				
				}	// end if customer_query->num_rows
			}	// end if result->num_rows
		} // end if isset
		return true;		
	}
}
