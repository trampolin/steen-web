<?php
	
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

class ItemResponse extends HTMLResponse {
	public $items;
	
	public function __construct($result,$message,$id,$html,$items) {
		parent::__construct($result,$message,$id,$html);
		
		if (is_array($items))
		{
			$this->items = $items;		
		}
		else
		{
			$this->items = array();
			$this->items[] = $items;
		}

	}
}

class LoginResponse extends BasicResponse {
	public $user;

	public function __construct($user) {
		$this->user = $user;
	
		if ($this->user == null || $this->user=="")
		{
			parent::__construct("nok","login failed");
		}
		else
		{
			parent::__construct("ok","login success");
		}
		
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

?>
