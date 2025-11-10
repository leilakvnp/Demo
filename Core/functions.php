<?php

use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function URLs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}
// function abort(){

// }
function authorize($condition, $satus = Response::Forbiden)
{
    if (! $condition) {
        abort($satus);
        die();
    }
}
function base_path($path)
{
    return BASE_PATH . $path;
}
function view($path, $attributes = [])
{
    extract($attributes); // change array to variables
    require base_path('views/' . $path);
}
function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/$code.php");
    die();
}
function login($user)
{
    $_SESSION['user'] = [
        'email' => $user['email']
    ];
    session_regenerate_id(true);//true= delete old session id
}
function logout()
{
    $_SESSION = [];

    session_destroy(); //destroy session files on the server
    //delete cookies
    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
