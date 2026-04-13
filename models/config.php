<?php
session_start();
$envPath = __DIR__ . '/.env';

if (file_exists($envPath)) {
    $env = parse_ini_file($envPath);
    $dbHost     = $env['DB_HOST']     ?? '';
    $dbName     = $env['DB_NAME']     ?? '';
    $dbUser     = $env['DB_USER']     ?? '';
    $dbPass     = $env['DB_PASS']     ?? '';
    $adminLogin = $env['ADMIN_LOGIN'] ?? '';
    $adminPass  = $env['ADMIN_PASS']  ?? '';
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