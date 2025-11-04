<?php

use Core\Router;

const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . "Core/functions.php";
//instead of
// require base_path("Response.php");
// require base_path('Database.php');

spl_autoload_register(function ($class) {// to know all calss in the project without require them
//Class=Core\Database
$class=str_replace('\\',DIRECTORY_SEPARATOR,$class);
//class=Core/Database
    require base_path("{$class}.php");
});
require base_path('views/bootstrap.php');
//require base_path("Core/router.php");// at the last
 $router=new Router();
 $routes=require  base_path('routes.php');
 $uri=parse_url($_SERVER['REQUEST_URI'])['path'];
 $method= $_POST['_method']?? $_SERVER['REQUEST_METHOD'];//request_method is get or post,how to handel delete? add hidden field
error_log($method);
 $router->route($uri,$method);