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