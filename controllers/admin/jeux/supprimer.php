<?php
require_once __DIR__ . '/../../../models/config.php';
require_once __DIR__ . '/../../../models/admin/jeux/supprimer.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../../login.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if ($id === 0) { header('Location: liste.php'); exit; }

$jeu = verifierJeuExiste($pdo, $id);
if (!$jeu) { header('Location: liste.php'); exit; }

supprimerJeu($pdo, $id);

header('Location: liste.php');
exit;
?>