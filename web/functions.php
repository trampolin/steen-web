<?php

include_once("database.php");
include_once("kachel.php");
include_once("quicklink.php");

class PageControl {
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
				$quicklink = new Quicklink($this->db);		
				$quicklink->qlcssid = $row['qlcssid'];
				$quicklink->id = $row['id'];
				$quicklink->qlcssclass = $row['qlcssclass'];
				$quicklink->qlorder = $row['qlorder'];
				$quicklink->active = $row['active'];
				$quicklink->qltitle = $row['qltitle'];
				$quicklink->qlurl = $row['qlurl'];
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
				$kachel = new Kachel($this->db);		
				$kachel->cssid = $row['cssid'];
				$kachel->id = $row['id'];
				$kachel->cssclass = $row['cssclass'];
				$kachel->options = $row['options'];
				$kachel->content = $row['content'];
				$kachel->kachelorder = $row['kachelorder'];
				$kachel->active = $row['active'];
				$kachel->kachelname = $row['kachelname'];
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
		return "\n<div class='adminkachel'><span>Kacheln</span></div>"; 
	}	
	
	public function getQuicklinkListHeaderHTML() {
		return "\n<div class='adminkachel'><span>Quicklinks</span></div>"; 
	}
	
	public function getKachelListHTML() {
		$result = "";
		foreach($this->kacheln as $kachel) 
		{ 
			$result = $result.$kachel->getHTML($this->adminmode);
		}
		return $result;
	}
	
	public function getQuicklinkListHTML() {
		$result = "";
		foreach($this->quicklinks as $quicklink) 
		{ 
			$result = $result.$quicklink->getHTML($this->adminmode);
		}
		return $result;
	}
	
	public function toJson() {
		return json_encode($this);
	}
}




?>