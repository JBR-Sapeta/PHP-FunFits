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

        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($project == false) {
            //Add Exception
            return null;
        }

        return new Project(
            $project['title'],
            $project['city'],
            $project['game'],
            $project['description'],
            $project['image']
        );
    }

    

}