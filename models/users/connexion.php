<?php
function trouverUtilisateurParEmail(PDO $pdo, string $email): array|false
{
    $stmt = $pdo->prepare("SELECT * FROM USER_ WHERE email = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch();
}
?>