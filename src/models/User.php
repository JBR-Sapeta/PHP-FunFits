<?php

class User {

    private $email;
    private $password;
    private $username;
    private $name;
    private $surname;
    private $avatar;
    private $phone;
    private $id;


    public function __construct( string $email, string $password, string $username, string $name="User", string $surname="Anonymous", ?string $avatar="default_avatar", ?string $phone="", int $id=0 ){

        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->name = $name;
        $this->surname = $surname;
        $this->avatar = $avatar;
        $this->phone = $phone;
        $this->id = $id;
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
    public function setName (string $name){
        return $this->name = $name;
    }


    public function getSurname ():string {
        return $this->surname;
    }
    public function setSurname (string $surname) {
        return $this->surname = $surname;
    }


    public function getAvatar ():string {
        return $this->avatar;
    }
    public function setAvatar (string $avatar) {
        return $this->avatar = $avatar;
    }


    public function getPhone ():string {
        return $this->phone;
    }
    public function setPhone (string $phone) {
        return $this->phone = $phone;
    }


    public function getId():int {
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

}