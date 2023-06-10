<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class AuthController extends AppController{

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/avatars/';

    private $messages = []; 
    private $userRepository;

    public function __construct(){
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function signup(){
        $this->render("auth/signup");
    }

    public function register(){
        
        if (!$this->isPost()) {
            return $this->render('auth/signup');
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirm'];


        if (!strlen($username)) {
            return $this->render('auth/signup', ['errors' => ['Username cannot be empty.']]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->render('auth/ignup', ['errors' => ['Invalid email address.']]);
        }

        if (!strlen($password)) {
            return $this->render('auth/signup', ['errors' => ['Password must be at least 6 characters long.']]);
        }

        if ($password !== $confirmedPassword) {
            return $this->render('auth/signup', ['errors' => ['Please provide proper password.']]);
        }

        $user =  $this->userRepository->isEmailTaken($email);

        if($user){
            return $this->render('auth/signup', ['errors' => ['Email in use.']]);
        }

        $user =  $this->userRepository->isUsernameTaken($username);

        if($user){
            return $this->render('auth/signup', ['errors' => ['Username in use.']]);
        }

        $hashedUser = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($email, $hashedUser, $username);
      
        $this->userRepository->addUser($user);
      
        return $this->render('auth/signin', ['messages' => ['You\'ve been succesfully registrated!']]);

    }

    public function signin(){
        $this->render("auth/signin");
    }

    public function login(){

        if (!$this->isPost()) {
            return $this->render('auth/signin');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->render('auth/signin', ['errors' => ['Invalid email address.']]);
        }

        $user =  $this->userRepository->getUserByEmail($email);

        if(!$user){
            return $this->render('auth/signin', ['errors' => ['User does not exist.']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('auth/signin', ['errors' => ['User with this email not exist.']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('auth/signin', ['errors' => ['Wrong password.']]);
        }

        session_start();
        $_SESSION['userId'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['avatar'] = $user->getAvatar();
  

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/searchteams");
    }

    


    public function logout(){
        $this->render("auth/logout");
    }
  

    public function profile(){
        session_start();
        $id = $_SESSION['userId'];
        $user =  $this->userRepository->getUserById($id);
        $this->render("auth/profile", ['user' => $user]);
    }


    public function userform(){
        $this->render("auth/userform");
    }

    public function userupdate(){

        if ($this->isPost()) {
            
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $phone = $_POST['phone'];
            
            if (!strlen($name)) {
                $this->message[] = 'Name to short.';
                return $this->render("auth/userform",  ['messages' => $this->message]);
            }

            if (!strlen($surname)) {
                $this->message[] = 'Surname to short.';
                return $this->render("auth/userform",  ['messages' => $this->message]);
            }

            if (!strlen($phone)) {
                $this->message[] = 'Enter phone number.';
                return $this->render("auth/userform",  ['messages' => $this->message]);
            }

            if(!is_uploaded_file($_FILES['file']['tmp_name'])){
                $this->message[] = 'Please add your avatar.';
                return $this->render("auth/userform",  ['messages' => $this->message]);
            }

            if(!$this->validate($_FILES['file'])){
                return $this->render("auth/userform",  ['messages' => $this->message]);
            }
            
            move_uploaded_file(
                $_FILES['file']['tmp_name'], 
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            
      
            session_start();
            $id = $_SESSION['userId'];    
            $_SESSION['avatar'] = $_FILES['file']['name']; 

            $this->userRepository->updateUser($id, $name, $surname, $phone, $_FILES['file']['name']  );

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/profile");
        }

        return $this->render("auth/userform");
    }



    private function validate(array $file): bool{

        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }

}