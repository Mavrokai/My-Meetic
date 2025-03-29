<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$host = 'localhost';
$dbname = 'Meetic';
$username = 'root';
$pswd = 'admin';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pswd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}