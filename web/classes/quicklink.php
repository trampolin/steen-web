<?php

require_once(ROOT_DIR."/classes/basePageObject.php");

class Quicklink extends BasePageObject {
	public $url;
	
	
	public function getHTML() {
		if (!$this->adminmode)
		{
			return "\n<a href='".$this->url."' title='".$this->title."'><div class='".$this->cssclass."' id='".$this->cssid."'></div></a>";
		}
		else
		{
			return 	
				"<div class='adminkachel ".($this->active ? "active" : "inactive")."' id='quicklink-".$this->id."'>".
					"<div class='adminkachel-content'>".
						"<span>".$this->title."</span>".
						"<div class='buttonbox'>".
							"<div class='adminbutton adminbutton-delete' onClick='removeQuicklink(".$this->id.")'></div>".
							"<div class='adminbutton adminbutton-".($this->active ? "deactivate' onClick='deactivateQuicklink(".$this->id.")'" : "activate' onClick='activateQuicklink(".$this->id.")'")." id='adminbutton-quicklink-".$this->id."'></div>".
						"</div>".
					"</div>".
				"</div>";
		}
	}
	
	public function __construct($aDb,$asAdmin) {
		parent::__construct($aDb,$asAdmin);
	}
	
	public static function select($db,$aid,$asAdmin = true) {
		if ($aid != null) 
		{
			$result = new Quicklink($db,$asAdmin);
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
				$this->order = $row['qlorder'];
				$this->title = $row['qltitle'];
				$this->cssid = $row['qlcssid'];
				$this->cssclass = $row['qlcssclass'];
				$this->url = $row['qlurl'];
				$this->active = $row['active'];
			}
			$this->createResponse("Refresh ok");
			return true;
		}
		else
		{
			$this->createError("Refresh fehlgeschlagen (Empty)");
			return false;
		}
	}
	
	public function update() {
		if ($this->id != null) 
		{
			$q =	"UPDATE Quicklinks SET ".
							"qlorder=".$this->order.", ".
							"qltitle='".$this->title."', ".
							"qlcssid='".$this->cssid."', ".
							"qlcssclass='".$this->cssclass."', ".
							"qlurl='".$this->url."', ".
							"active=".$this->active." ".
						"WHERE id=".$this->id;
			$success = $this->db->query($q); 
			if ($success)
			{
				$this->createResponse("Update ok");
			}
			else
			{
				$this->createError("Update fehlgeschlagen (Query)");
			}
			return $success;
		}
		else
		{
			createError("Update fehlgeschlagen");
			return false;
		}
	}
	
	public function remove() {
		if ($this->id != null) {
			$q = "DELETE FROM Quicklinks WHERE id=".$this->id;
			$success = $this->db->query($q); 
			if ($success)
			{
				$this->createResponse("Remove ok");
			}
			else
			{
				$this->createError("Remove fehlgeschlagen (Query)");
			}
			return $success;
		}
		else
		{
			createError("Remove fehlgeschlagen");
			return false;
		}
	}
	
	public function insert() {
		$q = "INSERT INTO Quicklinks(qlorder,qltitle,qlcssid,qlcssclass,qlurl,active) VALUES(".
							$this->order.",".
						"'".$this->title."',".
						"'".$this->cssid."',".
						"'".$this->cssclass."',".
						"'".$this->url."',".
							$this->active.")";
		$success = $this->db->query($q); 
		if ($success)
		{
			$this->createResponse("Insert ok");
		}
		else
		{
			$this->createError("Insert fehlgeschlagen (Query)");
		}
		return $success;
	}
}

?>