<?php
function obtenirStatistiques(PDO $pdo): array
{
    return [
        'nb_jeux'         => $pdo->query("SELECT COUNT(*) FROM GAME")->fetchColumn(),
        'nb_utilisateurs' => $pdo->query("SELECT COUNT(*) FROM USER_")->fetchColumn(),
        'nb_favoris'      => $pdo->query("SELECT COUNT(*) FROM Asso_FAVORITES_GAME")->fetchColumn(),
        'nb_categories'   => $pdo->query("SELECT COUNT(*) FROM CATEGORY")->fetchColumn(),
    ];
}

function obtenirDerniersJeux(PDO $pdo): array
{
    return $pdo->query("
        SELECT g.id_game, g.name, g.rating,
               COALESCE(c.name, 'Non classé') AS category
        FROM GAME g
        LEFT JOIN ASSO_GAME_CATEGORY agc ON g.id_game = agc.id_game
        LEFT JOIN CATEGORY c ON agc.id_category = c.id_category
        ORDER BY g.id_game DESC
        LIMIT 5
    ")->fetchAll(PDO::FETCH_ASSOC);
}

function obtenirDerniersUtilisateurs(PDO $pdo): array
{
    return $pdo->query("
        SELECT name, email, created_at
        FROM USER_
        ORDER BY created_at DESC
        LIMIT 5
    ")->fetchAll(PDO::FETCH_ASSOC);
}
?>