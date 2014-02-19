<?php

require_once("basePageObject.php");

class Kachel extends BasePageObject {
	public $options;
	public $content;
	
	public function getHTML() {
		if (!$this->adminmode)
		{
			return "<div class='".$this->cssclass."' id='".$this->cssid."' ".$this->options.">".$this->content."</div>";
		}
		else
		{
			return 
				"<div class='adminkachel ".($this->active ? "active" : "inactive")."' id='kachel-".$this->id."'>".
					"<div class='adminkachel-content'>".
						"<span>".$this->title."</span>".
						"<div class='buttonbox'>".
							"<a href='#'><div class='adminbutton adminbutton-delete' onClick=''></div></a>".
							"<a href='#'><div class='adminbutton adminbutton-".($this->active ? "deactivate' onClick=''" : "activate' onClick=''")." id='adminbutton-kachel-".$this->id."'></div></a>".
						"</div>".
					"</div>".
				"</div>";
		}
	}
	
	public function __construct($aDb,$asAdmin) {
		parent::__construct($aDb,$asAdmin);
	}
	
	public static function select($db,$aid) {
		if ($aid != null) 
		{
			$result = new Kachel($db);
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
		$q = "SELECT * FROM kacheln WHERE id=".$this->id;
		$result = $this->db->query($q);
		if ($this->db->get_last_num_rows() > 0) {
			
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$this->cssid = $row['cssid'];
				$this->cssclass = $row['cssclass'];
				$this->options = $row['options'];
				$this->content = $row['content'];
				$this->order = $row['kachelorder'];
				$this->active = $row['active'];
				$this->title = $row['kachelname'];
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
			$q =	"UPDATE Kacheln SET ".
							"kachelorder=".$this->order.", ".
							"cssid='".$this->cssid."', ".
							"cssclass='".$this->cssclass."', ".
							"options='".$this->options."', ".
							"content='".$this->content."', ".
							"active=".$this->active.", ".
							"kachelname='".$this->title."' ".
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
			$q =	"DELETE FROM Kacheln WHERE id=".$this->id;
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
		$q =	"INSERT INTO Kacheln(kachelorder,cssid,cssclass,options,content,active,kachelname) VALUES(".
							$this->order.",".
						"'".$this->cssid."',".
						"'".$this->cssclass."',".
						"'".$this->options."',".
						"'".$this->content."',".
							$this->active.",".
						"'".$this->title."')";
						
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