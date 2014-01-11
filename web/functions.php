<?php

include_once("database.php");

class Kachel {
	public $kachelorder;
	public $cssid;
	public $cssclass;
	public $options;
	public $content;
	public $active;
}

function GetKacheln() {
	$db = new DatabaseConnection();
	
	$result = $db->query("SELECT * FROM kacheln WHERE active=1 ORDER BY kachelorder ASC");
	if ($db->get_last_num_rows() > 0) {
		$content = array();
		
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$kachel = new Kachel();		
			$kachel->cssid = $row['cssid'];
			$kachel->cssclass = $row['cssclass'];
			$kachel->options = $row['options'];
			$kachel->content = $row['content'];
			$kachel->kachelorder = $row['kachelorder'];
			$kachel->active = $row['active'];
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