<?php

class Game {
    
    private $host_id;
    private $opponent_id;
    private $place;
    private $date;
    private $status;
    private $id;

    public function __construct( int $host_id, int $opponent_id, string $place, string $date, string $status = "Pending", int $id=0){

        $this->host_id = $host_id;
        $this->opponent_id = $opponent_id;
        $this->place = $place;
        $this->date = $date;
        $this->status = $status;
        $this->id = $id;
    }

    public function getHostId(): int {
        return $this->host_id;
    }
    public function setHostId (int $host_id) {
        return $this->host_id = $host_id;
    }


    public function getOpponentId():int {
        return $this->opponent_id;
    }
    public function setOpponentId (int $opponent_id) {
        return $this->opponent_id = $opponent_id;
    }


    public function getPlace ():string {
        return $this->place;
    }
    public function setPlace (string $place) {
        return $this->place = $place;
    }


    public function getDate ():string {
        return $this->date;
    }
    public function setDate (string $date){
        return $this->date = $date;
    }


    public function getStatus ():string {
        return $this->status;
    }
    public function setStatus (string $status) {
        return $this->status = $status;
    }

    public function getId():int {
        return $this->id;
    }
    public function setId(int $id){
        $this->id = $id;
    }

}