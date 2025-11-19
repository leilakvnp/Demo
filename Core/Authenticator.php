<?php

namespace Core;

use Core\App;
use Core\Database;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query('select * from users where email=:email', [
            'email' => $email
        ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) { //check if password match

                $this->login($user);
                return true;
            }
        }
        return false;
    }
    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];
        session_regenerate_id(true); //true= delete old session id
    }
    public function logout()
    {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    //added for register new user
    public function register($email)
    {
        $user = App::resolve(Database::class)->query('select * from users where email=:email', [
            'email' => $email
        ])->find();
        if ($user) {
            redirect('/login');
        } else {
            App::resolve(Database::class)->query('INSERT INTO users (email, password) VALUES (:email,:password)', [
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            ]);
            $newUser = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
                'email' => $_POST['email']
            ])->find();
            $this->login($newUser);
        }
    }
}
