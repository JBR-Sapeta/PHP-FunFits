<?php

require_once __DIR__.'/../../Database.php';

class  Repository{

    protected $database;

    public function __construct(){
        $this->database = Database::getInstance(); //We  use the Database singleton instance
    }
}