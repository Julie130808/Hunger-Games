<?php
require_once __DIR__ . '/../../../models/config.php';
require_once __DIR__ . '/../../../models/admin/jeux/ajouter.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../../login.php');
    exit;
}

$erreurs    = [];
$succes     = '';
$categories = obtenirCategories($pdo);

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
        $id_game = insererJeu($pdo, [
            'name'        => $name,
            'image'       => $image,
            'rating'      => $rating,
            'players'     => $players,
            'duration'    => $duration,
            'description' => $description,
            'details'     => $details,
        ]);

        if (!empty($id_category)) {
            associerCategorieJeu($pdo, $id_game, (int)$id_category);
        }

        $succes = "Le jeu a été ajouté avec succès !";
    }
}

require_once __DIR__ . '/../../../views/admin/jeux/ajouter.php';
?>