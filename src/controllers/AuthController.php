<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class AuthController extends AppController{

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }


    public function signup(){

        $this->render("signup");
    }

    public function register(){
        
        if (!$this->isPost()) {
            return $this->render('signup');
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirm'];


        if (!strlen($username)) {
            return $this->render('signup', ['errors' => ['Username cannot be empty.']]);
        }

        if (!strlen($password)) {
            return $this->render('signup', ['errors' => ['Password must be at least 6 characters long.']]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->render('signup', ['errors' => ['Invalid email address.']]);
        }

        if ($password !== $confirmedPassword) {
            return $this->render('signup', ['errors' => ['Please provide proper password.']]);
        }

        $user =  $this->userRepository->isEmailTaken($email);

        if($user){
            return $this->render('signup', ['errors' => ['Email in use.']]);
        }

        $user =  $this->userRepository->isUsernameTaken($username);

        if($user){
            return $this->render('signup', ['errors' => ['Username in use.']]);
        }

        $hashedUser = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($email, $hashedUser, $username);
      
        $this->userRepository->addUser($user);
      
        return $this->render('signin', ['messages' => ['You\'ve been succesfully registrated!']]);

    }



    public function signin(){

        $this->render("signin");
    }


    public function login(){
        
        if (!$this->isPost()) {
            return $this->render('signin');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->render('signup', ['errors' => ['Invalid email address.']]);
        }

        $user =  $this->userRepository->getUserByEmail($email);

        if(!$user){
            return $this->render('signin', ['errors' => ['User does not exist.']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('signin', ['errors' => ['User with this email not exist.']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('signin', ['errors' => ['Wrong password.']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/allTeams");
    }

    
    

  

}