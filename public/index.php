<?php
require __DIR__ . '../../vendor/autoload.php';

use \App\Http\Router;
use \WilliamCosta\DotEnv\Environment;
use \App\Utils\View;

//LOAD ENVIRONMENT VARS FROM FILEs
// Environment::load('../');

define('URL', 'http://localhost:8000');

//GET ENVIRONMENT VAR
// echo getenv('URL');
View::init([
    'URL' => URL
]);



$obRouter = new Router(URL);


require_once("../app/routes/pages.php");

$obRouter->run()->sendResponse();



// MVC em PHP: Implementando um gerenciador de rotas - Série MVC em PHP - Parte 2   1:06:00

// echo '<pre>';
// print_r($teste);
// echo '</pre>';
// exit;