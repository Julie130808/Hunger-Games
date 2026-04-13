<?php
function obtenirToutesLesCategories(PDO $pdo): array
{
    return $pdo->query("SELECT * FROM CATEGORY ORDER BY name")
               ->fetchAll(PDO::FETCH_ASSOC);
}

function ajouterCategorie(PDO $pdo, string $name, string $description): void
{
    $pdo->prepare("INSERT INTO CATEGORY (name, description) VALUES (:name, :description)")
        ->execute(['name' => $name, 'description' => $description]);
}

function supprimerCategorie(PDO $pdo, int $id): void
{
    $pdo->prepare("DELETE FROM ASSO_GAME_CATEGORY WHERE id_category = :id")
        ->execute(['id' => $id]);

    $pdo->prepare("DELETE FROM CATEGORY WHERE id_category = :id")
        ->execute(['id' => $id]);
}
?>