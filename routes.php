<?php
// return[
//     "/" => "controllers/index.php",
//     "/about" => "controllers/about.php",
//     "/notes" => "controllers/notes/index.php",
//     "/note" => "controllers/notes/show.php",
//     "/notes/create" => "controllers/notes/create.php",
//     "/contact" => "controllers/contact.php"

// ];

$router->get('/','index.php');
$router->get('/about','about.php');
$router->get('/contact','contact.php');

$router->get('/notes','notes/index.php')->only('auth');
$router->get('/note','notes/show.php');
$router->get('/notes/create','notes/create.php');
$router->get('/note/edit','notes/edit.php');

$router->patch('/note','notes/Update.php');

$router->delete('/note','notes/destroy.php');
$router->post('/notes','notes/store.php');

$router->get('/register','registration/create.php')->only('guest');
$router->post('/register','registration/store.php');

$router->get('/login','sessions/create.php')->only('guest');
$router->post('/session','sessions/store.php')->only('guest');
$router->delete('/session','sessions/destroy.php')->only('auth');