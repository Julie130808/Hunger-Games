<?php
require_once __DIR__ . '/../../models/config.php';
require_once __DIR__ . '/../../models/admin/dashboard.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$stats         = obtenirStatistiques($pdo);
$derniers_jeux = obtenirDerniersJeux($pdo);
$derniers_users = obtenirDerniersUtilisateurs($pdo);

require_once __DIR__ . '/../../views/admin/dashboard.php';
?>