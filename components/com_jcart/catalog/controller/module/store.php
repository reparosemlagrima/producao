<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ControllerModuleStore extends Controller {
	public function index() {
		$status = true;

		if ($this->config->get('store_admin')) {
			$this->user = new Cart\User($this->registry);

			$status = $this->user->isLogged();
		}

		if ($status) {
			$this->load->language('module/store');

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_store'] = $this->language->get('text_store');

			$data['store_id'] = $this->config->get('config_store_id');

			$data['stores'] = array();

			$data['stores'][] = array(
				'store_id' => 0,
				'name'     => $this->language->get('text_default'),
				'url'      => HTTP_SERVER . 'index.php?option=com_jcart&'.ITEM_ID.'route=common/home&session_id=' . $this->session->getId()
			);

			$this->load->model('setting/store');

			$results = $this->model_setting_store->getStores();

			foreach ($results as $result) {
				$data['stores'][] = array(
					'store_id' => $result['store_id'],
					'name'     => $result['name'],
					'url'      => $result['url'] . 'index.php?option=com_jcart&'.ITEM_ID.'route=common/home&session_id=' . $this->session->getId()
				);
			}

			global $replace_module_output_check_array;
			$replace_module_output_check_array[]=array('search'=>'<div class="panel-heading">'.(isset($data['heading_title'])?$data['heading_title']:"").'</div>','replace'=>'','existing_var'=>'heading_title');
			return $this->load->view('module/store', $data);
		}
	}
}
