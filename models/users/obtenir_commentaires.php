<?php
function obtenirCommentairesJeu(PDO $pdo, int $id_jeu): array
{
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
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>