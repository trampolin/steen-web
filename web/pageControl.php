<?php

include_once("database.php");
include_once("kachel.php");
include_once("quicklink.php");

class PageControl {
	private $lastResponse;
	private $db;
	public $adminmode;
	public $kacheln;
	public $quicklinks;
	
	private function GetQuicklinks() {
		$where = $this->adminmode ? "" : "WHERE active=1 ";
		$q = "SELECT * FROM quicklinks " . $where . "ORDER BY qlorder ASC";
		$result = $this->db->query($q);
		if ($this->db->get_last_num_rows() > 0) {
			$content = array();
			
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$quicklink = new Quicklink($this->db,$this->adminmode);		
				$quicklink->cssid = $row['qlcssid'];
				$quicklink->id = $row['id'];
				$quicklink->cssclass = $row['qlcssclass'];
				$quicklink->order = $row['qlorder'];
				$quicklink->active = $row['active'];
				$quicklink->title = $row['qltitle'];
				$quicklink->url = $row['qlurl'];
				$content[] = $quicklink;
			}
			
			return $content;		
		}
		else
		{
			return null;
		}
	}
	
	private function GetKacheln() {
		$where = $this->adminmode ? "" : "WHERE active=1 ";
		
		$q = "SELECT * FROM kacheln " . $where . "ORDER BY kachelorder ASC";
		
		$result = $this->db->query($q);
		if ($this->db->get_last_num_rows() > 0) {
			$content = array();
			
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$kachel = new Kachel($this->db,$this->adminmode);		
				$kachel->cssid = $row['cssid'];
				$kachel->id = $row['id'];
				$kachel->cssclass = $row['cssclass'];
				$kachel->options = $row['options'];
				$kachel->content = $row['content'];
				$kachel->order = $row['kachelorder'];
				$kachel->active = $row['active'];
				$kachel->title = $row['kachelname'];
				$content[] = $kachel;
			}
			
			return $content;		
		}
		else
		{
			return null;
		}
	}
	
	public function getDB() {
		return $this->db;
	}
	
	public function __construct($asAdmin = false) {
		$this->db = new DatabaseConnection();
		$this->adminmode = $asAdmin;
		$this->kacheln = $this->getKacheln();
		$this->quicklinks = $this->GetQuicklinks();
	}
	
	public function getKachelListHeaderHTML() {
		return "\n<div class='adminkachel'><span>Kacheln</span>".
			"<a href='#'><div class='adminbutton adminbutton-add' onClick=''></div></a>".
		"</div>"; 
	}	
	
	public function getQuicklinkListHeaderHTML() {
		return "\n<div class='adminkachel'><span>Quicklinks</span>".
			"<a href='#'><div class='adminbutton adminbutton-add' onClick='addLocalQuicklink()'></div></a>".
		"</div>"; 
	}
	
	public function getKachelListHTML() {
		$result = "<div id='kachelliste'>";
		foreach($this->kacheln as $kachel) 
		{ 
			$result .= $kachel->getHTML($this->adminmode);
		}
		$result .= "</div>";
		return $result;
	}
	
	public function getQuicklinkListHTML() {
		$result = "<div id='quicklinkliste'>";
		foreach($this->quicklinks as $quicklink) 
		{ 
			$result = $result.$quicklink->getHTML($this->adminmode);
		}
		$result .= "</div>";
		return $result;
	}
	
	public function getQuicklinkWrapperWidth() {
		$width = 0;
		foreach ($this->quicklinks as $quicklink) {
			if($quicklink->active == 1) {
				$width++;
			}
		};
		return ($width*64)+($width*32);
	}
	
	public function getKachelByID($aid) {		
		foreach ($this->kacheln as $kachel) {
			if($kachel->id == $aid) {
				return $kachel;
			}
		};
		$this->createError("Kachel ".$aid." not found!");
		return null;
	}
	
	public function getQuicklinkByID($aid) {		
		foreach ($this->quicklinks as $quicklink) {
			if($quicklink->id == $aid) {
				return $quicklink;
			}
		};
		$this->createError("Quicklink ".$aid." not found!");
		return null;
	}
	
	public function toJson() {
		return json_encode($this);
	}
	
	public function createError($message) {
		$this->lastResponse = new ErrorResponse($message);
		return $this->lastResponse;
	}
	
	public function createQuicklinkResponse($message = null) {
		$this->lastResponse = new ItemResponse("ok",$message,null,$this->getQuicklinkListHTML(),$this->quicklinks);
		return $this->lastResponse;
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
}




?>