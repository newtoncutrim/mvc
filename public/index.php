<?php
require __DIR__ . '../../vendor/autoload.php';
use App\Http\Response;
use \App\Http\Router;
use \App\Controller\Pages\Home;


define('URL', 'http://localhost:8000');

$teste = new Router(URL);
$teste->get('/',[function(){
    return new Response(200, Home::getHome());
}]);

$teste->run()->sendResponse();
// MVC em PHP: Implementando um gerenciador de rotas - Série MVC em PHP - Parte 2 13:00

// echo '<pre>';
// print_r($teste);
// echo '</pre>';
// exit;