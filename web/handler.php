<?php

include_once("database.php");
include_once("functions.php");

class BasicResponse {
	public $result;
	public $message;
}

class IDResponse extends BasicResponse {
	public $id;
}

function handleRequest() {
	$_WHERE = $_POST;
	
	$db = new DatabaseConnection();

	$loggedin = isset($_WHERE['loggedin']) ? $_WHERE['loggedin'] : null;
	if ($loggedin != null && $loggedin == 1)
	{
		$action = isset($_WHERE['action']) ? $_WHERE['action'] : null;
		$id = isset($_WHERE['id']) ? $_WHERE['id'] : null;
		$mode = isset($_WHERE['mode']) ? $_WHERE['mode'] : null;
		
		
		
		switch ($action) {
			case "update":
				$result = "update: ";
				break;
			case "activate":
				$result =  "activate: ";
				break;
			case "deactivate":
				$result =  "deactivate: ";
				break;
			case "remove":
				switch ($mode) {
					case "quicklink":
						$ql = Quicklink::select($db,$id);
						
						if ($ql != null)
						{	$result["id"] = $id;
							if($ql->remove()) {
								$result = new IDResponse();
								$result->result = "ok";
								$result->id = $id;
								return json_encode($result);
							}
							else
							{
								$result = new IDResponse();
								$result->result = "nok";
								$result->id = $id;
								$result->message = "fehlschlag";
								return json_encode($result);
							}
						}						
						break;
					default:
								$result = new IDResponse();
								$result->result = "nok";
								$result->id = $id;
								$result->message = "fehlschlag";
								return json_encode($result);
						break;
				};
				break;
			default:
				$result["result"] = "nok";
		};
		
		return json_encode($result);
	}
	else
	{
		$result["result"] = "nok";
		return json_encode($result);
	}
}

echo handleRequest();

?>