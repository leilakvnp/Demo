<?php

namespace Core;
// $routes=require base_path('routes.php');
// $uriPath = parse_url($_SERVER['REQUEST_URI'])['path'];

// function routeToController($uriPath, $routes)
// {
//     if (array_key_exists($uriPath, $routes)) {

//         require base_path($routes[$uriPath]);
//     } else {
//         abort();
//     }
// }
// function abort($code=404){
//     http_response_code($code);
//     require base_path("views/$code.php");
// }
// routeToController($uriPath, $routes);


class Router
{
    protected $routes = [];
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method))
                return require base_path($route['controller']);
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
    {//or compact method opposit to extract; compact('method','uri','controller')
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }
    public function get($uri, $controller)
    {
        $this->add('GET', $uri, $controller);
    }
    public function post($uri, $controller)
    {
        $this->add('POST', $uri, $controller);
    }
    public function delete($uri, $controller)
    {
        $this->add('DELETE', $uri, $controller);
    }
    public function patch($uri, $controller)
    {
        $this->add('PATCH', $uri, $controller);
    }
    public function put($uri, $controller)
    {
        $this->add('PUT', $uri, $controller);
    }
}
