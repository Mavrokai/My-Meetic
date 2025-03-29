<?php

include __DIR__ . '../../../config.php';



function get_login($email, $password) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        if (!isset($user['is_active']) || $user['is_active'] != 1) {
            return 'inactive';
        }

        if (password_verify($password, $user['password'])) {
            return $user;
        }


        return false;

    } catch (PDOException $e) {
        error_log("Erreur de connexion : " . $e->getMessage());

        
        return false;
    }
}