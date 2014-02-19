<?php

require_once(ROOT_DIR."/classes/basePageObject.php");

class Gig extends BasePageObject {
	public $url;
	public $datum;
	public $city;
	public $venue;
	public $info;
	
	public function getTitle() {
		$d = new DateTime($this->datum);
		return mb_strtoupper(date_format($d, 'd.m.Y H:i')." - ".$this->city." - ".$this->venue);
	}
	
	public function getHTML() {
		if (!$this->adminmode)
		{	
			return "\n<li class='gigtickeritem'><a href='".$this->url."'>".$this->getTitle()."</a></li>";
		}
		else
		{
			return "\n";	
		}
	}
	
	public function __construct($aDb,$asAdmin) {
		parent::__construct($aDb,$asAdmin);
	}
	
	public static function select($db,$aid,$asAdmin = true) {
		if ($aid != null) 
		{
			$result = new Gig($db,$asAdmin);
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
		$q = "SELECT * FROM gigs WHERE id=".$this->id;
		$result = $this->db->query($q);
		if ($this->db->get_last_num_rows() > 0) {
			
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$this->url = $row['url'];
				$this->active = $row['active'];
				$this->datum = $row['datum'];
				$this->city = $row['stadt'];
				$this->venue = $row['club'];
				$this->info = $row['info'];
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
			$q =	"UPDATE gigs SET ".
							"datum=".$this->datum.", ".
							"stadt='".$this->city."', ".
							"club='".$this->venue."', ".
							"url='".$this->url."', ".
							"info='".$this->info."', ".
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
			$q = "DELETE FROM gigs WHERE id=".$this->id;
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
		$q = "INSERT INTO gigs(datum,stadt,club,url,info,active) VALUES(".
							$this->datum.",".
						"'".$this->city."',".
						"'".$this->venue."',".
						"'".$this->url."',".
						"'".$this->info."',".
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