<?php

class Team {

    private $title;
    private $city;
    private $description;
    private $game;
    private $image;


    public function __construct( string $title,string $city,string $description,string $game,string $image){
        $this->title = $title;
        $this->city = $city;
        $this->description = $description;
        $this->game = $game;
        $this->image = $image;
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


}