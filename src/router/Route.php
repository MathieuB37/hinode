<?php

namespace App\Router;

class Route
{
    private $path;
    private $callable;
    private $matches = [];
    private $params = [];

    public function __construct ($path, $callable)
    {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }
    public function with($param, $regex)
    {
        $this->param[$param] =  str_replace('(', '(?:', $regex);
        // Allows fluent, chain the arguments and methods with the same instance of Route :
        return $this;
    }
    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path); // ([\w] = word character)
        // Verifying the path from start to end ('i' at the end used to check lowercase AND uppercase)
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches)){
            return false;
        }
        // Delete the first index of the array which value is $url
        array_shift($matches);
        $this->matches = $matches; 
        return true;  
    }
    private function paramMatch($match)
    {
        if(isset($this->params[$match[1]])){
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }
    public function getUrl($params) :string
    {

        $path = $this->path;
        foreach($params as $k => $v){
            $path = str_replace(":$k", $v, $path);
        }
        return $path;
    }
    public function call()
    {
        if(is_string($this->callable)){
            // Separate the Controller name from the Method name (ex: Article#show -> [Article, show])
            $params = explode('#', $this->callable);
            $controller = "App\\controller\\" . $params[0] . "Controller";
            $controller = new $controller();
            return call_user_func_array([$controller, $params[1]], $this->matches);
        } else {
        return call_user_func_array($this->callable, $this->matches);
        }   
    }

}