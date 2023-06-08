<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Invitation.php';

class InvitationRepository extends Repository{

    public function createInvitation( int $userId, int $teamId): void{
        $stmt = $this->database->connect()->prepare('
            CALL createinvitation( :userId , :teamId )
        ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':teamId', $teamId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteInvitation(int $id, int $userId): void{

        $stmt = $this->database->connect()->prepare('
            CALL deleteinvitation( :id , :userId )
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function acceptInvitation(int $id, int $userId): void{

        $stmt = $this->database->connect()->prepare('
            CALL acceptinvitation( :id , :userId )
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function rejectInvitation(int $id, int $userId):void{

        $stmt = $this->database->connect()->prepare('
            CALL rejectinvitation( :id , :userId )
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getUsersInvitations(int $userId):array{

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM v_teams_invitations WHERE user_id = :userId
        ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTeamsInvitations( int $teamId , int $userId):array{

        $stmt = $this->database->connect()->prepare("
            SELECT * FROM v_users_invitations WHERE team_id = :teamId AND owner_id = :userId AND status = 'Pending'
       ");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':teamId', $teamId, PDO::PARAM_INT);
        $stmt->execute();

        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

