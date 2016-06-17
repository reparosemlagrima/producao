<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2015 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$mainframe = JFactory::getApplication();
if ($mainframe->isAdmin()) {
	if($use_separate_db!="Yes"){
		if(!function_exists("mysql_query"))
		$joomla_db = JFactory::getDBO();
		if(!class_exists("JConfig"))
		require_once(JPATH_SITE."/configuration.php");
		$j_config=new JConfig();
		$host=$j_config->host;
		$user=$j_config->user;
		$pass=$j_config->password;
		$dbname=$j_config->db;
	}
	if(function_exists("mysql_query")){
		$con=@mysql_connect($host,$user,$pass);
		@mysql_query('SET names=utf8');
		@mysql_query('SET character_set_client=utf8');
		@mysql_query('SET character_set_connection=utf8');
		@mysql_query('SET character_set_results=utf8');
		@mysql_query('SET collation_connection=utf8_general_ci');
		if($con!=false){
			@mysql_select_db($dbname,$con);
		}
	}
	if($db_file_name!="")
	$filename=dirname(__FILE__).$db_file_name;
	$ignoreerrors=true;
	$file_content = file($filename);
	$query = "";
	foreach($file_content as $sql_line) {
		$tsl = trim($sql_line);
		if (($tsl != "") && (strpos($tsl, "--") != 0 || strpos($tsl, "--") != 1) && (substr($tsl, 0, 1) != "#")) {
			$query .= $sql_line;
			if(preg_match("/;\s*$/", $sql_line)) {
				if(function_exists("mysql_query")){
					$result = @mysql_query($query);
					if (!$result && !$ignoreerrors) die(mysql_error());
					if (!$result && !$ignoreerrors){
						$sqlErrorCode = mysql_errno();
						$sqlErrorText = mysql_error();
						echo $sqlErrorCode.$sqlErrorText;
					}
				}
				else{
					$joomla_db->setQuery($query);
					$result = $joomla_db->query();
				}
				$query = "";
			}
		}
	}
}
?>
