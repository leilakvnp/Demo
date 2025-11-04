<?php
use Core\Response;
function dd($value){
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function URLs($value){
    return $_SERVER['REQUEST_URI']=== $value;
}
// function abort(){
    
// }
function authorize($condition,$satus= Response::Forbiden){
    if(! $condition){
        abort($satus);
        die();
    }
}
function base_path($path){
    return BASE_PATH.$path;
}
function view($path,$attributes=[]){
    extract($attributes);// change array to variables
    require base_path('views/'.$path);
}
function abort($code=404){
    http_response_code($code);
    require base_path("views/$code.php");
    die();
}
