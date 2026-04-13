<?php
require_once __DIR__ . '/../../models/config.php';
require_once __DIR__ . '/../../models/users/soumettre_commentaire.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['succes' => false, 'erreur' => 'Vous devez être connecté pour laisser un commentaire.']);
    exit;
}

$id_jeu  = (int)($_POST['id_jeu'] ?? 0);
$note    = isset($_POST['note']) ? (float)$_POST['note'] : null;
$contenu = trim($_POST['contenu'] ?? '');

if ($id_jeu <= 0) {
    echo json_encode(['succes' => false, 'erreur' => 'Jeu introuvable.']);
    exit;
}

if ($note === null || $note < 1 || $note > 5) {
    echo json_encode(['succes' => false, 'erreur' => 'Veuillez sélectionner une note entre 1 et 5.']);
    exit;
}

if (strlen($contenu) < 10) {
    echo json_encode(['succes' => false, 'erreur' => 'Le commentaire doit faire au moins 10 caractères.']);
    exit;
}

if (strlen($contenu) > 1000) {
    echo json_encode(['succes' => false, 'erreur' => 'Le commentaire ne peut pas dépasser 1000 caractères.']);
    exit;
}

try {
    insererCommentaire($pdo, $id_jeu, (int)$_SESSION['user_id'], $note, $contenu);
    $nouvelle_note   = recalculerNoteMoyenne($pdo, $id_jeu);
    $nom_utilisateur = obtenirNomUtilisateur($pdo, (int)$_SESSION['user_id']);

    echo json_encode([
        'succes'        => true,
        'nouvelle_note' => $nouvelle_note,
        'commentaire'   => [
            'auteur'  => htmlspecialchars($nom_utilisateur),
            'note'    => $note,
            'contenu' => htmlspecialchars($contenu),
            'date'    => date('d/m/Y'),
        ],
    ]);

} catch (PDOException $e) {
    echo json_encode(['succes' => false, 'erreur' => 'Erreur serveur, veuillez réessayer.']);
}
?>