<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ControllerModuleSagepayDirectCards extends Controller {
	public function index() {
		if ($this->config->get('sagepay_direct_cards_status') && $this->config->get('sagepay_direct_status') && $this->customer->isLogged()) {
			$this->load->language('account/sagepay_direct_cards');

			$data['text_card'] = $this->language->get('text_card');
			$data['card'] = $this->url->link('account/sagepay_direct_cards', '', true);

			return $this->load->view('module/sagepay_direct_cards', $data);
		}
	}

}