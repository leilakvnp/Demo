<?php

use Core\Validator;
use Core\App;
use Core\Database;

// $config = require base_path('config.php');
// $db=new Database($config['database']);
$db = App::resolve(Database::class);
$errors = [];
//server side validation
if (!Validator::email($_POST['email'])) {
    $errors['email'] = 'Please provide a valid email address.';
}
if (!Validator::string($_POST['password'], 7, 255)) {
    $errors['password'] = 'Please provide a password of at least 7 characters.';
}
if (! empty($errors)) {
    view("registration/create.view.php", ['heading' => 'register', 'errors' => $errors]);
}
$user = $db->query('select * from users where email=:email', [
    'email' => $_POST['email']
])->find();
if (!empty($user)) { //check if already exists if yes redirect to login
    header('location: /login');
    exit();
} else {
    $db->query('INSERT INTO users (email, password) VALUES (:email,:password)', [
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
    ]);
    login($user);

    header('location: /');
    exit();
}
