<?php


use Core\Database;
use Core\app;

$db=App::resolve(Database::class);
$currentuserId = 1;

$note1 = $db->query('select * from notes where  id =:id', ['id' => $_GET['id']])->FindORFail();

authorize($note1['user_id'] === $currentuserId);



view("notes/edit.view.php",['heading'=>'Edit Note','errors'=>[],'note'=>$note1]);