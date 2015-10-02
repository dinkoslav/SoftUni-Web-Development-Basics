<?php

namespace SoftUni\Models;


use SoftUni\Core\Database;

class Building
{
    public function getBuildings($userId){
        $db = Database::getInstance('app');
        $result = $db->prepare("
            SELECT
                p.user_id,
                p.building_id,
                b.name,
                bl.level,
                bl.gold,
                bl.food
            FROM
                players_buildings_levels p
            INNER JOIN
                buildings_levels bl
            ON  p.building_id = bl.building_id AND p.level_id = bl.level
            INNER JOIN
                buildings b
            ON  bl.building_id = b.id
            WHERE
                p.user_id = ?
        ");
        $result->execute([$userId]);
        return $result->fetchAll();
    }

    public function evolveBuilding($userId, $buildingId, $userGold, $userFood){
        $db = Database::getInstance('app');
        $result = $db->prepare("
            SELECT
                *
            FROM
                players_buildings_levels p
            INNER JOIN
                buildings_levels bl
            ON
                p.level_id = bl.level
            WHERE
                p.building_id = ?
            AND
                p.user_id = ?
        ");

        $result->execute([$buildingId, $userId]);
        $building = $result->fetch();

        if($building['gold'] > $userGold || $building['food'] > $userFood){
            throw new \Exception("No enough resources");
        }

        $maxLevel = $db->prepare("
            SELECT
                max(level) as max
            FROM
                buildings_levels
            WHERE
                building_id = ?
        ");

        $maxLevel->execute([$buildingId]);
        $maxLevelRow = $maxLevel->fetch();

        if($building['level'] >= $maxLevelRow['max']){
            throw new \Exception("Max level reached");
        }

        $resourceUpdate = $db->prepare("
            UPDATE
                users
            SET
                gold = gold - ?, food = food - ?
            WHERE id = ?
        ");

        $resourceUpdate->execute([$building['gold'], $building['food'], $userId]);

        if($resourceUpdate->rowCount() > 0){
            $levelUpdate = $db->prepare("
                UPDATE
                    players_buildings_levels
                SET
                    level_id = level_id + 1
                WHERE
                    building_id = ?
                AND
                    user_id = ?
            ");
            $levelUpdate->execute([$buildingId, $userId]);
            if($levelUpdate->rowCount() > 0){
                return true;
            }

            throw new \Exception("Level did not increase successfully");
        }

        throw new \Exception("Something went wrong");
    }
}