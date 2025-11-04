<?php
use Core\Database;
use Core\app;
use Core\Validator;

$db=App::resolve(Database::class);
$currentuserId = 1;
//dd($_POST['id']);
$note1 = $db->query('select * from notes where  id =:id', ['id' => $_POST['id']])->FindORFail();

authorize($note1['user_id'] === $currentuserId);
$errors = [];//server side validation
    if (!Validator::string($_POST['body'],1,10)) {
        $errors['body'] = 'A body no more than 1000 character is required';
       
    }
   if(! empty($errors)){
    view("notes/edit.view.php",['heading'=>'Edit Note','errors'=>$errors,'note'=>$note1]);
   }
    if (empty($errors)) {
        // dd($insert);
        
        $db->query('Update notes set body= :body where id=:id ', [
            'body' => $_POST['body'],
            'id' => $_POST['id']
        ]);
        // $insert = 'INSERT INTO notes (body, user_id) VALUES ("2: ' . $_POST['body'] . '",1)';
        // $db->query($insert);
        header('location: /notes');
        die();
    }
