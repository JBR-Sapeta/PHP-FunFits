<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Invitation.php';
require_once __DIR__.'/../repository/InvitationRepository.php';

class InvitationController extends AppController{


    private $invitationRepository;

    public function __construct(){
        parent::__construct();
        $this->invitationRepository = new InvitationRepository();
    }

    public function createinvitation(int $teamId){
       
        session_start();
        $userId = $_SESSION['userId'];

        $id = (int)$teamId;

        $this->invitationRepository->createInvitation($userId,$id);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/userinvitations");
    }

    public function deleteinvitation(int $id){
        
        session_start();
        $userId = $_SESSION['userId'];

        $invId = (int)$id;

        $this->invitationRepository->deleteInvitation($invId,$userId);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/userinvitations");
    }

    public function acceptinvitation(int $id){
        session_start();
        $userId = $_SESSION['userId'];

        $invId = (int)$id;

        $this->invitationRepository->acceptInvitation($invId,$userId);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/myteams");
    }

    public function rejectinvitation(int $id){
        session_start();
        $userId = $_SESSION['userId'];

        $invId = (int)$id;

        $this->invitationRepository->rejectInvitation($invId,$userId);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/myteams");
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