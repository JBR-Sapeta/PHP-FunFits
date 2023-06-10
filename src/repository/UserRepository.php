<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository{

    public function addUser( User $user){
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, username)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getUsername(),
        ]);
    }



    public function updateUser( int $id, string $name, string $surname, string $phone, string $avatar ){
        $stmt = $this->database->connect()->prepare('
            UPDATE users SET name = :name , surname = :surname , phone = :phone , avatar = :avatar  WHERE id = :id
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':avatar', $avatar, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
       
    }

    public function getUserById (int $id): ?User{

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            //Add Exception
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['username'],
            $user['name'],
            $user['surname'],
            $user['avatar'],
            $user['phone'],
            $user['id']
        );
    }



    public function getUserByEmail (string $email): ?User{

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            //Add Exception
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['username'],
            $user['name'],
            $user['surname'],
            $user['avatar'],
            $user['phone'],
            $user['id']
        );
    }



    public function isEmailTaken (string $email): bool{

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return false;
        }

        return  true;
    }



    public function isUsernameTaken (string $username): bool{

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE username = :username
        ');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return false;
        }

        return  true;
    }

}