<?php

include_once("database.php");

class Kachel {
	public $id;
	public $kachelorder;
	public $cssid;
	public $cssclass;
	public $options;
	public $content;
	public $active;
	public $kachelname;
	
	public function getHTML($asAdmin = false) {
		if (!$asAdmin)
		{
			return "<div class='".$this->cssclass."' id='".$this->cssid."' ".$this->options.">".$this->content."</div>";
		}
		else
		{
			return "<div class='adminkachel ".($this->active ? "active" : "inactive")."'><span>".$this->kachelname."</span></div>";
		}
	}
}

class Quicklink {
	public $id;
	public $qlorder;
	public $qltitle;
	public $qlcssid;
	public $qlcssclass;
	public $qlurl;
	public $active;
	
	public function getHTML($asAdmin = false) {
		if (!$asAdmin)
		{
			return "<a href='".$this->qlurl."' title='".$this->qltitle."'><div class='".$this->qlcssclass."' id='".$this->qlcssid."'></div></a>";
		}
		else
		{
			return "<div class='adminkachel ".($this->active ? "active" : "inactive")."'><span>".$this->qltitle."</span></div>";
		}
	}
}

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
				$quicklink = new Quicklink();		
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
				$kachel = new Kachel();		
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
	
	public function __construct($asAdmin = false) {
		$this->db = new DatabaseConnection();
		$this->adminmode = $asAdmin;
		$this->kacheln = $this->getKacheln();
		$this->quicklinks = $this->GetQuicklinks();
	}
	
	public function getKachelListHeaderHTML() {
		return "<div class='adminkachel'><span>Kacheln</span></div>"; 
	}	
	
	public function getQuicklinkListHeaderHTML() {
		return "<div class='adminkachel'><span>Quicklinks</span></div>"; 
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
}




?>