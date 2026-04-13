<?php
require_once __DIR__ . '/../../models/config.php';
require_once __DIR__ . '/../../models/users/supprimer_favoris.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

$id_game     = (int)($_POST['id_game'] ?? 0);
$id_favorites = obtenirIdFavoris($pdo, (int)$_SESSION['user_id']);

if ($id_favorites && $id_game) {
    supprimerJeuDesFavoris($pdo, $id_game, $id_favorites);
}

header('Location: ../users/favoris.php');
exit;
?>