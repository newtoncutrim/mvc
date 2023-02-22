<?php
namespace App\Http;

use Closure;
use Exception;
use ReflectionFunction;

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

        $params['variables'] = [];
        $patterVariable = '/{(.*?)}/';
        if(preg_match_all($patterVariable, $route, $matches)){
            $route = preg_replace($patterVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
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
    
            if(preg_match($patterHoute, $uri, $matches)){
            
                if(isset($method[$httpMethod])){
                    unset($matches[0]);

                    $keys = $method[$httpMethod]['variables'];
                    $method[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $method[$httpMethod]['variables']['request'] = $this->request;


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

            $reflection = new ReflectionFunction($route['controller']);
            foreach($reflection->getParameters() as $parameter){
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }


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