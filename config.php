<?php
$host = '127.0.0.1';
$db   = 'todo_app';
$user = 'root';   // Par défaut sur XAMPP
$pass = '';       // Mot de passe vide par défaut
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    exit("Erreur connexion BD : " . $e->getMessage());
}
