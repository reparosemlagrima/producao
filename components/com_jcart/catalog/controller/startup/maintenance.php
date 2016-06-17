<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ControllerStartupMaintenance extends Controller {
	public function index() {
		if ($this->config->get('config_maintenance')) {
			$route = '';

			if (isset($this->request->get['route'])) {
				$part = explode('/', $this->request->get['route']);

				if (isset($part[0])) {
					$route .= $part[0];
				}
			}

			// Show site if logged in as admin
			$this->user = new Cart\User($this->registry);
			
			//Mainatance code change start
			jimport("joomla.user.helper");
			$joomla_user= JFactory::getUser();
			$allow_user="no";
			if($joomla_user->get('id')>0)
			{
				$j_config = new JConfig();
				global $joomla_db;
				$result = $joomla_db->query("SELECT * FROM ".$j_config->dbprefix."users where id= '".$joomla_user->get('id')."'");
				$user_type=$result->row["usertype"];
				if($user_type=="deprecated" || $user_type=="Super Administrator" || $user_type=="Administrator" || $user_type=="Manager"){
					$allow_user="yes";
				}
			}
			if (($route != 'payment' && $route != 'api') && !$this->user->isLogged() && $allow_user!="yes") {
				return new Action('common/maintenance');
			}
			//	Maintance code change stop			
		}
	}
}
