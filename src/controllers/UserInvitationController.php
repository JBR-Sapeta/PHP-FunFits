<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Invitation.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/InvitationRepository.php';

class UserInvitationController extends AppController{


    private $invitationRepository;

    public function __construct(){
        parent::__construct();
        $this->invitationRepository = new InvitationRepository();
    }

    public function teaminvitations(){
        return $this->render("invitation/teaminvitations");
    }

    public function getteaminvitations(string $teamId){
        session_start();
        $userId = $_SESSION['userId'];

        if($userId){
       
            $id = (int)$teamId;

            $contentType  = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) :"";

            if($contentType === "application/json"){
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($this->invitationRepository->getTeamsInvitations($id, $userId));
            }
         }
     
    }

}
