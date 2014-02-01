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
	
	public function activate() {
		$this->active = 1;
		$success = $this->update(); 
		if ($success)
		{
			$this->lastResponse == new HTMLResponse("ok",null,$this->id,$this->getHTML());
		}
		else
		{
			$this->doError("Activation failed");
		}
		return $success;
	}
	
	public function deactivate() {
		$this->active = 0;
		$success = $this->update(); 
		if ($success)
		{
			$this->lastResponse == new HTMLResponse("ok",null,$this->id,$this->getHTML());
		}
		else
		{
			$this->doError("Deactivation failed");
		}
		return $success;
	}
	
	public abstract function update();	
	public abstract function getHTML();
	
	public function getDB() {
		return $this->db;
	}
	
	public function getLastResponse($useJson = true) {
		/*if ($this->lastResponse === null) 
		{
			$this->doError("No response available");
		}*/
		
		if ($useJson) 
		{
			return $this->lastResponse->toJson();
		}
		else
		{
			return $this->lastResponse;
		}
	}
	
	public function doError($message) {
		$this->lastResponse = new IDErrorResponse($message,$this->id);
	}
}

?>