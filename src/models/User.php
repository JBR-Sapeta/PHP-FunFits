<?php

class User {

    private $email;
    private $password;
    private $username;
    private $name;
    private $surname;

    public function __construct( string $email,string $password,string $username,string $name, string $surname){
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->name = $name;
        $this->surname = $surname;
    }

    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail (string $email) {
        return $this->email = $email;
    }


    public function getPassword(){
        return $this->password;
    }
    public function setPassword (string $password) {
        return $this->password = $password;
    }


    public function getUsername ():string {
        return $this->username;
    }
    public function setUsername (string $username) {
        return $this->username = $username;
    }


    public function getName ():string {
        return $this->name;
    }
    public function setName (string $name) {
        return $this->name = $name;
    }


    public function getSurname ():string {
        return $this->surname;
    }
    public function setSurname (string $surname) {
        return $this->surname = $surname;
    }


}