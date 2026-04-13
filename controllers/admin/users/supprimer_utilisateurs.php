<?php
require_once __DIR__ . '/../../../models/config.php';
require_once __DIR__ . '/../../../models/admin/users/supprimer_utilisateur.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if ($id === 0) { header('Location: liste.php'); exit; }

$user = verifierUtilisateurExiste($pdo, $id);
if (!$user) { header('Location: liste.php'); exit; }

supprimerUtilisateur($pdo, $id);

header('Location: liste.php');
exit;
?>