<?php
require_once __DIR__ . '/../../models/config.php';
require_once __DIR__ . '/../../models/users/jeu.php';

$id = (int)($_GET['id'] ?? 0);
if ($id === 0) { header('Location: ../../index.php'); exit; }

$jeu = obtenirJeu($pdo, $id);
if (!$jeu) { header('Location: ../../index.php'); exit; }

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        header('Location: connexion.php');
        exit;
    }

    $id_favorites = obtenirOuCreerFavori($pdo, (int)$_SESSION['user_id']);

    if (jeuDejaEnFavori($pdo, $id, $id_favorites)) {
        $message = 'Ce jeu est déjà dans vos favoris !';
    } else {
        ajouterEnFavori($pdo, $id, $id_favorites);
        $message = '⭐ Jeu ajouté à vos favoris !';
    }
}

require_once __DIR__ . '/../../views/users/jeu.php';
?>