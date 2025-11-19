<?php

use Core\Authenticator;
use Http\Forms\Loginform;


// $email = $_POST['email'];
// $password = $_POST['password'];
// dd($email);
//server side validation

$form = Loginform::validate([
  'email' => $_POST['email'],
  'password' => $_POST['password']
]);//if validate fail throw an exception else return an object
$signdIn = new Authenticator()->attempt($_POST['email'], $_POST['password']);
if (!$signdIn) {
  $form->setError(
    'password',
    'No matching account found for that email address and password.'
  )->throw();
}
redirect('/');
// $form = new Loginform($email,$password);
// if ($form->validate($email, $password)) {


//   if (new Authenticator()->attempt($email, $password)) {
//     redirect('/');
//   } else {
//     $form->setError('password', 'No matching account found for that email address and password.');
//   }
// }
//$db = App::resolve(Database::class);
// $config = require base_path('config.php');
// $db=new Database($config['database']);


// return view("sessions/create.view.php", [
//         'heading' => 'login', 
//         'errors' => $form->errors()]);

//$_SESSION['errors']=$form->errors();
