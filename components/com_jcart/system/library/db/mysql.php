<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
namespace DB;
defined( '_JEXEC' ) or die( 'Restricted access' );
final class MySQL {
	private $connection;

	public function __construct($hostname, $username, $password, $database, $port = '3306') {
		$j_config=new \JConfig();		
		if($j_config->db!=DB_DATABASE && $j_config->host==DB_HOSTNAME && $j_config->user==DB_USERNAME && $j_config->password==DB_PASSWORD){			
			if (!$this->connection = @mysql_connect($hostname . ':' . $port, $username, $password,true)) {
				$_SESSION["wrong_db_info"]="yes";
				if(!$this->connection = mysql_connect($j_config->host . ':' . $port, $j_config->user, $j_config->password)) {
				throw new \Exception('Error: Could not connect to database ' . $database);
				}
			}
		}
		elseif (!$this->connection = @mysql_connect($hostname . ':' . $port, $username, $password)) {
			$_SESSION["wrong_db_info"]="yes";
			if(!$this->connection = mysql_connect($j_config->host . ':' . $port, $j_config->user, $j_config->password)) {
				throw new \Exception('Error: Could not connect to database ' . $database);
			}
    	}

    	if (!@mysql_select_db($database, $this->connection)) {
			$_SESSION["wrong_db_info"]="yes";
			if (!mysql_select_db($j_config->db, $this->connection)) {
			throw new \Exception('Error: Could not connect to database ' . $database);
		}
    	}
		mysql_query("SET NAMES 'utf8'", $this->connection);
		mysql_query("SET CHARACTER SET utf8", $this->connection);
		mysql_query("SET CHARACTER_SET_CONNECTION=utf8", $this->connection);
		mysql_query("SET SQL_MODE = ''", $this->connection);
	}

	public function query($sql) {
		if ($this->connection) {
			$resource = mysql_query($sql, $this->connection);

			if ($resource) {
				if (is_resource($resource)) {
					$i = 0;

					$data = array();

					while ($result = mysql_fetch_assoc($resource)) {
						$data[$i] = $result;

						$i++;
					}

					mysql_free_result($resource);

					$query = new \stdClass();
					$query->row = isset($data[0]) ? $data[0] : array();
					$query->rows = $data;
					$query->num_rows = $i;

					unset($data);

					return $query;
				} else {
					return true;
				}
			} else {
				$trace = debug_backtrace();

				throw new \Exception('Error: ' . mysql_error($this->connection) . '<br />Error No: ' . mysql_errno($this->connection) . '<br /> Error in: <b>' . $trace[1]['file'] . '</b> line <b>' . $trace[1]['line'] . '</b><br />' . $sql);
			}
		}
	}

	public function escape($value) {
		if ($this->connection) {
			return @mysql_real_escape_string($value, $this->connection);
		}
	}

	public function countAffected() {
		if ($this->connection) {
			return mysql_affected_rows($this->connection);
		}
	}

	public function getLastId() {
		if ($this->connection) {
			return mysql_insert_id($this->connection);
		}
	}
	
	public function isConnected() {
		if ($this->connection) {
			return true;
		} else {
			return false;
		}
	}
	
	public function __destruct() {
		if ($this->connection) {
			@mysql_close($this->connection);
		}
	}
}