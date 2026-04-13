<?php
require_once __DIR__ . '/../../models/config.php';
require_once __DIR__ . '/../../models/users/favoris.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

$favoris = obtenirFavorisUtilisateur($pdo, (int)$_SESSION['user_id']);

require_once __DIR__ . '/../../views/users/favoris.php';
?>