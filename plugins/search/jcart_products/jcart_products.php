<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//Define the registerEvent and the language file. Replace 'jcart_products' with the name of your plugin.
$mainframe = JFactory::getApplication();
if ( version_compare(JVERSION, '1.6.0', '<' ) == 1) {
	$mainframe->registerEvent( 'onSearch', 'plgSearchjcart_products' );
	$mainframe->registerEvent( 'onSearchAreas', 'plgSearchjcart_productsAreas' );	
}
else{
	$mainframe->registerEvent( 'onContentSearch', 'plgSearchjcart_products' );
	$mainframe->registerEvent( 'onContentSearchAreas', 'plgSearchjcart_productsAreas' );	
}

//Define a function to return an array of search areas. Replace 'jcart_products' with the name of your plugin.
function &plgSearchjcart_productsAreas()
{
		 $areas = array(
                'jcart_products' => JText::_('Products')
        );
        return $areas;
}
 
//The real function has to be created. The database connection should be made. 
//The function will be closed with an } at the end of the file.
function plgSearchjcart_products( $text, $phrase='', $ordering='', $areas=null )
{
	if(file_exists(JPATH_SITE."/components/com_jcart/index_mod.php")){
		global $registry;
		require_once(JPATH_SITE."/components/com_jcart/index_mod.php");
		if(!isset($registry))
			require(JPATH_SITE."/components/com_jcart/index_mod.php");
		$url = $registry->get('url');
		$config=$registry->get('config');
		$query = "SELECT  p.*,'1' AS browsernav,a.name AS  title,a.product_id as product_id, p.image,a.description as description, m.name AS manufacturer, ss.name AS stock,              (SELECT AVG(r.rating) FROM " . DB_PREFIX . "review r WHERE p.product_id = r.product_id GROUP BY r.product_id) AS rating FROM " . DB_PREFIX . "product p
				  LEFT JOIN " . DB_PREFIX . "product_description a ON (p.product_id = a.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON
				  (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id)
				  LEFT JOIN " . DB_PREFIX . "stock_status ss ON (p.stock_status_id = ss.stock_status_id)
				  WHERE a.language_id = '" . (int)$config->get('config_language_id') . "' AND p2s.store_id = '" . (int)$config->get('config_store_id') . "'
				  AND ss.language_id = '" . (int)$config->get('config_language_id') . "'";
		//$db = JFactory::getDBO();
		$option = array(); //prevent problems 
		$option['driver']   = DB_DRIVER;            // Database driver name
		$option['host']     = DB_HOSTNAME;    // Database host name
		$option['user']     = DB_USERNAME;       // User for database authentication
		$option['password'] = DB_PASSWORD;   // Password for database authentication
		$option['database'] = DB_DATABASE;      // Database name
		$option['prefix']   = DB_PREFIX;             // Database prefix (may be empty)		 
		$db = JDatabaseDriver::getInstance( $option );
		$user = JFactory::getUser();

		//If the array is not correct, return it:
		if (is_array( $areas )) {
				if (!array_intersect( $areas, array_keys( plgSearchjcart_productsAreas() ) )) {
						return array();
				}
		}

		if(class_exists("JParameter")){
			//Define the parameters. First get the right plugin; 'search' (the group), 'jcart_products'. 
			$plugin = JPluginHelper::getPlugin('search', 'jcart_products');

			//Then load the parameters of the plugin.
			$pluginParams = new JParameter( $plugin->params );

			//Now define the parameters like this:
			$limit = $pluginParams->def( 'search_limit', 10 );
		 }
		 else{
		 	$limit = 10;
		 }
		//Use the function trim to delete spaces in front of or at the back of the searching terms
		$text = trim( $text );

		//Return Array when nothing was filled in.
		if ($text == '') {
				return array();
		}

		//After this, you have to add the database part. This will be the most difficult part, because this changes per situation.
		//In the coding examples later on you will find some of the examples used by Joomla! 1.5 core Search Plugins.
		//It will look something like this.
		$wheres = array();
		switch ($phrase) {

		//search exact
				case 'exact':
						$text          = $db->Quote( '%'.addslashes( $text ).'%', false );
						$wheres2       = array();
						$wheres2[]   = 'LOWER(a.name) LIKE LOWER('.$text.')';
						$wheres2[]   = 'LOWER(a.description) LIKE LOWER('.$text.')';
						$where                 = '(' . implode( ') OR (', $wheres2 ) . ')';
						break;

		//search all or any
				case 'all':
				case 'any':

		//set default
				default:
						$words         = explode( ' ', $text );
						$wheres = array();
						foreach ($words as $word)
						{
								$word          = $db->Quote( '%'.addslashes( $word ).'%', false );
								$wheres2       = array();
								$wheres2[]   = 'LOWER(a.name) LIKE LOWER('.$word.')';
								$wheres2[]   = 'LOWER(a.description) LIKE LOWER('.$word.')';
								$wheres[]    = implode( ' OR ', $wheres2 );
						}
						$where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
						break;
		}
		if(!isset($ordering))
		$ordering='alpha';
		//ordering of the results
		switch ( $ordering ) {

		//alphabetic, ascending
				case 'alpha':
						$order = 'a.name ASC';
						break;

		//oldest first
				case 'oldest':

		//popular first
				case 'popular':

		//newest first
				case 'newest':

		//default setting: alphabetic, ascending
				default:
						$order = 'a.name ASC';
		}


		$query .= " AND ". $where;

		$query .= " AND p.status = '1' AND p.date_available <= NOW()";

		//the database query; differs per situation! It will look something like this:


		$query = $query. ' ORDER BY '. $order;
		//echo $query;
		//Set query
		$db->setQuery( $query, 0, $limit );
		$rows = $db->loadObjectList();
				//The 'output' of the displayed link
				//$mdl_tl_seo=new ModelToolSeoUrl();
		if(is_array($rows))
		foreach($rows as $key => $row) {
				$rows[$key]->href = $url->link('product/product', 'product_id=' . $row->product_id);
				$rows[$key]->text=html_to_text($row->description);
				$rows[$key]->section=$row->model;
				$rows[$key]->created=$row->date_added;
				$rows[$key]->browsernav  = '0';
		}


		//Return the search results in an array
		return $rows;
	}//end if file exists
}

function html_to_text($document)
{
	$search = array ("'<script[^>]*?>.*?</script>'si",  // Strip out javascript
					 "'<[/!]*?[^<>]*?>'si",          // Strip out HTML tags
					 "'([rn])[s]+'",                // Strip out white space
					 "'&(quot|#34);'i",                // Replace HTML entities
					 "'&(amp|#38);'i",
					 "'&(lt|#60);'i",
					 "'&(gt|#62);'i",
					 "'&(nbsp|#160);'i",
					 "'&(iexcl|#161);'i",
					 "'&(cent|#162);'i",
					 "'&(pound|#163);'i",
					 "'&(copy|#169);'i",
					 "'&#(d+);'");                    // evaluate as php

	$replace = array ("",
					 "",
					 "",
					 "\"",
					 "&",
					 "<",
					 ">",
					 " ",
					 chr(161),
					 chr(162),
					 chr(163),
					 chr(169),
					 "chr(\1)");

	$text = preg_replace($search, $replace, $document);
	return $text;
}
?>