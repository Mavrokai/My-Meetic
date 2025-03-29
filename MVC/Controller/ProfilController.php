<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../model/ProfileModel.php';

if (isset($_GET['action'])) {

    switch ($_GET['action']) {
        case 'update':
            handleProfileUpdate();
            break;
        case 'change_password':
            handlePasswordChange();
            break;
        case 'delete':
            handleAccountDeletion();
            break;
        case 'add_hobby':
            handleHobbyAddition();
            break;
        case 'delete_hobby':
            handleHobbyDeletion();
            break;
        case 'upload_photos':
            handlePhotoUpload();
            break;
        case 'delete_photo':
            handlePhotoDeletion();
            break;
    }
}



function handlePhotoDeletion()
{
    if (!isset($_SESSION['user_id'])) {

        //l'utilisateur n'est pas connecté
        http_response_code(401);
        exit;
    }


    $userId = $_SESSION['user_id'];
    $photoName = basename($_GET['photo'] ?? '');


    $currentPhotos = getUserPhotos($userId);


    if (count($currentPhotos) <= 1) {

        //dernier photo, on ne peut pas supprimer
        http_response_code(400);
        echo "Vous ne pouvez pas supprimer la dernière photo restante";
        exit;
    }


    $filePath = __DIR__ . '/../../profile_photos/' . $userId . '/' . $photoName;
    if (!file_exists($filePath)) {

        //chemin non trouvé
        http_response_code(404);
        exit;
    }


    unlink($filePath);


    if (deleteUserPhotoFromDatabase($userId, $photoName)) {
        //sucess
        http_response_code(200);
    } else {
        //erreur
        http_response_code(500);
    }

    exit;
}


function handlePhotoUpload()
{
    if (!isset($_SESSION['user_id'])) {
        setFlashMessage('error', 'Session expirée, veuillez vous reconnecter');
        redirect('../vue/Auth/login.php');
        exit;
    }



    $userId = $_SESSION['user_id'];
    $uploadDir = __DIR__ . '/../../profile_photos/' . $userId . '/';
    $maxFileSize = 5 * 1024 * 1024;
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

    try {

        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new Exception('Erreur de création du dossier');
            }
        }


        if (!is_writable($uploadDir)) {
            throw new Exception('Dossier non accessible en écriture');
        }


        $currentData = getUserData($userId);
        $currentPhotos = $currentData['profile_photo'] ? explode(',', $currentData['profile_photo']) : [];
        $newPhotos = [];


        foreach ($_FILES['profile_photos']['tmp_name'] as $key => $tmpName) {

            $errorCode = $_FILES['profile_photos']['error'][$key];


            if ($errorCode !== UPLOAD_ERR_OK) {
                throw new Exception('Erreur d\'upload ');
            }


            if ($_FILES['profile_photos']['size'][$key] > $maxFileSize) {
                throw new Exception('Fichier trop volumineux (>5Mo)');
            }


            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($tmpName);
            if (!in_array($mimeType, $allowedTypes)) {
                throw new Exception('Type de fichier non autorisé');
            }


            $originalName = $_FILES['profile_photos']['name'][$key];
            $safeFilename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $originalName);
            $targetPath = $uploadDir . $safeFilename;


            if (!move_uploaded_file($tmpName, $targetPath)) {
                throw new Exception('Échec du déplacement du fichier');
            }

            $newPhotos[] = $safeFilename;
        }


        if (!empty($newPhotos)) {
            $allPhotos = array_merge($currentPhotos, $newPhotos);
            $photosString = implode(',', array_unique($allPhotos));

            if (!updateProfilePhoto($userId, $photosString)) {
                throw new Exception('Échec de la mise à jour de la base de données');
            }

            setFlashMessage('success', count($newPhotos) . ' photo(s) téléchargée(s) avec succès !');
            redirectBack();
        } else {
            setFlashMessage('warning', 'Aucune nouvelle photo valide détectée');
        }
    } catch (Exception $e) {
        error_log('Erreur upload photo: ' . $e->getMessage());
        setFlashMessage('error', 'Erreur: ' . $e->getMessage());
    }

    redirectBack();
}




function handleHobbyAddition()
{
    if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        session_destroy();
        redirect('../vue/Auth/login.php');
        exit;
    }

    $userId = $_SESSION['user_id'];
    $hobbyId = $_POST['hobby_id'] ?? null;

    if (addHobbyToUser($userId, $hobbyId)) {
        setFlashMessage('success', 'Hobby ajouté !');
    } else {
        setFlashMessage('error', 'Erreur lors de l\'ajout');
    }

    redirectBack();
}

function handleHobbyDeletion()
{
    if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        session_destroy();
        redirect('../vue/Auth/login.php');
        exit;
    }


    $userId = $_SESSION['user_id'];
    $hobbyId = $_POST['hobby_id'] ?? null;


    $currentHobbies = getUserHobbies($userId);



    if (count($currentHobbies) <= 1) {
        $_SESSION['hobby_error'] = 'Vous devez conserver au moins un loisir';
        redirectBack();
        exit;
    }

    if (deleteHobby($userId, $hobbyId)) {
        setFlashMessage('success', 'Hobby supprimé !');
    } else {
        setFlashMessage('error', 'Erreur lors de la suppression');
    }

    redirectBack();
}



