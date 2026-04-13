<?php
require_once __DIR__ . '/../../models/config.php';
require_once __DIR__ . '/../../models/users/obtenir_commentaires.php';

header('Content-Type: application/json');

$id_jeu = (int)($_GET['id_jeu'] ?? 0);

if ($id_jeu <= 0) {
    echo json_encode(['succes' => false, 'erreur' => 'ID invalide.']);
    exit;
}

try {
    $commentaires = obtenirCommentairesJeu($pdo, $id_jeu);

    foreach ($commentaires as &$c) {
        $c['note']    = (float)$c['note'];
        $c['auteur']  = htmlspecialchars($c['auteur']);
        $c['contenu'] = htmlspecialchars($c['contenu']);
    }

    echo json_encode([
        'succes'       => true,
        'commentaires' => $commentaires,
        'total'        => count($commentaires),
        'connecte'     => isset($_SESSION['user_id']),
    ]);

} catch (PDOException $e) {
    echo json_encode(['succes' => false, 'erreur' => 'Erreur serveur.']);
}
?>