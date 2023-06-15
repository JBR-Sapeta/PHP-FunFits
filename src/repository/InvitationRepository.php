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

    public function deleteInvitation(int $invId, int $userId): void{

        $stmt = $this->database->connect()->prepare('
            CALL deleteinvitation( :invId , :userId )
        ');
        $stmt->bindParam(':invId', $invId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function acceptInvitation(int $invId, int $userId): void{

        $stmt = $this->database->connect()->prepare('
            CALL acceptinvitation( :invId , :userId )
        ');
        $stmt->bindParam(':invId', $invId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function rejectInvitation(int $invId, int $userId):void{

        $stmt = $this->database->connect()->prepare('
            CALL rejectinvitation( :invId , :userId )
        ');
        $stmt->bindParam(':invId', $invId, PDO::PARAM_INT);
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

