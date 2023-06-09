<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Game.php';
require_once __DIR__.'/../repository/GameRepository.php';

class GameController extends AppController{


    private $gameRepository;

    public function __construct(){
        parent::__construct();
        $this->gameRepository = new GameRepository();
    }

    public function creategame(){
       
        if (!$this->isPost()) {
            header("Location: {$url}/searchteams");
        }

        session_start();
        $userId = $_SESSION['userId'];


        $game = new Game(intval($_POST['hostId']),intval($_POST['opponentId']),$_POST['place'],$_POST['game_date']);
       
  

        $teams = $this->gameRepository->createGame($userId, $game);
       
    }

    public function acceptgame($id){
        session_start();
        $userId = $_SESSION['userId'];

        if (!$this->isPost()) {
            header("Location: {$url}/myteams");
        }

        $gameId = (int)$id;
    
        $teams = $this->gameRepository->acceptGame($userId,$gameId );
        header("Location: {$url}/myteams");
    }
    
    public function rejectgame($id){
        session_start();
        $userId = $_SESSION['userId'];

        if (!$this->isPost()) {
            header("Location: {$url}/myteams");
        }

        $gameId = (int)$id;
    
        $teams = $this->gameRepository->rejectGame($userId,$gameId );
        header("Location: {$url}/myteams");
    }

    public function deletegame($id){
        session_start();
        $userId = $_SESSION['userId'];

        if (!$this->isPost()) {
            header("Location: {$url}/myteams");
        }

        $gameId = (int)$id;
    
        $teams = $this->gameRepository->deleteGame($userId,$gameId );
        header("Location: {$url}/myteams");
    }

    public function menagegames($id){
        return $this->render("game/menagegames");
    }

    public function getgames($id){
        session_start();
        $userId = $_SESSION['userId'];

        $teamId = (int)$id;
    
        if($userId){
            $contentType  = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) :"";

            if($contentType === "application/json"){
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($this->gameRepository->getTeamGames($teamId,$userId));
            }
        }
        
    }
    
}