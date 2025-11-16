<?php
use Core\Database;
use Core\App;
//dd(dirname(__DIR__. '/../../config.php) . '/config.php');
// $config = require(base_path('config.php'));

// $db=new Database($config['database']);
//dd($config['database']);
 //dd($_GET['id']);

$db=App::resolve(Database::class);
$notes= $db-> query('select * from notes where user_id= :userid',['userid'=> 1])->get();


view("notes/index.view.php",['heading'=>'My Notes','notes'=>$notes]);