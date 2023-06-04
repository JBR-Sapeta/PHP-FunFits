<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Team.php';

class TeamRepository extends Repository{

    public function addTeam( Team $team): void
    {

        $stmt = $this->database->connect()->prepare('
            INSERT INTO teams (owner_id, title, city, game, description, image)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        //TODO you should get this value from logged user session.
        $ownerId = 1;

        $stmt->execute([
            $ownerId,
            $team->getTitle(),
            $team->getCity(),
            $team->getGame(),
            $team->getDescription(),
            $team->getImage(),
        ]);
    }



    public function getTeam (int $id): ?Team{

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.teams WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $team = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($team == false) {
            //Add Exception
            return null;
        }

        return new Team(
            $team['title'],
            $team['city'],
            $team['description'],
            $team['game'],
            $team['image']
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
                $team['title'],
                $team['city'],
                "",
                $team['game'],
                $team['image']
             );
         }

        return $result;
    }

    public function searchTeam( string $title, string $city, string $game): array
    {
        $title = '%'.strtolower($title).'%';
        $city = '%'.strtolower($city).'%';
       
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM teams WHERE LOWER(title) LIKE :title AND LOWER(city) LIKE :city
        ');
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}

