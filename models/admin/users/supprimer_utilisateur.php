<?php
function verifierUtilisateurExiste(PDO $pdo, int $id): array|false
{
    $stmt = $pdo->prepare("SELECT id_user FROM USER_ WHERE id_user = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function supprimerUtilisateur(PDO $pdo, int $id): void
{
    $pdo->prepare("
        DELETE FROM Asso_FAVORITES_GAME
        WHERE id_favorites IN (
            SELECT id_favorites FROM FAVORITES WHERE id_user = :id
        )
    ")->execute(['id' => $id]);

    $pdo->prepare("DELETE FROM FAVORITES WHERE id_user = :id")
        ->execute(['id' => $id]);

    $pdo->prepare("DELETE FROM USER_ WHERE id_user = :id")
        ->execute(['id' => $id]);
}
?>