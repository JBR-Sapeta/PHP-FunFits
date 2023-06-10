<?php

class Invitation {

    private $user_id;
    private $team_id;
    private $status;
    private $created_at;
    private $id;

    public function __construct( int $user_id, int $team_id, string $status, ?string $created_at, int $id ){
        $this->user_id = $user_id;
        $this->team_id = $team_id;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->id = $id;
    }

    public function getUserId(): string {
        return $this->user_id;
    }
    public function setUserId (string $user_id) {
        return $this->user_id = $user_id;
    }


    public function getTeamId(){
        return $this->team_id;
    }
    public function setTeamId (string $team_id) {
        return $this->team_id = $team_id;
    }


    public function getStatus ():string {
        return $this->status;
    }
    public function setStatus (string $status) {
        return $this->status = $status;
    }


    public function getCreatedAt ():string {
        return $this->created_at;
    }
    public function setCreatedAt (string $created_at){
        return $this->created_at = $created_at;
    }


    public function getId ():string {
        return $this->id;
    }
    public function setId (string $id) {
        return $this->id = $id;
    }


}