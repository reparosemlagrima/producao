<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ControllerModuleSagepayServerCards extends Controller {
	public function index() {
		if ($this->config->get('sagepay_server_cards_status') && $this->config->get('sagepay_server_status') && $this->customer->isLogged()) {
			$this->load->language('account/sagepay_server_cards');

			$data['text_card'] = $this->language->get('text_card');
			$data['card'] = $this->url->link('account/sagepay_server_cards', '', true);

			return $this->load->view('module/sagepay_server_cards', $data);
		}
	}

}