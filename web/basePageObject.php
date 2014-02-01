<?php

include_once("database.php");
include_once("responseTypes.php");

abstract class BasePageObject {
	protected $db;
	protected $adminmode;
	
	protected $lastResponse;
	
	public $id;
	public $order;
	public $cssid;
	public $cssclass;
	public $active;
	public $title;
	
	public function toJson() {
		return json_encode($this);
	}
	
	public function __construct($aDb,$asAdmin) {
		$this->db = $aDb;
		$this->id = null;
		$this->adminmode = $asAdmin;
		$this->lastResponse = null;
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
	
	public function getLastResponse($useJson = true) {
		if ($lastResponse === null) 
		{
			$this->doError("No response available");
		}
		
		if ($useJson) 
		{
			return $lastResponse->toJson();
		}
		else
		{
			return $lastResponse;
		}
	}
	
	public function doError($message) {
		$lastResponse = new IDErrorResponse($message,$this->id);
	}
}

?>