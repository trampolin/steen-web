<?php

include_once("basePageObject.php");

class Kachel extends BasePageObject {
	public $options;
	public $content;
	
	public function getHTML($asAdmin = false) {
		if (!$asAdmin)
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
							"<a href='#'><div class='adminbutton adminbutton-".($this->active ? "deactivate' onClick=''" : "activate' onClick=''")."></div></a>".
						"</div>".
					"</div>".
				"</div>";
		}
	}
	
	public function __construct($aDb) {
		parent::__construct($aDb);
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
				$this->order = $row['kachelorder'];
				$this->active = $row['active'];
				$this->title = $row['kachelname'];
			}
			
			return true;
		}
		else
		{
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
							$this->order.",".
						"'".$this->cssid."',".
						"'".$this->cssclass."',".
						"'".$this->options."',".
						"'".$this->content."',".
							$this->active.",".
						"'".$this->title."')";
		return $this->db->query($q);
	}
}

?>