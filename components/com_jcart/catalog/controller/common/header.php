<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class ControllerCommonHeader extends Controller {
	public function index() {
		// Analytics
		$this->load->model('extension/extension');

		$data['analytics'] = array();

		$analytics = $this->model_extension_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get($analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('analytics/' . $analytic['code'], $this->config->get($analytic['code'] . '_status'));
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . JCART_RELATIVE_URL . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . JCART_RELATIVE_URL . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');

		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}

		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['login'] = $this->url->link('account/login', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', true);
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} elseif (isset($this->request->get['information_id'])) {
				$class = '-' . $this->request->get['information_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}
		
		$title=$data['title'];
		$title=str_replace("&amp;","&",str_replace("&quot;","\"",$title));
		$description=$data['description'];
		$keywords=$data['keywords'];
		$document = JFactory::getDocument();
		// Add keywords,title,description withing oc compoenent
		if(isset($_REQUEST["option"]) && $_REQUEST["option"]=="com_jcart"){
			if(isset($_REQUEST["title1"]))
			$_REQUEST["title1"] = htmlspecialchars($_REQUEST["title1"]);
			if(isset($_REQUEST["title2"]))
			$_REQUEST["title2"] = htmlspecialchars($_REQUEST["title2"]);
			
			if ($description) {
				$document->setTitle($title);
				$document->setMetaData("title",$title);
				$document->setMetaData("description",$description);
			}
			else{
				$document->setTitle($title);
				$document->setMetaData("title",$title);
			}

			if ($keywords && isset($_REQUEST["title2"])) {
				if(!strstr($keywords,$_REQUEST["title2"].",")){
					$document->setMetaData("keywords",$_REQUEST["title2"].", ".$keywords);
				}
				else{

					$keywords=str_replace($_REQUEST["title2"].",","",$keywords);
					$document->setMetaData("keywords",$_REQUEST["title2"].", ".$keywords);
				}

			}
			elseif ($keywords) {
				$document->setMetaData("keywords",$keywords);
			}
			if(isset($_REQUEST["title1"]) && isset($_REQUEST["title2"]))
			{
				$document->setTitle($_REQUEST["title1"]." - ".$_REQUEST["title2"]);
				$document->setMetaData("description",$_REQUEST["title2"]." ".$description);
				$document->setMetaData("title",$_REQUEST["title1"]." - ".$_REQUEST["title2"]);
			}
		}
		if(method_exists($document,'setBase'))
		$document->setBase($data['base']);
		// Add script files,stylesheets within oc compoenent
		if(isset($_REQUEST["option"]) && $_REQUEST["option"]=="com_jcart"){
			if(method_exists($document,'addCustomTag'))
			$document->addCustomTag('<link href="'.JCART_COMPONENT_URL.'catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">');
			if(defined("USE_CUSTOM_COLOR_TEMPLATE")&& USE_CUSTOM_COLOR_TEMPLATE=="1"){
				ob_start();	
				require_once(DIR_SYSTEM."../catalog/view/theme/default/stylesheet/stylesheet.css.php");
				$mod_css_output = ob_get_contents();
				ob_end_clean();
				if(method_exists($document,'addCustomTag') && $mod_css_output !="")
				$document->addCustomTag($mod_css_output);
			}
			if(isset($document->_scripts[JURI::base() . '/media/system/js/mootools-more.js']))
			unset($document->_scripts[JURI::base() . '/media/system/js/mootools-more.js']);			
			
		} elseif(!isset($_REQUEST["option"]) || $_REQUEST["option"]!="com_jcart"){ // Add script files,stylesheets for Joomla modules
			if(defined("DONT_INCLUDE_JQUERY_JCART") && DONT_INCLUDE_JQUERY_JCART!="1" && DONT_INCLUDE_JQUERY_JCART!="3"){
				if(method_exists($document,'addScript'))
				$document->addScript(JCART_COMPONENT_URL.'catalog/view/javascript/jquery/jquery-2.1.1.min.js');
			}

			if(defined("DONT_INCLUDE_JQUERY_JCART") && DONT_INCLUDE_JQUERY_JCART!="2" && DONT_INCLUDE_JQUERY_JCART!="3"){
				if(method_exists($document,'addScript'))
				$document->addScript(JCART_COMPONENT_URL.'catalog/view/javascript/bootstrap/js/bootstrap.min.js');
			}
			
			if(method_exists($document,'addScript')){			
				foreach ($data['scripts'] as $script) { 
					$document->addScript(JCART_COMPONENT_URL.$script);
				}
			}
			
			if(method_exists($document,'addStyleSheet')){
				$document->addStyleSheet(JCART_COMPONENT_URL."catalog/view/javascript/bootstrap/css/bootstrap.min.css");
				foreach ($data['styles'] as $style) { 
					$document->addStyleSheet(JCART_COMPONENT_URL . $style['href']);
				}			
			}
			
			if(method_exists($document,'addCustomTag'))
			$document->addCustomTag('<script type="text/javascript">http_serv_url_oc="'.HTTP_SERVER.'";item_id_oc="'.str_replace("&","&amp;",ITEM_ID).'";'.((defined("USE_JQUERY_DOLLAR_JCART") && USE_JQUERY_DOLLAR_JCART=="1")?'$=':'').'jQuery.noConflict();</script>');
		
			if(method_exists($document,'addScript'))
			$document->addScript(JCART_COMPONENT_URL.'catalog/view/javascript/common.js');
		}
		
		return $this->load->view('common/header', $data);
	}
}
