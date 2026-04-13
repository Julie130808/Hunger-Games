<?php
function obtenirIdFavoris(PDO $pdo, int $id_user): int|false
{
    $stmt = $pdo->prepare("SELECT id_favorites FROM FAVORITES WHERE id_user = :id_user");
    $stmt->execute(['id_user' => $id_user]);
    $favori = $stmt->fetch();
    return $favori ? (int)$favori['id_favorites'] : false;
}

function supprimerJeuDesFavoris(PDO $pdo, int $id_game, int $id_favorites): void
{
    $pdo->prepare("
        DELETE FROM Asso_FAVORITES_GAME
        WHERE id_game = :id_game AND id_favorites = :id_favorites
    ")->execute(['id_game' => $id_game, 'id_favorites' => $id_favorites]);
}
?>