<?php
namespace App\Http;

use Closure;
use Exception;

class Router{
    private string $url = '';
    private string $prefix = '';
    private array $routes = [];
    private $request;
    
    public function __construct($url){
        $this->request = new Request();
        $this->url = $url;
        self::setPrefix();
    }

    private function setPrefix(){
        $urlPrefix = parse_url($this->url);
        $this->prefix = $urlPrefix['path'] ?? '';
    }

    private function addRouter($method, $route, $params = []){
        foreach($params as $key => $value){
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
            }
        }
        $patterRoute = '/^'.str_replace('/', '\/', $route). '$/';
        $this->routes[$patterRoute][$method] = $params;
        
    }
    private function getUri(){
        $uri = $this->request->getUri();
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        return end($xUri);

    }

    private function getRoute(){
        $uri = $this->getUri();
        $httpMethod = $this->request->getHttpMethod();
        foreach($this->routes as $patterHoute=>$method){
    
            if(preg_match($patterHoute, $uri)){
            
                if(isset($method[$httpMethod])){
                    return $method[$httpMethod];
                } 
                throw new Exception('Metodo nao permitido', 405);
            }      
        }
        throw new Exception('Url Não encontrada', 404);
    }

    public function run(){
        try{
            $route = $this->getRoute();
            if(!isset($route['controller'])){
                throw new Exception('A URL não pode ser processada', 500);
            }
            $args = [];
            return call_user_func_array($route['controller'], $args);
            
        }catch(Exception $e){
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    public function get($route, $params = []){
        return $this->addRouter('GET', $route, $params);
    }

    public function post($route, $params = []){
        return $this->addRouter('POST', $route, $params);
    }

    public function put($route, $params = []){
        return $this->addRouter('PUT', $route, $params);
    }

    public function delete($route, $params = []){
        return $this->addRouter('DELETE', $route, $params);
    }

}