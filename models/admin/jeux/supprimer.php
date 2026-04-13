<?php
function verifierJeuExiste(PDO $pdo, int $id): array|false
{
    $stmt = $pdo->prepare("SELECT name FROM GAME WHERE id_game = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function supprimerJeu(PDO $pdo, int $id): void
{
    $pdo->prepare("DELETE FROM ASSO_GAME_CATEGORY WHERE id_game = :id")
        ->execute(['id' => $id]);

    $pdo->prepare("DELETE FROM Asso_FAVORITES_GAME WHERE id_game = :id")
        ->execute(['id' => $id]);

    $pdo->prepare("DELETE FROM GAME WHERE id_game = :id")
        ->execute(['id' => $id]);
}
?>