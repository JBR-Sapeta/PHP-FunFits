<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class AuthController extends AppController{

    public function login(){
        
        if (!$this->isPost()) {
            return $this->render('signin');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $userRepository = new UserRepository();
        $user =  $userRepository->getUser($email);

        if(!$user){
            return $this->render('signin', ['messages' => ['User does not exist.']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('signin', ['messages' => ['User with this email not exist.']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('signin', ['messages' => ['Wrong password.']]);
        }

       return $this->render('home');
    }

}