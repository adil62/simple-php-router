<?php 

use App\Router;
use App\Request;

// require_once('router.php');
// require_once('request.php');

$router = new Router(new Request());

$router->get('/php/router/about',function(){

  return "viewABOUT PAGE";
});


$router->get('/php/router', function() {
  return <<<HTML
    <h1>Hello world</h1>
  HTML;
});

$router->get('/about', function() {

  return "about";
});