function handleProfileUpdate()
{

    if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        session_destroy();
        redirect('../vue/Auth/login.php');
        exit;
    }

    $userId = $_SESSION['user_id'];
    $email = trim($_POST['email']);
    $gender = trim($_POST['gender']);




    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setFlashMessage('error', 'Email invalide');
        redirectBack();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email_error'] = 'Format d\'email invalide';
        $_SESSION['old_email'] = $email;
        redirectBack();
    }


    if (isEmailTaken($email, $userId)) {
        $_SESSION['email_error'] = 'Cet email est déjà utilisé';
        $_SESSION['old_email'] = $email;
        redirectBack();
    }


    if (isset($_SESSION['password_errors'])) {
        unset($_SESSION['password_errors']);
    }


    unset($_SESSION['email_error'], $_SESSION['old_email']);


    if (updateUserData($userId, $email, $gender)) {
        setFlashMessage('success', 'Profil mis à jour !');
    } else {
        setFlashMessage('error', 'Erreur lors de la mise à jour');
    }

    $selectedHobbies = isset($_POST['hobbiesfinal']) && is_array($_POST['hobbiesfinal'])
        ? array_map('intval', $_POST['hobbiesfinal'])
        : [];

    foreach ($selectedHobbies as $hobbyId) {
        addHobbyToUser($userId, $hobbyId);
    }

    $errors = [];
    $successCount = 0;

    foreach ($selectedHobbies as $hobbyId) {
        if (!addHobbyToUser($userId, $hobbyId)) {
            $errors[] = $hobbyId;
        } else {
            $successCount++;
        }
    }


    if ($successCount > 0) {
        setFlashMessage('success', "$successCount hobbies ajoutés avec succès");
    }

    if (!empty($errors)) {

        $errorNames = array_map('getHobbyNameById', $errors);
        $errorMessage = "Hobbies déjà existants : " . implode(', ', $errorNames);
        setFlashMessage('warning', $errorMessage);
    }

    redirectBack();
}




function getProfile()
{
    global $pdo;

    if (!isset($_SESSION['user_id'])) {
        session_destroy();
        redirect('../vue/Auth/login.php');
    }

    try {
        $user = getUserData($_SESSION['user_id']);
        $hobbies = getUserHobbies($_SESSION['user_id']);


        $photosPerPage = 6;
        $currentPage = $_GET['photo_page'] ?? 1;
        $allPhotos = getUserPhotos($_SESSION['user_id']);
        $totalPhotos = count($allPhotos);
        $totalPages = ceil($totalPhotos / $photosPerPage);



        $currentPage = max(1, min($currentPage, $totalPages));

        $photos = array_slice($allPhotos, ($currentPage - 1) * $photosPerPage, $photosPerPage);

        return [
            'user' => $user,
            'hobbies' => $hobbies,
            'photos' => $photos,
            'photo_pagination' => [
                'current_page' => $currentPage,
                'total_pages' => $totalPages
            ]
        ];
    } catch (PDOException $e) {
        error_log("PDO Error: " . $e->getMessage());
        return false;
    }
}



function handlePasswordChange()
{
    if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        session_destroy();
        redirect('../vue/Auth/login.php');
        exit;
    }

    $userId = $_SESSION['user_id'];
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    $_SESSION['password_errors'] = [];



    $currentHash = getPasswordHash($userId);
    if (!$currentHash || !password_verify($currentPassword, $currentHash)) {
        $_SESSION['password_errors']['current'] = "Mot de passe actuel incorrect";
    }


    if ($newPassword !== $confirmPassword) {
        $_SESSION['password_errors']['confirm'] = "Les mots de passe ne correspondent pas";
    }



    if (!empty($_SESSION['password_errors'])) {
        redirectBack();
    }


    $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
    if ($newHash === false) {
        setFlashMessage('error', 'Erreur lors de la création du hash');
        redirectBack();
    }


    if (updatePassword($userId, $newHash)) {
        setFlashMessage('success', 'Mot de passe mis à jour avec succès');
        session_destroy();
        redirect('../vue/Auth/login.php');
    } else {
        setFlashMessage('error', 'Erreur lors de la mise à jour du mot de passe');
        redirectBack();
    }
}




function handleAccountDeletion()
{
    if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        session_destroy();
        redirect('../vue/Auth/login.php');

        exit;
    }

    $userId = $_SESSION['user_id'];
    $password = $_POST['password'] ?? '';


    $currentHash = getPasswordHash($userId);
    if (!$currentHash || !password_verify($password, $currentHash)) {
        setFlashMessage('error', 'Mot de passe incorrect');

        redirectBack();
    }



    if (deactivateAccount($userId)) {

        session_destroy();
        redirect('../vue/Auth/login.php');
    } else {
        redirectBack();
    }
}


function setFlashMessage($type, $message)
{
    $_SESSION['flash'][$type] = $message;
}

function redirect($url)
{
    header("Location: $url");
    exit;
}

function redirectBack()
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function displayHobbiesOptions()
{
    $hobbies = getHobbies();
    $existingIds = array_column(getUserHobbies($_SESSION['user_id']), 'id');

    echo '<option value="">Sélectionnez un hobby</option>';
    foreach ($hobbies as $hobby) {

        $disabled = in_array($hobby['id'], $existingIds) ? 'disabled' : '';
        
        echo '<option value="' . $hobby['id'] . '" ' . $disabled . '>'
            . htmlspecialchars($hobby['name'])
            . '</option>';
    }
}
