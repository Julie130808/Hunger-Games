<?php
require_once __DIR__ . '/../../config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);

if ($id === 0) {
    header('Location: utilisateurs.php');
    exit;
}

// Vérifier que l'utilisateur existe
$stmt = $pdo->prepare("SELECT id_user FROM USER_ WHERE id_user = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();

if (!$user) {
    header('Location: utilisateurs.php');
    exit;
}

// Supprimer les favoris de l'utilisateur avant de le supprimer
$stmt = $pdo->prepare("
    DELETE FROM Asso_FAVORITES_GAME
    WHERE id_favorites IN (
        SELECT id_favorites FROM FAVORITES WHERE id_user = :id
    )
");
$stmt->execute(['id' => $id]);

$stmt = $pdo->prepare("DELETE FROM FAVORITES WHERE id_user = :id");
$stmt->execute(['id' => $id]);

// Supprimer l'utilisateur
$stmt = $pdo->prepare("DELETE FROM USER_ WHERE id_user = :id");
$stmt->execute(['id' => $id]);

header('Location: utilisateurs.php');
exit;
?>