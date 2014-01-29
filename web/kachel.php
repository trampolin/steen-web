<?php

include_once("database.php");

class Kachel {
	private $db;
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
			return "\n<div class='".$this->cssclass."' id='".$this->cssid."' ".$this->options.">".$this->content."</div>";
		}
		else
		{
			return "\n<div class='adminkachel ".($this->active ? "active" : "inactive")."' id='kachel-".$this->id."'><span>"
				.$this->kachelname."</span>".
				"<div class='adminbutton adminbutton-".($this->active ? "deactivate' onClick='handleRequest(1,".$this->id.",\"deactivate\")'" : "activate' onClick='handleRequest(1,".$this->id.",\"activate\")'")."></div>".
				"<div class='adminbutton adminbutton-delete' onClick='handleRequest(1,".$this->id.",\"delete\",{\"bla\": \"blub\"})'></div>".
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
				//$kachel = new Kachel($this->db);		
				$this->cssid = $row['cssid'];
				$this->cssclass = $row['cssclass'];
				$this->options = $row['options'];
				$this->content = $row['content'];
				$this->kachelorder = $row['kachelorder'];
				$this->active = $row['active'];
				$this->kachelname = $row['kachelname'];
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
			$q =	"UPDATE Kacheln SET ".
							"kachelorder=".$this->kachelorder.", ".
							"cssid='".$this->cssid."', ".
							"cssclass='".$this->cssclass."', ".
							"options='".$this->options."', ".
							"content='".$this->content."', ".
							"active=".$this->active.", ".
							"kachelname='".$this->kachelname."' ".
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
			$q =	"DELETE FROM Kacheln WHERE id=".$this->id;
			return $this->db->query($q);
		}
		else
		{
			return false;
		}
	}
	
	public function insert() {
		$q =	"INSERT INTO Kacheln(kachelorder,cssid,cssclass,options,content,active,kachelname) VALUES(".
								$this->kachelorder.",".
						"'".$this->cssid."',".
						"'".$this->cssclass."',".
						"'".$this->options."',".
						"'".$this->content."',".
								$this->active.",".
						"'".$this->kachelname."')";
		return $this->db->query($q);
	}
}

?>