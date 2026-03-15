<?php
session_start();
$envPath = __DIR__ . '/.env';

if (file_exists($envPath)) {
    $env = parse_ini_file($envPath);
    $dbHost = $env['DB_HOST'] ?? 'mysql-server';
    $dbName = $env['DB_NAME'] ?? 'HungerGames';
    $dbUser = $env['DB_USER'] ?? 'root';
    $dbPass = $env['DB_PASS'] ?? 'root';
} else {
    die("❌ Fichier .env introuvable.");
}

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}
?>