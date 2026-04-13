<?php
function obtenirTousLesJeux(PDO $pdo): array
{
    return $pdo->query("
        SELECT g.id_game, g.name, g.rating, g.players, g.duration,
               COALESCE(c.name, 'Non classé') AS category
        FROM GAME g
        LEFT JOIN ASSO_GAME_CATEGORY agc ON g.id_game = agc.id_game
        LEFT JOIN CATEGORY c ON agc.id_category = c.id_category
        ORDER BY g.id_game DESC
    ")->fetchAll(PDO::FETCH_ASSOC);
}
?>