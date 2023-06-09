<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Game.php';

class GameRepository extends Repository{

    public function createGame(int $userId, Game $game ): void{

        
        $stmt = $this->database->connect()->prepare('
            CALL creategame( :userId , :hostId , :opponentId , :place , :game_date )
        ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':hostId', $game->getHostId(), PDO::PARAM_INT);
        $stmt->bindParam(':opponentId', $game->getOpponentId(), PDO::PARAM_INT);
        $stmt->bindParam(':place', $game->getPlace(), PDO::PARAM_STR);
        $stmt->bindParam(':game_date',  $game->getDate() , PDO::PARAM_STR);
        $stmt->execute();
    }

    public function deleteGame(int $userId, int $gameId): void{

        $stmt = $this->database->connect()->prepare('
            CALL deletegame( :userId , :gameId )
        ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function acceptGame(int $userId, int $gameId): void{

        $stmt = $this->database->connect()->prepare('
            CALL acceptgame( :userId , :gameId )
        ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function rejectGame(int $userId, int $gameId): void{

        $stmt = $this->database->connect()->prepare('
            CALL rejectgame( :userId , :gameId )
        ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function getTeamGames( int $teamId , int $userId):array{

        $stmt = $this->database->connect()->prepare("
            SELECT * FROM v_games_teams WHERE  host_id = :teamId AND host_owner = :userId  OR opponent_id = :teamId  AND opponent_owner = :userId 
       ");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':teamId', $teamId, PDO::PARAM_INT);
        $stmt->execute();

        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

//SELECT * FROM v_games_teams WHERE  host_id = :teamId  AND host_owner = :userId OR opponent_id = :teamId  AND opponent_owner = :userId AND id != null

