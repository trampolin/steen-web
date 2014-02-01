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
