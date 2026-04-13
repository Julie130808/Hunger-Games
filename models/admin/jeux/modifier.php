<?php
function obtenirJeuAdmin(PDO $pdo, int $id): array|false
{
    $stmt = $pdo->prepare("SELECT * FROM GAME WHERE id_game = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtenirCategorieActuelle(PDO $pdo, int $id): int|false
{
    $stmt = $pdo->prepare("SELECT id_category FROM ASSO_GAME_CATEGORY WHERE id_game = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetchColumn();
}

function mettreAJourJeu(PDO $pdo, int $id, array $donnees): void
{
    $pdo->prepare("
        UPDATE GAME
        SET name = :name, image = :image, rating = :rating,
            players = :players, duration = :duration,
            description = :description, détails = :details
        WHERE id_game = :id
    ")->execute([
        'name'        => $donnees['name'],
        'image'       => $donnees['image'],
        'rating'      => $donnees['rating'],
        'players'     => $donnees['players'],
        'duration'    => $donnees['duration'],
        'description' => $donnees['description'],
        'details'     => $donnees['details'],
        'id'          => $id,
    ]);
}

function mettreAJourCategorieJeu(PDO $pdo, int $id, int|string $id_category): void
{
    $pdo->prepare("DELETE FROM ASSO_GAME_CATEGORY WHERE id_game = :id")
        ->execute(['id' => $id]);

    if (!empty($id_category)) {
        $pdo->prepare("
            INSERT INTO ASSO_GAME_CATEGORY (id_game, id_category)
            VALUES (:id_game, :id_category)
        ")->execute(['id_game' => $id, 'id_category' => $id_category]);
    }
}
?>