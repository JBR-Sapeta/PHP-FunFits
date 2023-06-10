<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Team.php';

class TeamRepository extends Repository{

    public function addTeam( Team $team): void{

        $stmt = $this->database->connect()->prepare('
            INSERT INTO teams (owner_id, title, city, game, description, image)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $team->getOwnerId(),
            $team->getTitle(),
            $team->getCity(),
            $team->getGame(),
            $team->getDescription(),
            $team->getImage(),
        ]);
    }

    public function deleteTeam( int $teamId, int $userId){

        $stmt = $this->database->connect()->prepare('
            SELECT   delete_team( :teamid , :userid )
        ');
        $stmt->bindParam(':teamid', $teamId, PDO::PARAM_INT);
        $stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }




    public function getTeam (int $id): ?Team{

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM teams WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $team = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($team == false) {
            //Add Exception
            return null;
        }

        return new Team(
            $team['owner_id'],
            $team['title'],
            $team['city'],
            $team['description'],
            $team['game'],
            $team['image'],
            $team['members'],
            $team['id']
        );
    }

    public function getTeams(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM teams
        ');
        $stmt->execute();
        $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

         foreach ($teams as $team) {
             $result[] = new Team(
                $team['owner_id'],
                $team['title'],
                $team['city'],
                "",
                $team['game'],
                $team['image'],
                $team['members'],
                $team['id']
             );
         }

        return $result;
    }

    public function getTeamsForOwner(int  $id): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM teams WHERE owner_id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($teams as $team) {
             $result[] = new Team(
                $team['owner_id'],
                $team['title'],
                $team['city'],
                $team['description'],
                $team['game'],
                $team['image'],
                $team['members'],
                $team['id']
             );
         }

        return $result;
    }


    public function getTeamsForUser(int  $userId): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM teams WHERE teams.id IN (SELECT team_id FROM users_teams WHERE user_id = :userId )
        ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($teams as $team) {
             $result[] = new Team(
                $team['owner_id'],
                $team['title'],
                $team['city'],
                $team['description'],
                $team['game'],
                $team['image'],
                $team['members'],
                $team['id']
             );
         }

        return $result;
    }


    public function getTeamsForChallenge(int $userId, string $game): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM teams WHERE owner_id = :userId AND game = :game
        ');
        $stmt->bindParam(':game', $game, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($teams as $team) {
             $result[] = new Team(
                $team['owner_id'],
                $team['title'],
                $team['city'],
                $team['description'],
                $team['game'],
                $team['image'],
                $team['members'],
                $team['id']
             );
         }

        return $result;
    }


    public function searchTeam( string $title, string $city, string $game): array
    {
        $title = '%'.strtolower($title).'%';
        $city = '%'.strtolower($city).'%';
       
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM teams WHERE LOWER(title) LIKE :title AND LOWER(city) LIKE :city AND game = :game
        ');
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':game', $game, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}

