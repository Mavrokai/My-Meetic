<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


include __DIR__ . '../../../config.php';



function getUserData($userId) {
    global $pdo;

    try {

        $stmt = $pdo->prepare("SELECT id, firstname, lastname, email, birthday, gender, city, profile_photo FROM users WHERE id = ?");
        $stmt->execute([$userId]);

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        

        error_log("User Data: " . print_r($userData, true));
        
        return $userData;
    } catch (PDOException $e) {
        error_log("Erreur modèle : " . $e->getMessage());
        return false;
    }
}




function updateUserData($userId, $email, $gender)
{
    global $pdo;


    try {
        $stmt = $pdo->prepare("UPDATE users SET 
            email = ?, 
            gender = ? 
            WHERE id = ?");

        return $stmt->execute([$email, $gender, $userId]);
    } catch (PDOException $e) {
        error_log("Update error: " . $e->getMessage());


        return false;
    }
}



function getUserHobbies($userId)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT h.id, h.name FROM hobbies h  INNER JOIN user_hobbies uh ON h.id = uh.hobby_id WHERE uh.user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur modèle : " . $e->getMessage());
        return [];
    }
}

function addHobbyToUser($userId, $hobbyId) {
    global $pdo;

    try {

        $stmtCheck = $pdo->prepare("SELECT * FROM user_hobbies WHERE user_id = ? AND hobby_id = ?");
        $stmtCheck->execute([$userId, $hobbyId]);
        
        if ($stmtCheck->rowCount() > 0) {

            $hobbyName = getHobbyNameById($hobbyId);
            setFlashMessage('warning', "Le hobby '$hobbyName' est déjà associé à votre profil");
            return false;
        }


        $stmtInsert = $pdo->prepare("INSERT INTO user_hobbies (user_id, hobby_id) VALUES (?, ?)");
        return $stmtInsert->execute([$userId, $hobbyId]);

    } catch (PDOException $e) {
        error_log("Erreur addHobbyToUser: " . $e->getMessage());
        setFlashMessage('error', 'Erreur technique lors de l\'ajout');
        return false;
    }
}




function getHobbyNameById($hobbyId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT name FROM hobbies WHERE id = ?");
    $stmt->execute([$hobbyId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['name'] ?? 'Inconnu';
}

function deleteHobby($userId, $hobbyId)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("DELETE FROM user_hobbies WHERE user_id = ? AND hobby_id = ?");
        return $stmt->execute([$userId, $hobbyId]);
    } catch (PDOException $e) {
        error_log("Delete hobby error: " . $e->getMessage());
        return false;
    }
}


function isEmailTaken($email, $userId) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $stmt->execute([$email, $userId]);
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        error_log("Email check error: " . $e->getMessage());
        return true;
    }
}

function getPasswordHash($userId)
{
    global $pdo;


    try {
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['password'] ?? null;
    } catch (PDOException $e) {
        error_log("Erreur modèle : " . $e->getMessage());

        return false;
    }
}




function updatePassword($userId, $newPasswordHash)
{
    global $pdo;


    try {
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        return $stmt->execute([$newPasswordHash, $userId]);
    } catch (PDOException $e) {
        error_log("Update password error: " . $e->getMessage());
        return false;
    }
}



function deactivateAccount($userId)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("UPDATE users SET is_active = 0 WHERE id = ?");
        return $stmt->execute([$userId]);
    } catch (PDOException $e) {
        error_log("Deactivation error: " . $e->getMessage());


        return false;
    }
}

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


function saveProfilePhoto($userId, $fileName) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("INSERT INTO user_photos (user_id, file_path) VALUES (?, ?)");
        return $stmt->execute([$userId, $fileName]);
    } catch (PDOException $e) {
        error_log("Photo upload error: " . $e->getMessage());
        return false;
    }
}

function updateProfilePhoto($userId, $photos) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("UPDATE users SET profile_photo = ? WHERE id = ?");
        return $stmt->execute([$photos, $userId]);
    } catch (PDOException $e) {
        error_log("Photo update error: " . $e->getMessage());
        return false;
    }
}



function getUserPhotos($userId) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT profile_photo FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['profile_photo'] ? explode(',', $result['profile_photo']) : [];
    } catch (PDOException $e) {
        error_log("Photo fetch error: " . $e->getMessage());
        return [];
    }
}


function deleteUserPhotoFromDatabase($userId, $photoName) {
    try {
        global $pdo;


        $stmt = $pdo->prepare("SELECT profile_photo FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $currentPhotos = $stmt->fetchColumn();


        $updatedPhotos = array_filter(explode(',', $currentPhotos), function($p) use ($photoName) {
            return $p !== $photoName;
        });



        $stmt = $pdo->prepare("UPDATE users SET profile_photo = ? WHERE id = ?");
        $stmt->execute([implode(',', $updatedPhotos), $userId]);

        return true;
    } catch (PDOException $e) {
        error_log("Delete photo error: " . $e->getMessage());

        return false;
    }
}