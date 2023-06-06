<?php

class Team {

    private $title;
    private $city;
    private $description;
    private $game;
    private $image;
    private $owner_id;
    private $members; 
    private $id; 


    public function __construct( int $owner_id, string $title,string $city,string $description,string $game,string $image, int $members=1 , int $id=0){
        $this->owner_id = $owner_id;
        $this->title = $title;
        $this->city = $city;
        $this->description = $description;
        $this->game = $game;
        $this->image = $image;
        $this->members = $members;
        $this->id = $id;
    }

    public function getOwnerId ():int {
        return $this->owner_id;
    }
    public function setOwnerId (int $owner_id) {
        return $this->owner_id = $owner_id;
    }

    public function getTitle(): string {
        return $this->title;
    }
    public function setTitle (string $title) {
        return $this->title = $title;
    }

    public function getCity(): string {
        return $this->city;
    }
    public function setCity (string $city) {
        return $this->city = $city;
    }

    public function getDescription(){
        return $this->description;
    }
    public function setDescription (string $description) {
        return $this->description = $description;
    }

    public function getGame ():string {
        return $this->game;
    }
    public function setGame (string $game) {
        return $this->game = $game;
    }

    public function getImage ():string {
        return $this->image;
    }
    public function setImage (string $image) {
        return $this->image = $image;
    }

    public function getMembers ():int {
        return $this->members;
    }
    public function setMembers (int $members) {
        return $this->members = $members;
    }

    public function getId ():int {
        return $this->id;
    }
    public function setId (int $id) {
        return $this->id = $id;
    }


}