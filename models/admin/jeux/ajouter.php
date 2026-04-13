<?php
function obtenirCategories(PDO $pdo): array
{
    return $pdo->query("SELECT id_category, name FROM CATEGORY ORDER BY name")
               ->fetchAll(PDO::FETCH_ASSOC);
}

function insererJeu(PDO $pdo, array $donnees): int
{
    $stmt = $pdo->prepare("
        INSERT INTO GAME (name, image, rating, players, duration, description, détails)
        VALUES (:name, :image, :rating, :players, :duration, :description, :details)
    ");
    $stmt->execute([
        'name'        => $donnees['name'],
        'image'       => $donnees['image'],
        'rating'      => $donnees['rating'],
        'players'     => $donnees['players'],
        'duration'    => $donnees['duration'],
        'description' => $donnees['description'],
        'details'     => $donnees['details'],
    ]);
    return (int)$pdo->lastInsertId();
}

function associerCategorieJeu(PDO $pdo, int $id_game, int $id_category): void
{
    $pdo->prepare("
        INSERT INTO ASSO_GAME_CATEGORY (id_game, id_category)
        VALUES (:id_game, :id_category)
    ")->execute(['id_game' => $id_game, 'id_category' => $id_category]);
}
?>