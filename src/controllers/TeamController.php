<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Team.php';
require_once __DIR__.'/../repository/TeamRepository.php';


class TeamController extends AppController{

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = []; 
    private $teamRepository;

    public function __construct(){
        parent::__construct();
        $this->teamRepository = new TeamRepository();
    }
    
    public function addteam(){
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'], 
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            session_start();
            $id = $_SESSION['userId'];    

            $team = new Team($id, $_POST['title'],$_POST['city'], $_POST['description'],$_POST['game'], $_FILES['file']['name']);
            $this->teamRepository->addTeam($team);

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/myteams");
        }
        return $this->render("team/add-team",  ['messages' => $this->message]);
    }

    public function deleteteam(int $teamId){
        $url = "http://$_SERVER[HTTP_HOST]";

        if (!$this->isPost()) {
            header("Location: {$url}/myteams");
        }

        session_start();
        $userId = $_SESSION['userId'];

        if(is_numeric($teamId) ){
            $id = (int)$teamId;
            $this->teamRepository->deleteTeam($id,$userId);
        }
        header("Location: {$url}/myteams");
    }

    public function team(string $id){

        if(!is_numeric($id) ){
            return $this->render("team/team", ['team' => null]);
        }

        $teamId = (int)$id;

        $team = $this->teamRepository->getTeam($teamId);
        return $this->render("team/team", ['team' => $team]);
    }

    public function menageteam(string $id){

        if(!is_numeric($id) ){
            return $this->render("team/menage-team", ['team' => null]);
        }

        $teamId = (int)$id;

        $team = $this->teamRepository->getTeam($teamId);
        return $this->render("team/menage-team", ['team' => $team]);
    }

    public function myteams(){
        session_start();
        $id = $_SESSION['userId'];
        $teams = $this->teamRepository->getTeamsForOwner($id);
        return $this->render("team/my-teams", ['teams' => $teams]);
    }


    public function teammember(){
        session_start();
        $id = $_SESSION['userId'];
        $teams = $this->teamRepository->getTeamsForUser($id);
        return $this->render("team/team-member", ['teams' => $teams]);
    }

    public function searchteams(){
        $teams = $this->teamRepository->getTeams();
        return $this->render("team/search-teams", ['teams' => $teams]);
    }

    public function search(){
        $contentType  = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) :"";

        if($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($this->teamRepository->searchTeam( $decoded['title'], $decoded['city'], $decoded['game']));
        }
    }
    
    public function challenge(string $id){

        session_start();
        $userId = $_SESSION['userId'];

        if(!is_numeric($id) ){
            return $this->render("team/team", ['team' => null]);
        }

        $teamId = (int)$id;
        $opponent = $this->teamRepository->getTeam($teamId);

        if($opponent){

            $game = $opponent->getGame();
            $teams = $this->teamRepository->getTeamsForChallenge($userId, $game);

            return $this->render("team/challenge", ['opponent' => $opponent ,'teams' => $teams]);
        }

        return $this->render("team/team", ['team' => null]);
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