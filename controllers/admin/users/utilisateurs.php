<?php
require_once __DIR__ . '/../../../models/config.php';
require_once __DIR__ . '/../../../models/admin/users/utilisateurs.php';

if (!isset($_SESSION['admin'])) {
    header('Location: /HungerGames/admin/login.php');
    exit;
}

$utilisateurs = obtenirTousLesUtilisateurs($pdo);

require_once __DIR__ . '/../../../views/admin/users/utilisateurs.php';
?>