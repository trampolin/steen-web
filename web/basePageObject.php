<?php

include_once("database.php");

abstract class BasePageObject {
	protected $db;
	
	public $id;
	public $order;
	public $cssid;
	public $cssclass;
	public $active;
	public $title;
	
	public function toJson() {
		return json_encode($this);
	}
	
	public function __construct($aDb) {
		$this->db = $aDb;
		$this->id = null;
	}
	
	public function deactivate() {
		$this->active = 0;
		return $this->update();
	}	
	
	public function activate() {
		$this->active = 1;
		return $this->update();
	}
	
	public abstract function update();	
	
	public function getDB() {
		return $this->db;
	}
}

?>