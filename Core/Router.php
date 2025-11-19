<?php

namespace Core;

use Core\Middleware\Guest;
use Core\Middleware\Auth;
use Core\Middleware\Middleware;

class Router
{
    protected $routes = [];
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                //apply middleware
                if (isset($route['middleware'])) {
                    //dd($_SESSION['user']);
                    Middleware::resolve($route['middleware']);
                }

                return require base_path('Http/controllers/' . $route['controller']);
            }
        }
        //abort
        $this->abort();
    }
    protected function abort($code = 404)
    {
        http_response_code($code);
        require base_path("views/$code.php");
        die();
    }
    public function add($method, $uri, $controller)
    { //or compact method opposit to extract; compact('method','uri','controller')
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
        return $this;
    }
    public function only($key)
    { //authorization
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }
    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }
    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }
    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }
    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }
    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }
}
