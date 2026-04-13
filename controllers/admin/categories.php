<?php
require_once __DIR__ . '/../../models/config.php';
require_once __DIR__ . '/../../models/admin/categories.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$erreurs = [];
$succes  = '';

// Supprimer une catégorie
if (isset($_GET['supprimer'])) {
    $id = (int)$_GET['supprimer'];
    supprimerCategorie($pdo, $id);
    header('Location: categories.php');
    exit;
}

// Ajouter une catégorie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $name        = trim($_POST['name']        ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($name))        $erreurs[] = "Le nom est obligatoire.";
    if (empty($description)) $erreurs[] = "La description est obligatoire.";

    if (empty($erreurs)) {
        ajouterCategorie($pdo, $name, $description);
        $succes = "Catégorie ajoutée avec succès !";
    }
}

$categories = obtenirToutesLesCategories($pdo);

require_once __DIR__ . '/../../views/admin/categories.php';
?>