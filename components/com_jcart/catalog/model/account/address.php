<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ModelAccountAddress extends Model {
	public function addAddress($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$this->customer->getId() . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', city = '" . $this->db->escape($data['city']) . "', zone_id = '" . (int)$data['zone_id'] . "', country_id = '" . (int)$data['country_id'] . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "'");

		$address_id = $this->db->getLastId();

		if (!empty($data['default'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");
			//################START joomla user profile integration#############################	
			//find joomla_user_id if not $joomla_user_id variable already declared
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
						if(isset($data[$single_entry["value"]]) && $data[$single_entry["value"]]!="" ){							$result = $joomla_db->query("SELECT * FROM ".$j_config->dbprefix."user_profiles where user_id = '".(int) $joomla_user_id."' and profile_key='profile.".$single_entry["key"]."'");							if(!$result->num_rows){
								$joomla_db->query("INSERT INTO " . $j_config->dbprefix . "user_profiles SET user_id = '".$joomla_user_id."',profile_key = 'profile.".$single_entry["key"]."',profile_value='\"".$data[$single_entry["value"]]."\"',ordering='".(int)$single_entry["ordering"]."'");
							}
							else{
								$joomla_db->query("UPDATE  " . $j_config->dbprefix . "user_profiles SET profile_value='\"".$data[$single_entry["value"]]."\"' WHERE  user_id = '".$joomla_user_id."' and profile_key = 'profile.".$single_entry["key"]."'");
							}
						}//end isset
					}//end foreach
				}//end if $user_profile_result(table)
			}//end joomla version check
			//################END joomla user profile integration#############################	

		}

		return $address_id;
	}

	public function editAddress($address_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "address SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', city = '" . $this->db->escape($data['city']) . "', zone_id = '" . (int)$data['zone_id'] . "', country_id = '" . (int)$data['country_id'] . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "' WHERE address_id  = '" . (int)$address_id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");

		if (!empty($data['default'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");
			//################START joomla user profile integration#############################	
			//find joomla_user_id if not $joomla_user_id variable already declared
			global $joomla_db;						if(!isset($data['email']))
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
						}//end isset
					}//end foreach
				}//end if $user_profile_result(table)
			}//end joomla version check
			//################END joomla user profile integration#############################	
		}
	}

	public function deleteAddress($address_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE address_id = '" . (int)$address_id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");
	}

	public function getAddress($address_id) {
		$address_query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "address WHERE address_id = '" . (int)$address_id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");

		if ($address_query->num_rows) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$address_query->row['country_id'] . "'");

			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';
				$address_format = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$address_query->row['zone_id'] . "'");

			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}

			$address_data = array(
				'address_id'     => $address_query->row['address_id'],
				'firstname'      => $address_query->row['firstname'],
				'lastname'       => $address_query->row['lastname'],
				'company'        => $address_query->row['company'],
				'address_1'      => $address_query->row['address_1'],
				'address_2'      => $address_query->row['address_2'],
				'postcode'       => $address_query->row['postcode'],
				'city'           => $address_query->row['city'],
				'zone_id'        => $address_query->row['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $address_query->row['country_id'],
				'country'        => $country,
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format,
				'custom_field'   => json_decode($address_query->row['custom_field'], true)
			);

			return $address_data;
		} else {
			return false;
		}
	}

	public function getAddresses() {
		$address_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		foreach ($query->rows as $result) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$result['country_id'] . "'");

			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';
				$address_format = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$result['zone_id'] . "'");

			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}

			$address_data[$result['address_id']] = array(
				'address_id'     => $result['address_id'],
				'firstname'      => $result['firstname'],
				'lastname'       => $result['lastname'],
				'company'        => $result['company'],
				'address_1'      => $result['address_1'],
				'address_2'      => $result['address_2'],
				'postcode'       => $result['postcode'],
				'city'           => $result['city'],
				'zone_id'        => $result['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $result['country_id'],
				'country'        => $country,
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format,
				'custom_field'   => json_decode($result['custom_field'], true)

			);
		}

		return $address_data;
	}

	public function getTotalAddresses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		return $query->row['total'];
	}
}