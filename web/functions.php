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
	
	public function getHTML() {
		return "<div class='".$this->cssclass."' id='".$this->cssid."' ".$this->options.">".$this->content."</div>";
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
	
	public function getHTML() {
		return "<a href='".$this->qlurl."' title='".$this->qltitle."'><div class='".$this->qlcssclass."' id='".$this->qlcssid."'></div></a>";
	}
}

function GetQuicklinks($adminmode = false) {
	$db = new DatabaseConnection();
	
	$where = $adminmode ? "" : "WHERE active=1 ";
	
	$q = "SELECT * FROM quicklinks " . $where . "ORDER BY qlorder ASC";
	
	$result = $db->query($q);
	if ($db->get_last_num_rows() > 0) {
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

function GetKacheln($adminmode = false) {
	$db = new DatabaseConnection();
	
	$where = $adminmode ? "" : "WHERE active=1 ";
	
	$q = "SELECT * FROM kacheln " . $where . "ORDER BY kachelorder ASC";
	
	$result = $db->query($q);
	if ($db->get_last_num_rows() > 0) {
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

?>