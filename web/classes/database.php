<?php

require_once("config/db.php");

class DatabaseConnection {
	var $dblink;
	var $result;
	var $num_rows;
	
	function __construct() {
			$this->dblink = mysql_connect(DB_HOST, DB_USER, DB_PASS);
		mysql_select_db(DB_NAME);
	}

	function query($query) {
		$this->result = mysql_query($query);
		if (!$this->result) {
			$this->num_rows = 0;
		} else if (is_bool($this->result)){
			$this->num_rows = 0;
		} else {
			$this->num_rows = mysql_num_rows($this->result);
		}
		return $this->result;
	}	
	
	function get_last_result() {
		return $this->result;
	}
	
	function get_last_num_rows() {
		return $this->num_rows;
	}
	
	function __destruct() {
		mysql_close($this->dblink);
	}
	
}

?>