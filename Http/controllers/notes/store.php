<?php

use Core\Validator;
use Core\Database;

$config = require base_path('config.php');
$db=new Database($config['database']);
 $errors = [];//server side validation
    if (!Validator::string($_POST['body'])) {
        $errors['body'] = 'A body no more than 1000 character is required';
       
    }
   if(! empty($errors)){
    view("notes/create.view.php",['heading'=>'Create Note','errors'=>$errors]);
   }
    if (empty($errors)) {
        // dd($insert);
        
        $db->query('INSERT INTO notes (body, user_id) VALUES (:body,:user_id)', [
            'body' => $_POST['body'],
            'user_id' => 1
        ]);
        // $insert = 'INSERT INTO notes (body, user_id) VALUES ("2: ' . $_POST['body'] . '",1)';
        // $db->query($insert);
        header('location: /notes');
        die();
    }

