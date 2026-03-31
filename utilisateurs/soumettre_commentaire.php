<?php
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['succes' => false, 'erreur' => 'Vous devez être connecté pour laisser un commentaire.']);
    exit;
}

// Récupérer les données envoyées
$id_jeu  = (int)($_POST['id_jeu'] ?? 0);
$note    = isset($_POST['note']) ? (float)$_POST['note'] : null;
$contenu = trim($_POST['contenu'] ?? '');

// Vérifications simples
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
    // Insérer le commentaire
    $stmt = $pdo->prepare("
        INSERT INTO COMMENT (id_game, id_user, note, content, created_at)
        VALUES (:id_jeu, :id_user, :note, :contenu, NOW())
    ");
    $stmt->execute([
        'id_jeu'  => $id_jeu,
        'id_user' => (int)$_SESSION['user_id'],
        'note'    => $note,
        'contenu' => $contenu,
    ]);

    // Recalculer la note moyenne du jeu et mettre à jour GAME.rating
    $stmt = $pdo->prepare("
        UPDATE GAME
        SET rating = (SELECT ROUND(AVG(note) * 2) / 2 FROM COMMENT WHERE id_game = :id_jeu)
        WHERE id_game = :id_jeu2
    ");
    $stmt->execute(['id_jeu' => $id_jeu, 'id_jeu2' => $id_jeu]);

    // Récupérer la nouvelle note moyenne
    $stmt = $pdo->prepare("SELECT rating FROM GAME WHERE id_game = :id_jeu");
    $stmt->execute(['id_jeu' => $id_jeu]);
    $nouvelle_note = (float)$stmt->fetchColumn();

    // Récupérer le nom de l'utilisateur pour l'affichage
    $stmt = $pdo->prepare("SELECT name FROM USER_ WHERE id_user = :id_user");
    $stmt->execute(['id_user' => (int)$_SESSION['user_id']]);
    $nom_utilisateur = $stmt->fetchColumn();

    echo json_encode([
        'succes'       => true,
        'nouvelle_note' => $nouvelle_note,
        'commentaire'  => [
            'auteur'    => htmlspecialchars($nom_utilisateur),
            'note'      => $note,
            'contenu'   => htmlspecialchars($contenu),
            'date'      => date('d/m/Y'),
        ],
    ]);

} catch (PDOException $e) {
    echo json_encode(['succes' => false, 'erreur' => 'Erreur serveur, veuillez réessayer.']);
}