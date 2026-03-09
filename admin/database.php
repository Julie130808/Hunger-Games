<?php
$envPath = ":/HungerGames/.env";

if (file_exists($envPath)) {
    $env = parse_ini_file($envPath);
    $dbHost = $env['DB_HOST'] ?? 'localhost';
    $dbName = $env['DB_NAME'] ?? 'hungergames';
    $dbUser = $env['DB_USER'] ?? 'root';
    $dbPass = $env['DB_PASS'] ?? '';
} else {
    die("❌ Fichier .env introuvable. Veuillez créer un fichier .env à la racine du projet avec les variables DB_HOST, DB_NAME, DB_USER et DB_PASS.");
}

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Erreur de connexion à la base de données : " . $e->getMessage());
}

?>