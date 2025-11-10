<?php

use Core\Validator;
use Core\App;
use Core\Database;

// $config = require base_path('config.php');
// $db=new Database($config['database']);
$db = App::resolve(Database::class);
$errors = [];
$email = $_POST['email'];
$password = $_POST['password'];
//server side validation
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}
if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a  valid password .';
}
if (! empty($errors)) {
    view("sessions/create.view.php", ['heading' => 'login', 'errors' => $errors]);
}
$user = $db->query('select * from users where email=:email', [
    'email' => $email
])->find();

if ($user) {
    if (password_verify($password, $user['password'])) { //check if password match

        login($user);


        header('location: /');
        exit();
    }
}
return view('sessions/create.view.php', [
    'errors' => [
        'email' => "No matching account found for that email address and password."
    ]
]);
