<?php
require_once __DIR__ . '/../../config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);

if ($id === 0) {
    header('Location: liste.php');
    exit;
}

// Vérifier que le jeu existe
$stmt = $pdo->prepare("SELECT name FROM GAME WHERE id_game = :id");
$stmt->execute(['id' => $id]);
$jeu = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$jeu) {
    header('Location: liste.php');
    exit;
}

// Supprimer les associations avant de supprimer le jeu
$stmt = $pdo->prepare("DELETE FROM ASSO_GAME_CATEGORY WHERE id_game = :id");
$stmt->execute(['id' => $id]);

$stmt = $pdo->prepare("DELETE FROM Asso_FAVORITES_GAME WHERE id_game = :id");
$stmt->execute(['id' => $id]);

// Supprimer le jeu
$stmt = $pdo->prepare("DELETE FROM GAME WHERE id_game = :id");
$stmt->execute(['id' => $id]);

header('Location: liste.php');
exit;
?>