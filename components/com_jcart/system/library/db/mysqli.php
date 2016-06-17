<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2016 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
namespace DB;
defined( '_JEXEC' ) or die( 'Restricted access' );
final class MySQLi {
	private $connection;

	public function __construct($hostname, $username, $password, $database, $port = '3306') {
		if(strstr($hostname, ".sock") && strstr($hostname, ":")) {
			$socket = '';
			$host_name = explode(":", $hostname);
		    if(count($host_name) == 3 && !is_numeric($host_name[2])){
				$hostname =$host_name[0] . ":" .$host_name[1];
				$socket = $host_name[2];
			} elseif(count($host_name) == 2 && !is_numeric($host_name[1])) {
				$hostname =$host_name[0];
				$socket = $host_name[1];
			}			
			$this->connection = new \mysqli($hostname, $username, $password, $database, $port, $socket);
		} else {
			$host_name = explode(":", $hostname);
			if(count($host_name) == 2 && is_numeric($host_name[1])) {
				$hostname =$host_name[0];
				$port = $host_name[1];
			}
			$this->connection = new \mysqli($hostname, $username, $password, $database, $port);
		}

		if ($this->connection->connect_error) {
		$_SESSION["wrong_db_info"]="yes";
		$j_config=new \JConfig();
		if(isset($this->connection))
		unset($this->connection);
		$this->connection = new \mysqli($j_config->host, $j_config->user, $j_config->password, $j_config->db, $port);			
		if ($this->connection->connect_error)
			throw new \Exception('Error: Could not connect to database ' . $database);
		}

		$this->connection->set_charset("utf8");
		$this->connection->query("SET SQL_MODE = ''");
	}

	public function query($sql) {
		$query = $this->connection->query($sql);

		if (!$this->connection->errno) {
			if ($query instanceof \mysqli_result) {
				$data = array();

				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}

				$result = new \stdClass();
				$result->num_rows = $query->num_rows;
				$result->row = isset($data[0]) ? $data[0] : array();
				$result->rows = $data;

				$query->close();

				return $result;
			} else {
				return true;
			}
		} else {
			throw new \Exception('Error: ' . $this->connection->error  . '<br />Error No: ' . $this->connection->errno . '<br />' . $sql);
		}
	}

	public function escape($value) {
		return $this->connection->real_escape_string($value);
	}
	
	public function countAffected() {
		return $this->connection->affected_rows;
	}

	public function getLastId() {
		return $this->connection->insert_id;
	}
	
	public function connected() {
		return $this->connection->connected();
	}
	
	public function __destruct() {
		if($this->connection)
		$this->connection->close();
	}
}