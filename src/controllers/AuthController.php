<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class AuthController extends AppController{

    public function login(){
        $user = new User("user@mail.com", "Password123", "user", "John", "Doe");

        if (!$this->isPost()) {
            return $this->render('signin');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->getEmail() !== $email) {
            return $this->render('signin', ['messages' => ['User with this email not exist.']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('signin', ['messages' => ['Wrong password.']]);
        }

       return $this->render('home');
    }

}