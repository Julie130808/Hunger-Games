<?php
function obtenirTousLesUtilisateurs(PDO $pdo): array
{
    return $pdo->query("
        SELECT id_user, name, email, created_at
        FROM USER_
        ORDER BY created_at DESC
    ")->fetchAll(PDO::FETCH_ASSOC);
}
?>