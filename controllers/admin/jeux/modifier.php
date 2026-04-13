<?php
require_once __DIR__ . '/../../../models/config.php';
require_once __DIR__ . '/../../../models/admin/jeux/modifier.php';
require_once __DIR__ . '/../../../models/admin/jeux/ajouter.php'; // pour obtenirCategories()

if (!isset($_SESSION['admin'])) {
    header('Location: ../../login.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if ($id === 0) { header('Location: liste.php'); exit; }

$jeu = obtenirJeuAdmin($pdo, $id);
if (!$jeu) { header('Location: liste.php'); exit; }

$categories         = obtenirCategories($pdo);
$categorie_actuelle = obtenirCategorieActuelle($pdo, $id);
$erreurs            = [];
$succes             = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = trim($_POST['name']        ?? '');
    $description = trim($_POST['description'] ?? '');
    $details     = trim($_POST['details']     ?? '');
    $image       = trim($_POST['image']       ?? '');
    $rating      = trim($_POST['rating']      ?? '');
    $players     = trim($_POST['players']     ?? '');
    $duration    = trim($_POST['duration']    ?? '');
    $id_category = trim($_POST['id_category'] ?? '');

    if (empty($name))                   $erreurs[] = "Le nom est obligatoire.";
    if (empty($description))            $erreurs[] = "La description est obligatoire.";
    if (empty($image))                  $erreurs[] = "L'image est obligatoire.";
    if ($rating < 0 || $rating > 5)     $erreurs[] = "La note doit être entre 0 et 5.";
    if ($players < 1)                   $erreurs[] = "Le nombre de joueurs est obligatoire.";
    if ($duration < 1)                  $erreurs[] = "La durée est obligatoire.";

    if (empty($erreurs)) {
        mettreAJourJeu($pdo, $id, [
            'name'        => $name,
            'image'       => $image,
            'rating'      => $rating,
            'players'     => $players,
            'duration'    => $duration,
            'description' => $description,
            'details'     => $details,
        ]);

        mettreAJourCategorieJeu($pdo, $id, $id_category);

        $succes             = "Le jeu a été modifié avec succès !";
        $jeu                = obtenirJeuAdmin($pdo, $id);
        $categorie_actuelle = $id_category;
    }
}

require_once __DIR__ . '/../../../views/admin/jeux/modifier.php';
?>