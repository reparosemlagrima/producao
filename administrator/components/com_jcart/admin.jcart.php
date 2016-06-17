<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2015 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if(version_compare(JVERSION, '1.6.0', '<' ) != 1){
	// Access check. for joomla 1.6
	if (!JFactory::getUser()->authorise('core.manage', 'com_jcart'))
	{
		return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	}
}
//set joomla toolbar header
JToolBarHelper::title( '<table style="display: inline-block;background-color:#F4F4F4;border-radius:5px;padding-left:8px;padding-right:12px;"><tr><td><img src="../components/com_jcart/image/data/shopping_cart.png" /></td><td><big><big><a style="text-decoration:none;color:#006BB7;" target="_blank" href="http://www.soft-php.com">jCart</a></big></big></td></tr></table>', 'jcart' );
if(!isset($_SESSION["version_checked"])){
	$content="";
	$post_url= "http://www.soft-php.com/index.php";
	$post_data="option=com_softphp&pgn=api/check_version&servername=".$_SERVER['HTTP_HOST'];
	if(function_exists("curl_init")){
		$c = curl_init($post_url);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($c, CURLOPT_VERBOSE, 0);
		curl_setopt($c, CURLOPT_HEADER, 0);
		curl_setopt($c, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($c, CURLOPT_POST, 1);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 10 );
		curl_setopt($c, CURLOPT_TIMEOUT, 10 );
		if(!ini_get('safe_mode') && function_exists("set_time_limit")){
			set_time_limit(120);
		}
		$content = @curl_exec($c);
	}
	else{
		$content = @file_get_contents("http://www.soft-php.com/index.php?option=com_softphp&pgn=api/check_version&servername=".$_SERVER['HTTP_HOST']);
	}
	
	if(trim($content)==""){
		$content = @file_get_contents("http://www.soft-php.com/index.php?option=com_softphp&pgn=api/check_version&servername=".$_SERVER['HTTP_HOST']);
	
	}
	$_SESSION["version_checked"]="yes";
}

