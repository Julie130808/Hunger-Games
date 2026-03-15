<?php
require_once __DIR__ . '/../config.php';

if (!isset($_SESSION['user_id'])) { header('Location: connexion.php'); exit; }

$id_game = (int)($_POST['id_game'] ?? 0);

$stmt = $pdo->prepare("SELECT id_favorites FROM FAVORITES WHERE id_user = :id_user");
$stmt->execute(['id_user' => $_SESSION['user_id']]);
$favori = $stmt->fetch();

if ($favori && $id_game) {
    $pdo->prepare("DELETE FROM Asso_FAVORITES_GAME WHERE id_game = :id_game AND id_favorites = :id_favorites")
        ->execute(['id_game' => $id_game, 'id_favorites' => $favori['id_favorites']]);
}

header('Location: favoris.php');
exit;