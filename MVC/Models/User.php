<?php

namespace SoftUni\Models;


use SoftUni\Core\Database;

class User
{
    const GOLD_DEFAULT = 1500;
    const FOOD_DEFAULT = 1500;

    public function exists($username){
        $db = Database::getInstance('app');
        $result = $db->prepare('SELECT id FROM users WHERE username = ?');
        $result->execute([$username]);
        return $result->rowCount() > 0;
    }

    public function register($username, $password){
        $db = Database::getInstance('app');

        if($this->exists($username)){
            throw new \Exception("User already registered");
        }

        $result = $db->prepare("
            INSERT INTO users (username, password, gold, food)
            VALUES (?, ?, ?, ?);
        ");
        $password = password_hash($password, PASSWORD_DEFAULT);

        $result->execute(
            [
                $username,
                $password,
                User::GOLD_DEFAULT,
                User::FOOD_DEFAULT
            ]
        );

        if($result->rowCount() > 0){
            $userId = $db->lastId();

            $db->query("
                INSERT INTO players_buildings_levels (user_id, building_id, level_id)
                SELECT $userId, id, 0 FROM buildings
            ");

            return true;
        }

        throw new \Exception('Cannot register user');
    }

    public function login($username, $password){
        $db = Database::getInstance('app');

        $result = $db->prepare("SELECT * FROM users WHERE username = ?");
        $result->execute([$username]);

        if($result->rowCount() == 0){
            throw new \Exception("Invalid username");
        }

        $user = $result->fetch();
        $passwordsEqual = password_verify($password, $user['password']);

        if($passwordsEqual){
            return $user['id'];
        }

        throw new \Exception("Passwords do not match");
    }

    public function getInfo($id){
        $db = Database::getInstance('app');

        $result = $db->prepare("
            SELECT
                *
            FROM
              users
            WHERE id = ?
        ");
        $result->execute([$id]);
        return $result->fetch();
    }

    public function edit($username, $password, $id){
        $db = Database::getInstance('app');
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $result = $db->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
        $result->execute([
            $username, $hashed, $id
        ]);

        return $result->rowCount() > 0;
    }
}