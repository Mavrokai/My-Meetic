<?php
header('Content-Type: application/json');

include __DIR__ . '/../model/LoginModel.php';


function login() {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $response = ['success' => false, 'message' => ''];


        try {
            $email = $_POST["email"] ?? '';
            $password = $_POST["password"] ?? '';

            if (empty($email) || empty($password)) {

                //paterne de l'input coté user pas respécté
                http_response_code(400);
                $response['message'] = 'Veuillez remplir tous les champs';
                echo json_encode($response);
                return;
            }

            $user = get_login($email, $password);
            
            if ($user === 'inactive') {
                //pas les perms coté user
                http_response_code(403);
                $response['message'] = 'Compte désactivé';
            } elseif ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $response['success'] = true;
                $response['redirect'] = '../acceuil.php';

            } else {


                //// Email ou mot de passe incorrect, authentification échouée
                http_response_code(401);
                $response['message'] = 'Email ou mot de passe incorrect';

            }
        } catch (Exception $e) {

            //// Erreur serveur interne
            http_response_code(500);
            $response['message'] = 'Erreur technique';
            
        }
        
        echo json_encode($response);
    }
}

login();