<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ControllerOpenbayEbay extends Controller {
	public function eventAddOrder($route, $data) {

	}

	public function eventAddOrderHistory($route, $order_id, $order_status_id, $comment = '', $notify = false, $override = false) {
		if (!empty($order_id)) {
			$this->load->model('openbay/ebay_order');

			$this->model_openbay_ebay_order->addOrderHistory($order_id);
		}
	}
}