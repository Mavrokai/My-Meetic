<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once __DIR__ . '../../model/RegisterModel.php';



function displayHobbiesOptions()
{
    $hobbies = getHobbies();

    echo '<option value="">Sélectionnez un hobby</option>';
    foreach ($hobbies as $hobby) {
        echo '<option value="' . htmlspecialchars($hobby["id"]) . '">' . htmlspecialchars($hobby["name"]) . '</option>';
    }
}



function validateFrenchCity($city)
{
    $apiKey = 'd439fed75bdc48b9ae1e3babcf19806e';
    $url = "https://api.geoapify.com/v1/geocode/search?text=" . urlencode($city) . "&filter=countrycode:fr&apiKey=$apiKey";


    $response = file_get_contents($url);
    $data = json_decode($response, true);

    return !empty($data['features']) &&
        strtolower($data['features'][0]['properties']['formatted']) === strtolower(trim($city));
}




function register()
{

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'register') {
        header('Content-Type: application/json');

        try {
            $success = processRegistration($_POST);

            if ($success) {
                echo json_encode(['success' => true, 'redirect' => '../acceuil.php']);
            } else {
                throw new Exception("Erreur lors de l'inscription");
            }
        
        } catch (PDOException $e) {

            if ($e->errorInfo[1] == 1062) {
                echo json_encode(['success' => false, 'errors' => ['email' => "L'email existe déjà"]]);
            } else {
                echo json_encode(['success' => false, 'errors' => ['general' => "Erreur de base de données"]]);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'errors' => ['general' => $e->getMessage()]]);
        }
        exit;
    }
}

register();