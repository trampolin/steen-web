<?php

include_once("database.php");
include_once("pageControl.php");

function handleRequest() {
	$_WHERE = $_POST;
	
	$pageControl = new PageControl(true);

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
						$ql = Quicklink::select($pageControl->getDB(),$id);
						if ($ql != null)
						{								
							if($ql->activate()) {
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
						$ql = Quicklink::select($pageControl->getDB(),$id);
						
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