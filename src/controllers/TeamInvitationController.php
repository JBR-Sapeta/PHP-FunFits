<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Invitation.php';
require_once __DIR__.'/../models/Team.php';
require_once __DIR__.'/../repository/InvitationRepository.php';

class TeamInvitationController extends AppController{


    private $invitationRepository;

    public function __construct(){
        parent::__construct();
        $this->invitationRepository = new InvitationRepository();
    }

    public function userinvitations(){
        return $this->render("invitation/userivitations");
    }

    public function getuserinvitations(){
        session_start();
        $userId = $_SESSION['userId'];

        if($userId){
            $contentType  = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) :"";

            if($contentType === "application/json"){
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($this->invitationRepository->getUsersInvitations($userId));
            }
        }
    }

}