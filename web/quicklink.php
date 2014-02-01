<?php

include_once("database.php");

class Quicklink {
	private $db;
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
			return "\n<a href='".$this->qlurl."' title='".$this->qltitle."'><div class='".$this->qlcssclass."' id='".$this->qlcssid."'></div></a>";
		}
		else
		{
			return 	"<div class='adminkachel ".($this->active ? "active" : "inactive")."' id='quicklink-".$this->id."'>".
					"<div class='adminkachel-content'>".
						"<span>".$this->qltitle."</span>".
						"<div class='buttonbox'>".
							"<a href='#'><div class='adminbutton adminbutton-delete' onClick='removeQuicklink(".$this->id.")'></div></a>".
							"<a href='#'><div class='adminbutton adminbutton-".($this->active ? "deactivate' onClick='deactivateQuicklink(".$this->id.")'" : "activate' onClick='activateQuicklink(".$this->id.")'")."></div></a>".
						"</div>".
					"</div>".
				"</div>";
		}
	}
	
	public function __construct($aDb) {
		$this->db = $aDb;
		$this->id = null;
	}
	
	public function toJson() {
		return json_encode($this);
	}
	
	public static function select($db,$aid) {
		if ($aid != null) 
		{
			$result = new Quicklink($db);
			$result->id = $aid;
			if ($result->refresh())
			{
				return $result;
			}
			else
			{
				return null;
			}
		}
		else
		{
			return null;
		}
	}
	
	public function refresh() {
		$q = "SELECT * FROM Quicklinks WHERE id=".$this->id;
		$result = $this->db->query($q);
		if ($this->db->get_last_num_rows() > 0) {
			
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$this->qlorder = $row['qlorder'];
				$this->qltitle = $row['qltitle'];
				$this->qlcssid = $row['qlcssid'];
				$this->qlcssclass = $row['qlcssclass'];
				$this->qlurl = $row['qlurl'];
				$this->active = $row['active'];
			}
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function deactivate() {
		$this->active = 0;
		return $this->update();
	}	
	
	public function activate() {
		$this->active = 1;
		return $this->update();
	}
	
	public function update() {
		if ($this->id != null) 
		{
			$q =	"UPDATE Quicklinks SET ".
							"qlorder=".$this->qlorder.", ".
							"qltitle='".$this->qltitle."', ".
							"qlcssid='".$this->qlcssid."', ".
							"qlcssclass='".$this->qlcssclass."', ".
							"qlurl='".$this->qlurl."', ".
							"active=".$this->active." ".
						"WHERE id=".$this->id;
			return $this->db->query($q);
		}
		else
		{
			return false;
		}
	}
	
	public function remove() {
		if ($this->id != null) {
			$q =	"DELETE FROM Quicklinks WHERE id=".$this->id;
			return $this->db->query($q);
		}
		else
		{
			return false;
		}
	}
	
	public function insert() {
		$q =	"INSERT INTO Quicklinks(qlorder,qltitle,qlcssid,qlcssclass,qlurl,active) VALUES(".
								$this->qlorder.",".
						"'".$this->qltitle."',".
						"'".$this->qlcssid."',".
						"'".$this->qlcssclass."',".
						"'".$this->qlurl."',".
								$this->active.")";
		return $this->db->query($q);
	}
}

?>