<?php
function obtenirJeu(PDO $pdo, int $id): array|false
{
    $stmt = $pdo->prepare("
        SELECT g.*, COALESCE(c.name, 'Non classé') AS category
        FROM GAME g
        LEFT JOIN ASSO_GAME_CATEGORY agc ON g.id_game = agc.id_game
        LEFT JOIN CATEGORY c ON agc.id_category = c.id_category
        WHERE g.id_game = :id
    ");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtenirOuCreerFavori(PDO $pdo, int $id_user): int
{
    $stmt = $pdo->prepare("SELECT id_favorites FROM FAVORITES WHERE id_user = :id_user");
    $stmt->execute(['id_user' => $id_user]);
    $favori = $stmt->fetch();

    if (!$favori) {
        $pdo->prepare("INSERT INTO FAVORITES (id_user) VALUES (:id_user)")
            ->execute(['id_user' => $id_user]);
        return (int)$pdo->lastInsertId();
    }

    return (int)$favori['id_favorites'];
}

function jeuDejaEnFavori(PDO $pdo, int $id_game, int $id_favorites): bool
{
    $stmt = $pdo->prepare("
        SELECT * FROM Asso_FAVORITES_GAME
        WHERE id_game = :id_game AND id_favorites = :id_favorites
    ");
    $stmt->execute(['id_game' => $id_game, 'id_favorites' => $id_favorites]);
    return (bool)$stmt->fetch();
}

function ajouterEnFavori(PDO $pdo, int $id_game, int $id_favorites): void
{
    $pdo->prepare("
        INSERT INTO Asso_FAVORITES_GAME (id_game, id_favorites)
        VALUES (:id_game, :id_favorites)
    ")->execute(['id_game' => $id_game, 'id_favorites' => $id_favorites]);
}
?>