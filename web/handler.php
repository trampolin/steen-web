<?php

include_once("database.php");
include_once("functions.php");

class BasicResponse {
	public $result;
	public $message;
	
	public function toJson()
	{
		return json_encode($this);
	}
	
	public function __construct($result,$message) {
		$this->result = $result;
		$this->message = $message;
	}
}

class IDResponse extends BasicResponse {
	public $id;	
	
	public function __construct($result,$message,$id) {
		parent::__construct($result,$message);
		$this->id = $id;
	}
}

class HTMLResponse extends IDResponse {
	public $html;
	
	public function __construct($result,$message,$id,$html) {
		parent::__construct($result,$message,$id);
		$this->html = $html;
	}

}

class ErrorResponse extends BasicResponse {
	public function __construct($message) {
		parent::__construct("nok",$message);
	}
}

class IDErrorResponse extends ErrorResponse {
	public $id;
	
	public function __construct($message,$id) {
		parent::__construct($message);
		$this->id = $id;
	}
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
		
		$result = null;
		
		switch ($action) {
			case "update":
				$result = "update: ";
				break;
			case "activate":
				switch ($mode) {
					case "quicklink":
						$ql = Quicklink::select($db,$id);
						if ($ql != null)
						{	
							$ql->active = 1;
							if($ql->update()) {
								$result = new HTMLResponse("ok",null,$id,$ql->getHTML(true));
								return json_encode($result);
							}
							else
							{
								$result = new IDErrorResponse("Activate failed",$id);
								return json_encode($result);
							}								
						};
						$result = new IDErrorResponse("Quicklink not found",$id);
						return json_encode($result);
						break;
				};
				break;
			case "deactivate":
				$result =  "deactivate: ";
				break;
			case "remove":
				switch ($mode) {
					case "quicklink":
						$ql = Quicklink::select($db,$id);
						
						if ($ql != null)
						{	
							if($ql->remove()) {
								$result = new IDResponse("ok",null,$id);
								return json_encode($result);
							}
							else
							{
								$result = new IDErrorResponse("Remove failed",$id);
								return json_encode($result);
							}
						};
						$result = new IDErrorResponse("Quicklink not found",$id);
						return json_encode($result);					
						break;
					default:
						$result = new IDErrorResponse("Wrong mode",$id);
						return json_encode($result);
						break;
				};
				break;
			default:
				$result = new IDErrorResponse("Wrong action",$id);
		};
		
		return json_encode($result);
	}
	else
	{
		$result = new IDErrorResponse("Error",$id);
		return json_encode($result);
	}
}

echo handleRequest();

?>