<?php
function insererCommentaire(PDO $pdo, int $id_jeu, int $id_user, float $note, string $contenu): void
{
    $pdo->prepare("
        INSERT INTO COMMENT (id_game, id_user, note, content, created_at)
        VALUES (:id_jeu, :id_user, :note, :contenu, NOW())
    ")->execute([
        'id_jeu'  => $id_jeu,
        'id_user' => $id_user,
        'note'    => $note,
        'contenu' => $contenu,
    ]);
}

function recalculerNoteMoyenne(PDO $pdo, int $id_jeu): float
{
    $pdo->prepare("
        UPDATE GAME
        SET rating = (SELECT ROUND(AVG(note) * 2) / 2 FROM COMMENT WHERE id_game = :id_jeu)
        WHERE id_game = :id_jeu2
    ")->execute(['id_jeu' => $id_jeu, 'id_jeu2' => $id_jeu]);

    $stmt = $pdo->prepare("SELECT rating FROM GAME WHERE id_game = :id_jeu");
    $stmt->execute(['id_jeu' => $id_jeu]);
    return (float)$stmt->fetchColumn();
}

function obtenirNomUtilisateur(PDO $pdo, int $id_user): string
{
    $stmt = $pdo->prepare("SELECT name FROM USER_ WHERE id_user = :id_user");
    $stmt->execute(['id_user' => $id_user]);
    return $stmt->fetchColumn();
}
?>