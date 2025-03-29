<?php
include __DIR__ . '/../../config.php';




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


function processRegistration($data)
{
    global $pdo;

    $pdo->beginTransaction();

    try {

        $uploadDir = __DIR__ . '/../../profile_photos/';



        $fileName = uniqid('profile_') . '.' . pathinfo($_FILES['profilePhoto']['name'], PATHINFO_EXTENSION);


        $stmt = $pdo->prepare("INSERT INTO users VALUES (
            0, 
            :firstname, 
            :lastname, 
            :birthday, 
            :gender, 
            :city, 
            :email, 
            :password, 
            1, 
            :profile_photo
        )");

        $stmt->execute([
            "firstname"     => $data['firstname'],
            "lastname"      => $data['lastname'],
            "birthday"      => $data['birthday'],
            "gender"        => ucfirst($data['gender']),
            "city"          => $data['city'],
            "email"         => $data['email'],
            "password"      => password_hash($data['password'], PASSWORD_DEFAULT),
            "profile_photo" => $fileName
        ]);


        $userId = $pdo->lastInsertId();



        $userDir = $uploadDir . $userId . '/';
        if (!is_dir($userDir) && !mkdir($userDir, 0755, true)) {
            throw new Exception("Impossible de créer le dossier utilisateur");
        }



        $destinationPath = $userDir . $fileName;
        if (!move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $destinationPath)) {
            throw new Exception("Erreur lors du déplacement de la photo");
        }



        if (!empty($data['hobbiesfinal'])) {
            foreach ($data['hobbiesfinal'] as $hobby_id) {
                $stmt = $pdo->prepare("INSERT INTO user_hobbies (user_id, hobby_id) VALUES (:user_id, :hobby_id)");
                $stmt->execute(["user_id" => $userId, "hobby_id" => $hobby_id]);
            }
        }

        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();


        if (isset($destinationPath) && file_exists($destinationPath)) {
            unlink($destinationPath);
        }
        throw $e;
    }
}
