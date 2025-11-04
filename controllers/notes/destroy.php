<?php

use Core\Database;
use Core\app;

$db=App::resolve(Database::class);
$currentuserId = 1;

$note1 = $db->query('select * from notes where  id =:id', ['id' => $_POST['id']])->FindORFail();

authorize($note1['user_id'] === $currentuserId);
$db->query('delete from notes where id=:id', ['id' => $_POST['id']]);
header('location: /notes');
exit();

//view("notes/show.view.php", ['heading' => 'Note', 'note1' => $note1]);
