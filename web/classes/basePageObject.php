<?php

require_once("database.php");
require_once("responseTypes.php");

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
		if ($this->active !=  0)
		{
			$this->createError("Already activated");
		}
		else
		{
			$this->active = 1;
			$success = $this->update(); 
			if ($success)
			{
				$this->createResponse("Activation ok");
			}
			else
			{
				$this->createError("Activation failed");
			}
			return $success;
		}
	}
	
	public function deactivate() {
		if ($this->active ==  0)
		{
			$this->createError("Already deactivated");
		}
		else
		{
			$this->active = 0;
			$success = $this->update(); 
			if ($success)
			{
				$this->createResponse("Deactivation ok");
			}
			else
			{
				$this->createError("Deactivation failed");
			}
			return $success;
		}
	}
	
	public abstract function update();	
	public abstract function getHTML();
	
	public function getDB() {
		return $this->db;
	}
	
	public function getLastResponse($useJson = true) {
		if ($this->lastResponse === null) 
		{
			$this->createError("No response available");
		}
		
		if ($useJson) 
		{
			return $this->lastResponse->toJson();
		}
		else
		{
			return $this->lastResponse;
		}
	}
	
	public function createError($message) {
		$this->lastResponse = new IDErrorResponse($message,$this->id);
		return $this->lastResponse;
	}
	
	public function createResponse($message, $result = "ok") {
		$this->lastResponse = new ItemResponse($result,$message,$this->id,$this->getHTML(),$this);
		return $this->lastResponse;
	}
}

?>