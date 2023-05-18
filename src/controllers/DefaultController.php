<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index(){
        //TODO display home.html
        $this->render('home');
    }

    public function signin(){
        //TODO display signin.html
        $this->render("signin");
    }

    public function signup(){
        //TODO display signup.html
        $this->render("signup");
    }
    
}