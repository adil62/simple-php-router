<?php 

use App\Interfaces\IRequest;
// require_once('Irequest.php');

class Request implements Irequest{
	
	function __construct(){
		// when creating instance of Request add all properties of $_SERVER array as properties to the instance
		$this->bootstrapSelf();
	}

	private function bootstrapSelf() {
		foreach ($_SERVER as $key => $value) {
			$this->{$key} = $value; 
		}
	}

	public function getbody(){
		if ($this->REQUEST_METHOD === "GET") {
       		return;
    	} elseif ($this->REQUEST_METHOD === "POST") {
    		foreach ($_POST as $key => $value) {
    			$body[$key] =  filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    		}
	
			return $body;
    	}
	}
}