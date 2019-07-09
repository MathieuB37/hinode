<?php
namespace App\Router;

class Router
{
    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct (string $url)
    {
        $this->url = $url;
    }
    //// METHODS :
    // Detect GET method url :
    public function get(string $path, $callable, $name = null) :Route
    {
        return $this->add($path, $callable, $name, 'GET');
    }
    // Detect POST method url :
    public function post(string $path, $callable, $name = null) :Route
    {
        return $this->add($path, $callable, $name, 'POST');
    }
    // Create a new Route :
    private function add($path, $callable, $name, $method) :Route
    {
        $route = new Route ($path, $callable);
        $this->routes[$method][] = $route;
        if($name){
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }
    public function url($name, $params = [])
    {
        if(!isset($this->namedRoutes[$name])){
            throw new RouterException('No route matches this name');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

    // Cheking if the current url matches one of the routes:
    public function run() 
    {
       // 
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        // Cheking all the routes 
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            // Checks if the entered url exists :
            if($route->match($this->url)){
                return $route->call();
            }
        }
        throw new RouterException('No matching routes');
    }

}