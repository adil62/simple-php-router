<?php

class Router{

	private $request;
	private $supported_methods = array("GET","POST");

	function __construct(Irequest $request){
		$this->request = $request;
	}

	function __call($method ,$args){
		if (in_array(strtoupper($method), $this->supported_methods)) {
			list($uri,$action) = $args;
			$this->{ strtolower($method) }[$this->formatRoute($uri)] = $action;
		} else {
			echo "unsupported method";
		}
	} 

	public function formatRoute($uri) {
		$res = rtrim($uri, '/');
	
		if ($res === '') {
			return '/';
		}	
	
		return $res;
	}

	public function resolve() {
		$method = $this->{strtolower($this->request->REQUEST_METHOD)};
		$formatedRoute = $this->formatRoute($this->request->REQUEST_URI);
		$callback = $method[$formatedRoute];

		if(is_null($method)){
      		echo "404 not found";

			return ;
		}
		
        echo call_user_func_array($callback, array($this->request));
	}

	function __destruct(){
	    $this->resolve();
	}

}