<?php 
class Router{
	private $request;
	private $supported_methods = array("GET","POST");

	function __construct(Irequest $request){
		$this->request = $request;
	}
	function __call($method ,$args){
		if ( in_array(strtoupper($method), $this->supported_methods) ) {
			list($uri,$action) = $args;
			$this->{ strtolower($method) }[$this->formatRoute($uri)] = $action;

		}else{
			echo "unsupported method";
		}
	} 
	public function formatRoute($uri){
		$res = rtrim($uri, '/');
		if($res === ''){
			return '/';
		}	
		return $res;
	}
	public function resolve(){
		//get request method
		//get request route associated callback 
		// echo "<br><br><br><br><br>";
		// echo "<br><br><br><br><br>";
		// var_dump($this);
		$method           = $this->{strtolower($this->request->REQUEST_METHOD)};
		$formatedRoute    = $this->formatRoute($this->request->REQUEST_URI);
		$callback         = $method[$formatedRoute];
		// echo '<br>REQUEST->URI:'.$this->request->REQUEST_URI;
		// print_r($method);
		// echo "formatted route is :".$formatedRoute;
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