<?php
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

$id_jeu = (int)($_GET['id_jeu'] ?? 0);

if ($id_jeu <= 0) {
    echo json_encode(['succes' => false, 'erreur' => 'ID invalide.']);
    exit;
}

try {
    // Récupérer tous les commentaires du jeu avec le nom de l'auteur
    $stmt = $pdo->prepare("
        SELECT
            c.note,
            c.content AS contenu,
            DATE_FORMAT(c.created_at, '%d/%m/%Y') AS date,
            u.name AS auteur
        FROM COMMENT c
        JOIN USER_ u ON c.id_user = u.id_user
        WHERE c.id_game = :id_jeu
        ORDER BY c.created_at DESC
    ");
    $stmt->execute(['id_jeu' => $id_jeu]);
    $commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Nettoyer les données
    foreach ($commentaires as &$c) {
        $c['note']    = (float)$c['note'];
        $c['auteur']  = htmlspecialchars($c['auteur']);
        $c['contenu'] = htmlspecialchars($c['contenu']);
    }

    echo json_encode([
        'succes'        => true,
        'commentaires'  => $commentaires,
        'total'         => count($commentaires),
        'connecte'      => isset($_SESSION['user_id']),
    ]);

} catch (PDOException $e) {
    echo json_encode(['succes' => false, 'erreur' => 'Erreur serveur.']);
}