if(isset($_SESSION["version_checked"])){
	//if click to upgrade link then include upgrade file
    if(isset($_REQUEST["upgn"]) && file_exists("../components/com_jcart/".$_REQUEST["upgn"].".php")){
		require_once("../components/com_jcart/".$_REQUEST["upgn"].".php");
	}//checking upgrade installtion folder uploaded or not.If yes,then upgrade link will be visible
	elseif(file_exists("../components/com_jcart/install/upgrade.php")){
		echo "<div align='left' ><h2>Install folder exists(".$_SERVER['DOCUMENT_ROOT'].str_replace("administrator","", dirname($_SERVER['SCRIPT_NAME']))."components/com_jcart/install).<br/>Please to upgrade click <a style='color:red'  href='index.php?option=com_jcart&upgn=install/upgrade'>Here</a><br/> Otherwise remove the folder (".$_SERVER['DOCUMENT_ROOT'].str_replace("administrator","", dirname($_SERVER['SCRIPT_NAME']))."components/com_jcart/install)</h2></div>";

	}
	else{
		//checking upgrade installtion folder uploaded or not.If Not,then include jCart  ouptput using obstart.
		require_once('../components/com_jcart/admin/config.php');
		if(isset($_REQUEST["route"])){
			//start writing jcart code to new extension
			if($_REQUEST["route"]=="extension/module/install" || $_REQUEST["route"]=="extension/shipping/install" || $_REQUEST["route"]=="extension/payment/install" || $_REQUEST["route"]=="extension/total/install" || $_REQUEST["route"]=="extension/feed/install" || ($_REQUEST["route"]=="setting/setting" &&  isset($_REQUEST["config_theme"]) && $_REQUEST["config_theme"]!="theme_default")){
				//if new extension or template is installed then write jcart code to all previously existing module files
				global $replace_files_array;
				//add new left/right extensions(module) code for joomla module
				if($_REQUEST["route"]=="extension/module/install"){
					$flnm = "catalog/controller/module/".$_REQUEST["extension"].".php";
					$srch='if (file_exists(DIR_TEMPLATE . $this->config->get(\'theme_default_directory\') . \'/template/module/';
					$rplc='global $replace_module_output_check_array;
		$replace_module_output_check_array[]=array(\'search\'=>\'<h3>\'.(isset($data[\'heading_title\'])?$data[\'heading_title\']:"").\'</h3>\',\'replace\'=>\'\',\'existing_var\'=>\'heading_title\');
		if (file_exists(DIR_TEMPLATE . $this->config->get(\'theme_default_directory\') . \'/template/module/';
					$existingvar="global ";

					$replace_files_array[]=array(
	'file'=>$flnm,'search'=>$srch,'replace'=>$rplc,'existing_var'=>$existingvar);
	
				}

				foreach($replace_files_array as $single_file){
					$file_name = JCART_COMPONENT_DIR.''.$single_file["file"];
					$fh = fopen($file_name, 'r');
					$file_contents = file_get_contents($file_name);
					fclose($fh);
					if(!strstr($file_contents,$single_file["existing_var"]) && file_exists($file_name) && strstr($file_contents,$single_file["search"])){
						$file_contents=str_replace($single_file["search"],$single_file["replace"],$file_contents);
						$fh = fopen($file_name, 'w') or die("can't open file");
						fwrite($fh, $file_contents);
						fclose($fh);
					}
				}
				//if new template is installed then write jcart code to template css file and column_left/right.tpl file
				if($_REQUEST["route"]=="setting/setting" &&  isset($_REQUEST["config_theme"]) && $_REQUEST["config_theme"]!=""){
					$template_name=$_REQUEST["config_theme"];
					if($template_name == "theme_default")
					$template_name = "default";
					global $replace_templates_files_array;
					$css_file_names=array('catalog/view/theme/'.$template_name.'/stylesheet/stylesheet.css','catalog/view/theme/'.$template_name.'/stylesheet/ie7.css','catalog/view/theme/'.$template_name.'/stylesheet/ie6.css');
					$change_template_file="No";
					foreach($css_file_names as $css_f_name){
						$file_name = JCART_COMPONENT_DIR.$css_f_name;
						$file_contents="";
						if(file_exists($file_name)){
							$fh = fopen($file_name, 'r');
							$file_contents = file_get_contents($file_name);
							fclose($fh);
						}
						if(!strstr($file_contents,"content-oc") && file_exists($file_name)){
							foreach($replace_templates_files_array as $key=>$value){
								$file_contents=str_replace($key,$value,$file_contents);
							}
							$fh = fopen($file_name, 'w') or die("can't open file");
							fwrite($fh, $file_contents);
							fclose($fh);
							$change_template_file="Yes";
						}
					}
					if($change_template_file=="Yes"){
						$file_name = JCART_COMPONENT_DIR.'catalog/view/theme/'.$template_name.'/template/common/column_left.tpl';
						if(file_exists($file_name)){
							$fh = fopen($file_name, 'w') or die("can't open file");
							fwrite($fh, "");
							fclose($fh);
						}

						$file_name = JCART_COMPONENT_DIR.'catalog/view/theme/'.$template_name.'/template/common/column_right.tpl';
						if(file_exists($file_name)){
							$fh = fopen($file_name, 'w') or die("can't open file");
							fwrite($fh, "");
							fclose($fh);
						}
					}
				}
				//if new extension  is installed then write jcart code to specific module file
				$file_name="";
				if($_REQUEST["route"]=="extension/payment/install"){
					$file_name = JCART_COMPONENT_DIR.'catalog/controller/payment/'.$_REQUEST["extension"].".php";
				}
				elseif($_REQUEST["route"]=="extension/module/install"){
				$file_name = JCART_COMPONENT_DIR.'catalog/controller/module/'.$_REQUEST["extension"].".php";
				}
				elseif($_REQUEST["route"]=="extension/feed/install"){
				$file_name = JCART_COMPONENT_DIR.'catalog/controller/feed/'.$_REQUEST["extension"].".php";
				}
				if($file_name!=""){
					$fh = fopen($file_name, 'r');
					$file_contents = file_get_contents($file_name);
					fclose($fh);

					if(!strstr($file_contents,"com_jcart") && strstr($file_contents,"index.php?route=") && file_exists($file_name)){
						$file_contents=str_replace("index.php?route=","index.php?option=com_jcart&'.ITEM_ID.'route=",$file_contents);
						$fh = fopen($file_name, 'w') or die("can't open file");
						fwrite($fh, $file_contents);
						fclose($fh);
					}

				}
			}//end writing jcart code to new extension
		}//end if isset($_REQUEST["route"])

		//check token
		if(isset($_GET["token"]))
			$_SESSION["token"]=$_GET["token"];
		if(isset($_SESSION["token"])&&!isset($_GET["token"]))
			$_GET["token"]=$_SESSION["token"];

		//echo opencart output in joomla
		global $replace_outputs_array;
		$prevcurdir=getcwd();
		ob_start();
		chdir(JCART_COMPONENT_DIR.'admin');
		require_once("index.php");
		$output = ob_get_contents();
		ob_end_clean();
		chdir($prevcurdir);
		foreach($replace_outputs_array as $key=>$value){
			$output=str_replace($key,$value,$output);
		}
		global $replace_outputs_check_array;
		foreach($replace_outputs_check_array as $single_array){
			if(strstr($output,$single_array["existing_var"])){
				$output=str_replace($single_array["search"],$single_array["replace"],$output);
			}
		}
		echo $output;

		//set joomla toolbar sub menu items
		$component="com_jcart";

		//checking permission
		if (isset($session->data['user_id'])) {
			$user_query = $db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$session->data['user_id'] . "' AND status = '1'");
			$user_group_query =$db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");
			$permissions = $user_group_query->row['permission'];

			$permissions =(unserialize($permissions));
			if(in_array("setting/setting",$permissions["modify"])){
				$modify_permission="Yes";
			}
		}

		//if($modify_permission=="Yes"){//show preferences if user has permission to modify setting
			if(version_compare(JVERSION, '1.6.0', '<' ) != 1){
				// Access check. for joomla 1.6
				if (JFactory::getUser()->authorise('core.admin', 'com_jcart'))
				{
					JToolBarHelper::preferences($component, '350', '570');
				}
			}
			else{
				JToolBarHelper::preferences($component, '350', '570');
			}
			
		//}

		if (isset($session->data['user_id'])) {//show submenus in toolbar if user is logged in
			$joomla_toolbar_submenus = array();
			$menu = JToolBar::getInstance('submenu');

			if(in_array("catalog/category",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_category'),'route'=>'catalog/category');

			if(in_array("catalog/product",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_product'),'route'=>'catalog/product');

			if(in_array("extension/module",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_module'),'route'=>'extension/module');

			if(in_array("extension/shipping",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_shipping'),'route'=>'extension/shipping');

			if(in_array("extension/payment",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_payment'),'route'=>'extension/payment');

			if(in_array("sale/order",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_order'),'route'=>'sale/order');

			if(in_array("sale/customer",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_customer'),'route'=>'sale/customer');

			if(in_array("setting/store",$permissions["access"]))
			$joomla_toolbar_submenus[]=array('name'=>$language->get('text_setting'),'route'=>'setting/store');


			foreach($joomla_toolbar_submenus as $sub_menu){
				$menu->appendButton($sub_menu["name"], "index.php?option=".$component."&route=".$sub_menu["route"], true);

			}
		}
		//end joomla toolbar
		$bar = JToolBar::getInstance('toolbar');
		$bar->appendButton( 'Link', 'help', 'Support', 'http://www.soft-php.com/support.html' );
		if (isset($_REQUEST['tmpl'])) {
			if($_REQUEST['tmpl']=="component")
				exit();
		}
	}//end if(if click to upgrade link then include upgrade file)


}//end if(version checked)
?>
