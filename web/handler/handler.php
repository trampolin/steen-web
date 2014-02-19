<?php

require_once("database.php");
require_once("pageControl.php");

function handleRequest() {
	$_WHERE = $_POST;
	
	$pageControl = new PageControl(true);
	$action = isset($_WHERE['action']) ? $_WHERE['action'] : null;
	$loggedin = isset($_WHERE['loggedin']) ? $_WHERE['loggedin'] : null;
	if (($loggedin != null && $loggedin == 1) || ($action == 'login'))
	{
		
		$id = isset($_WHERE['id']) ? $_WHERE['id'] : null;
		$mode = isset($_WHERE['mode']) ? $_WHERE['mode'] : null;
		
		$result = null;
		
		switch ($action) {
			case "login":
				$user = isset($_WHERE['user']) ? $_WHERE['user'] : null;
				$password = isset($_WHERE['pass']) ? $_WHERE['pass'] : null;
				$result = new LoginResponse($user);
				return $result->toJson();
				break;
			case "update":
				$result = "update: ";
				break;
			case "activate":
				switch ($mode) {
					case "quicklink":
						$ql = $pageControl->getQuicklinkByID($id);
						if ($ql != null)
						{								
							$ql->activate();
							return $ql->getLastResponse();							
						};
						return $pageControl->getLastResponse();
				};
				break;
			case "deactivate":
				switch ($mode) {
					case "quicklink":
						$ql = $pageControl->getQuicklinkByID($id);
						if ($ql != null)
						{								
							$ql->deactivate();
							return $ql->getLastResponse();							
						};
						return $pageControl->getLastResponse();
				};
				break;
			case "remove":
				switch ($mode) {
					case "quicklink":
						$ql = $pageControl->getQuicklinkByID($id);
						
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
		$result = new ErrorResponse("Not logged in or login params wrong");
		return json_encode($result);
	}
}

echo handleRequest();

?>