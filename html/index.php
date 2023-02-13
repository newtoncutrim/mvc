<?php


require __DIR__ . '../../vendor/autoload.php';

use \App\Controller\Pages\Home;
// use \App\Http\Request;

use \App\Http\Response;
$teste = new Response(200, '0la');


// $teste = new Response(200, 'ola mundo');
echo '<pre>';
print_r($teste);
echo '</pre>';
exit;






echo Home::getHome();

// MVC em PHP: Conceito e início do projeto - Série MVC em PHP - Parte 1

//echo '<pre>';
//print_r($teste);
//echo '</pre>';
//exit;