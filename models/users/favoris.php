<?php
function obtenirFavorisUtilisateur(PDO $pdo, int $id_user): array
{
    $stmt = $pdo->prepare("
        SELECT g.id_game, g.name, g.image, g.rating, g.players, g.duration, g.description,
               COALESCE(c.name, 'Non classé') AS category
        FROM GAME g
        JOIN Asso_FAVORITES_GAME afg ON g.id_game = afg.id_game
        JOIN FAVORITES f ON afg.id_favorites = f.id_favorites
        LEFT JOIN ASSO_GAME_CATEGORY agc ON g.id_game = agc.id_game
        LEFT JOIN CATEGORY c ON agc.id_category = c.id_category
        WHERE f.id_user = :id_user
    ");
    $stmt->execute(['id_user' => $id_user]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>