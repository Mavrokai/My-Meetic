<?php

include_once __DIR__ . '../../../config.php';


function getHobbies()
{
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM hobbies ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération des hobbies: " . $e->getMessage());
        return [];
    }
}


function getFilteredUsers($filters)
{
    global $pdo;

    $query = "SELECT u.*, GROUP_CONCAT(h.name SEPARATOR ', ') AS hobbies 
              FROM users u
              LEFT JOIN user_hobbies uh ON u.id = uh.user_id
              LEFT JOIN hobbies h ON uh.hobby_id = h.id
              WHERE u.is_active = 1";

    $conditions = [];
    $params = [];


    if (!empty($filters['gender'])) {
        $conditions[] = "u.gender = :gender";
        $params[':gender'] = $filters['gender'];
    }


    if (!empty($filters['city'])) {
        $cities = array_map('trim', explode(',', $filters['city']));
        $cities = array_filter($cities);

        if (!empty($cities)) {
            $cityConditions = [];
            foreach ($cities as $index => $city) {
                $placeholder = ":city{$index}";
                $cityConditions[] = "u.city LIKE {$placeholder}";
                $params[$placeholder] = "%{$city}%";
            }
            $conditions[] = "(" . implode(" OR ", $cityConditions) . ")";
        }
    }


    if (!empty($filters['age'])) {
        list($minAge, $maxAge) = explode('/', $filters['age']);



        $minAge = (int)$minAge;
        $maxAge = (int)$maxAge;

        if ($minAge > $maxAge || $minAge < 18) {
            error_log("Filtre d'âge invalide");
            return [];
        }

        $conditions[] = "(TIMESTAMPDIFF(YEAR, u.birthday, CURDATE()) BETWEEN :minAge AND :maxAge)";
        $params[':minAge'] = $minAge;
        $params[':maxAge'] = $maxAge;
    }


    if (!empty($filters['hobby'])) {
        $hobbies = is_array($filters['hobby']) ?
            array_filter($filters['hobby']) :
            [trim($filters['hobby'])];

        if (!empty($hobbies)) {
            $hobbyConditions = [];
            foreach ($hobbies as $index => $hobbyId) {
                $placeholder = ":hobby{$index}";
                $hobbyConditions[] = "uh.hobby_id = {$placeholder}";
                $params[$placeholder] = $hobbyId;
            }
            $conditions[] = "(" . implode(" OR ", $hobbyConditions) . ")";
        }
    }

    if (!empty($conditions)) {
        $query .= " AND " . implode(" AND ", $conditions);
    }

    $query .= " GROUP BY u.id";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur de recherche: " . $e->getMessage());
        return [];
    }
}
