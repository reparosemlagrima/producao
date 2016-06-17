<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

global $mainframe;
$mainframe = JFactory::getApplication();
//Define the registerEvent and the language file. Replace 'jcart_products' with the name of your plugin.


if ( version_compare(JVERSION, '1.6.0', '<' ) == 1) {
	$mainframe->registerEvent( 'onLoginUser', 'plgjcart_user_login' );
	$mainframe->registerEvent( 'onLogoutUser', 'plgjcart_user_logout' );
	
	$mainframe->registerEvent( 'onAfterStoreUser', 'plgjcart_user_store' );
	$mainframe->registerEvent( 'onBeforeStoreUser', 'plgjcart_user_before_store' );
	$mainframe->registerEvent( 'onAfterDeleteUser', 'plgjcart_user_delete' );
	 
}
else{
	$mainframe->registerEvent( 'onUserLogin', 'plgjcart_user_login' );
	$mainframe->registerEvent( 'onUserLogout', 'plgjcart_user_logout' );
	
	$mainframe->registerEvent( 'onUserAfterSave', 'plgjcart_user_store' );
	$mainframe->registerEvent( 'onUserBeforeSave', 'plgjcart_user_before_store' );
	$mainframe->registerEvent( 'onUserAfterDelete', 'plgjcart_user_delete' );
}

 
function plgjcart_user_login($user, $options = array())
{
	global $mainframe;
	if ($mainframe->isAdmin()) { // bypass plugin when logging in through administrator
		return true;
	}
	if(isset($user['password'])){
		$_SESSION['user_salt'] = $salt = substr(md5(uniqid(rand(), true)), 0, 9);
		$_SESSION['jcart_password'] = sha1($salt . sha1($salt . sha1($user['password'])));		
	}
	return true;
}


function plgjcart_user_logout($user, $options = array())
{
	global $mainframe;
	if ($mainframe->isAdmin()) { // bypass plugin when logging in through administrator
		return true;
	}
	if(isset($_SESSION["customer_id"]))
	unset($_SESSION["customer_id"]);
	if(isset($_SESSION["cart"]))
	unset($_SESSION["cart"]);
	if(isset($_SESSION["wishlist"]))
	unset($_SESSION["wishlist"]);
	
	return true;
}
function plgjcart_user_before_store($old_user, $isnew, $new_user)
{
	if(!$isnew){
		require_once(JPATH_SITE."/components/com_jcart/index_mod.php");
		global 	$db_jcart;	
		$db_jcart = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
		$db_jcart->query("UPDATE " . DB_PREFIX . "customer SET email='".$db_jcart->escape($new_user['email'])."' WHERE email = '" . $db_jcart->escape($old_user['email']) . "'");	
	}
}

function plgjcart_user_store($user, $isnew, $succes, $msg)
{
	global $registry;
	require_once(JPATH_SITE."/components/com_jcart/index_mod.php");
	if(!isset($registry))
		require(JPATH_SITE."/components/com_jcart/index_mod.php");
	$data = array();
	$data['username']	= $user['username'];
	$data['email'] 		= $user['email'];
	$data['fullname']	= $user['name'];
	$data['password']	= $user['password'];
	$salt = substr(md5(uniqid(rand(), true)), 0, 9);
	$jcart_password = sha1($salt . sha1($salt . sha1($data['password'])));
	
	//find first name and  last name from fullname
	$name=explode(" ",$data['fullname']);
	$fname=$name[0];
	$lname="";
	if(count($name)>1){
		for($i=1;$i<count($name);$i=$i+1){
			if($i==1)
				$lname=$name[$i];
			else{
					$lname=$lname." ".$name[$i];
				}
		}
	}
	
	//connect to jcart database	
	global 	$db_jcart;	
	$db_jcart = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
	
	if(isset($user["block"])){
		$data['status']=$user["block"]=="1"?"0":"1";
		
		$status_str = ", status ='".$data['status']."',approved='".$data['status']."' ";
	}
	else
	$status_str="";
	//check whether jCart user exists with joomla user email id.
	
	$customer_query = $db_jcart->query("SELECT * FROM " . DB_PREFIX . "customer WHERE email = '" . $db_jcart->escape($data['email']) . "'");
	
	if ($customer_query->num_rows) {
		//If jcart user is existed with joomla  email id,then update jcart users information including password
		$db_jcart->query("UPDATE " . DB_PREFIX . "customer SET salt='".$db_jcart->escape($salt)."', password = '" . $db_jcart->escape($jcart_password) . "',firstname = '" . $db_jcart->escape($fname) . "', lastname = '" . $db_jcart->escape($lname) . "' ".$status_str.",email='".$db_jcart->escape($data['email'])."' WHERE email = '" . $db_jcart->escape($data['email']) . "'");	
		
	}
	else{
		//If jcart user not existed with joomla user id or email id,then insert new jcart user same as joomla logged user.
		$data['telephone']="";
		$data['fax']="";
		$data['newsletter']="";
		$data['company']="";
		$data['address_1']="";
		$data['address_2']="";
		$data['country_id']="";
		$data['zone_id']="";
		if(isset($user["postcode"]))
			$data['postcode']=$user["postcode"];
		else
			$data['postcode']="";
		$data['city']="";	
		$config=$registry->get('config');	
		if(!isset($default_customer_group_id))
		$default_customer_group_id = $config->get('config_customer_group_id');
		//insert data to jcart users table
		$db_jcart->query("INSERT INTO " . DB_PREFIX . "customer SET firstname = '" . $db_jcart->escape($fname) . "', lastname = '" . $db_jcart->escape($lname) . "', email = '" . $db_jcart->escape($data['email']) . "', telephone = '" . $db_jcart->escape($data['telephone']) . "', fax = '" . $db_jcart->escape($data['fax']) . "', salt='".$db_jcart->escape($salt)."', password = '" . $db_jcart->escape($jcart_password) . "', newsletter = '" . $db_jcart->escape($data['newsletter']) . "', customer_group_id = '".$default_customer_group_id ."', status = '".$data['status']."',approved='".$data['status']."' , date_added = NOW()");
		// $customer_id = $db_jcart->getLastId();
		// input an address for this customer in address table
		// $db_jcart->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $db_jcart->escape($fname) . "', lastname = '" . $db_jcart->escape($lname) . "', company = '" . $db_jcart->escape($data['company']) . "', address_1 = '" . $db_jcart->escape($data['address_1']) . "', address_2 = '" . $db_jcart->escape($data['address_2']) . "', city = '" . $db_jcart->escape($data['city']) . "', postcode = '" . $db_jcart->escape($data['postcode']) . "', country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "'");
		
		// $address_id = $db_jcart->getLastId();
		// update the address id with customer id
		// $db_jcart->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");	
	}
	
	return true;
	
}


function plgjcart_user_delete($user, $succes, $msg)
{
	require_once(JPATH_SITE."/components/com_jcart/index_mod.php");
	global 	$db_jcart;	
	$db_jcart = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
	
	$customer_id=-1;
	if($db_jcart->escape($user["email"])!=""){
		$result = $db_jcart->query("SELECT customer_id FROM ".DB_PREFIX . "customer where email = '".$db_jcart->escape($user["email"])."'");
		if($result->num_rows){
			$customer_id=$result->row["customer_id"];			
			$db_jcart->query("DELETE FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
			$db_jcart->query("DELETE FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");
			$db_jcart->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "'");
			$db_jcart->query("DELETE FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$customer_id . "'");
			$db_jcart->query("DELETE FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");			
		}
		
	}	
	return true;
}

?>